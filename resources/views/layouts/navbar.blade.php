<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="{{url ('/')}}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="/assets/img/front-pages/icons/shuttle-rocket.png" alt="" srcset="" width="auto"
                        height="25" />
                </span>
                <span class="app-brand-text demo menu-text fw-bold">IQA</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ti ti-md"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="ti ti-layout-grid-add ti-md"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                          
                            </div>
                        </div>
                        <div class="dropdown-shortcuts-list scrollable-container">
                            <div class="row row-bordered overflow-visible g-0">
                                @if (in_array(auth()->user()->role, [1,2,3]))
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-color-swatch fs-4"></i>
                                    </span>
                                    <a href="{{ route('allQuotation')}}" class="stretched-link">Quotation</a>
                                    <small class="text-muted mb-0">List Quotation</small>
                                </div>
                                @elseif (auth()->user()->role == 4)
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-color-swatch fs-4"></i>
                                    </span>
                                    <a href="{{ route('adminQuotation')}}" class="stretched-link">Quotation</a>
                                    <small class="text-muted mb-0">List Quotation</small>
                                </div>
                                @elseif (in_array(auth()->user()->role, [5,6,7]))
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-color-swatch fs-4"></i>
                                    </span>
                                    <a href="{{ route('salesQuotation')}}" class="stretched-link">Quotation</a>
                                    <small class="text-muted mb-0">List Quotation</small>
                                </div>
                                @endif
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-menu-2 fs-4"></i>
                                    </span>
                                    <a href="{{url ('/quotationItem')}}" class="stretched-link">Item Quotation</a>
                                    <small class="text-muted mb-0">List of Item</small>
                                </div>
                            </div>
             
                        </div>
                    </div>
                </li>
                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="ti ti-bell ti-md"></i>
                        <span class="badge bg-danger rounded-pill badge-notifications countNotification"> </span>
                    </a>
                     <ul class="dropdown-menu dropdown-menu-end py-0"><!--ini bagian notifikasi -->
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto">Notification</h5>
                                You have&nbsp;<strong class="text-primary countNotification"></strong> &nbsp;notifications</h6>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush notificationElement">
                                {{-- HAPUS baris <li> yang kosong di sini. Biarkan UL ini kosong. --}}
                                {{-- <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read"></li> --}}
                            </ul>
                        </li>
                        <li class="dropdown-menu-footer border-top">
                            <a href="{{ url('notification') }}"
                                class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                View all notifications
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="/assets/img/front-pages/icons/uzer.png" alt class="h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(Auth::user()->role > 4)
                        <li>
                            <a class="dropdown-item" href="{{ route('settings') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="/assets/img/front-pages/icons/uzer.png" alt
                                                class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                        <?php
                                            if (Auth::user()->role == 1) {
                                                $role = "IT Developer";
                                            } elseif (Auth::user()->role == 2) {
                                                $role = "Super Admin";
                                            } elseif (Auth::user()->role == 3) {
                                                $role = "General Manager";
                                            } elseif (Auth::user()->role == 4) {
                                                $role = "Admin Sales";
                                            } elseif (Auth::user()->role == 5) {
                                                $role = "Sales Manager";
                                            } elseif (Auth::user()->role == 6) {
                                                $role = "Sales Assisten Manager";
                                            } elseif (Auth::user()->role == 7) {
                                                $role = "Sales Engineer";
                                            }
                                            ?>
                                        <small class="text-muted">
                                            {{$role}}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item" href="{{ route('setting') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="/assets/img/front-pages/icons/uzer.png" alt
                                                class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                        <?php
                                        if (Auth::user()->role == 1) {
                                            $role = "IT Developer";
                                        } elseif (Auth::user()->role == 2) {
                                            $role = "Super Admin";
                                        } elseif (Auth::user()->role == 3) {
                                            $role = "General Manager";
                                        } elseif (Auth::user()->role == 4) {
                                            $role = "Admin Sales";
                                        } elseif (Auth::user()->role == 5) {
                                            $role = "Sales Manager";
                                        } elseif (Auth::user()->role == 6) {
                                            $role = "Sales Assisten Manager";
                                        } elseif (Auth::user()->role == 7) {
                                            $role = "Sales Engineer";
                                        }
                                        ?>
                                        <small class="text-muted">
                                            {{$role}}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('logout') }}">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </div>
</nav>
