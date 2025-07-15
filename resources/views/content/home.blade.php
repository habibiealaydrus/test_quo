@extends('app')
@section('content')
<div class="row">
    @auth {{-- Pastikan user sudah login --}}
        @if (Auth::user()->default_password == 1)
            <div class="col-12 mb-4">
                <div class="alert alert-warning text-center" role="alert">
                    <strong>Peringatan!</strong> Password Anda masih default. Demi keamanan akun Anda, harap ganti password sekarang.
                    <br>
                    Anda akan dialihkan ke halaman profil dalam <span id="countdown">5</span> detik...
                </div>
            </div>

            <script>
                // JavaScript untuk redirect setelah beberapa detik
                let countdown = 5; // Waktu hitung mundur
                const countdownElement = document.getElementById('countdown');
                const redirectUrl = "{{ route('profile') }}"; // Ganti 'profile.show' dengan nama route halaman profil Anda

                const interval = setInterval(function() {
                    countdown--;
                    if (countdownElement) {
                        countdownElement.textContent = countdown;
                    }

                    if (countdown <= 0) {
                        clearInterval(interval);
                        window.location.href = redirectUrl;
                    }
                }, 1000); // Update setiap 1 detik
            </script>
        @endif
    @endauth
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-7">
                    <div class="card-body text-nowrap">
                        <h5 class="card-title mb-0">Welcome, {{Auth::user()->name}}</h5>
                        <p class="mb-2">Integration Quotation Application Doang ya</p>
                        @if (in_array(auth()->user()->role, [1,2,3]))
                        <h4 class="text-primary mb-1"> {{$data['allQuotation']->count()}} Quotation</h4>
                        @elseif (in_array(auth()->user()->role, [4,5,6]))
                        <h4 class="text-primary mb-1"> {{$data['allQuotationInSameCompany']->count()}} Quotation</h4>
                        @elseif (in_array(auth()->user()->role, [7]))
                        <h4 class="text-primary mb-1"> {{$data['quotationPerUser']->count()}} Quotation</h4>
                        @endif
                        @if (in_array(Auth::user()->role, [1,2,3]))
                        <a href="{{route('allQuotation')}}" class="btn btn-primary">View Quotation</a>
                        @elseif (Auth::user()->role == 4)
                        <a href="{{route('adminQuotation')}}" class="btn btn-primary">View Quotation</a>
                        @elseif (in_array(Auth::user()->role, [5,6,7]))
                        <a href="{{route ('salesQuotation')}}" class="btn btn-primary">View Quotation</a>
                        @endif
                    </div>
                </div>
                <div class="col-5 text-center text-sm-left">
                    <div class="card-body ">
                        @if (Auth::user()->compId == 1)
                        <img src="/assets/img/front-pages/branding/logo_mlm.png" height="140" alt="logo_mlm" />
                        @elseif (Auth::user()->compId == 2)
                        <img src="/assets/img/front-pages/branding/logo_adk.png" height="140" alt="logo_adk" class="pb-0 px-0 px-md-4" />
                        @elseif (Auth::user()->compId == 0)
                        <img src="/assets/img/illustrations/card-advance-sale.png" height="140" alt="all_company" class="pb-0 px-0 px-md-4" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Summary</h5>
                    </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    @if (in_array(auth()->user()->role, [1]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['user']->count()}}</h5>
                                <small>Users</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [3]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-medal ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['allSalesManager']->count()}}</h5>
                                <small>Sales Manager</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-pin ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['allAsistantManagerUser']->count()}}</h5>
                                <small>Sales Assitant Manager</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-id-badge ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['allAdminUser']->count()}}</h5>
                                <small>Admin Sales</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['allSalesUser']->count()}}</h5>
                                <small>Sales</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-file ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{$data['allQuotation']->count()}}
                                </h5>
                                <small>Quotation</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [5]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-pin ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['salesAsistantManagerUser']->count()}}</h5>
                                <small>Sales Assitant Manager</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [4,5,6]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['salesUser']->count()}}</h5>
                                <small>Sales</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [4,5,6,7]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-id-badge ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['adminUser']->count()}}</h5>
                                <small>Admin Sales</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if (in_array(auth()->user()->role, [4,5,6]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-file ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{$data['allQuotationInSameCompany']->count()}}
                                </h5>
                                <small>Quotation</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [7]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-file ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{$data['allQuotationSalesPerUser']->count()}}
                                </h5>
                                <small>Quotation</small>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [1,2]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-file ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{$data['allQuotation']->count()}}
                                </h5>
                                <small>Quotation</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (in_array(auth()->user()->role, [1,2]))
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-home ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$data['company']->count()}}</h5>
                                <small>Company</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(window).on('load', function () {
        $('.dashboard-page').addClass('active')
    });

</script>
@endsection