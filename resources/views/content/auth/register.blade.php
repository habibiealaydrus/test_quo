<link rel="stylesheet" href="{{asset ('/assets/vendor/css/pages/page-auth.css')}}" />

@extends('app')
@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="/assets/img/illustrations/auth-register-illustration-light.png" alt="auth-register-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-register-illustration-light.png"
                    data-app-dark-img="illustrations/auth-register-illustration-dark.png" />

                <img src="/assets/img/illustrations/bg-shape-image-light.png" alt="auth-register-cover"
                    class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">

                <h3 class="mb-1">Adventure starts here 🚀</h3>
                <p class="mb-4">Create Your Account</p>

                <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('registerPost') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                            autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter your email" />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Company</label>
                        <select id="select2" class="select2 form-select" name="company">
                            <optgroup label="Select Your Company">
                            @foreach ($data['company'] as $key => $item)
                        <option value="{{ $item->companyId }}">
                          {{ $item->companyName }} - {{ $item->companyArea }}
                        </option>
                        @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Role or Position</label>
                        <select id="select2Icons" class="select2-icons form-select" name="role">
                            <optgroup label="Select Your Role">
                              <option value="7" data-icon="fa-solid fa-id-card">Sales Engineer</option>
                            </option>
                            <option value="6" data-icon="fa-solid fa-id-badge">Sales Assistant Manager</option>
                            <option value="5" data-icon="fa-solid fa-clipboard-user">Sales Manager</option>
                            <option value="4" data-icon="fa-solid fa-chalkboard-user">Admin Sales</option>
                            <option value="3" data-icon="fa-solid fa-universal-access">General Manager
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                </form>

                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">
                        <span>Sign in instead</span>
                    </a>
                </p>

                <div class="divider my-4">
                    <div class="divider-text">Integration Quotation Application</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/auth.js')}}"></script>
@endsection
