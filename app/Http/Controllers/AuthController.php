<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserProfile;
use App\Models\SalesProfile;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB; 
use Carbon\Carbon; 
use Mail; 
use App\Helpers\UserSystemInfoHelper;
use App\Mail\RegistrationMail;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    
    public function register()
    {
        $company = Company::all();
        return view('/content/auth/register', [
            'data'  => [
                'company' => $company
            ],
        ]);
    }
 
    public function registerPost(Request $request)
    {
        $exist = User::where('email',$request->email)->count();

        if ($exist > 0) {
            return redirect('errorPage')->with('error', 'Existing Email')->withInput();
        } else {
            $user               = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            $user->role         = $request->role;
            $user->compId       = $request->company;
            $user->userStatus   = "Inactive";
            $user->save();
        
            if($user->role > 4 )
            {
                $getRow = SalesProfile::select('spCode')->get();

                $row = count($getRow);

                if ($row > 0) {
                    $row ++;
                } else {
                    $row = 1;
                }
                $next = str_pad($row, 3, "0", STR_PAD_LEFT);
                $salesProfile               = new SalesProfile();
                $salesProfile->usersId      = $user->id;
                $salesProfile->spCode       = 'SLS'.$next;
                $salesProfile->save();
            }
            else{
                $userProfile               = new UserProfile();
                $userProfile->usersId      = $user->id;
                $userProfile->save();
            }

            $company = Company::leftJoin('users','users.compId','company.companyId')
            ->where('companyId',$user->compId)
            ->first();
            
            $roleUser = Roles::leftJoin('users','users.compId','roles.rolesId')
            ->where('rolesId',$user->role)
            ->first();
            
            $data = [
                'title'  => 'New User',
                'subtitle'  => 'User has Registration',
                'name'  => $user->name,
                'email'  => $user->email,
                'role'  => $roleUser->rolesName,
                'company'  => $company->companyName,
                'area'  => $company->companyArea,
                'date'  => date('d F, Y', strtotime($user->created_at)),
                'link' => url('/confirmationUser?id='.$user->id),
            ];

            $roleSuperAdmin = User::where('role','<', 3)->get();
            foreach ($roleSuperAdmin as $user) {
                Mail::to($user->email)->send(new RegistrationMail($data));
            }

            return redirect()->route('login')->with('success', '👋 Register successfully');
        }
    }
 
    public function login()
    {
        return view('/content/auth/login');
    }
 
    public function loginPost(Request $request)
    { 
        $getip = UserSystemInfoHelper::get_ip();
        $getbrowser = UserSystemInfoHelper::get_browsers();
        $getdevice = UserSystemInfoHelper::get_device();
        $getos = UserSystemInfoHelper::get_os();
           
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
            'userStatus' => "Active"
        ];
        
        if (Auth::attempt($credetials)) {
            User::where('email', $credetials)->update([
                'last_login_at' => date('Y-m-d h:i:s'),
                'login_ip' => $getip,
                'login_browser' => $getbrowser,
                'login_device' => $getdevice,
            ]);
            return redirect('/',)->with('success', '👋 Login Success');
        }
 
        return back()->with('fail', 'Wrong Account. Please Try Again or Contact Admin !!!');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login')->with('success', '👋 Logout Success');
    }

    public function showForgetPasswordForm()
    {
       return view('/content/auth/forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_reset_tokens')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('mail/forget-password-mail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('success', 'We have e-mailed your password reset link!');
      }

    public function showResetPasswordForm($token) { 
        return view('/content/auth/reset-password', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request)
     {
         $updatePassword = DB::table('password_reset_tokens')
                             ->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])
                             ->first();
 
         if(!$updatePassword){
             return back()->withInput()->with('fail', 'Invalid Data!');
         }
 
         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
 
         return redirect()->route('login')->with('success', 'Your password has been changed!');
     }

}
