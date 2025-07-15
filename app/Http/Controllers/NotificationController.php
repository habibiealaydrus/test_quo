<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\Quotation;
use App\Models\User;
use DB; 
use Carbon; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $role = $user->role;
        $compId = $user->compId;
        $dateNow = now()->toDateString();
        $startDate = now()->subDays(30)->toDateString();
    
        $notif = collect(); // default kosong
    
        if (in_array($role, [1, 2, 3])) {
            // Admin - bisa lihat semua
            $notif = Notification::leftJoin('users', 'users.id', '=', 'notification.usersId')
                ->select('notification.*', 'users.name as user_name')
                ->whereBetween(DB::raw('DATE(notification.created_at)'), [$startDate, $dateNow])
                ->orderBy('notification.created_at', 'desc')
                ->get();
    
        } elseif ($role == 7) {
            // Sales - hanya notifikasi yang mengandung quotation yang dia buat
            $quotationCodes = Quotation::where('usersId', $userId)
                ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $dateNow])
                ->pluck('quoCode');
    
            if ($quotationCodes->isNotEmpty()) {
                $notif = Notification::leftJoin('users', 'users.id', '=', 'notification.usersId')
                    ->where('notification.compsId', 'like', "%{$request->id}%")
                    ->whereBetween(DB::raw('DATE(notification.created_at)'), [$startDate, $dateNow])
                    ->where(function ($query) use ($quotationCodes) {
                        foreach ($quotationCodes as $code) {
                            $query->orWhere('notification.content', 'like', "%{$code}%");
                        }
                    })
                    ->whereNotIn('notification.notification_id', function ($q) use ($userId) {
                        $q->select('notification_id')
                            ->from('notification_reads')
                            ->where('user_id', $userId);
                    })
                    ->select('notification.*', 'users.name as user_name', 'users.email as user_email')
                    ->orderBy('notification.created_at', 'desc')
                    ->get();
            }
    
        } else {
            // User biasa - tampilkan berdasarkan compId
            $notif = Notification::leftJoin('users', 'users.id', '=', 'notification.usersId')
                ->where('notification.compsId', 'like', "%{$compId}%")
                ->whereBetween(DB::raw('DATE(notification.created_at)'), [$startDate, $dateNow])
                ->whereNotIn('notification.notification_id', function ($q) use ($userId) {
                    $q->select('notification_id')
                        ->from('notification_reads')
                        ->where('user_id', $userId);
                })
                ->select('notification.*', 'users.name as user_name', 'users.email as user_email')
                ->orderBy('notification.created_at', 'desc')
                ->get();
        }
    
        return view('/content/notification/index', [
            'data' => [
                'notif' => $notif
            ],
        ]);
    }
    
    public function index2(Request $request)
{
    $user = Auth::user();
    $userId = $user->id;
    $compId = $user->compId;

    $dateNow = now()->toDateString();
    $startDate = now()->subDays(30)->toDateString();

    $notifications = Notification::where('compsId', 'like', "%{$compId}%")
        ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $dateNow])
        ->whereNotIn('notification_id', function ($q) use ($userId) {
            $q->select('notification_id')
              ->from('notification_reads')
              ->where('user_id', $userId);
        })
        ->orderBy('created_at', 'DESC')
        ->get();

    return response()->json([
        'notification' => $notifications,
    ]);
}

public function markAsRead($id)
{
    $userId = Auth::id();

    DB::table('notification_reads')->updateOrInsert(
        ['notification_id' => $id, 'user_id' => $userId],
        ['read_at' => now()]
    );

    $notif = Notification::find($id);

    // Jika notif tidak ditemukan, jangan redirect ke follup_url kosong
    if (!$notif) {
        return redirect('/')->with('fail', 'Notifikasi tidak ditemukan');
    }

    return redirect()->to($notif->follup_url ?? '/dashboard');
}

    


}
