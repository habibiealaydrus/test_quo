<div class="card border border-info mb-3">
    <div class="card-body">
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
        <hr>
        <div class="demo-inline-spacing">
            @if($data['quotation']->quoStatus == "Done")
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#sendQuotationOffcanvas">
                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                        class="ti ti-send ti-xs me-2"></i>Send Quotation</span>
            </button>
            @endif
            @if($data['quotation']->quoStatus == "Done")
            <a class="btn btn-label-info" target="_blank"
                href="/quotation/exportPdf/{{$data['quotation']->quoSlug}}">
                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                        class="ti ti-download ti-xs me-2"></i>Download</span>
                </button>
            </a>
            @endif
            @if (in_array(auth()->user()->role, [1,2,3,4,6,7]))
            <a class="btn btn-label-warning "
                href="{{ url('/quotation/editQuotation/'.$data['quotation']->quoSlug) }}">
                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                        class="ti ti-edit ti-xs me-2"></i>Edit</span>
                </button>
            </a>
            @endif
            @if (in_array(auth()->user()->role, [1,2,3,5,6])) 
                <button class="btn btn-primary" data-bs-toggle="offcanvas"
                    data-bs-target="#changeStatusQuotation">
                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                            class="ti ti-bookmark ti-xs me-2"></i>Change Status</span>
                </button>
            @endif
        </div>
    </div>

</div>
