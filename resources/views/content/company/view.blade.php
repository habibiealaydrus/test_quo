@extends('app')
@section('content')
<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Company : <u>{{$data['company']->companyName}}</u></h5>
                <small class="text-muted float-end">{{$data['company']->companyArea}}</small>
            </div>
            <div class="card-body">
                <form class="form-horizontal"
                    action="{{ url('company/update?companyId='.$data['company']->companyId) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="code">Company Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{$data['company']->companyCode}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{$data['company']->companyName}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="area">Company Area</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="area" name="area"
                                value="{{$data['company']->companyArea}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="codeArea">Code Area</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="codeArea" name="codeArea"
                                value="{{$data['company']->codeArea}}" />
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{url('/company')}}" type="submit" class="btn btn-secondary">
                                <i class="ti ti-x me-1"></i>
                                Cancel / Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/company-list.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.admin-page').addClass('active')
        $('.company-page').addClass('active')
    });

</script>
@endsection
