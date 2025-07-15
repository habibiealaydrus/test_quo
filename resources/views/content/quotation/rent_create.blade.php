@extends('app')
@section('content')
<div class="row">
    <!-- Cards Action -->
    <div class="card card-action mb-5">
        <div class="card-header header-elements">
            <span class="me-2 btn btn-sm btn-warning rounded-pill waves-effect waves-light">Rent Quotation</span>
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
                <a href="{{route ('salesQuotation')}}">
                    <i class="tf-icons ti ti-arrow-left ti-sm"></i>
                    <span class="badge bg-primary rounded-pill">Back to Quotations</span>
                </a>
            </div>
        </div>
        <form id="addNewQuotationForm" action="{{ url('/quotation/rentstore') }}" method="POST" onsubmit="return false">
            @csrf
            <div class="card-body border-top">
                <input type="hidden" name="itemId"
                    value="{{ isset($data['quotation']->quotationId) ? $data['quotation']->quotationId : '' }}">
                <div class="row mb-2 qic">
                    <label class="col-sm-2 col-form-label" for="company">Company :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="company" placeholder="Company Name"
                            aria-label="Company Name">
                    </div>
                    <label class="col-sm-2 col-form-label" for="project">Project :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="project" placeholder="Project Name"
                            aria-label="Project Name">
                    </div>
                </div>
                <div class="row mb-2 qic">
                    <label class="col-sm-2 col-form-label" for="customer">Customer :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="customer" placeholder="Customer Name"
                            aria-label="Customer Name">
                    </div>
                    <label class="col-sm-2 col-form-label" for="contact">Contact :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="contact" placeholder="Contact Customer"
                            aria-label="Contact Customer">
                    </div>
                </div>
                <div class="row mb-2 qic">
                    <label class="col-sm-2 col-form-label" for="address">Address :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="address" placeholder="Address Customer"
                            aria-label="Address Customer">
                    </div>
                    <label class="col-sm-2 col-form-label" for="address">Email :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="email" placeholder="Email Customer"
                            aria-label="Email Customer">
                    </div>
                </div>
                <div class="divider my-4">
                    <div class="divider-text">Create Item Quotation Below</div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40%">Items / Description</th>
                                <th style="width: 15%">Price per-Items</th>
                                <th style="width: 10%">Discount Price</th>
                                <th style="width: 10%">Quantity</th>
                                <th style="width: 20%">Subtotal Items</th>
                                <th style="width: 5%">
                                    <input type="hidden" name="token" value="{{ csrf_token() }}">
                                    <a href="#add-row"
                                        class="btn rounded-pill btn-primary waves-effect waves-light add-row" row="1">
                                        <span class="ti-xs ti ti-plus me-1"></span>Add
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="row-table table-border-bottom-0">
                            <tr id="row-1">
                                <td class="text-nowrap qic">
                                    <input type="text" name="items[]" class="form-control items item-1"
                                        placeholder="Description Item">
                                </td>
                                <td class="text-nowrap qic">
                                    <input type="text" id="rupiah" name="price[]" class="form-control price price-1"
                                        placeholder="Price">
                                </td>
                                <td class="text-nowrap qic">
                                    <input type="number" min="0" name="disc[]" class="form-control disc disc-1"
                                        placeholder="Discount %">
                                </td>
                                <td class="text-nowrap qic">
                                    <input name="qty[]" min="1" type="number" row="1" class="form-control qty qty-1"
                                        placeholder="Qty">
                                </td>
                                <td class="text-nowrap qic">
                                    <input id="rupiah" name="subtotal[]" type="text"
                                        class="form-control-plaintext subtotal subtotal-1" readonly="">
                                </td>
                                <td class="text-nowrap qic">
                                    <a href="#delete-row" row="row-1" class="btn btn-danger delete-row">Delete</a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="mt-2">
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="totalAll">Total All :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control totalAll" name="totalAll" id="totalAll" readonly>
                        </div>
                    </div>
                    <div class="divider my-4">
                        <div class="divider-text">Input Quotation Notes here</div>
                    </div>
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="notePeriod">*) Period Note :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="notePeriod" placeholder="Note of Quotation Period">
                        </div>
                    </div>
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="notePpn">*) PPN Note :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="notePpn" placeholder="Note of PPN (include/exclude)">
                        </div>
                    </div>
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="noteTop">*) Term of Payment Note :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noteTop" placeholder="Note of Term of Payment">
                        </div>
                    </div>
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="noteDelivery">*) Delivery Note :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noteDelivery" placeholder="Note of Delivery">
                        </div>
                    </div>
                    <div class="row mb-2 qic">
                        <label class="col-sm-2 col-form-label" for="noteStock">*) Availability Note :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noteStock" placeholder="Note of Availability Item">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="col-12 text-center">
                    <button type="submit" class="btn rounded-pill btn-primary waves-effect waves-light">
                        <span class="ti-xs ti ti-check me-1"></span>Submit
                    </button>
                    <button type="reset" class="btn rounded-pill btn-secondary waves-effect waves-light">
                        <span class="ti-xs ti ti-x me-1"></span>Reset
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/createQuotation.js')}}"></script>
<script src="{{asset ('/assets/js/addScript.js')}}"></script>
<script src="{{asset ('/assets/js/cards-actions.js')}}"></script>
@endsection
