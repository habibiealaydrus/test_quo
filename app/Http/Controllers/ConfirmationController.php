<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function confirmationUser(Request $request)
    {
        $users = User::find($request->id);
        $users->userStatus = 'Active';
        $users->save();
        return redirect('confirmatedUser')->with('berhasil','👋 User '.$users->name.' has been In Actived'); 
    }
}
