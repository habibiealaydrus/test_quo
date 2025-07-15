<div class="offcanvas offcanvas-end" id="changeStatusQuotation" aria-hidden="true">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Change Status</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">Code :</p>
            <p class="fw-medium mb-0">{{($data['quotation']->quoCode)}}</p>
        </div>
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">Sales Person :</p>
            <p class="fw-medium mb-0">{{($data['quotation']->name)}}</p>
        </div>
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">Total Quotation :</p>
            <p class="fw-medium mb-0">Rp. {{number_format($data['quotation']->quoTotal)}},</p>
        </div>
        <form action="{{ url('/quotation/changeStatus?quotationId='.$data['quotation']->quotationId) }}"
            method="POST">
            @csrf
            <div class="mb-2">
                <label class="form-label" for="payment-method">Status Quotation</label>
                <select class="form-select" id="payment-method" name="status">
                    <option value="{{$data['quotation']->quoStatus}}" selected>Selected :
                        "{{$data['quotation']->quoStatus}}"</option>
                    <option value="Submitted">Submitted</option>
                    <option value="On Process">On Process</option>
                    <option value="Done">Done</option>
                    <option value="Canceled">Canceled</option>
                </select>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label" for="sk">Term Of Payment</label>
                <textarea class="form-control" rows="2"
                    disabled>{{($data['quotation']->quoTopNote)}}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-control" rows="2"
                    disabled>{{($data['quotation']->quoPpnNote)}}</textarea>
            </div>
            <div class="mb-3 d-flex flex-wrap">
                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Submit</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
