@extends('app')
@section('content')
<!-- Role cards -->
<div class="row g-4">
    @foreach ($data['roles'] as $item)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-normal mb-2">Name Of Role :</h6>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1">
                    <div class="role-heading">
                        <h4 class="mb-1">{{ $item->rolesName ?? '-' }}</h4>
                        <a href="{{ url('roles/view?rolesId='.$item->rolesId) }}" class="text-primary text-nowrap">
                        <span>Edit Role</span>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="text-muted"><i class="ti ti-settings ti-md"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if (in_array(auth()->user()->role, [1,2]))
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card h-100">
            <div class="row h-100">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="../../assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0"
                            alt="add-new-roles" width="83" />
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                            class="btn btn-primary mb-2 text-nowrap add-new-role">
                            Add New Role
                        </button>
                        <p class="mb-0 mt-1">Add role, if it does not exist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
<!--/ Role cards -->

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">Add New Role</h3>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" action="{{ url('roles/store') }}" method="post"
                    onsubmit="return false">
                    @csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="roleName">Role Name</label>
                        <input type="text" id="roleName" name="roleName" class="form-control"
                            placeholder="Enter a role name" tabindex="-1" />
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
                                                    name="superAdmin" />
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
                                                        name="generalManager" />
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
                                                        name="administrator" />
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
                                                        name="salesManager" />
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
                                                        name="salesSupervisor" />
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
                                                        name="salesEngineer" />
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
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->

<!-- / Add Role Modal -->
@endsection
@section('script')
<script src="{{asset ('assets/js/content/role-user.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.admin-page').addClass('active')
        $('.roles-page').addClass('active')
    });

</script>
@endsection
