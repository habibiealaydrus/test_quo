<!-- // NON SALES SETTING PROFILE -->
@extends('app')
@section('content')
<div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    <hr class="my-0" />
    <div class="card-body">
        <form id="formProfileSettings" action="{{ url('settingStore?id='.$data['settings']->id) }}" method="POST" onsubmit="return false">
        @csrf
        <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$data['settings']->name}}"
                        autofocus />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" id="email"
                        value="{{$data['settings']->email}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input class="form-control" type="text" id="phone" name="phone"
                        value="{{$data['settings']->upPhone}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nik" class="form-label">NIK</label>
                    <input class="form-control" type="text" id="nik" name="nik"
                        value="{{$data['settings']->upNIK}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="select2 form-select">
                        <option value="{{$data['settings']->upGender}}" selected>Selected : "{{$data['settings']->upGender}}"</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="company" class="form-label">Company</label>
                    <input class="form-control" type="text" id="company" name="company"
                        value="{{$data['settings']->companyName}}" disabled/>
                </div>
                <!-- <div class="mb-3 col-md-6">
                    <label for="company" class="form-label">Company</label>
                    <select id="company" name="company" class="select2 form-select">
                        @foreach ($data['company'] as $key => $item)
                        <option value="{{$item->companyId}}" @if($item->companyId == $data['settings']->compId) selected @endif>{{$item->companyName}}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="mb-3 col-md-6">
                    <label for="role" class="form-label">Role / Position</label>
                    <input class="form-control" type="text" id="role" name="role"
                    value="{{$data['settings']->rolesName}}" disabled/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <input class="form-control" type="text" id="status" name="status"
                    value="{{$data['settings']->userStatus}}" disabled/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" type="text" id="address" name="address">{{$data['settings']->upAddress}}</textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
            </div>
        </form>
    </div>
    <!-- /Account -->
</div>
<!-- Change Password -->
<div class="card mb-4">
    <h5 class="card-header">Change Password</h5>
    <div class="card-body">
        <form id="formPasswordSettings"  action="{{ url('changePassword?id='.$data['settings']->id) }}" method="POST" onsubmit="return false">
        @csrf    
        <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle">
                    <label class="form-label" for="currentPassword">Current Password</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" name="currentPassword" id="currentPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle">
                    <label class="form-label" for="newPassword">New Password</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" id="newPassword" name="newPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>

                <div class="mb-3 col-md-6 form-password-toggle">
                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <h6>Password Requirements:</h6>
                    <ul class="ps-3 mb-0">
                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                        <li class="mb-1">At least one lowercase character</li>
                        <li>At least one number, or symbol</li>
                    </ul>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ Change Password -->

@endsection
@section('script')
<script src="{{asset ('/assets/js/profile.js')}}"></script>
@endsection