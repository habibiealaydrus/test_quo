<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Quotation;
use App\Models\Notification;
use App\Models\QuotationList;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendQuotationMail;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; //penting untuk system download pdf
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class QuotationController extends Controller
{


    public function create()
    {

        $userQuotations = Quotation::where('usersId', Auth::user()->id)->get();

        return view('/content/quotation/create', [
            'data' => [
                'quotation' => $userQuotations,
            ],
        ]);
    }
    public function rent_create()
    {

        $userQuotations = Quotation::where('usersId', Auth::user()->id)->get();

        return view('/content/quotation/rent_create', [
            'data' => [
                'quotation' => $userQuotations,
            ],
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'company' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'totalAll' => 'required|string', // Akan dibersihkan nanti
            'items' => 'required|array|min:1',
            'qty' => 'required|array',
            'price' => 'required|array',
            'disc' => 'required|array',
            'subtotal' => 'required|array',
        ]);

        $user = User::leftJoin('sales_profile', 'sales_profile.usersId', 'users.id')
            ->leftJoin('company', 'company.companyId', 'users.compId')
            ->where('users.id', Auth::user()->id) // Gunakan users.id untuk kejelasan
            ->first();

        if (!$user) {
            return back()->with('fail', 'Profil pengguna yang terautentikasi tidak ditemukan.');
        }

        // Tentukan nomor quotasi berikutnya berdasarkan bulan/tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $lastQuotationInMonth = Quotation::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->first();

        $row = 1; // Default jika tidak ada quotasi bulan ini
        if ($lastQuotationInMonth) {
            // Ekstrak bagian numerik dari quoCode.
            // Asumsi format quoCode adalah contoh: '008/ADK/SL0025-JKT/05/2025'
            $parts = explode('/', $lastQuotationInMonth->quoCode);
            if (count($parts) > 0) {
                $lastNumber = intval($parts[0]); // Ambil '008' dan konversi menjadi 8
                $row = $lastNumber + 1;
            }
        }

        $next = str_pad($row, 3, "0", STR_PAD_LEFT);

        // Penting: quoSlug dan quoCode sebaiknya dibuat secara konsisten.
        // Jika '05/2025' ada di quoCode, created_at seharusnya mencerminkan bulan Mei.
        // Masalahnya adalah ketika nilai-nilai ini tidak sinkron.
        $quoCode = $next . '/' . $user->companyCode . '/' . $user->spCode . '-' . $user->codeArea . '/' . $currentMonth . '/' . $currentYear;
        $quoSlug = Str::slug($next . '-' . $user->companyCode . '-' . $user->spCode . '-' . $user->codeArea . '-' . $currentMonth . '-' . $currentYear);


        $quotation = new Quotation;
        $quotation->quoSlug         = $quoSlug;
        $quotation->quoCode         = $quoCode;
        $quotation->quoCompany      = $request->company;
        $quotation->quoProject      = $request->project;
        $quotation->quoPIC          = $request->customer;
        $quotation->quoContact      = $request->contact;
        $quotation->quoAddress      = $request->address;
        $quotation->quoEmail        = $request->email;
        $quotation->quoTotal        = (float)str_replace(['.', 'Rp', ' '], '', $request->totalAll); // Cast ke float
        $quotation->quoPeriodNote   = $request->notePeriod;
        $quotation->quoPpnNote      = $request->notePpn;
        $quotation->quoTopNote      = $request->noteTop;
        $quotation->quoDeliveryNote = $request->noteDelivery;
        $quotation->quoStockNote    = $request->noteStock;
        $quotation->quoStatus       = 'Submitted';
        $quotation->usersId         = Auth::user()->id;
        $quotation->compsId         = Auth::user()->compId;
        $quotation->save(); // Laravel secara otomatis mengatur created_at dan updated_at di sini

        // Loop melalui item dan simpan ke QuotationList
        $count = count($request->items);
        for ($i = 0; $i < $count; $i++) {
            $dataListItem               = new QuotationList;
            $dataListItem->quoId        = $quotation->quotationId;
            $dataListItem->users        = Auth::user()->name; // Kolom 'users' ini di QuotationList tampaknya redundan jika Anda memiliki usersId di Quotation
            $dataListItem->code         = $quotation->quoCode; // Kolom 'code' ini juga tampaknya redundan
            $dataListItem->item         = ucfirst($request->items[$i]);
            $dataListItem->quantity     = $request->qty[$i];
            $dataListItem->price        = (float)str_replace('.', '', $request->price[$i]);
            $dataListItem->discount     = $request->disc[$i];
            $dataListItem->subtotal     = (float)str_replace('.', '', $request->subtotal[$i]);
            $dataListItem->save();
        }

        // Pembuatan Notifikasi
        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]'; // Pertimbangkan untuk menggunakan relasi many-to-many yang tepat atau `json_encode`
        $dataNotification->compsId = '[0,' . $quotation->compsId . ']'; // Pertimbangkan untuk menggunakan json_encode
        $dataNotification->quotId = $quotation->quotationId;
        $dataNotification->title = 'Create : New Quotation';
        $dataNotification->content = 'Quotation Code : ' . $quotation->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/' . $quotation->quoSlug);
        $dataNotification->save();

        // Siapkan data untuk email
        // $listQuotation = QuotationList::where('quoId', $quotation->quotationId)->get(); // Query yang lebih sederhana
        // $listQuotationArray = $listQuotation->map(function ($item) {
        //     return [
        //         'id' => $item->quLiId,
        //         'item' => $item->item,
        //         'qty' => $item->quantity,
        //         'price' => $item->price,
        //         'discount' => $item->discount,
        //         'net' => $item->subtotal,
        //     ];
        // })->toArray();

        // $emailData = [
        //     'title'        => 'New Quotation',
        //     'subtitle'     => $quotation->quoCode,
        //     'sales'        => Auth::user()->name,
        //     'email'        => Auth::user()->email, // Ini adalah email pengirim
        //     'customer'     => $quotation->quoPIC,
        //     'address'      => $quotation->quoAddress,
        //     'customer_email' => $quotation->quoEmail, // Gunakan kunci yang berbeda untuk email pelanggan
        //     'company'      => $quotation->quoCompany,
        //     'project'      => $quotation->quoProject,
        //     'total'        => number_format($quotation->quoTotal),
        //     'date'         => $quotation->created_at->format('d F, Y'), // Gunakan format Carbon
        //     'periodNote'   => $quotation->quoPeriodNote,
        //     'ppnNote'      => $quotation->quoPpnNote,
        //     'topNote'      => $quotation->quoTopNote,
        //     'deliveryNote' => $quotation->quoDeliveryNote,
        //     'stockNote'    => $quotation->quoStockNote,
        //     'items'        => $listQuotationArray,
        //     'link'         => url('quotation/viewQuotation/' . $quotation->quoSlug),
        // ];

        // try {
        //     // Dapatkan pengguna di perusahaan yang sama dengan peran > 3
        //     $usersInCompany = User::where('compId', $quotation->compsId)->where('role', '>', 3)->get();
        //     foreach ($usersInCompany as $user) {
        //          Mail::to($user->email)->send(new QuotationMail($emailData));
        //      }

        //     // Dapatkan pengguna dengan peran 3
        //      $roleThreeUsers = User::where('role', 3)->get();
        //      foreach ($roleThreeUsers as $user) {
        //          Mail::to($user->email)->send(new QuotationMail($emailData));
        //      }
        // } catch (\Exception $e) {
        //     Log::error("Pengiriman email gagal: " . $e->getMessage(), ['quotation_id' => $quotation->quotationId]);
        //     return redirect('quotation/viewQuotation/' . $quotation->quoSlug)->with('fail', '👋 Quotation Baru ' . $quotation->quoCode . ' Berhasil Dibuat, tetapi Pengiriman Email Gagal. Error: ' . $e->getMessage());
        // }

        return redirect('quotation/viewQuotation/' . $quotation->quoSlug)->with('success', '👋 Quotation Baru ' . $quotation->quoCode . ' Berhasil Dibuat dan Dikirim Melalui Email');
    }

    public function rentStore(Request $request)
    {

        $request->validate([
            'company' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'totalAll' => 'required|string', // Akan dibersihkan nanti
            'items' => 'required|array|min:1',
            'qty' => 'required|array',
            'price' => 'required|array',
            'disc' => 'required|array',
            'subtotal' => 'required|array',
        ]);

        $user = User::leftJoin('sales_profile', 'sales_profile.usersId', 'users.id')
            ->leftJoin('company', 'company.companyId', 'users.compId')
            ->where('users.id', Auth::user()->id) // Gunakan users.id untuk kejelasan
            ->first();


        if (!$user) {
            return back()->with('fail', 'Profil pengguna yang terautentikasi tidak ditemukan.');
        }

        // Tentukan nomor quotasi berikutnya berdasarkan bulan/tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $lastQuotationInMonth = Quotation::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->first();

        $row = 1; // Default jika tidak ada quotasi bulan ini
        if ($lastQuotationInMonth) {
            // Ekstrak bagian numerik dari quoCode.
            // Asumsi format quoCode adalah contoh: '008/ADK/SL0025-JKT/05/2025'
            $parts = explode('/', $lastQuotationInMonth->quoCode);
            if (count($parts) > 0) {
                $lastNumber = intval($parts[0]); // Ambil '008' dan konversi menjadi 8
                $row = $lastNumber + 1;
            }
        }
        $lastQuoId = $lastQuotationInMonth->quotationId;
        $next = str_pad($row, 3, "0", STR_PAD_LEFT);
        $kodeCompany = (Auth::user()->compId == 1) ? "M" : "A";

        $quoCode = $next . '/' . "R-" . $user->kode_cabang . '/' . $kodeCompany . '/' . $user->spCode . '/' . $currentMonth . '/' . $currentYear;
        $quoSlug = Str::slug($next . '-' . "R-" . $user->kode_cabang . '-' . $kodeCompany . '-' . $user->spCode . '-' . $currentMonth . '-' . $currentYear);


        $quotation = new Quotation;


        $quotation->quoSlug         = $quoSlug;
        $quotation->quoCode         = $quoCode;
        $quotation->quoCompany      = $request->company;
        $quotation->quoProject      = $request->project;
        $quotation->quoPIC          = $request->customer;
        $quotation->quoContact      = $request->contact;
        $quotation->quoAddress      = $request->address;
        $quotation->quoEmail        = $request->email;
        $quotation->quoTotal        = (float)str_replace(['.', 'Rp', ' '], '', $request->totalAll); // Cast ke float
        $quotation->quoPeriodNote   = $request->notePeriod;
        $quotation->quoPpnNote      = $request->notePpn;
        $quotation->quoTopNote      = $request->noteTop;
        $quotation->quoDeliveryNote = $request->noteDelivery;
        $quotation->quoStockNote    = $request->noteStock;
        $quotation->quoStatus       = 'Submitted';
        $quotation->usersId         = Auth::user()->id;
        $quotation->compsId         = "3";
        $quotation->save(); // Laravel secara otomatis mengatur created_at dan updated_at di sini

        // Loop melalui item dan simpan ke QuotationList
        $count = count($request->items);

        for ($i = 0; $i < $count; $i++) {

            $dataListItem = new QuotationList;
            $dataListItem->quoId        = $quotation->quotationId;
            $dataListItem->users        = Auth::user()->name;
            $dataListItem->code         = $quotation->quoCode;
            $dataListItem->item         = ucfirst($request->items[$i]);
            $dataListItem->quantity     = $request->qty[$i];
            $dataListItem->price        = (float)str_replace('.', '', $request->price[$i]);
            $dataListItem->discount     = $request->disc[$i];
            $dataListItem->subtotal     = (float)str_replace('.', '', $request->subtotal[$i]);

            $dataListItem->save();
        }


        // Pembuatan Notifikasi
        $lastIdNotif = Notification::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->first();

        $lastIdNtf = $lastIdNotif ? $lastIdNotif->notification_id : 0;

        $dataNotification = new Notification;
        $dataNotification->notification_id = $lastIdNtf + 1; // ✅ diperbaiki
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]'; // Pertimbangkan untuk menggunakan relasi many-to-many yang tepat atau `json_encode`
        $dataNotification->compsId = '[0,' . "MLC" . ']'; // Pertimbangkan untuk menggunakan json_encode
        $dataNotification->quotId = $quotation->quotationId;
        $dataNotification->title = 'Create : New Quotation';
        $dataNotification->content = 'Quotation Code : ' . $quotation->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/' . $quotation->quoSlug);
        $dataNotification->save();

        // Siapkan data untuk email
        // $listQuotation = QuotationList::where('quoId', $quotation->quotationId)->get(); // Query yang lebih sederhana
        // $listQuotationArray = $listQuotation->map(function ($item) {
        //     return [
        //         'id' => $item->quLiId,
        //         'item' => $item->item,
        //         'qty' => $item->quantity,
        //         'price' => $item->price,
        //         'discount' => $item->discount,
        //         'net' => $item->subtotal,
        //     ];
        // })->toArray();

        // $emailData = [
        //     'title'        => 'New Quotation',
        //     'subtitle'     => $quotation->quoCode,
        //     'sales'        => Auth::user()->name,
        //     'email'        => Auth::user()->email, // Ini adalah email pengirim
        //     'customer'     => $quotation->quoPIC,
        //     'address'      => $quotation->quoAddress,
        //     'customer_email' => $quotation->quoEmail, // Gunakan kunci yang berbeda untuk email pelanggan
        //     'company'      => $quotation->quoCompany,
        //     'project'      => $quotation->quoProject,
        //     'total'        => number_format($quotation->quoTotal),
        //     'date'         => $quotation->created_at->format('d F, Y'), // Gunakan format Carbon
        //     'periodNote'   => $quotation->quoPeriodNote,
        //     'ppnNote'      => $quotation->quoPpnNote,
        //     'topNote'      => $quotation->quoTopNote,
        //     'deliveryNote' => $quotation->quoDeliveryNote,
        //     'stockNote'    => $quotation->quoStockNote,
        //     'items'        => $listQuotationArray,
        //     'link'         => url('quotation/viewQuotation/' . $quotation->quoSlug),
        // ];

        // try {
        //     // Dapatkan pengguna di perusahaan yang sama dengan peran > 3
        //     $usersInCompany = User::where('compId', $quotation->compsId)->where('role', '>', 3)->get();
        //     foreach ($usersInCompany as $user) {
        //          Mail::to($user->email)->send(new QuotationMail($emailData));
        //      }

        //     // Dapatkan pengguna dengan peran 3
        //      $roleThreeUsers = User::where('role', 3)->get();
        //      foreach ($roleThreeUsers as $user) {
        //          Mail::to($user->email)->send(new QuotationMail($emailData));
        //      }
        // } catch (\Exception $e) {
        //     Log::error("Pengiriman email gagal: " . $e->getMessage(), ['quotation_id' => $quotation->quotationId]);
        //     return redirect('quotation/viewQuotation/' . $quotation->quoSlug)->with('fail', '👋 Quotation Baru ' . $quotation->quoCode . ' Berhasil Dibuat, tetapi Pengiriman Email Gagal. Error: ' . $e->getMessage());
        // }

        return redirect('quotation/viewQuotation/' . $quotation->quoSlug)->with('success', '👋 Quotation Baru ' . $quotation->quoCode . ' Berhasil Dibuat dan Dikirim Melalui Email');
    }

    public function editQuotation($slug)
    {
        $data['quotation'] = Quotation::leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftJoin('roles', 'roles.rolesId', '=', 'users.role')
            ->leftJoin('sales_profile', 'sales_profile.usersId', '=', 'users.id')
            ->leftJoin('company', 'company.companyId', '=', 'quotation.compsId')
            ->leftJoin('users AS supervisor', 'supervisor.id', '=', 'users.id_direct_supervisor')
            ->leftJoin('sales_profile AS supervisor_profile', 'supervisor_profile.usersId', '=', 'supervisor.id')
            ->leftJoin('roles AS supervisorRole', 'supervisorRole.rolesId', '=', 'supervisor.role') // ✅ ini yang benar
            ->select(
                'quotation.*',
                'users.*',
                'company.*',
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %M %Y') as quotation_date_created"),
                'users.name as name',
                'sales_profile.spPhone as spPhone',
                'roles.rolesName as rolesName',
                'supervisor.name AS supervisor_name',
                'supervisorRole.rolesName AS supervisor_role_name'
            )
            ->where('quoSlug', '=', $slug)
            ->first();
        if (!$data['quotation']) {
            return redirect()->route('errorPage')->with('fail', 'Quotation tidak ditemukan.'); // Tangani jika tidak ditemukan
        }
        $data['items'] = QuotationList::leftJoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
            ->where('quotation_list.quoId', '=', $data['quotation']->quotationId)
            ->first();
        $list = QuotationList::leftJoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
            ->where('quotation_list.quoId', '=', $data['quotation']->quotationId)
            ->get();
        $data['lizt'] = [];
        foreach ($list as $item) { // Gunakan foreach yang lebih sederhana
            $data['lizt'][] = [
                'qLId' => $item->quLiId,
                'code' => $item->code,
                'items' => $item->item,
                'desc' => $item->description,
                'qty' => $item->quantity,
                'price' => $item->price,
                'disc' => $item->discount,
                'net' => $item->subtotal,
                'img' => $item->image,
            ];
        }
        //QRcode Generator
        $nama_company = $data['quotation']->companyName;
        $nama_sales_qr = $data['quotation']->name;
        $no_quotation = $data['quotation']->quoCode;
        $jabatan = $data['quotation']->rolesName;
        $tgl_penawaran = $data['quotation']->quotation_date_created;
        $sales_wa = $data['quotation']->spPhone;
        $nama_spv = $data['quotation']->supervisor_name;
        $jabatan_spv = $data['quotation']->supervisor_role_name;

        $data_qr_sales =
            "Perusahaan: " . $nama_company . " ,"
            . "Nama: " . $nama_sales_qr . " ,"
            . "No.Telepon: " . $sales_wa . " ,"
            . "No.quotation: " . $no_quotation . " ,"
            . "Jabatan: " . $jabatan . " ,"
            . "Tgl.Penawaran: " . $tgl_penawaran;

        $data_qr_spv =
            "Nama: " . $nama_spv . " ,"
            . "Jabatan: " . $jabatan_spv . " ,";

        $qr_sales = QrCode::size(150)->generate($data_qr_sales);
        $qr_spv = QrCode::size(150)->generate($data_qr_spv);

        if (
            $data['quotation']->usersId == Auth::user()->id
            || $data['quotation']->companyId == Auth::user()->compId // Ini mungkin salah. Seharusnya compsId?
            || Auth::user()->role = 4
        ) {
            return view('/content/quotation/edit', [
                'data' => $data,
                'qr_sales' => $qr_sales,
                'qr_spv' => $qr_spv
            ]);
        } else {
            return redirect()->route('notAuthorized')->with('fail', 'Maaf, Quotation bukan milik Anda!');
        }
    }


    public function updateQuotation(Request $request)
    {
        $request->validate([
            'idQ' => 'required|exists:quotation,quotationId',
            'items' => 'required|array|min:1',
        ]);

        $user = Auth::user()->name;
        $itemIds    = $request->itemId ?? [];
        $itemCode   = $request->itemCode ?? [];
        $items      = $request->items ?? [];
        $descs      = $request->desc ?? [];
        $qtys       = $request->qty ?? [];
        $prices     = $request->price ?? [];
        $discs      = $request->disc ?? [];
        $images     = $request->file('img') ?? [];
        $subtotals  = $request->net ?? [];

        foreach ($items as $i => $itemName) {
            if (isset($itemIds[$i]) && !empty($itemIds[$i])) {
                $dataListItem = QuotationList::find($itemIds[$i]);
                if (!$dataListItem) continue;

                $dataListItem->quoId         = $request->idQ;
                $dataListItem->item          = ucfirst($itemName);

                $dataListItem->code          = $itemCode[$i];
                $dataListItem->description   = ucfirst($descs[$i] ?? '');
                $dataListItem->quantity      = $qtys[$i] ?? 0;
                $dataListItem->price         = (float) str_replace('.', '', $prices[$i] ?? 0);
                $dataListItem->discount      = $discs[$i] ?? 0;
                $dataListItem->subtotal = (float) str_replace(['Rp', "\u{A0}", '.'], '', $subtotals[$i] ?? 0);

                if (isset($images[$i]) && $images[$i] instanceof \Illuminate\Http\UploadedFile) {
                    // Hapus gambar lama jika ada dan tersimpan di disk 'public'
                    if ($dataListItem->image) {
                        $oldImagePath = 'media/image/quotation_item/' . $dataListItem->image;
                        if (Storage::disk('public')->exists($oldImagePath)) { // <-- Perubahan di sini
                            Storage::disk('public')->delete($oldImagePath); // <-- Perubahan di sini
                        }
                    }

                    $filename = time() . '_' . $images[$i]->getClientOriginalName();
                    // Simpan gambar baru menggunakan Storage Facade
                    Storage::disk('public')->putFileAs('media/image/quotation_item', $images[$i], $filename); // <-- Perubahan di sini
                    $dataListItem->image = $filename;
                }

                $dataListItem->save();
            }
        }
        foreach ($items as $i => $itemName) {
            if (!isset($itemIds[$i]) || empty($itemIds[$i])) {
                $newItem = new QuotationList();
                $newItem->quoId         = $request->idQ;
                $newItem->item          = ucfirst($itemName);
                $newItem->users         = $user;
                $newItem->code          = $itemCode[$i];
                $newItem->description   = ucfirst($descs[$i] ?? '');
                $newItem->quantity      = $qtys[$i] ?? 0;
                $newItem->price         = (float) str_replace('.', '', $prices[$i] ?? 0);
                $newItem->discount      = $discs[$i] ?? 0;
                $newItem->subtotal = (float) str_replace(['Rp', "\u{A0}", '.'], '', $subtotals[$i] ?? 0);

                if (isset($images[$i]) && $images[$i] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . $images[$i]->getClientOriginalName();
                    // Simpan gambar baru menggunakan Storage Facade
                    Storage::disk('public')->putFileAs('media/image/quotation_item', $images[$i], $filename);
                    $newItem->image = $filename;
                }

                $newItem->save();
            }
        }
        $quotation = Quotation::find($request->idQ);
        if (!$quotation) {
            return back()->with('fail', 'Quotation tidak ditemukan.');
        }

        $total = (int) str_replace(['Rp', '.', "\u{A0}"], '', $request->totalAll);

        $quotation->quoTotal        = $total;
        $quotation->quoCompany      = $request->quoCompany;
        $quotation->quoProject      = $request->quoProject;
        $quotation->quoPIC          = $request->quoPIC;
        $quotation->quoContact      = $request->quoContact;
        $quotation->quoAddress      = $request->quoAddress;
        $quotation->quoPeriodNote   = $request->notePeriod;
        $quotation->quoPpnNote      = $request->notePpn;
        $quotation->quoTopNote      = $request->noteTop;
        $quotation->quoDeliveryNote = $request->noteDelivery;
        $quotation->quoStockNote    = $request->noteStock;

        $quotation->save();

        // --- Notification ---
        Notification::create([
            'usersId'    => Auth::id(),
            'rolesId'    => '[1,2,3,4,5,6,7]',
            'compsId'    => '[0,' . $quotation->compsId . ']',
            'quotId'     => $quotation->quotationId,
            'title'      => 'Update : Quotation',
            'content'    => 'Quotation Code : ' . $quotation->quoCode,
            'follup_url' => url('/quotation/viewQuotation/' . $quotation->quoSlug),
        ]);

        return redirect('quotation/viewQuotation/' . $quotation->quoSlug)
            ->with('success', '👋 Quotation ' . $quotation->quoCode . ' berhasil diperbarui.');
    }


    public function addDescription(Request $request)
    {

        $request->validate([
            'quLiId' => 'required|exists:quotation_list,quLiId',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'idCompany' => 'required|integer',
            'idQuot' => 'required|integer',
            'idCode' => 'required|string',
            'idSlug' => 'required|string',
        ]);
        $description = QuotationList::find($request->quLiId);
        if (!$description) {
            return back()->with('fail', 'Item Quotation List tidak ditemukan.');
        }

        $description->description = $request->desc;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('media/image/quotation_item', $file, $filename);
            $description->image = $filename;
        }
        $description->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId = '[0,' . $request->idCompany . ']';
        $dataNotification->quotId = $request->idQuot;
        $dataNotification->title = 'Add Description : Quotation';
        $dataNotification->content = 'Quotation Code : ' . $request->idCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/' . $request->idSlug);
        $dataNotification->save();

        return back()->with('success', '👋 Deskripsi berhasil Dikirimkan.');
    }

    public function viewQuotation(Request $request, $slug)
    {

        $quotation = Quotation::leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftJoin('roles', 'roles.rolesId', '=', 'users.role')
            ->leftJoin('sales_profile', 'sales_profile.usersId', '=', 'users.id')
            ->leftJoin('company', 'company.companyId', '=', 'quotation.compsId')
            ->leftJoin('users AS supervisor', 'supervisor.id', '=', 'users.id_direct_supervisor')
            ->leftJoin('sales_profile AS supervisor_profile', 'supervisor_profile.usersId', '=', 'supervisor.id')
            ->leftJoin('roles AS supervisorRole', 'supervisorRole.rolesId', '=', 'supervisor.role') // ✅ ini yang benar
            ->select(
                'quotation.*',
                'users.*',
                'company.*',
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %M %Y') as quotation_date_created"),
                'users.name as name',
                'sales_profile.spPhone as spPhone',
                'roles.rolesName as rolesName',
                'supervisor.name AS supervisor_name',
                'supervisorRole.rolesName AS supervisor_role_name'
            )
            ->where('quoSlug', '=', $slug)
            ->first();
        if (!$quotation) {

            return redirect()->route('allQuotation')->with('fail', 'Quotation tidak ditemukan!');
        }
        // Log::info('--- Debugging viewQuotation untuk slug: ' . $slug . ' ---');
        // Log::info('ID Quotation yang diambil: ' . $quotation->quotationId);
        // Log::info('quoCode Quotation yang diambil: ' . $quotation->quoCode);
        // Log::info('Quotation created_at (Carbon): ' . $quotation->created_at);
        //Log::info('Quotation created_at (toDateTimeString): ' . $quotation->created_at->toDateTimeString());

        $data['quotation'] = $quotation;

        //QRcode
        $nama_company = $data['quotation']->companyName;
        $nama_sales_qr = $data['quotation']->name;
        $no_quotation = $data['quotation']->quoCode;
        $jabatan = $data['quotation']->rolesName;
        $tgl_penawaran = $data['quotation']->quotation_date_created;
        $tlp_sales = $data['quotation']->spPhone;
        $nama_spv = $data['quotation']->supervisor_name;
        $jabatan_spv = $data['quotation']->supervisor_role_name;


        $data_qr_sales =
            "Perusahaan: " . $nama_company . " ,"
            . "Nama: " . $nama_sales_qr . " ,"
            . "Telepon: " . $tlp_sales . " ,"
            . "No.quotation: " . $no_quotation . " ,"
            . "Jabatan: " . $jabatan . " ,"
            . "Tgl.Penawaran: " . $tgl_penawaran;

        $data_qr_spv =
            "Nama: " . $nama_spv . " ,"
            . "Jabatan: " . $jabatan_spv . " ,";



        $qr_sales = QrCode::size(150)->generate($data_qr_sales);
        $qr_spv = QrCode::size(150)->generate($data_qr_spv);

        $data['items'] = QuotationList::where('quoId', '=', $data['quotation']->quotationId)->first();


        $list = QuotationList::where('quoId', '=', $data['quotation']->quotationId)->get();

        $data['lizt'] = $list->map(function ($item) {
            return [
                'quLiId' => $item->quLiId,
                'items' => $item->item,
                'desc' => $item->description,
                'qty' => $item->quantity,
                'price' => $item->price,
                'disc' => $item->discount,
                'net' => $item->subtotal,
                'image' => $item->image,
            ];
        })->toArray();


        if (
            $data['quotation']->usersId == Auth::user()->id
            || $data['quotation']->compsId == Auth::user()->compId
            || $data['quotation']->compsId == 3
            || Auth::user()->role < 4
        ) {
            return view('/content/quotation/view', [
                'data' => $data,
                'qr_sales' => $qr_sales,
                'qr_spv' => $qr_spv
            ]);
        } else {
            return redirect()->route('notAuthorized')->with('fail', 'Maaf, Quotation bukan milik Anda!');
        }
    }

    public function deleteQuotation($id)
    {
        $targetDeletedQuot = Quotation::findOrfail($id);
        $targetDeletedQuot->delete();
        return redirect()->back()->with('success', 'Quotation Berhasil dihapus.');
    }

    public function deleteItemQuotation($id)
    {
        $targetItem = QuotationList::findOrFail($id);

        // Hapus gambar jika ada
        if ($targetItem->img) {
            $imagePath = public_path('media/image/quotation_item/' . $targetItem->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Hapus item dari database
        $targetItem->delete();

        // Redirect ke halaman edit dengan pesan sukses
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }

    public function canceledProcess(Request $request)
    {
        $request->validate([
            'quotationId' => 'required|exists:quotation,quotationId',
        ]);

        $canceledProcess = Quotation::find($request->quotationId);
        if (!$canceledProcess) {
            return back()->with('fail', 'Quotation tidak ditemukan.');
        }

        $canceledProcess->quoStatus = 'Canceled';
        $canceledProcess->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId = '[0,' . $canceledProcess->compsId . ']';
        $dataNotification->quotId = $canceledProcess->quotationId;
        $dataNotification->title = 'Cancel : Quotation';
        $dataNotification->content = 'Quotation Code : ' . $canceledProcess->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/' . $canceledProcess->quoSlug);
        $dataNotification->save();

        return back()->with('success', '👋 Status Quotation ' . $canceledProcess->quoCode . ' sekarang Dibatalkan');
    }

    public function sendQuotation(Request $request)
    {
        // Validasi input (opsional tapi sangat disarankan)
        $request->validate([
            'idQuo' => 'required|exists:quotation,quotationId',
            'emailTo' => 'required|email',
            'subjekEmail' => 'required|string',
            'nameTo' => 'required|string',
            'pesanEmail' => 'required|string',
        ]);
        // Ambil data quotation dan relasi terkait
        $quotation = Quotation::leftJoin('quotation_list', 'quotation_list.quoId', '=', 'quotation.quotationId')
            ->leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftJoin('sales_profile', 'sales_profile.usersId', '=', 'users.id')
            ->leftJoin('roles', 'roles.rolesId', '=', 'users.role')
            ->leftJoin('company', 'company.companyId', '=', 'quotation.compsId')
            ->leftJoin('users AS supervisor', 'supervisor.id', '=', 'users.id_direct_supervisor')
            ->leftJoin('sales_profile AS supervisor_profile', 'supervisor_profile.usersId', '=', 'supervisor.id')
            ->leftJoin('roles AS supervisorRole', 'supervisorRole.rolesId', '=', 'supervisor.role')
            ->select(
                'quotation.quotationId',
                'quotation.quoCode',
                'quotation.quoPIC',
                'quotation.quoAddress',
                'quotation.quoCompany',
                'quotation.quoProject',
                'quotation.quoContact',
                'quotation.quoTotal',
                'quotation.quoPeriodNote',
                'quotation.quoPpnNote',
                'quotation.quoTopNote',
                'quotation.quoDeliveryNote',
                'quotation.quoStockNote',
                'quotation.quoEmail as email_costumer',
                'quotation.created_at as quotation_created_at',
                'company.companyId as compsId',
                'company.companyName as companyName', // ✅ Ditambahkan
                'users.name as sales_name',
                'users.address_office as address_office',
                'users.phone_office as phone_office',
                'users.website_office as website_office',
                'users.email_office as email_office',
                'users.email as sales_email',
                'users.nama_wilayah as wilayah',
                'sales_profile.spTtdCode as spTtdCode',
                'sales_profile.spPhone as sales_wa',
                'roles.rolesName as rolesName',
                'supervisor.name AS supervisor_name',
                'supervisorRole.rolesName AS supervisor_role_name'
            )
            ->where('quotation.quotationId', '=', $request->idQuo)
            ->first();
        // Cek jika data tidak ditemukan
        if (!$quotation) {
            return back()->with('error', 'Data quotation tidak ditemukan.');
        }
        // Ambil daftar item quotation
        $listQuotation = QuotationList::where('quotation_list.quoId', '=', $quotation->quotationId)->get();
        $listQuotationArray = [];
        foreach ($listQuotation as $item) {
            $listQuotationArray[] = [
                'id' => $item->quLiId,
                'item' => $item->item,
                'qty' => $item->quantity,
                'price' => $item->price,
                'disc' => $item->discount,
                'desc' => $item->description,
                'net' => $item->subtotal,
                'image' => $item->image,
            ];
        }
        // Data pengirim (sales)
        $sender = User::find(Auth::id());

        // QR Code string (sudah include di data)
        $data_qr_sales =
            "Perusahaan: " . $quotation->supervisor_name . " ,"
            . "Nama: " . $quotation->sales_name . " ,"
            . "Telepon: " . $quotation->sales_wa . " ,"
            . "No.quotation: " . $quotation->quoCode . " ,"
            . "Jabatan: " . $quotation->rolesName . " ,"
            . "Tgl.Penawaran: " . $quotation->quotation_created_at . " ,";

        $data_qr_spv =
            "Nama: " . $quotation->supervisor_name . " ,"
            . "Jabatan: " . $quotation->supervisor_role_name . " ,";

        $qr_sales = QrCode::size(150)->generate($data_qr_sales);
        $qr_spv = QrCode::size(150)->generate($data_qr_spv);
        $qr_base64_image_sales = 'data:image/png;base64,' . base64_encode($qr_sales);
        $qr_base64_image_spv = 'data:image/png;base64,' . base64_encode($qr_spv);


        // Data untuk dikirim ke email/view
        $data = [
            'receiver' => $request->emailTo,
            'subjekEmail' => $request->subjekEmail,
            'fileName' => 'Quotation No. : ' . $quotation->quoCode . '.pdf',
            'pesanEmail' => 'Dear ' . htmlspecialchars($request->nameTo) . ',<br/>' .
                nl2br(htmlspecialchars($request->pesanEmail)) .
                '<br/><br/><b><u>Best Regards,</u></b><br/><b>' . $sender->name . '</b>',
            'title' => 'Quotation',
            'code' => $quotation->quoCode,
            'comp' => $quotation->compsId,
            'pic' => $quotation->quoPIC,
            'address' => $quotation->quoAddress,
            'company' => $quotation->quoCompany,
            'project' => $quotation->quoProject,
            'contact' => $quotation->quoContact,
            'date' => date('d F, Y', strtotime($quotation->quotation_created_at)),
            'total' => $quotation->quoTotal,
            'periodNote' => $quotation->quoPeriodNote,
            'ppnNote' => $quotation->quoPpnNote,
            'topNote' => $quotation->quoTopNote,
            'deliveryNote' => $quotation->quoDeliveryNote,
            'stockNote' => $quotation->quoStockNote,
            'items' => $listQuotationArray,
            'sales' => $quotation->sales_name, // ✅ Perbaikan
            'sales_wa' => $quotation->sales_wa,
            'supervisor_name' => $quotation->supervisor_name,
            'supervisor_role_name' => $quotation->supervisor_role_name,
            'codeTtd' => $quotation->spTtdCode,
            'role' => $quotation->rolesName,
            'email_costumer' => $quotation->email_costumer,
            'email_sales' => $quotation->sales_email,
            'wilayah' => $quotation->wilayah,
            'email_office' => $quotation->email_office,
            'address_office' => $quotation->address_office,
            'phone_office' => $quotation->phone_office,
            'website_office' => $quotation->website_office,
            'qr_sales' => $qr_base64_image_sales,
            'qr_spv' => $qr_base64_image_spv,
        ];
        // Kirim email and cc email ke sales

        Mail::cc($data['email_sales'])->send(new SendQuotationMail($data));
        return back()->with('success', '👋 Email has Sent Successfully');
    }


    public function createPDF($slug) //fixed
    {
        // 1. Pengambilan Data Quotation
        // Menggunakan leftJoin untuk mendapatkan semua informasi yang relevan dalam satu query.
        $quotation = Quotation::leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftJoin('sales_profile', 'sales_profile.usersId', '=', 'users.id')
            ->leftJoin('roles', 'roles.rolesId', '=', 'users.role')
            ->leftJoin('company', 'company.companyId', '=', 'quotation.compsId')
            ->leftJoin('users AS supervisor', 'supervisor.id', '=', 'users.id_direct_supervisor')
            ->leftJoin('sales_profile AS supervisor_profile', 'supervisor_profile.usersId', '=', 'supervisor.id')
            ->leftJoin('roles AS supervisorRole', 'supervisorRole.rolesId', '=', 'supervisor.role') // ✅ ini yang benar
            ->select(
                'quotation.*', // Ambil semua kolom dari tabel quotation
                'users.address_office as company_address_office', // Ambil kolom dari tabel users
                'users.phone_office as company_phone_office', // Ambil kolom dari tabel users
                'users.website_office as company_website_office', // Ambil kolom dari tabel users
                'users.name as sales_name', // Alias untuk nama sales
                'users.email as sales_email', // Alias untuk email sales
                'users.email_office as email_office', // Alias untuk email office
                'users.nama_wilayah as wilayah', // Alias untuk email office
                'sales_profile.spTtdCode as spTtdCode',
                'sales_profile.spPhone as spPhone', // Nomor WA sales
                'roles.rolesName as rolesName', // Nama peran sales
                'company.*',
                'supervisor.name AS supervisor_name',
                'supervisorRole.rolesName AS supervisor_role_name',
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %M %Y') as quotation_date_created"), // memanggil variable tanggal pembuatan quotation
            )
            ->where('quotation.quoSlug', '=', $slug)
            ->first();


        // Tangani jika quotation tidak ditemukan
        if (!$quotation) {
            return redirect()->route('dashboard')->with('fail', 'Quotation tidak ditemukan untuk pembuatan PDF.');
        }

        // 2. Pengambilan Data Item Quotation
        $listQuotation = QuotationList::where('quoId', $quotation->quotationId)->get();
        $listQuotationArray = $listQuotation->map(function ($item) {
            return [
                'id' => $item->quLiId,
                'item' => $item->item,
                'qty' => $item->quantity,
                'price' => $item->price,
                'disc' => $item->discount,
                'desc' => $item->description,
                'net' => $item->subtotal,
                'image' => $item->image,
            ];
        })->toArray();


        $sender = Auth::user();

        //QRcode Generator
        $nama_company = $quotation->companyName;
        $nama_sales_qr = $quotation->sales_name;
        $no_quotation = $quotation->quoCode;
        $jabatan = $quotation->rolesName;
        $tgl_penawaran = $quotation->quotation_date_created;
        $sales_phone = $quotation->spPhone;
        $nama_spv = $quotation->supervisor_name;
        $jabatan_spv = $quotation->supervisor_role_name;

        $data_qr_sales =
            "Perusahaan: " . $nama_company . " ,"
            . "Nama: " . $nama_sales_qr . " ,"
            . "Telepon: " . $sales_phone . " ,"
            . "No.quotation: " . $no_quotation . " ,"
            . "Jabatan: " . $jabatan . " ,"
            . "Tgl.Penawaran: " . $tgl_penawaran . " ,";

        $data_qr_spv =
            "Nama: " . $nama_spv . " ,"
            . "Jabatan: " . $jabatan_spv . " ,";

        $qr_sales = QrCode::size(150)->generate($data_qr_sales);
        $qr_sales_base64_image = 'data:image/png;base64,' . base64_encode($qr_sales); // Tambahkan awalan dan encode ke Base64

        $qr_spv = QrCode::size(150)->generate($data_qr_spv);
        $qr_spv_base64_image = 'data:image/png;base64,' . base64_encode($qr_spv); // Tambahkan awalan dan encode ke Base64


        $data = [
            'fileName' => 'Quotation No. : ' . $quotation->quoCode . '.pdf',
            'title' => 'Quotation',
            'code' => $quotation->quoCode,
            'comp' => $quotation->compsId,
            'company_name' => $quotation->company_name,
            'pic' => $quotation->quoPIC,
            'address' => $quotation->quoAddress,
            'company' => $quotation->quoCompany,
            'project' => $quotation->quoProject,
            'contact' => $quotation->quoContact,
            'email' => $quotation->quoEmail,
            'date' => $quotation->quotation_date_created,
            'total' => $quotation->quoTotal,
            'periodNote' => $quotation->quoPeriodNote,
            'ppnNote' => $quotation->quoPpnNote,
            'topNote' => $quotation->quoTopNote,
            'deliveryNote' => $quotation->quoDeliveryNote,
            'stockNote' => $quotation->quoStockNote,
            'items' => $listQuotationArray,
            'sales' => $quotation->sales_name,
            'role' => $quotation->rolesName,
            'codeTtd' => $quotation->spTtdCode,
            'sales_address' => $quotation->company_address_office,
            'sales_phone_office' => $quotation->company_phone_office,
            'sales_website_office' => $quotation->company_website_office,
            'email_office' => $quotation->email_office,
            'sales_wa' => $quotation->spPhone,
            'sales_email' => $quotation->sales_email,
            'wilayah' => $quotation->wilayah,
            'spv_name' => $quotation->supervisor_name,
            'spv_role_name' => $quotation->supervisor_role_name,
        ];


        //6. Muat View dan Hasilkan PDF
        view()->share('data', $data);
        view()->share('qr_sales', $qr_sales_base64_image);
        view()->share('qr_spv', $qr_spv_base64_image);
        $pdf = PDF::loadView('quotation')->setPaper('a4', 'portrait');

        // 7. Unduh PDF
        return $pdf->download('Quotation_' . $quotation->quoSlug . '.pdf');
    }
}
