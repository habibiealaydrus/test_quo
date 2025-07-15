@extends('app')
@section('content')
<div class="card px-3">
    <div class="card-header header-elements">
        <span class="me-2">List Quotation</span>
        <div class="ms-auto flex flex-row gap-3">
            @if (in_array(auth()->user()->role, [1,2,7]))
            <div class="card-header-elements ms-auto">
                <a href="{{url ('/quotation/create')}}"
                    class="btn btn-sm btn-success rounded-pill waves-effect waves-light">
                    <span class="ti ti-plus me-1"></span>
                    Add New Sell Quotation
                </a>
            </div>
            <div class="card-header-elements ms-auto">
                <a href="{{url ('/quotation/rent_create')}}"
                    class="btn btn-sm btn-warning rounded-pill waves-effect waves-light">
                    <span class="ti ti-plus me-1"></span>
                    Add New Rent Quotation
                </a>
            </div>
            @endif
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <table class="data-quotation table" id="quotation">
            <thead class="border-top">
                <tr>
                    <th class="text-center" id="test">No. </th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Sales</th>
                    <th class="text-center">Company </th>
                    <th class="text-center">Project</th>
                    <th class="text-center">PIC</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['quotation'] as $key => $item)
                <tr id="index_{{ $item->quotationId }}" class="text-center">
                <td >{{$key + 1}}</td>
                    <td>
                        <a href="{{ url('/quotation/viewQuotation/'.$item->quoSlug) }}" class="text-body fw-bold">
                            {{ $item->quoCode ?? '-' }}
                        </a>
                    </td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td>{{ $item->quoCompany ?? '-' }}</td>
                    <td>{{ $item->quoProject?? '-'  }}</td>
                    <td>{{ $item->quoPIC ?? '-' }}</td>
                    <td>{{ $item->quoContact?? '-'  }}</td>
                    <td class="text-right">{{ number_format($item->quoTotal) ?? '-' }}</td>
                    <td class="text-center">
                        @if ($item->quoStatus == 'Submitted')
                        <span class="badge bg-label-warning">Submitted</span>
                        @elseif ($item->quoStatus == 'On Process')
                        <span class="badge bg-label-info">On Process</span>
                        @elseif ($item->quoStatus == 'Done')
                        <span class="badge bg-label-success">Done</span>
                        @elseif ($item->quoStatus == 'Canceled')
                        <span class="badge bg-label-danger">Canceled</span>
                        @endif
                    </td>
                    <td class="text-right">
                    {{ $item->quotation_date_created }}
                    </td>
                    <td class="text-center">
                        <div class="d-inline-block text-nowrap">
                            <a href="{{ url('/quotation/viewQuotation/'.$item->quoSlug) }}" class="btn btn-sm btn-icon"
                                title="Edit/View">
                                <i class="ti ti-eye"></i>
                            </a>
                            <a href="{{ url('/quotation/deleteQuotation/'.$item->quotationId) }}" class="btn btn-sm btn-icon delete-record"
                                title="Delete">
                                <i class="ti ti-trash"></i>
                            </a>
                            <a href="javascript:;" class="text-body dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown" title="Change Status"><i
                                    class="ti ti-dots-vertical ti-sm mx-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end m-0">
                            @if (in_array(Auth::user()->role, [1,2,5,6,7])) 
                                <a href="{{ url('/quotation/editQuotation/'.$item->quoSlug) }}"
                                    class="dropdown-item"><i class="fas fa-pencil me-2"></i>Edit</a>
                            @endif
                            @if (in_array(Auth::user()->role, [1,2,4])) 
                                @if ($item->quoStatus == 'Submitted')
                                    <a href="{{url ('quotation/onProcess?quotationId='.$item->quotationId)}}"
                                        class="dropdown-item"><i class="fas fa-history me-2"></i>On Process</a>
                                    <a href="{{url ('quotation/canceledProcess?quotationId='.$item->quotationId)}}"
                                        class="dropdown-item"><i class="fas fa-times me-2"></i>Canceled</a>
                                    @elseif ($item->quoStatus == 'On Process')
                                    <a href="{{url ('quotation/doneProcess?quotationId='.$item->quotationId)}}"
                                        class="dropdown-item"><i class="fas fa-check me-2"></i>Done</a>
                                    <a href="{{url ('quotation/canceledProcess?quotationId='.$item->quotationId)}}"
                                        class="dropdown-item"><i class="fas fa-times me-2"></i>Canceled</a>
                                    @elseif ($item->quoStatus == 'Done')
                                    <span class="dropdown-item">Done </span>
                                    @elseif ($item->quoStatus == 'Canceled')
                                    <span class="dropdown-item">Has Canceled </span>
                                @endif
                            @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/quotation.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.quotation-page').addClass('active') ;
    });
</script>
@endsection
