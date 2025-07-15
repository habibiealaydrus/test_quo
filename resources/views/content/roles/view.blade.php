@extends('app')
@section('content')
<div class="row g-4">
    <div class="card">
        <div class="card-header">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">Edit Role : <u>{{ $data['roles']->rolesName ?? '-' }}</u></h3>
                </div>
                <!-- Add role form -->
                <form id="editRoleForm" class="row g-3"
                    action="{{ url('roles/update?rolesId='.$data['roles']->rolesId) }}" method="post"
                    onsubmit="return false">
                    @csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="roleName">Role Name</label>
                        <input type="text" id="roleName" name="roleName" class="form-control"
                            value="{{ $data['roles']->rolesName }}" tabindex="-1" />
                    </div>
                    <div class="col-12">
                        <h5>Role Permissions</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium">
                                            Super Admin
                                            <i class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Allows a full access to the system"></i>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll"
                                                    name="superAdmin" @if ($data['roles']->superAdmin == 1)
                                                checked
                                                @endif />
                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-medium">General Manager</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="generalManager"
                                                        name="generalManager" @if ($data['roles']->generalManager == 1)
                                                    checked
                                                    @endif />
                                                    <label class="form-check-label" for="generalManager"> Allow
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-medium">Admin Sales</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="administrator"
                                                        name="administrator" @if ($data['roles']->administrator == 1)
                                                    checked
                                                    @endif />
                                                    <label class="form-check-label" for="administrator"> Allow
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-medium">Sales Manager</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="salesManager"
                                                        name="salesManager" @if ($data['roles']->salesManager == 1)
                                                    checked
                                                    @endif />
                                                    <label class="form-check-label" for="salesManager"> Allow
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-medium">Sales Assistant Manager</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="salesSupervisor"
                                                        name="salesSupervisor" @if ($data['roles']->salesSupervisor ==
                                                    1)
                                                    checked
                                                    @endif />
                                                    <label class="form-check-label" for="salesSupervisor"> Allow
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-medium">Sales Engineer</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="salesEngineer"
                                                        name="salesEngineer" @if ($data['roles']->salesEngineer == 1)
                                                    checked
                                                    @endif />
                                                    <label class="form-check-label" for="salesEngineer"> Allow
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <a href="{{url('/roles')}}" class="btn btn-label-secondary  me-sm-3 me-1">
                            <i class="ti ti-x"></i>
                            Cancel
                        </a>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset ('assets/js/content/role-edit.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.admin-page').addClass('active')
        $('.roles-page').addClass('active')
    });

</script>
@endsection
