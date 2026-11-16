<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <div class="logo-box">
        <a href="" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="" height="24">
                <!-- <span class="logo-lg-text-light">Minton</span> -->
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20">
                <!-- <span class="logo-lg-text-light">M</span> -->
            </span>
        </a>

        <a href="index.html" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="#" class="text-reset dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">username</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>
                    <!-- item-->
                    <a href="" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-reset">Admin</p>
        </div>

        <!--- Sidemenu -->


<div id="sidebar-menu">

    <ul id="side-menu">

        <li>
            <a href="#sidebarDashboards" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="sidebarDashboards" class="waves-effect text-muted">
                <i class="mdi mdi-view-dashboard-outline me-1 align-middle"></i>
                <span class="badge bg-success rounded-pill float-end">3</span>
                <span> Dashboards </span>
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('dashboard.analytics') }}" class="text-muted">Analytics</a>
                    </li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#sidebarContent" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="sidebarContent" class="waves-effect text-muted">
                <i class="mdi mdi-database-outline me-1 align-middle"></i>
                <span class="menu-arrow"></span>
                <span> Solidarite Plus </span>
            </a>
            <div class="collapse" id="sidebarContent">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('contents.index') }}" class="text-muted"><i class="mdi mdi-school-outline me-1 align-middle"></i> Contenu </a>
                    </li>
                    <li>
                        <a href="{{ route('donations.index') }}" class="text-muted"><i class="mdi mdi-map-marker-radius-outline me-1 align-middle"></i> Dons </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}" class="text-muted"><i class="mdi mdi-text-box-outline me-1 align-middle"></i> Evenements </a>
                    </li>
                    <li>
                        <a href="#" class="text-muted"><i class="mdi mdi-handshake-outline me-1 align-middle"></i> Partenaires </a>
                    </li>
                    <li>
                        <a href="#" class="text-muted"><i class="mdi mdi-account-heart-outline me-1 align-middle"></i> Membres </a>
                    </li>
                </ul>
            </div>
        </li>

        <li>
            <a href="" class="waves-effect text-muted">
                <i class="mdi mdi-account-group-outline me-1 align-middle"></i>
                <span> Utilisateurs </span>
            </a>
        </li>

    </ul>

</div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
