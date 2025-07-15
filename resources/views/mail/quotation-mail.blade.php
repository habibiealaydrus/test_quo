@extends('mail.layouts.template_email')
@section('mailcontent')
<div
    style="color: #e62a32; font-weight: 700; font-size: 20px; letter-spacing: 1px;">
    {{ $data['title'] ?? 'New Quotation' }}
</div>
<div style="background-color: #dce1e6; padding: 5px;">
    <div style="font-size: 12px; font-weight: 300; color: #000;">
        Quotation No. : {{ $data['subtitle'] ?? '' }}
    </div>
    <p style="margin-top: 1em;">
        <span style="font-size: 14px; font-weight: 600; color: #000;">
            Sales : {{ $data['sales'] ?? '' }} ({{ $data['email'] ?? '' }})
        </span> <br>
        <span style="font-size: 14px; font-weight: 400; color: #000; margin-top: -.5em;">
            {{ $data['date'] ?? '' }}
        </span>
    </p>
    <ul style="list-style: none; padding: 0;">
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
                - Customer : {{ $data['customer'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
                - Address : {{ $data['address'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
                - Company : {{ $data['company'] ?? '' }}
            </span>
        </li>
        <li>
            <span style="font-size: 14px; font-weight: 400; color: #000;">
                - Project : {{ $data['project'] ?? '' }}
            </span>
        </li>
    </ul>
    <div style="overflow-x:auto;">
        <table style="width: 100%; margin-top: 1em; border-collapse: collapse;" border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th style="width: 4%">No.</th>
                    <th style="width: 50%">Items</th>
                    <th style="width: 13%">Price</th>
                    <th style="width: 8%">Qty</th>
                    <th style="width: 8%">Discount</th>
                    <th style="width: 17%">Subtotal</th>
                </tr>
            </thead>
            @foreach ($data['items'] as $key => $item)
            <tr>
                <td style="text-align: center;">
                    {{ $key + 1 }}
                </td>
                <td>
                    {{ $item['item'] }}
                </td>
                <td style="text-align: right;">
                    {{ number_format($item['price']) }}
                </td>
                <td style="text-align: center;">
                    {{ $item['qty'] }}
                </td>
                <td style="text-align: center;">
                    {{ $item['discount'] }} %
                </td>
                <td style="text-align: right;">
                    {{ number_format($item['net']) }}
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: center; font-weight: 600;">
                    TOTAL
                </td>
                <td style="text-align: right; font-weight: 600;">
                    {{ $data['total'] }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <p style="margin: 0">- Quotaion Periode : {{ $data['periodNote'] ?? '' }}</p>
                    <p style="margin: 0">- Include / Exlude PPN : {{ $data['ppnNote'] ?? '' }}</p>
                    <p style="margin: 0">- Term of Payment : {{ $data['topNote'] ?? '' }}</p>
                    <p style="margin: 0">- Delivery : {{ $data['deliveryNote'] ?? '' }}</p>
                    <p style="margin: 0">- Availability : {{ $data['stockNote'] ?? '' }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 2em; text-align: center;">
        <a href="{{ $data['link'] ?? '' }}" style="box-shadow: 0 2px 6px #e62a32; 
                    background-color: #e62a32;
                    border-color: #e62a32;
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
            Click here to view quotation
        </a>
    </div>
</div>
@endsection