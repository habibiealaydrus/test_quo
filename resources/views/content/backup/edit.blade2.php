@extends('app')
@section('content')
<div class="row">
    <div class="card card-action mb-5">
        <form action="{{ url('/quotation/updateQuotation') }}" method="POST">
            @csrf
            <div class="card-header header-elements">
                <span class="me-2">Edit Quotation </u></span>
                <div class="card-action-element">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="card-expand">
                                <i class="tf-icons ti ti-arrows-maximize ti-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header-elements ms-auto mt-2">
                    <a href="{{ url('/quotation/viewQuotation/'.$data['quotation']->quoSlug) }}">
                        <i class="tf-icons ti ti-arrow-left ti-sm"></i>
                        <span class="badge bg-primary rounded-pill">Back to Quotations</span>
                    </a>
                </div>
            </div>
            <div class="card-body collapse show">
                <input type="hidden" name="itemQId" value="{{$data['quotation']->quotationId}}">
                <div class="mt-2">
                    <div class="row mb-2 viq">
                        <label class="col-sm-2 col-form-label" for="total">Quotation Code :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control ribuan" name="total"
                                value="{{$data['quotation']->quoCode}}" disabled>
                        </div>
                        <label class="col-sm-2 col-form-label" for="status">Status :</label>
                        <div class="col-sm-4">
                            @if (Auth::user()->role < 4) <select id="status" name="status" class="select2 form-select">
                                <option value="{{$data['quotation']->quoStatus}}" selected>Selected :
                                    "{{$data['quotation']->quoStatus}}"</option>
                                <option value="Submitted">Submitted</option>
                                <option value="On Process">On Process</option>
                                <option value="Done">Done</option>
                                <option value="Canceled">Canceled</option>
                                </select>
                                @else
                                <input type="text" class="form-control" name="status"
                                    value="{{$data['quotation']->quoStatus}}" readonly>
                                @endif
                        </div>

                    </div>
                    <div class="row mb-2 viq">
                        <label class="col-sm-2 col-form-label" for="company">Company :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="company"
                                value="{{$data['quotation']->quoCompany}}">
                        </div>
                        <label class="col-sm-2 col-form-label" for="project">Project :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="project"
                                value="{{$data['quotation']->quoProject}}">
                        </div>
                    </div>
                    <div class="row mb-2 viq">
                        <label class="col-sm-2 col-form-label" for="customer">Customer :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="customer"
                                value="{{$data['quotation']->quoPIC}}">
                        </div>
                        <label class="col-sm-2 col-form-label" for="contact">Contact :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="contact"
                                value="{{$data['quotation']->quoContact}}">
                        </div>
                    </div>
                    <div class="row mb-2 viq">
                        <label class="col-sm-2 col-form-label" for="address">Address :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address"
                                value="{{$data['quotation']->quoAddress}}">
                        </div>
                    </div>
                    <div class="row mb-2 viq">
                        <label class="col-sm-2 col-form-label" for="user">User :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="user" value="{{$data['quotation']->name}}"
                                disabled>
                        </div>
                        <label class="col-sm-2 col-form-label" for="contact">Last Update :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="contact"
                                value="{{ date('d M, Y H:i:s', strtotime($data['quotation']->updated_at)) }}" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive text-nowrap">
                    <table class="table data-listQuo">
                        <thead class="table-light">
                            <tr>
                                <!-- <th style="width: 40%">ID.</th> -->
                                <th style="width: 40%">Items / Description</th>
                                <th style="width: 15%">Price per-Items</th>
                                <th style="width: 10%">Discount Price</th>
                                <th style="width: 10%">Quantity</th>
                                <th style="width: 20%">Subtotal Items</th>
                                <th style="width: 5%">
                                    <!-- <input type="hidden" name="token" value="{{ csrf_token() }}">
                                    <a href="#add-row"
                                        class="btn rounded-pill btn-primary waves-effect waves-light add-row" row="1">
                                        <span class="ti-xs ti ti-plus me-1"></span>Add
                                    </a> -->
                                </th>
                            </tr>
                        </thead>

                        <tbody class="row-table table-border-bottom-0">
                            @php $item = isset($data['lizt']) ? $data['lizt'] : []; @endphp
                            @if (count($item) > 0)
                            @for ($i = 0; $i < count($item); $i++) <input type="hidden" name="itemId[]"
                                value="{{ $item[$i]['qLId'] }}">
                                <tr id="row-1-{{ $item[$i]['qLId'] }}">
                                    <!-- <td>{{ $i + 1 }}</td> -->
                                    <td class="text-nowrap qic">
                                        <input type="text" name="items[]" id="items[]" class="form-control items item-1"
                                            value="{{ $item[$i]['items'] }}">
                                    </td>
                                    <td class="text-nowrap qic">
                                        <input type="number" name="price[]"
                                            class="form-control price price-1" value="{{ $item[$i]['price'] }}">
                                    </td>
                                    <td class="text-nowrap qic">
                                        <input type="number" id="disc" name="disc[]" class="form-control disc disc-1"
                                            value="{{ $item[$i]['disc'] }}">
                                    </td>
                                    <td class="text-nowrap qic">
                                        <input id="qty" name="qty[]" min="0" type="number" row="0"
                                            class="form-control qty qty-1" value="{{ $item[$i]['qty'] }}">
                                    </td>
                                    <td class="text-nowrap qic">
                                        <input id="subtotals" name="subtotal[]" type="text"
                                            class="form-control ribuan subtotal subtotal-1" value="{{ $item[$i]['net'] }}">
                                    </td>
                                    <td class="text-nowrap qic">
                                        <form id="delete-form" action="{{ route('deleteItemQuo') }}">
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                                data-id="{{ $item[$i]['qLId'] }}">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                @endfor
                                @endif
                        </tbody>
                </div>
                </table>
            </div>
            <div class="alert alert-warning" role="alert">
                <h5 class="alert-heading mb-2">Ensure that the quotations is valid</h5>
                <span>Check before Submit</span>
                <div class="mt-2">
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="totalAll">Total All :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control ribuan totalAll" name="totalAll" id="totalAll"
                                value="{{$data['quotation']->quoTotal}}">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="sk">Term of Payment :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sk" value="{{$data['quotation']->quoTopNote}}">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="col-12 text-center">
                    <button type="submit" class="btn rounded-pill btn-primary waves-effect waves-light">
                        <span class="ti-xs ti ti-check me-1"></span>Submit
                    </button>
                    <a href="{{url('/quotation/viewQuotation/'.$data['quotation']->quoSlug)}}"
                        class="btn rounded-pill btn-warning waves-effect waves-light">
                        <span class="ti-xs ti ti-x me-1"></span>Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('page-script')
<script src="/assets/js/updateItemQuotation.js"></script>
<script src="/assets/js/ribuan.js"></script>
<!-- <script src="/assets/js/editScript.js"></script> -->
<script src="/assets/js/cards-actions.js"></script>

@endsection
@section('custom-script')
<script type="text/javascript">
    $(window).on('load', function () {
        $('.quotation-page').addClass('active')
    });


    // Remove Row
    $(document).on('click', '.delete-row', function () {
        var row = $(this).attr('row');
        if (confirm('Are you sure want to delete this item?')) {
            event.preventDefault();
            $('#' + row).remove();
        } else {
            event.preventDefault();
        }
    });


</script>
@endsection
