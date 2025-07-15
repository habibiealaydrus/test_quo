<!-- <link rel="stylesheet" href="/assets/vendor/css/pages/app-invoice.css" /> -->
<link rel="stylesheet" href="/assets/vendor/css/pages/app-invoice-print.css" />
    @extends('app')
    @section('content')
    <!-- Content -->
    <div class="invoice-print">
        @if (Auth::user()->compId == 1)
        <div class="d-flex justify-content-between flex-row">
            <div class="mb-2">
                <div class="d-flex svg-illustration mb-1 gap-2">
                    <span class="text fw-bold"> PT Maju Langgeng Mandiri </span>
                </div>
                <p class="mb-1">Jl. Taman Plaza Meruya II Blok E14 No.17</p>
                <p class="mb-1">Kembangan, Jakarta Barat, DKI Jakarta 11620</p>
                <p class="mb-0">(021) 5851478</p>
            </div>
            <div>
                <h4 class="fw-medium">{{$data['quotation']->quoCode}}</h4>
                <div class="mb-2">
                    <span class="text-muted">Date Created :</span>
                    <span class="fw-medium"> {{ date('d M, Y', strtotime($data['quotation']->created_at)) }}</span>
                </div>
                <div>
                    <span class="text-muted">Sales Person :</span>
                    <span class="fw-medium">{{$data['quotation']->name}}</span>
                </div>
            </div>
        </div>
        @elseif (Auth::user()->compId == 2)
        <div class="d-flex justify-content-between flex-row">
            <div class="mb-2">
                <div class="d-flex svg-illustration mb-1 gap-2">
                    <span class="text fw-bold"> PT Andalan Dinamika Konstrukindo </span>
                </div>
                <p class="mb-1">Taman Meruya Plaza II Blok C No. 5, Meruya Utara</p>
                <p class="mb-1">Kembangan, Jakarta Barat, DKI Jakarta 11620</p>
                <p class="mb-0">(021) 58909733</p>
            </div>
            <div>
                <h4 class="fw-medium">{{$data['quotation']->quoCode}}</h4>
                <div class="mb-2">
                    <span class="text-muted">Date Created :</span>
                    <span class="fw-medium"> {{ date('d M, Y', strtotime($data['quotation']->created_at)) }}</span>
                </div>
                <div>
                    <span class="text-muted">Sales Person :</span>
                    <span class="fw-medium">{{$data['quotation']->name}}</span>
                </div>
            </div>
        </div>
        @endif
        <hr />

        <div class="row d-flex justify-content-between mb-4">
            <div class="col-sm-12 w-50">
                <h6>Quotation To:</h6>
                <p class="mb-1">{{$data['quotation']->quoPIC}}</p>
                <p class="mb-1">{{$data['quotation']->quoCompany}}</p>
                <p class="mb-1">{{$data['quotation']->quoProject}}</p>
                <p class="mb-1">{{$data['quotation']->quoAddress}}</p>
                <p class="mb-1">{{$data['quotation']->quoContact}}</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table m-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Discount (%)</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Net</th>
                    </tr>
                </thead>
                <tbody>
                    @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                    @if (count($item) > 0)
                    @for ($i = 0; $i < count($item); $i++) <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $item[$i]['items'] }}</td>
                        <td class="alnright">Rp. {{ number_format($item[$i]['price']) }},-</td>
                        <td class="text-center">{{ number_format($item[$i]['disc']) }} %</td>
                        <td class="text-center">{{ $item[$i]['qty'] }}</td>
                        <td class="alnright">Rp. {{ number_format($item[$i]['net']) }},-</td>
                        </tr>
                        @endfor
                        @endif
                        <tr>
                            <td colspan="3" class="align-top px-4 py-3">
                                <p class="mb-2">
                                    <span class="me-1">Ket:</span>
                                    <span>{{$data['quotation']->quoTopNote}}</span>
                                </p>
                                <span>Thanks for your business</span>
                            </td>
                            <td class="text-end px-4 py-3 forBold">
                                Total All
                            </td>
                            <td colspan="2" class="px-4 py-3 alnright forBold">
                                Rp. {{number_format($data['quotation']->quoTotal)}},-
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12">
                <span class="fw-medium">Note:</span>
                <span>This Quotation was provided by our system. It was a pleasure working with you and your team. We hope you will keep us in mind for future projects. Thank You!</span>
            </div>
        </div>
    </div>


    @endsection
    @section('page-script')

    <script src="/assets/js/app-invoice-print.js"></script>
    @endsection
