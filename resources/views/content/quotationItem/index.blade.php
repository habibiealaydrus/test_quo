<style>
    .alnright {
        text-align: right;
    }

    .forHidden {
        display: none;
    }

</style>
@extends('app')
@section('content')
<div class="card">
    <h5 class="card-header">List Quotation Items</h5>
    <div class="card-datatable table-responsive">
        <table class="data-quotationItem table">
            <thead class="border-top">
                <tr>
                    <th class="text-center">No. </th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Sales</th>
                    <th class="text-center">Company</th>
                    <th class="text-center">Project</th>
                    <th class="text-center">PIC</th>
                    <th class="text-center">Item</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['quotationItem'] as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ url('/quotation/viewQuotation/'.$item->quoSlug) }}" class="text-body fw-bold">
                            {{ $item->code ?? '-'  }}
                        </a>
                    </td>
                    <td>{{ $item->users ?? '-'  }}</td>
                    <td>{{ $item->quoCompany ?? '-' }}</td>
                    <td>{{ $item->quoProject?? '-'  }}</td>
                    <td>{{ $item->quoPIC ?? '-' }}</td>
                    <td>
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="avatar-wrapper">
                                {{ $item->item ?? '-'  }}
                            </div>
                            <div class="d-flex flex-column forHidden ml-2">
                                <span data-bs-toggle="modal" data-bs-target="#descModal{{ $key }}">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="alnright">{{ number_format($item->price) ?? '-'  }}</td>
                    <td class="text-center">{{ $item->discount ?? '-' }} %</td>
                    <td class="text-center">{{ $item->quantity ?? '-' }}</td>
                    <td class="alnright">{{ number_format($item->subtotal) ?? '-' }}</td>
                    <td class="text-center">
                        {{ date('d M, Y', strtotime($item->created_at)) }}
                    </td>
                    <td class="text-center">
                        <div class="d-inline-block text-nowrap">
                            <a href="{{ url('/quotation/viewQuotation/'.$item->quoSlug) }}" class="btn btn-sm btn-icon"
                                title="Edit/View">
                                <i class="ti ti-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="descModal{{ $key }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Description :
                                    <b><u>{{ $item->item ?? '-' }}</u></b>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($item->description != null && $item->image != null )
                                <div class="d-flex gap-3 mt-1">
                                    <div class="flex-grow-1">
                                        {!! $item->description !!}
                                    </div>
                                    <div class="flex-shrink-0 d-flex align-items-center">
                                        <img src="{{ asset('/media/image/quotation_item/'.$item->image)}}"
                                            class="w-px-100" />
                                    </div>
                                </div>
                                @else
                                <p><i>No Description & Image ....</i></p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-primary" data-bs-dismiss="modal">
                                    <i class="tf-icons ti ti-x ti-sm"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection
@section('script')
<script src="{{asset ('/assets/js/QuotationItem.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.quotationItem-page').addClass('active')
    });

</script>
@endsection
