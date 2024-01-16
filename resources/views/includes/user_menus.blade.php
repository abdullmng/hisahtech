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
      <a class="sidebar-link" href="/user/dashboard" aria-expanded="false">
        <span>
          <i class="ti ti-dashboard"></i>
        </span>
        <span class="hide-menu">Dashboard</span>
      </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="/user/devices" aria-expanded="false">
          <span>
            <i class="ti ti-device-analytics"></i>
          </span>
          <span class="hide-menu">Devices</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="/user/requests" aria-expanded="false">
          <span>
            <i class="ti ti-table-options"></i>
          </span>
          <span class="hide-menu">Repair Requests</span>
        </a>
    </li>

    {{--<li class="sidebar-item">
        <a class="sidebar-link" href="/user/notifications" aria-expanded="false">
          <span>
            <i class="ti ti-bell"></i>
          </span>
          <span class="hide-menu">Notifications</span>
        </a>
    </li>--}}

    <li class="sidebar-item">
        <a class="sidebar-link" href="/user/invoices" aria-expanded="false">
          <span>
            <i class="ti ti-file-invoice"></i>
          </span>
          <span class="hide-menu">Invoices</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="/user/logout" aria-expanded="false">
          <span>
            <i class="ti ti-logout"></i>
          </span>
          <span class="hide-menu">Logout</span>
        </a>
    </li>

  </ul>
@endsection
