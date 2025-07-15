<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">

            <!-- Dashboards -->
            <li class="menu-item dashboard-page">
                <a href="{{url ('/')}}" class="menu-link ">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div>Dashboards</div>
                </a>
            </li>

            <!-- Bidding -->
            @if (in_array(auth()->user()->role, [1,2,3]))
            <li class="menu-item quotation-page">
                <a href="{{route ('allQuotation')}}" class="menu-link ">
                    <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                    <div>Quotation</div>
                </a>
            </li>
            @elseif (auth()->user()->role == 4)
            <li class="menu-item quotation-page">
                <a href="{{route ('adminQuotation')}}" class="menu-link ">
                    <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                           Quotation
                </a>
            </li>
            @elseif (in_array(auth()->user()->role, [5,6,7]))
            <li class="menu-item quotation-page">
                <a href="{{route ('salesQuotation')}}" class="menu-link ">
                    <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                    <div>Quotation</div>
                </a>
            </li>
            @endif

            <!-- Bidding List -->
            <li class="menu-item quotationItem-page ">
                <a href="{{url ('/quotationItem')}}" class="menu-link ">
                    <i class="menu-icon tf-icons ti ti-menu-2"></i>
                    <div>Item Quotation</div>
                </a>
            </li>
            
            <!-- Administrator -->
            @if (in_array(auth()->user()->role, [1,2]))
            <li class="menu-item admin-page">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-user-circle"></i>
                    <div>Administrator</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item users-page">
                        <a href="{{url ('/users')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div>User List</div>
                        </a>
                    </li>
                    <li class="menu-item roles-page">
                        <a href="{{url ('/roles')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div>Role</div>
                        </a>
                    </li>
                    <li class="menu-item company-page">
                        <a href="{{url ('/company')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-home"></i>
                            <div>Company</div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (in_array(auth()->user()->role, [1,2,3]))
            <!-- Documentation -->
            <li class="menu-item documentation-page">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-box-multiple"></i>
                    <div>Documentation</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item loginLogs-page">
                        <a href="{{url ('/login_logs')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                            <div>Login Logs</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" target="_blank"
                            class="menu-link">
                            <i class="menu-icon tf-icons ti ti-file-description"></i>
                            <div>Guideline</div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</aside>
