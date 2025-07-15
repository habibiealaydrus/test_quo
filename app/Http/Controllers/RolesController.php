<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Roles;
use App\Models\Notification;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::where('rolesId','!=', 1)->get();
        $user = User::select('users.*','B.rolesName')
        ->join('roles AS B','B.rolesId','users.role')
        ->get();
        $users = User::where('users.role','=','roles.rolesId');

        return view('/content/roles/index', [
            'data'  => [
                'user' => $user,
                'users' => $users,
                'roles' => $roles,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $exist = Roles::where('rolesName',$request->roleName)->count();

        if ($exist > 0) {
            return back()->with('fail', 'Error Submit Data, Please Check and Submit Again')->withInput();
        }   
        
        $roles = new Roles;
        $roles->rolesName       = $request->roleName;
        $roles->superAdmin      = $request->superAdmin ? true : false;
        $roles->developer       = 0;
        $roles->generalManager	= $request->generalManager	 ? true : false;
        $roles->administrator   = $request->administrator ? true : false;
        $roles->salesManager    = $request->salesManager ? true : false;
        $roles->salesSupervisor = $request->salesSupervisor ? true : false;
        $roles->salesEngineer   = $request->salesEngineer ? true : false;

        $roles->save();

        $dataNotification = new Notification;
        $dataNotification->rolesId = '[1,2]';
        $dataNotification->quotId = 1;
        $dataNotification->title = 'Create : New Role';
        $dataNotification->content = $roles->rolesName;
        $dataNotification->follup_url = url('/roles/view?rolesId='.$roles->rolesId);
        $dataNotification->save();
        return back()->with('success','👋 New Role Added Successfully.');
    }

    public function view(Request $request)
    {
        $roles = Roles::find($request->rolesId);
        return view('/content/roles/view', [
            'data'  => [
                'roles' => $roles,
            ],
        ]);
        
    }

    public function update(Request $request)
    {
        $roles = Roles::find($request->rolesId);
        $roles->rolesName       = $request->roleName;
        $roles->superAdmin      = $request->superAdmin ? true : false;
        $roles->developer       = 0;
        $roles->generalManager	= $request->generalManager	 ? true : false;
        $roles->administrator   = $request->administrator ? true : false;
        $roles->salesManager    = $request->salesManager ? true : false;
        $roles->salesSupervisor = $request->salesSupervisor ? true : false;
        $roles->salesEngineer   = $request->salesEngineer ? true : false;
        $roles->save();
        return back()->with('success','👋 Role: '.$roles->roles.' has Updated Successfully.'); 
    }
}
