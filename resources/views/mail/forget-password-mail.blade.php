@extends('mail.layouts.template_email')
@section('mailcontent')
<div style="color: #e62a32; font-size: 20px;">
   <b>{{ 'Hello !' }}</b> 
</div>
<div style="background-color: #dce1e6; padding: 10px;">
    <div style="font-size: 12px; font-weight: 300; color: #000;">
        {{ 'You are receiving this email because we received a password reset request for your account.' }}
        {{ 'Please Click, Reset Password Button and Fill Correctly !' }}
    </div>
    <div style="margin-top: 1em; text-align: center;">
        <a href="{{ route('reset.password.get', $token) }}"
            style="box-shadow: 0 2px 6px #0f087a; 
                    background-color: #0f087a;
                    border-color: #01f567;
                    border-radius: 6px;
                    color: #01f567;
                    font-weight: 500; 
                    font-size: 12px;
                    line-height: 30px;
                    padding: 4px 8px;
                    display: inline-block; 
                    width: auto;
                    max-width: 180px;
                    min-width: 140px; 
                    text-align: center; 
                    text-decoration: none;
                    text-transform: uppercase;">
            RESET PASSWORD
        </a>
    </div>
    <div style="font-size: 12px; font-weight: 300; color: #000; margin-top: 1em;">
        {{ 'If you did not request a password reset, no further action is required.' }}
    </div>
</div>
@endsection