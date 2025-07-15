<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserProfile;
use App\Models\SalesProfile;
use App\Models\Company;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $data = User::
        leftjoin('users_profile as A','A.usersId','users.id')
        ->leftjoin('sales_profile as B','B.usersId','users.id')
        ->leftjoin('roles as C','C.rolesId','users.role')
        ->leftjoin('company as D','D.companyId','users.compId')
        ->where('users.id','=',Auth::user()->id)
        ->first();

        // admin
        $quotationCompanySubmitted = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('company.companyId','=', Auth()->user()->compId)
        ->where('quotation.quoStatus','=', 'Submitted')
        ->get();

        $quotationCompanyOnProcess = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('company.companyId','=', Auth()->user()->compId)
        ->where('quotation.quoStatus','=', 'On Process')
        ->get();

        $quotationCompanyDone = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('company.companyId','=', Auth()->user()->compId)
        ->where('quotation.quoStatus','=', 'Done')
        ->get();

        $quotationCompanyCanceled = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('company.companyId','=', Auth()->user()->compId)
        ->where('quotation.quoStatus','=', 'Canceled')
        ->get();

        // sales
        $quotationSalesSubmitted = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('quotation.usersId','=', Auth()->user()->id)
        ->where('quotation.quoStatus','=', 'Submitted')
        ->get();

        $quotationSalesOnProcess = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('quotation.usersId','=', Auth()->user()->id)
        ->where('quotation.quoStatus','=', 'On Process')
        ->get();

        $quotationSalesDone = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('quotation.usersId','=', Auth()->user()->id)
        ->where('quotation.quoStatus','=', 'Done')
        ->get();

        $quotationSalesCanceled = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('quotation.usersId','=', Auth()->user()->id)
        ->where('quotation.quoStatus','=', 'Canceled')
        ->get();


        // all
        $quotationSubmitted = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.quoStatus','=', 'Submitted')
            ->get();
        $quotationOnProcess = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.quoStatus','=', 'On Process')
            ->get();
        $quotationDone = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.quoStatus','=', 'Done')
            ->get();
        $quotationCanceled = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.quoStatus','=', 'Canceled')
            ->get();

        return view('/content/profile/index', [
            'data'  => [
                'profile' => $data,
                'quotationCompanySubmitted' => $quotationCompanySubmitted,
                'quotationCompanyOnProcess' => $quotationCompanyOnProcess,
                'quotationCompanyDone' => $quotationCompanyDone,
                'quotationCompanyCanceled' => $quotationCompanyCanceled,
                'quotationSalesSubmitted' => $quotationSalesSubmitted,
                'quotationSalesOnProcess' => $quotationSalesOnProcess,
                'quotationSalesDone' => $quotationSalesDone,
                'quotationSalesCanceled' => $quotationSalesCanceled,
                'quotationSubmitted' => $quotationSubmitted,
                'quotationOnProcess' => $quotationOnProcess,
                'quotationDone' => $quotationDone,
                'quotationCanceled' => $quotationCanceled,
            ],
        ]);
    }

    public function settingAccount()
    {
        $data = User::
        leftjoin('users_profile as A','A.usersId','users.id')
        ->leftjoin('roles as B','B.rolesId','users.role')
        ->leftjoin('company as D','D.companyId','users.compId')
        ->where('users.id','=',Auth::user()->id)
        ->first();

        $company = Company::all();
        $gender = UserProfile::all();
        return view('/content/profile/setting', [
            'data'  => [
                'settings' => $data,
                'company' => $company,
                'genders' => $gender,
            ],
        ]);
    }
    public function settingProfileAccount()
    {
        $data = User::
        leftjoin('sales_profile as A','A.usersId','users.id')
        ->leftjoin('roles as B','B.rolesId','users.role')
        ->leftjoin('company as C','C.companyId','users.compId')
        ->where('users.id','=',Auth::user()->id)
        ->first();

        $company = Company::all();
        $gender = UserProfile::all();
        return view('/content/profile/settingProfile', [
            'data'  => [
                'settings' => $data,
                'company' => $company,
                'genders' => $gender,
            ],
        ]);
    }

    public function updateAccount(Request $request)
    {
        $users           = User::find($request->id);
        $users->name     = ucfirst($request->name);
        $users->email    = strtolower($request->email);
        // $users->compId   = $request->company;
        $users->update();

        if($users->role > 4 )
        {
            $salesProfile              = SalesProfile::where('usersId',$users->id)->first();
            $salesProfile->spAddress    = $request->address;
            $salesProfile->spPhone      = $request->phone;
            $salesProfile->spNIK        = $request->nik;
            $salesProfile->spGender     = $request->gender;
            if($request->hasfile('QrTtd'))
            {
                $file = $request->file('QrTtd');
                $extention = $file->getClientOriginalName();
                $filename = $extention;
                $file->move('media/image/qr_code', $filename);
                $salesProfile->spTtdCode = $filename;
            }
            $salesProfile->update();    
        } else {
            $usersProfile              = UserProfile::where('usersId',$users->id)->first();
            $usersProfile->upAddress    = $request->address;
            $usersProfile->upPhone      = $request->phone;
            $usersProfile->upNIK        = $request->nik;
            $usersProfile->upGender     = $request->gender;
            $usersProfile->update();    
        }

        return back()->with('success','👋 Your Profile Updated Successfully.');
    }

    public function updatePassword(Request $request)
    {
        $users = User::find($request->id);
        if(Hash::check($request->currentPassword, Auth::user()->password)) {
            return back()->with('fail','👋 Your New Password Cannot Be The Same As Your Current Password.');
        } else {
            $users->password = Hash::make($request->newPassword);
            $users->default_password = 0;
            $users->save();
            Auth::logout();
            return redirect()->route('login')->with('success','👋 Your Password Changed Successully & Please Re-Login !'); 
        }
    }
}
