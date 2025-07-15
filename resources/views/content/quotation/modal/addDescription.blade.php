<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{ url('quotation/addDescription?quLiId='.$item[$i]['quLiId']) }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4"> Add Description
                        : {{ $item[$i]['items'] ?? '-' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-target="#exLargeModal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idCompany" value="{{$data['quotation']->compsId}}">
                    <input type="hidden" name="idQuot" value="{{$data['quotation']->quotationId}}">
                    <input type="hidden" name="idCode" value="{{$data['quotation']->quoCode}}">
                    <input type="hidden" name="idSlug" value="{{$data['quotation']->quoSlug}}">
                    <div id="snow-editor" class="mb-3" style="height: 300px;">
                    </div>
                    <textarea class="mb-3 d-none" name="body" id="quill-editor-area"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" onclick="updateDescription()">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
