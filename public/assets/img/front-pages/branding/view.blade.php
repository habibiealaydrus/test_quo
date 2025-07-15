<link rel="stylesheet" href="{{asset ('/assets/vendor/css/pages/app-invoice.css')}}" />
@include('content.quotation.terbilang')
@extends('app')
@section('content')
<div class="row invoice-preview">
    <!-- Quotation -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">

                @if ($data['quotation']->compsId == 1)

                <div class="row mb-2">
                    <div class="col-2 text-center">
                        <img src="assets/img/front-pages/branding/logo_MLM.png" alt="MLM_logo">
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <span class="fw-bold fs-4">PT. Maju Langgeng Mandiri</span>
                        </div>
                        <p class="mb-1">Taman Meruya Plaza II Blok E 14 No. 17, Meruya Utara</p>
                        <p class="mb-1">Phone : (021) 5851478 / +62 811-1766-138</p>
                        <p class="mb-0">www.majulanggeng.co.id</p>
                    </div>
                </div>
                @elseif ($data['quotation']->compsId == 2)
                <div class="row mb-2">
                    <div class="col-2 text-center">
                        <img src="/assets/img/front-pages/branding/logo_adk.png" alt="MLM_logo">
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <span class="fw-bold fs-4">PT. Andalan Dinamika Konstrukindo</span>
                        </div>
                        <p class="mb-1">Taman Meruya Plaza II Blok C No. 5, Meruya Utara</p>
                        <p class="mb-1">Phone : (021) 58909733 / +6221 5890 9733</p>
                        <p class="mb-0">www.konstrukindo.co.id</p>
                    </div>
                </div>
                @endif
                <hr class="my-0" />
                <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mt-4">
                        <h4 class="fw-medium mb-2"></h4>
                        <table class="borderless boldTitle">
                            <tr>
                                <td>ATN</td>
                                <td style="padding-left:10px; padding-right:10px;">:</td>
                                <td>{{ $data['quotation']->quoPIC ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $data['quotation']->quoCompany ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $data['quotation']->quoAddress ?? '-'}}
                                    ({{ $data['quotation']->quoContact ?? '-'}})</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $data['quotation']->quoProject ?? '-'}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <h2 class="fw-medium mb-2 text-center"><span class="badgeQuote">Quotation</span></h2>
                        <table class="borderless boldTitle">
                            <tr>
                                <td>Date</td>
                                <td style="padding-left:10px; padding-right:10px;">:</td>
                                <td>{{ date('d F, Y', strtotime($data['quotation']->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td>No. Quotation</td>
                                <td style="padding-left:10px; padding-right:10px;">:</td>
                                <td>{{ $data['quotation']->quoCode ?? '-'}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <p class="mb-0 boldTitle">Dear Valued Customer, </p>
                <p class="mb-2">Thank you for your recent inquiry, we are pleased to offer you as follows :</p>
                <!-- <hr class="my-0" /> -->
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:3%">No.</th>
                                <th class="text-center" style="width:30%">Item</th>
                                <th class="text-center" style="width:23%">Price</th>
                                <th class="text-center" style="width:10%">Disc</th>
                                <th class="text-center" style="width:10%">Qty</th>
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
                                    @if ($item[$i]['desc'] == null && Auth::user()->role >= 5)
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exLargeModal{{ $i }}" title="Add Description Here"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                    <div class="modal fade" id="exLargeModal{{ $i }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <form
                                                action="{{ url('quotation/addDescription?quLiId='.$item[$i]['quLiId']) }}"
                                                method="post">
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
                                    @else
                                    {!! $item[$i]['desc'] !!}
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
                                        <p class="mb-0"><b><u>NOTES</u></b></p>
                                        <p class="mb-0">*) Penawaran berlaku selama 7 (tujuh) hari sejak penawaran ini
                                            di terbitkan</p>
                                        <p class="mb-0"><b>*) {{ $data['quotation']->quoSK ?? '-' }}</b></p>
                                        <p class="mb-0"><b>*) {{ $data['quotation']->quoNotes ?? '-' }}</b></p>
                                        <p class="mb-0">*) Kondisi Stock Berjalan, silakan menghubungi via WA untuk
                                            menanyakan ketersediaan stock</p>
                                        <p class="mb-0">*) Garansi Jasa Service dan Spare Parts (Factory Defect) selama
                                            6 (enam) bulan sejak tanggal invoice</p>
                                        <p class="mt-4">Thank you for your kind attention.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <p style="padding-left:30px; padding-bottom:50px;">Best Regards,</p>
                                        <p style="padding-left:30px; padding-top:50px;" class="mb-0 boldTitle">
                                            <u>{{ $data['quotation']->name ?? '-' }}</u></p>
                                        <p style="padding-left:30px;" class="mb-0 boldTitle">
                                            {{ $data['quotation']->rolesName ?? '-' }}</p>
                                    </td>
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
                        <span class="fw-medium">Note:</span>
                        <span>This Quotation was provided by our system. Thank You.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Quotation -->
    @include('content.quotation.modal.buttonView')
</div>

<!-- Send Quotation Sidebar -->
@include('content.quotation.modal.sendQuotation')

@include('content.quotation.modal.changeStatus')
<!-- Change Status Sidebar -->
@endsection

@section('script')
<script src="{{asset ('/assets/js/content/quotation/viewQuotation.js')}}"></script>
@endsection
