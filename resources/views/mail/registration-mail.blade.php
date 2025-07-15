@extends('mail.layouts.template_email')
@section('mailcontent')
<div
    style="color: #e62a32; font-weight: 700; font-size: 20px; letter-spacing: 1px;">
    {{ $data['title'] ?? 'New User' }}
</div>
<div style="background-color: #dce1e6; padding: 5px;">
    <div style="font-size: 12px; font-weight: 300; color: #000;">
        {{ $data['subtitle'] ?? '' }}
    </div>
    <ul style="list-style: none; padding: 0;">
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
               - Name : {{ $data['name'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
               - Email : {{ $data['email'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
               - Role : {{ $data['role'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
               - Company : {{ $data['company'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
               - Area : {{ $data['area'] ?? '' }}
            </span>
        </li>
    </ul>

    <div style="margin-top: 2em; text-align: center;">
        <a href="{{ $data['link'] ?? '' }}" style="box-shadow: 0 2px 6px #e62a32; 
                    background-color:rgb(42, 230, 51);
                    border-color:rgb(12, 236, 68);
                    border-radius: 6px;
                    color: #fff;
                    font-weight: 500; 
                    font-size: 12px;
                    line-height: 30px;
                    padding: 4px 8px;
                    display: inline; 
                    width: auto;
                    text-align: center; 
                    text-decoration: none;
                    text-transform: uppercase;">
            Activated User
        </a>
    </div>
</div>
@endsection
