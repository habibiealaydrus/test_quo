<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuotationIndexController extends Controller
{
    public function salesQuotation ()
    {
        if (Auth::user()->role>6) {
            $data = Quotation::where('quotation.usersId', '=', Auth::user()->id)
            ->leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->select(
                'quotation.*', 
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %b %Y %T') as quotation_date_created"),// memanggil variable tanggal pembuatan quotation
                'users.name as name' // memanggil name dari tabel users sesuai tanggal quotation   
            )
            ->get();
        } else {
            $data = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('compId','=', Auth::user()->compId)
            ->select(
                'quotation.*', 
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %b %Y %T') as quotation_date_created"),// memanggil variable tanggal pembuatan quotation
                'users.name as name' // memanggil name dari tabel users sesuai tanggal quotation   
            )
            ->get();
        }

         return view('/content/quotation/index', [
             'data'  => [
                'quotation' => $data,
                
            ],
        ]);
    }

    public function adminQuotation()
    {
            $data = Quotation::leftJoin('users', 'users.id', '=', 'quotation.usersId')
            // ->leftJoin('company', function ($join) { // Menggunakan Closure untuk kondisi OR
            //     $join->on('company.companyId', '=', 'quotation.compsId')
            //          ->orWhere('company.companyId', '=', 3); // Kondisi OR dengan nilai statis 3
            // })
            ->where('users.compId','=', Auth::user()->compId)
            ->select(
                'quotation.*', 
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %b %Y') as quotation_date_created"),// memanggil variable tanggal pembuatan quotation
                'users.name as name', // memanggil name dari tabel users sesuai tanggal quotation  
            )
            ->get();
            return view('/content/quotation/index', [
            'data'  => [
                'quotation' => $data
            ],
            ]);
    }
    public function allQuotation()
    {
        if (in_array(Auth::user()->role, [1,2,3]))
        {
            $data = Quotation::leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->select(
                'quotation.*', 
                DB::raw("DATE_FORMAT(quotation.created_at, '%d %b %Y') as quotation_date_created"),// memanggil variable tanggal pembuatan quotation
                'users.name as name' // memanggil name dari tabel users sesuai tanggal quotation   
            )
                    ->get();
                    $totalData = count($data);

            return view('/content/quotation/index', [
                'data'  => [
                    'quotation' => $data,
                    'totalData' => $totalData
                ],
            ]);
        }
        else {
            return redirect()->route('notAuthorized')->with('fail', 'Sorry, You do not have the right to access the page!');
        }

    }
}
