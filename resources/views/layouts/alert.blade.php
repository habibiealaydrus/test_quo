@if (Session::has('berhasil'))
<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
    <span class="alert-icon text-success me-2">
        <i class="ti ti-check ti-xs"></i>
    </span>
    {{session()->get('berhasil')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
    <span class="alert-icon text-danger me-2">
        <i class="ti ti-ban ti-xs"></i>
    </span>
    {{session()->get('error')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

