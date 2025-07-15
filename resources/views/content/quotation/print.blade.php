<!doctype html>

<html lang="en" class="light-style layout-wide" dir="ltr" data-theme="theme-default" data-assets-path="/assets/"
    data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Quotation {{$data['quotation']->quoCode}}</title>

    <meta name="description" content="Integration Quotation Application" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('/assets/img/front-pages/icons/shuttle-rocket.png')}}" />

    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{asset ('/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset ('/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset ('/assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset ('/assets/vendor/css/pages/app-invoice-print.css')}}" />
    @include('content.quotation.terbilang')
    <style>
        .table2 {
            width: 100%;
            border: 1px solid black;
            white-space: nowrap;
            border-spacing: 10px;
        }

        .tb2 {
            white-space: nowrap;
            border: 1px solid black;
            padding: 10px
        }
    </style>
</head>

<body>
    <style>

    </style>
    <div class="invoice-print p-2">
        @if ($data['quotation']->compsId == 1)
        <div style="padding-left:25%; padding-right:25%;">
            <table style="border-collapse: collapse; border: none;">
                <tr>
                    <td style="text-align:right; border: none;">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/front-pages/branding/logo_mlm.png'))) }}" alt="MLM Logo" style="height: 80px;">
                    </td>
                    <td style="border: none;">
                        <p style="text-align:center; font-size:16px; font-weight: bold; white-space:nowrap; color: dimgrey; margin: 0;">PT. MAJU LANGGENG MANDIRI</p>
                        <hr style="border: 0; border-top: 1px solid #999; margin: 4px 0;">
                        <p style="text-align:center; font-size: 13px; margin: 0;">Sales & Service for Construction Equipment</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; border: none; white-space: nowrap; min-width: 400px;"> 
                        <p style="font-size:15px; font-weight: bold; white-space:nowrap; color: dimgrey; margin: 4px 0; display: inline-block;"> {{ $data['sales_address'] ?? ''}}
                        </p>
                        <p style="font-size:15px; color: dimgrey; white-space:nowrap; margin: 2px 0; display: inline-block;"> Phone : {{ $data['sales_phone_office'] ?? ''}}
                        </p>
                        <span style="font-size:13px; color: dimgrey; display: inline-block;">
                            Email : <a href="mailto:mlm@majulanggang.co.id" style="color: #0066cc; text-decoration: none;">mlm@majulanggang.co.id</a>&nbsp;Web: <a href="http://{{ $data['sales_website_office'] ?? ''}}" style="color: #0066cc; text-decoration: none;">{{ $data['sales_website_office'] ?? ''}}</a>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        @elseif ($data['quotation']->compsId == 2)
        <div class="row mb-2">
            <div class="col-3 text-center">
                <img src="{{asset ('/assets/img/front-pages/branding/logo_adk.png')}}" alt="MLM_logo">
            </div>
            <div class="col-9">
                <div class="d-flex align-items-center">
                    <span class="fw-bold fs-4">PT. Andalan Dinamika Konstrukindo</span>
                </div>
                <p class="mb-1">Taman Meruya Plaza II Blok C No. 5, Meruya Utara</p>
                <p class="mb-1">Phone : (021) 58909733 / +6221 5890 9733</p>
                <p class="mb-0">www.konstrukindo.co.id</p>
            </div>
        </div>
        @endif
        @if ($data['comp'] == 1)
        <table style="border: none; border-collapse: collapse;">
            <tr style="border: none;">
                <td style="border: none;">
                    <h2 style="margin: 0; font-size:14px; color: dimgrey;">Ref No.	 : {{ $data['code'] ?? ''}}</h2>  
                    <h2 style="margin: 0; font-size:14px; color: dimgrey;">Perihal	 :	Penawaran Harga</h2>  

                </td>
                <td style="border: none;text-align: right; padding-right: 10px;">
                    <h2 style="margin: 0; font-size:14px; color: dimgrey;">{{ $data['date'] ?? ''}}</h2>             
                </td>
            </tr>
        </table>
        <table style="border: none; border-collapse: collapse;">
            <tr style="border: none;">
                <td style="border: none;">
                <p style="font-size:14px;">Kepada Yth,</p>
                <p style="font-size:14px; font-weight: bold; text-transform:uppercase">{{ $data['company'] ?? ''}}</p>
                <p style="font-size:14px; font-weight: bold;">Project {{ $data['project'] ?? ''}}</p>
                <p style="font-size:14px;">UP : {{ $data['pic'] ?? ''}}</p>
                </td>
            </tr>
        </table>
        @else
        <hr class="my-0" />
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
            <div class="mb-xl-0 mt-2">
                <h4 class="fw-medium mb-2"></h4>
                <table class="borderless boldTitle">
                    <tr>
                        <td>ATN</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>
                            {{$data['quotation']->quoPIC ?? '-' }} 
                            ({{$data['quotation']->quoContact ?? '-' }})
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{$data['quotation']->quoCompany ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{$data['quotation']->quoAddress ?? '-' }} </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{$data['quotation']->quoProject ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $data['quotation']->quoEmail ?? '-' ?? '-'}}</td>
                    </tr>
                </table>
            </div>
            <div>
                <h2 class="fw-medium mb-2 text-center"><span class="badgeQuote">Quotation</span>
                </h2>
                <table class="borderless boldTitle">
                    <tr>
                        <td>Date</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>{{ date('d F, Y', strtotime($data['quotation']->created_at)) }}</td>
                    </tr>
                    <tr>
                        <td>No. Quotation</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>{{$data['quotation']->quoCode ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
        <p class="mb-0 boldTitle">Dear Valued Customer, </p>
        <p class="mb-2">Thank you for your recent inquiry, we are pleased to offer you as follows :</p>

        <table class="table2">
            <thead>
                <tr>
                    <th class="text-center tb2" style="width:3%">No.</th>
                    <th class="text-center tb2" style="width:50%">Item</th>
                    <th class="text-center tb2" style="width:15%">Price</th>
                    <th class="text-center tb2" style="width:10%">Disc</th>
                    <th class="text-center tb2" style="width:7%">Qty</th>
                    <th class="text-center tb2" style="width:15%">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                @if (count($item) > 0)
                @for ($i = 0; $i < count($item); $i++) <tr>
                    <td class="text-center tb2">{{ $i + 1 }}</td>
                    <td class="tb2">
                        <b><u>{{ $item[$i]['items'] ?? '-' }}</u></b>
                        <div class="d-flex gap-3 mt-1">
                            <div class="flex-grow-1" style="padding: 0px">
                                {!! $item[$i]['desc'] !!}
                            </div>
                            <div class="flex-shrink-0 d-flex align-items-center">
                                <img src="{{ isset($item[$i]['image']) ? asset('/media/image/quotation_item/'.$item[$i]['image']) : '' }}"
                                    class="w-px-50" />
                            </div>
                        </div>
                    </td>

                    <td class="alnright tb2">Rp. <span
                            class="float-right">{{ number_format($item[$i]['price']) ?? '-'  }},-</span></td>
                    <td class="text-center tb2">{{ number_format($item[$i]['disc']) ?? '-' }} %</td>
                    <td class="text-center tb2">{{ $item[$i]['qty'] }}</td>
                    <td class="alnright tb2">Rp. {{ number_format($item[$i]['net']) ?? '-' }},-</td>
                    </tr>
                    @endfor
                    @endif
                    <tr>
                        <td class="tb2" colspan="4">Terbilang : "<i>{{terbilang($data['quotation']->quoTotal) ?? '-'}}
                                Rupiah</i>"</td>
                        <td class="boldTitle tb2">Total</td>
                        <td class="alnright boldTitle tb2"> <b>Rp.
                                {{number_format($data['quotation']->quoTotal) ?? '-'}},-</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="tb2">
                            <p class="mb-2"><b><u>NOTES</u></b></p>
                            <p class="mb-0">*) {{ $data['quotation']->quoPeriodNote ?? '-' }}</p>
                            <p class="mb-0"><b>*) {{ $data['quotation']->quoPpnNote ?? '-' }}</b></p>
                            <p class="mb-0"><b>*) {{ $data['quotation']->quoTopNote ?? '-' }}</b></p>
                            <p class="mb-0">*) {{ $data['quotation']->quoDeliveryNote ?? '-' }}</p>
                            <p class="mb-0">*) {{ $data['quotation']->quoStockNote ?? '-' }}</p>
                            <div class="mb-0">*) 
                                <span>
                                    Rekening Pembayaran: <br/>
                                    @if ($data['quotation']->compsId == 1)
                                    <span class="ml-4">BCA      : 754 030 6588 PT. Maju Langgeng Mandiri</span><br/>
                                    <span class="ml-4">BRI      : 3770 1001 2803 01 PT. Maju Langgeng Mandiri</span><br/>
                                    <span class="ml-4">BNI      : 500 700 5788 01 PT. Maju Langgeng Mandiri</span><br/>
                                    <span class="ml-4">MANDIRI : 118 000 405 7211 PT. Maju Langgeng Mandiri</span><br/>
                                    @elseif ($data['quotation']->compsId == 2)
                                    <span class="ml-4">BCA : 754 030 6499 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
                                    <span class="ml-4">BNI : 400 953 8881 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
                                    <span class="ml-4">BRI : 0539 01 000377 30 1 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
                                    <span class="ml-4">DKI : 0539 01 000377 30 1 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
                                    <span class="ml-4">Mandiri : 165 008 088 0801 A.N PT. Andalan Dinamika Konstrukindo</span><br/>
                                    @elseif ($data['quotation']->compsId == 3)
                                    <span class="ml-4">BCA : 288 677 6788 A.N PT. Maju Lancar Mandiri</span><br/>
                                    <span class="ml-4">Mandiri : 165 000 198 1886 A.N PT. Maju Lancar Mandiri</span>
                                    @endif
                                </span>
                            </div>

                            <p class="mt-4">Thank you for your kind attention.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="tb2" colspan="6">
                            <p style="padding-left:30px; padding-bottom:20px;">Best Regards,</p>
                            <p style="padding-left:30px; padding-top:20px;" class="mb-0 boldTitle">
                                <u>{{$data['quotation']->name ?? '-'}}</u>
                            </p>
                            <p style="padding-left:30px;" class="mb-0 boldTitle">
                                {{$data['quotation']->rolesName ?? '-'}}
                            </p>
                        </td>
                    </tr>

            </tbody>
        </table>

        <div class="row">
            <div class="col-12">
                <span class="fw-medium">Note:</span>
                <span>The Quotation was provided by our system. Thank You.</span>
            </div>
        </div>
    </div>

    <script src="{{asset ('/assets/js/app-invoice-print.js')}}"></script>
</body>

</html>