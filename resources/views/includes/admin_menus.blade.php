@section('menus')
    <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">@yield('title')</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
            <span>
            <i class="ti ti-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
        </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                <span class="d-flex">
                <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Manage Users</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.users') }}" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.admins') }}" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Admins</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.devices') }}" aria-expanded="false">
              <span>
                <i class="ti ti-device-analytics"></i>
              </span>
              <span class="hide-menu">Devices</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.requests') }}" aria-expanded="false">
                <span>
                <i class="ti ti-table-options"></i>
                </span>
                <span class="hide-menu">Service Requests</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.settings') }}" aria-expanded="false">
                <span>
                <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Settings</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.logout') }}" aria-expanded="false">
                <span>
                <i class="ti ti-power"></i>
                </span>
                <span class="hide-menu">Logout</span>
            </a>
        </li>
    </ul>
@endsection
