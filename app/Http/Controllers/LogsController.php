<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = User::join('roles as A','A.rolesId','=','users.role')
                        ->whereNotIn('users.role',[1])
                        ->orderBy('users.last_login_at','ASC')
                        ->get();
        return view('/content/logs/login_logs', [
            'data'  => [
                'logs' => $logs
            ],
        ]);
    }
}
