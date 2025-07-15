@extends('app')
@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section border-bottom text-center pb-4">
                    <div class="d-flex align-items-center flex-column">
                        @if($data['users']->userStatus == "Active")
                        <div class="avatar avatar-xl me-2 avatar-online">
                            <span class="avatar-initial rounded-circle bg-label-info">
                                {{ $data['users']->initials() }}
                            </span>
                        </div>
                        @else($data['users']->userStatus == "Inactive")
                        <div class="avatar avatar-xl me-2 avatar-busy">
                            <span class="avatar-initial rounded-circle bg-label-info">
                                {{ $data['users']->initials() }}
                            </span>
                        </div>
                        @endif
                        <div class="user-info text-center">
                            <h4 class="mb-2">{{ $data['users']->name ?? '-' }}</h4>
                            <span class="badge bg-label-secondary mt-1">{{ $data['users']->rolesName ?? '-'  }}</span>
                        </div>
                    </div>
                </div>
                <p class="mt-4 small text-uppercase text-muted">Details</p>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="fw-medium me-1">Name :</span>
                            <span>{{ $data['users']->name ?? '-' }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Email:</span>
                            <span>{{ $data['users']->email ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Status:</span>
                            @if($data['users']->userStatus == "Active")
                            <span class="badge bg-label-success">
                                {{ $data['users']->userStatus }}
                            </span>
                            @else ($data['users']->userStatus == "Inactive")
                            <span class="badge bg-label-danger">
                                {{ $data['users']->userStatus }}
                            </span>
                            @endif
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Role:</span>
                            <span>{{ $data['users']->rolesName ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Company :</span>
                            <span>{{ $data['users']->companyName ?? '-'}}</span>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Area :</span>
                            <span>{{ $data['users']->kode_cabang ?? '-'}}</span>
                        </li>
                        @if ($data['users']->role > 4)
                        <li class="mb-2">
                            <span class="fw-medium me-1">Sales Code :</span>
                            <span>{{ $data['sales']->spCode ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">NIK :</span>
                            <span>{{ $data['sales']->spNIK ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">No. Handphone : </span>
                            <span>{{ $data['sales']->spPhone ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Address:</span>
                            <span>{{ $data['users']->address_office ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Gender : </span>
                            <span>{{ $data['sales']->spGender ?? '-'}}</span>
                        </li>
                        @else
                        <li class="mb-2">
                            <span class="fw-medium me-1">NIK :</span>
                            <span>{{ $data['users']->upNIK ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">No. Handphone : </span>
                            <span>{{ $data['users']->upPhone ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Address:</span>
                            <span>{{ $data['users']->upNIK ?? '-'}}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-medium me-1">Gender : </span>
                            <span>{{ $data['users']->upGender ?? '-'}}</span>
                        </li>
                        @endif

                    </ul>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                            data-bs-toggle="modal">Edit</a>
                        @if($data['users']->userStatus == "Active")
                        <a href="{{ url('users/inActiveUser?id='.$data['users']->id) }}"
                            class="btn btn-label-danger suspend-user">Change Inactive</a>
                        @else ($data['users']->userStatus == "Inactive")
                        <a href="{{ url('users/activeUser?id='.$data['users']->id) }}"
                            class="btn btn-label-success suspend-user">Change Active</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <a href="{{url('/users')}}" class="btn btn-secondary me-2 mb-4">
            <i class="ti ti-arrow-left me-1"></i>
            Back to List Users&nbsp;&nbsp;
            <i class="ti ti-users"></i>
        </a>
        <!-- Change Password -->
        <div class="card mb-4">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form id="formChangePassword" action="{{ url('users/updatePassword?id='.$data['users']->id) }}"
                    method="POST">
                    @csrf
                    <div class="alert alert-warning" role="alert">
                        <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                        <span>Minimum 8 characters long</span>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                            <label class="form-label" for="newPassword">New Password</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" id="newPassword" name="newPassword"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>

                        <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                            <label class="form-label" for="confirmPassword">Confirm New Password</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/ Change Password -->


        <!-- Recent Devices -->
        <div class="card mb-4">
            <h5 class="card-header">Recent Devices</h5>
            <div class="table-responsive">
                <table class="table border-top">
                    <thead>
                        <tr>
                            <th class="text-truncate">Browser</th>
                            <th class="text-truncate">Device</th>
                            <th class="text-truncate">IP Device</th>
                            <th class="text-truncate">Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-truncate">
                                <i class="ti ti-brand-chrome text-info ti-xs me-2"></i>
                                <span class="fw-medium">{{ $data['users']->login_browser ?? '-' }}</span>
                            </td>
                            <td class="text-truncate">{{ $data['users']->login_device ?? '-' }}</td>
                            <td class="text-truncate">{{ $data['users']->login_ip ?? '-' }}</td>
                            <td class="text-truncate">
                                @if (isset($data['users']->last_login_at))
                                {{date('d-M-Y, H:i:s', strtotime($data['users']->last_login_at))}}
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Recent Devices -->
    </div>
</div>

<!-- Modals -->
<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit User Information</h3>
                </div>
                <form id="editUserForm" class="row g-3" action="{{ url('users/update?id='.$data['users']->id) }}"
                    method="POST" onsubmit="return false">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="modalEditUserFirstName" name="name" class="form-control"
                            value="{{$data['users']->name}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserEmail">Email</label>
                        <input type="text" id="modalEditUserEmail" name="email" class="form-control"
                            value="{{$data['users']->email}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserEmail">Address office</label>
                        <input type="text" id="modalEditUseraddress_office" name="address_office" class="form-control"
                            value="{{$data['users']->address_office}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserPhone">Phone office</label>
                        <input type="text" id="modalEditUserphone_office" name="phone_office" class="form-control"
                            value="{{$data['users']->phone_office}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserWebsite">Website office</label>
                        <input type="text" id="modalEditUserWebsite_office" name="website_office" class="form-control"
                            value="{{$data['users']->website_office}}" />
                    </div>
                    <div class="col-12">
                    <label class="form-label" for="email_office">Email office</label>
                    <input type="text" id="email_offices" class="form-control" placeholder="email office's User"
                        aria-label="email office's User" name="email_office" value="{{$data['users']->email_office}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserKodeCabang">Kode Cabang</label>
                        <input type="text" id="modalEditUserKodeCabang_office" name="kode_cabang" class="form-control"
                            value="{{$data['users']->kode_cabang}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserNamaWilayah">Nama Wilayah</label>
                        <input type="text" id="modalEditUserNamaWilayah" name="nama_wilayah" class="form-control"
                            value="{{$data['users']->nama_wilayah}}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="role">Role / Position</label>
                        <select id="select2Icons" class="select2-icons form-select" name="role">
                            <optgroup label="Choose Your Role">
                                <option value="{{ $data['users']->role }}" selected data-icon="fa-solid fa-check">
                                    {{ $data['users']->rolesName }}
                                </option>
                                @if ($data['users']->role != 7)
                                    <option value="7" data-icon="fa-solid fa-id-card">Sales Engineer</option>
                                @endif
                                @if ($data['users']->role != 6)
                                    <option value="6" data-icon="fa-solid fa-id-badge">Sales Assistant Manager</option>
                                @endif
                                @if ($data['users']->role != 5)
                                    <option value="5" data-icon="fa-solid fa-clipboard-user">Sales Manager</option>
                                @endif
                                @if ($data['users']->role != 4)
                                    <option value="4" data-icon="fa-solid fa-chalkboard-user">Admin Sales</option>
                                @endif
                                @if ($data['users']->role != 3)
                                    <option value="3" data-icon="fa-solid fa-universal-access">General Manager</option>
                                @endif
                            </optgroup>
                        </select>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="role">Direct Supervisor</label>
                        <select id="id_direct_supervisor" class="select2 form-select" name="id_direct_supervisor">
                            <optgroup label="Choose Supervisor">
                                @if ($data['users']->id_direct_supervisor)
                                    <option value="{{ $data['users']->id_direct_supervisor }}" selected data-icon="fa-solid fa-check">
                                        {{ $data['users']->supervisor_name }}
                                    </option>
                                @endif
                                
                                @foreach ($data['atasan'] as $item)
                                    @if ($item->id != $data['users']->id_direct_supervisor)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->


@endsection
@section('script')
<script src="{{asset ('/assets/js/edit-user.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function() {
        $('.admin-page').addClass('active')
        $('.users-page').addClass('active')
    });
</script>
@endsection