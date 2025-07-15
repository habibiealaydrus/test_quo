<link rel="stylesheet" href="{{asset ('/assets/vendor/css/pages/app-invoice.css')}}" />
@include('content.quotation.terbilang')
@extends('app')
@section('content')
@include('content.quotation.modal.buttonView')

<div class="card invoice-preview-card border border-primary">
        <div class="card-body">
        @if ($data['quotation']->compsId == 1)
        <div class="py-3 max-w-5xl mx-auto"> 
            <div class="flex items-center justify-center "> 
                <div class="flex flex-col items-center w-1/2 pr-4"> 
                    <img src="{{ asset('/assets/img/front-pages/branding/logo_mlm.png') }}" alt="MLM_logo" class="mb-0" style="height:80pt;">                 
                </div>
                <div class="w-1/2 pl-4 text-center"> 
                    <h1 class="text-3xl font-bold underline underline-offset-8">PT. MAJU LANGGENG MANDIRI</h1> 
                    <p class="text-xl ">Sales & Service for Construction Equipment</p> 
                    <p class="text-lg ">{{ $data['quotation']->address_office ??"-"}}</p> 
                    <div class="flex flex-nowrap justify-center  text-sm"> 
                        <div class="pr-2 font-semibold">Telp.</div>
                        <div class="pr-4">{{ $data['quotation']->phone_office ??"-"}}</div>
                        <div class="mx-2 font-semibold">Email</div>
                        <div>
                            <a href="{{ $data['quotation']->email_office ??"-"}}" class="text-blue-600 underline">{{ $data['quotation']->email_office ??"-"}}</a>
                        </div>
                        <div class="mx-2 font-semibold">Website</div>
                        <div>
                            <a href="http://www.majulanggang.co.id" class="text-blue-600 underline italic ">www.majulanggeng.co.id</a> 
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>    
        @elseif ($data['quotation']->compsId == 2)
        <div class="row mb-2">
            <div class="col-3 place-content-center">
                <img src="{{asset ('/assets/img/front-pages/branding/logo_adk.png')}}" alt="MLM_logo" class="mx-auto">
            </div>
            <div class="col-9">
                <div class="d-flex align-items-center">
                    <span class="fw-bold fs-4">PT. Andalan Dinamika Konstrukindo</span>
                </div>
                <p class="mb-1">{{ $data['quotation']->address_office ??"-"}}</p>
                <p class="mb-1">Phone :{{ $data['quotation']->phone_office ??"-"}}</p>
                <p class="mb-1">{{ $data['quotation']->website_office ??"-"}}</p>
              
            </div>
        </div>
        @elseif ($data['quotation']->compsId == 3)
        <div class="row mb-2">
            <div class="col-3 text-center">
                <img src="{{asset ('/assets/img/front-pages/branding/mlm_rental_logo.png')}}" alt="MLM_rental_logo" class="mx-auto">
            </div>
            <div class="col-9">
                <div class="d-flex align-items-center">
                    <span class="fw-bold fs-4">PT. Maju Langgeng Rental</span>
                </div>
                <p class="mb-1">Jl. Taman Plaza Meruya II Blok E14 No.17, Kembangan, Meruya Utara, Kembangan, Daerah Khusus Ibukota, Jakarta 11620</p>
                <p class="mb-1">Phone :(021) 5851478</p>
                <p class="mb-1">www.majulancar.com</p>
              
            </div>
        </div>
        @endif
        <hr style=" width:90%; height:1px" class="mx-auto" />

        @if ($data['quotation']->compsId == 1)
        <div class="d-flex justify-content-between flex-row mt-4 mb-3">
            <div>
                <table class="borderless boldTitle">
                    <tr>
                        <td>Ref No.</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>{{ $data['quotation']->quoCode ?? '-'}}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>Penawaran Harga</td>
                    </tr>              
                </table>
            </div>
            <div>
                <table class="borderless boldTitle">
                    <tr>      
                        <td class="pe-3">{{$data['quotation']->nama_wilayah}},&nbsp;{{$data['quotation']->quotation_date_created}}</td>                       
                    </tr>
                </table>
            </div>
        </div>
        <div class="mb-4">
            Kepada Yth,
            <p class="fw-bold">{{ $data['quotation']->quoCompany ?? '-'}}</p>
            <p class="fw-bold">Alamat {{ $data['quotation']->quoAddress ?? '-'}}</p>
            <p class="fw-bold">Project {{ $data['quotation']->quoProject ?? '-'}}</p>
            <p>UP :&nbsp;{{ $data['quotation']->quoPIC ?? '-'}}</p>
            <p>Telepon :&nbsp;{{ $data['quotation']->quoContact ?? '-'}}</p>
        </div>
        @elseif ($data['quotation']->compsId == 2 || $data['quotation']->compsId == 2)
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
            <div class="mb-xl-0 mt-4">
                <h4 class="fw-medium mb-2 "></h4>
                <table class="borderless boldTitle">
                    <tr>
                        <td>ATN</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>
                            {{ $data['quotation']->quoPIC ?? '-'}}
                            ({{ $data['quotation']->quoContact ?? '-'}})
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $data['quotation']->quoCompany ?? '-'}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $data['quotation']->quoAddress ?? '-'}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $data['quotation']->quoProject ?? '-'}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $data['quotation']->quoEmail ?? '-' ?? '-'}}</td>
                    </tr>
                    
                </table>
            </div>
            <div>
                <h2 class="fw-medium mb-2 text-center"><span class="badgeQuote">Quotation</span></h2>
                <table class="borderless boldTitle">
                    <tr>
                        <td>Date</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>{{$data['quotation']->quotation_date_created}}</td>
                        
                    </tr>
                    <tr>
                        <td>No. Quotation</td>
                        <td style="padding-left:10px; padding-right:10px;">:</td>
                        <td>{{ $data['quotation']->quoCode ?? '-'}}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
        <p class="mb-0 boldTitle">Pelanggan Yth, </p>
        <p class="mb-2">Terimakasih telah menghubungi kami, Dengan senang hati kami menawarkan hal-hal berikut :</p>
        <!-- <hr class="my-0" /> -->
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width:3%">No.</th>
                        <th class="text-center" style="width:42%">Item</th>
                        <th class="text-center" style="width:15%">Price</th>
                        <th class="text-center" style="width:10%">Disc</th>
                        <th class="text-center" style="width:5%">Qty</th>
                        <th class="text-center" style="width:24%">Total Price</th>
                    </tr>
                </thead>
                @if (isset($data['items']->quLiId))
                <tbody>
                    @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                    @if (count($item) > 0)
                    @for ($i = 0; $i < count($item); $i++) <tr>
                        <td class="text-center listItem">{{ $i + 1 }}</td>
                        <td class="listItem">
                            <b><u>{{ $item[$i]['items'] ?? '-' }}</u></b>
                            @if ($item[$i]['desc'] != null && $item[$i]['image'] != null)
                            <div class="flex flex-row mt-1 ">
                                <div class="prose text-sm">
                                    {!! $item[$i]['desc'] ?? '-' !!}
                                </div>
                                <div class="flex align-items-center">
                                    <img src="{{ asset('storage/media/image/quotation_item/' .$item[$i]['image']) }}" alt="Item Image" style="width:100pt">
                                </div>
                            </div>
                            @else
                            @if (Auth::user()->role === 4)
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exLargeModal{{ $i }}" title="Add Description Here"><i
                                    class="fas fa-plus"></i>
                            </button>
                            <div class="modal fade" id="exLargeModal{{ $i }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <form action="{{ url('quotation/addDescription?quLiId='.$item[$i]['quLiId']) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel4"> Add Description
                                                    : <u>{{ $item[$i]['items'] ?? '-' }}</u>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" data-bs-target="#exLargeModal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="idCompany"
                                                    value="{{$data['quotation']->compsId}}">
                                                <input type="hidden" name="idQuot"
                                                    value="{{$data['quotation']->quotationId}}">
                                                <input type="hidden" name="idCode"
                                                    value="{{$data['quotation']->quoCode}}">
                                                <input type="hidden" name="idSlug"
                                                    value="{{$data['quotation']->quoSlug}}">
                                                <div id="editor_{{ $i }}" class="mb-3" style="height: 300px;">
                                                </div>
                                                <input type="hidden" name="desc" id="quill-editor-area">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Image of Item <i>(click
                                                            below for selecting image)</i></label>
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @endif
                        </td>
                        <td class="alnright">Rp. {{ number_format($item[$i]['price']) ?? '-' }},-</td>
                        <td class="text-center">{{ number_format($item[$i]['disc']) ?? '-' }} %</td>
                        <td class="text-center">{{ $item[$i]['qty'] ?? '-' }}</td>
                        <td class="alnright">Rp. {{ number_format($item[$i]['net']) ?? '-' }},-</td>
                        </tr>
                        @endfor
                        @endif
                        <tr>
                            <td colspan="4">Terbilang : "<i>{{terbilang($data['quotation']->quoTotal) ?? '-' }}
                                    Rupiah</i>"</td>
                            <td class="boldTitle">Total</td>
                            <td class="alnright boldTitle"> <b>Rp.
                                    {{number_format($data['quotation']->quoTotal) ?? '-' }},-</b></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <p class="mb-2"><b><u>NOTES</u></b></p>
                                <p class="mb-0">*) {{ $data['quotation']->quoPeriodNote ?? '-' }}</p>
                                <p class="mb-0"><b>*) {{ $data['quotation']->quoPpnNote ?? '-' }}</b></p>
                                <p class="mb-0"><b>*) {{ $data['quotation']->quoTopNote ?? '-' }}</b></p>
                                <p class="mb-0"><b>*) {{ $data['quotation']->quoDeliveryNote ?? '-' }}</b></p>
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
                                <p class="mt-4">Atas perhatianya kami ucapkan terimakasih</p>
                            </td>
                        </tr>
                        <tr class="border-1">
                            @if ($data['quotation']->compsId == 1)
                            <td colspan="3" class="border-none">
                                @if($qr_sales != null)
                                <p style="padding-left:30px;">Hormat kami,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_sales}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->spPhone ?? '-' }}</u>
                                </p>
                                @else
                                <p style="padding-left:30px;">Hormat kami,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    {{ $data['quotation']->rolesName ?? '-' }}</p>
                            </td>
                            <td colspan="3" class="border-none">
                                @if($qr_spv != null)
                                <p style="padding-left:30px;">Mengetahui,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_spv}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->supervisor_name ?? '-' }}</u>
                                </p>
                               
                                @else
                                <p style="padding-left:30px;">Mengetahui,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    {{ $data['quotation']->supervisor_role_name?? '-' }}</p>
                            </td>
                            @else
                            <td colspan="6">
                                @if($qr_sales != null)
                                <p style="padding-left:30px;">Hormat kami,
                                <p style="padding-left:30px;" class="px-4.5 py-2.5">
                                     {{ $qr_sales}}
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                </p>
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->spPhone ?? '-' }}</u>
                                </p>
                                @else
                                <p style="padding-left:30px;">Hormat kami,</p>
                                <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                    <u>{{ $data['quotation']->name ?? '-' }}</u>
                                    
                                </p>
                                @endif
                                
                                <p style="padding-left:30px;" class="mb-0 boldTitle">
                                    {{ $data['quotation']->rolesName ?? '-' }}</p>
                            </td>
                            @endif
                        </tr>

                </tbody>
                @else
                <tr>
                    <td colspan="6" class="text-center">No Data</td>
                </tr>
                @endif
            </table>       
        </div>
        <div class="row">
            <div class="col-12">
                <span class="fw-medium">Catatan:</span>
                <span>Penawaran ini dihasilkan oleh sistem kami. Terimakasih.</span>
            </div>
        </div>
    </div>
</div>


<!-- Send Quotation Sidebar -->
@include('content.quotation.modal.sendQuotation')

@include('content.quotation.modal.changeStatus')
<!-- Change Status Sidebar -->
@endsection

@section('script')
<script src="{{asset ('/assets/js/viewQuotation.js')}}"></script>
@endsection
