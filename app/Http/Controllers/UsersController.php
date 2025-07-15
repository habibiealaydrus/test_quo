<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\SalesProfile;
use App\Models\UserProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::select('users.*', 'B.rolesName', 'C.companyName')
            ->leftJoin('roles AS B', 'B.rolesId', 'users.role')
            ->leftJoin('company AS C', 'C.companyId', 'users.compId')
            ->get();
        $inactiveUsers = User::where('users.userStatus', '=', 'Inactive');
        $activeUsers = User::where('users.userStatus', '=', 'Active');

        $atasan = User::where('role', '=', '6')
            ->orderBy('name', 'ASC')
            ->get();

        return view('/content/users/index', [
            'data'  => [
                'user' => $data,
                'inactiveUsers' => $inactiveUsers,
                'activeUsers' => $activeUsers,
                'atasan' => $atasan,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $users                          = new User;
        $users->name                    = ucfirst($request->name);
        $users->email                   = strtolower($request->email);
        $users->password                = Hash::make($request->password);
        $users->role                    = $request->role;
        $users->address_office          = $request->address_office;
        $users->phone_office            = $request->phone_office;
        $users->website_office          = $request->website_office;
        $users->email_office            = strtolower($request->email_office);
        $users->kode_cabang             = $request->cabang;
        $users->nama_wilayah            = $request->nama_wilayah;
        $users->id_direct_supervisor    = $request->id_direct_supervisor;

        if ($request->role == 3) {
            $users->compId     = 0;
        } else {
            $users->compId     = $request->company;
        }
        $users->userStatus   = "Active";
        $users->default_password = 1;
        $users->save();

        if ($request->role > 4) {
            $getRow = SalesProfile::select('spCode')->get();

            $row = count($getRow);

            if ($row > 0) {
                $row++;
            } else {
                $row = 1;
            }
            $next = str_pad($row, 3, "0", STR_PAD_LEFT);
            $salesProfile               = new SalesProfile();
            $salesProfile->usersId      = $users->id;
            $salesProfile->spCode       = $request->kode;
            $salesProfile->spPhone      = $request->phone;
            $salesProfile->save();
        } else {
            $userProfile               = new UserProfile();
            $userProfile->usersId      = $users->id;
            $userProfile->upPhone      = $request->phone;
            $userProfile->save();
        }

        return back()->with('success', '👋 New User Created Successfully');
    }

    public function delete(Request $request)
    {
        if ($request->id == Auth::user()->id) {
            return back()->with('fail', 'Yo Can Not Delete Your Account When in Login Access');
        }

        $users               = User::find($request->id)->delete();

        return response()->json();
    }

    public function view(Request $request)
    {
        $data = User::leftJoin('roles', 'roles.rolesId', 'users.role')
            ->leftJoin('company', 'company.companyId', 'users.compId')
            ->leftJoin('users_profile', 'users_profile.usersId', 'users.id')
            ->leftJoin('users AS supervisor', 'supervisor.id', 'users.id_direct_supervisor')
            ->where('users.id', $request->id)
            ->select(
                'roles.*',
                'company.*',
                'users_profile.*',
                'users.*',
                'supervisor.name AS supervisor_name' // Aliaskan nama supervisor
            )
            ->first();

        $sales = User::leftJoin('roles', 'roles.rolesId', 'users.role')
            ->leftJoin('company', 'company.companyId', 'users.compId')
            ->leftJoin('sales_profile', 'sales_profile.usersId', 'users.id')
            ->where('users.id', $request->id)
            ->first();

        $atasan = User::whereIn('role', ['5', '6'])
            ->where('id', '!=', $request->id)
            ->orderBy('name', 'ASC')
            ->get()
            ->unique(fn($item) => strtolower(trim($item->name)))
            ->values(); // reset ulang index array supaya tidak aneh di blade

        return view('/content/users/view', [
            'data'  => [
                'users' => $data,
                'sales' => $sales,
                'atasan' => $atasan

            ],
        ]);
    }
    public function update(Request $request)
    {
        $users                        = User::find($request->id);
        $users->name                  = ucfirst($request->name);
        $users->email                 = strtolower($request->email);
        $users->phone_office          = strtolower($request->phone_office);
        $users->address_office        = $request->address_office;
        $users->website_office        = strtolower($request->website_office);
        $users->email_office          = strtolower($request->email_office);
        $users->kode_cabang           = $request->kode_cabang;
        $users->nama_wilayah          = $request->nama_wilayah;
        $users->id_direct_supervisor = $request->id_direct_supervisor;
        $users->role                  = $request->role;
        $users->update();

        return back()->with('success', '👋 Successfully updated the user.');
    }

    public function updatePassword(Request $request)
    {
        // if ($request->id == Auth::user()->id) {
        //     return back()->with('fail', 'Yo Can Not Delete Your Account When in Login Access');
        // }

        $users = User::find($request->id);
        $users->password = Hash::make($request->newPassword);
        $users->default_password = 0;
        $users->save();
        return back()->with('success', '👋 User ' . $users->name . ' has Changed Password.');
    }

    public function inActiveUser(Request $request)
    {
        if ($request->id == Auth::user()->id) {
            return back()->with('fail', 'Yo Can Not Inactive Your Account When in Login Access');
        }

        $users = User::find($request->id);
        $users->userStatus = 'Inactive';
        $users->save();
        return back()->with('success', '👋 User ' . $users->name . ' has been Inactived');
    }

    public function activeUser(Request $request)
    {
        $users = User::find($request->id);
        $users->userStatus = 'Active';
        $users->save();
        return back()->with('success', '👋 User ' . $users->name . ' has been In Actived');
    }
}
