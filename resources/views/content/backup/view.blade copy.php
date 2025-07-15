<link rel="stylesheet" href="/assets/vendor/css/pages/app-invoice.css" />
@extends('app')
@section('content')
<div class="row invoice-preview">
    <!-- Quotation -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                @if ($data['quotation']->compsId == 1)
                <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            <span class="fw-bold fs-4"> PT Maju Langgeng Mandiri </span>
                        </div>
                        <p class="mb-1">Jl. Taman Plaza Meruya II Blok E14 No.17</p>
                        <p class="mb-1">Kembangan, Jakarta Barat, DKI Jakarta 11620</p>
                        <p class="mb-0">(021) 5851478</p>
                    </div>
                    <div>
                        <h4 class="fw-medium">{{$data['quotation']->quoCode}}</h4>
                        <div class="mb-2">
                            <span>Date Created :</span>
                            <span
                                class="fw-medium">{{ date('d M, Y', strtotime($data['quotation']->created_at)) }}</span>
                        </div>
                        <div>
                            <span>Sales Person :</span>
                            <span class="fw-medium">{{$data['quotation']->name}}</span>
                        </div>
                        <div>
                            <span>Status Quotation :</span>
                            @if($data['quotation']->quoStatus == "Submitted")
                            <span class="fw-medium text-warning">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "On Process")
                            <span class="fw-medium text-info">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "Done")
                            <span class="fw-medium text-success">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "Canceled")
                            <span class="fw-medium text-danger">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @elseif ($data['quotation']->compsId == 1)
                <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            <span class="fw-bold fs-4"> PT Andalan Dinamika Konstrukindo </span>
                        </div>
                        <p class="mb-1">Taman Meruya Plaza II Blok C No. 5, Meruya Utara</p>
                        <p class="mb-1">Kembangan, Jakarta Barat, DKI Jakarta 11620</p>
                        <p class="mb-0">(021) 58909733</p>
                    </div>
                    <div>
                        <h4 class="fw-medium">{{$data['quotation']->quoCode}}</h4>
                        <div class="mb-2">
                            <span>Date Created :</span>
                            <span
                                class="fw-medium">{{ date('d M, Y', strtotime($data['quotation']->created_at)) }}</span>
                        </div>
                        <div>
                            <span>Sales Person :</span>
                            <span class="fw-medium">{{$data['quotation']->name}}</span>
                        </div>
                        <div>
                            <span>Status Quotation :</span>
                            @if($data['quotation']->quoStatus == "Submitted")
                            <span class="fw-medium text-warning">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "On Process")
                            <span class="fw-medium text-info">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "Done")
                            <span class="fw-medium text-success">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @elseif($data['quotation']->quoStatus == "Canceled")
                            <span class="fw-medium text-danger">
                                {{ strtoupper($data['quotation']->quoStatus) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <hr class="my-0" />
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-12 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-2">
                        <h6>Quotation To:</h6>
                        <p class="mb-1">{{$data['quotation']->quoPIC}}</p>
                        <p class="mb-1">{{$data['quotation']->quoCompany}}</p>
                        <p class="mb-1">{{$data['quotation']->quoProject}}</p>
                        <p class="mb-1">{{$data['quotation']->quoAddress}}</p>
                        <p class="mb-1">{{$data['quotation']->quoContact}}</p>
                    </div>
                </div>
                <div class="table-responsive border-top">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Item</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Discount (%)</th>
                                <th class="text-center">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                            @if (count($item) > 0)
                            @for ($i = 0; $i < count($item); $i++) <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>
                                    <b><u>{{ $item[$i]['items'] }}</u></b>
                                    @if ($item[$i]['desc'] == null)
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exLargeModal" title="Add Description Here"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                    @else 
                                    {!! $item[$i]['desc'] !!}
                                     @endif
                                </td>
                                <td class="text-center">{{ $item[$i]['qty'] }}</td>
                                <td class="alnright">Rp. {{ number_format($item[$i]['price']) }},-</td>
                                <td class="text-center">{{ number_format($item[$i]['disc']) }} %</td>
                                <td class="alnright">Rp. {{ number_format($item[$i]['net']) }},-</td>
                                </tr>
                                @endfor
                                @endif
                                <tr>
                                    <td colspan="3" class="align-top px-4 py-3">
                                        <p class="mb-2">
                                            <span class="me-1">Ket :</span>
                                            <span>{{$data['quotation']->quoTopNote}}</span>
                                        </p>
                                        <span>Thanks for your business</span>
                                    </td>
                                    <td class="text-end px-4 py-3 forBold">
                                        Total All :
                                    </td>
                                    <td colspan="2" class="alnright forBold">
                                        Rp. {{number_format($data['quotation']->quoTotal)}},-
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12">
                        <span class="fw-medium">Note:</span>
                        <span>This Quotation was provided by our system. It was a pleasure working with you and your
                            team. We hope you will keep us in mind for future projects. Thank You!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Quotation -->
    @include('content.quotation.modal.buttonExtra')
</div>

<!-- Send Quotation Sidebar -->
@include('content.quotation.modal.sendQuotation')


@include('content.quotation.modal.changeStatus')
<!-- Change Status Sidebar -->

@include('content.quotation.modal.addDescription')
@endsection
@section('custom-script')
<script type="text/javascript">
    $(window).on('load', function () {
        $('.quotation-page').addClass('active')
    });


</script>
@endsection
