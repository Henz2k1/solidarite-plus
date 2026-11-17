
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <div class="logo-box">
        <a href="" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm-dark.png') }}"
                     alt="Logo" height="24">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}"
                     alt="Logo" height="20">
            </span>
        </a>

        <a href="{{ route('dashboard.analytics') }}"
           class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}"
                     alt="Logo" height="24">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}"
                     alt="Logo" height="20">
            </span>
        </a>
    </div>

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                 alt="user-img"
                 class="rounded-circle avatar-md">

            <div class="dropdown">
                <a href="#"
                   class="text-reset dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-bs-toggle="dropdown">
                    {{ Auth::user()->name ?? 'Administrateur' }}
                </a>

                <div class="dropdown-menu user-pro-dropdown">
                    <a href="#" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-outline me-1"></i>
                        <span>Mon compte</span>
                    </a>

                    <a href="#" class="dropdown-item notify-item">
                        <i class="mdi mdi-cog-outline me-1"></i>
                        <span>Paramètres</span>
                    </a>

                    <a href="#" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>

            <p class="text-reset">Administrateur</p>
        </div>

        <!-- Sidebar Menu -->
        <div id="sidebar-menu">
            <ul id="side-menu">

                <!-- Dashboard -->
                <li>
                    <a href="#sidebarDashboards"
                       data-bs-toggle="collapse"
                       aria-expanded="false"
                       aria-controls="sidebarDashboards"
                       class="waves-effect text-muted">

                        <i class="mdi mdi-view-dashboard-outline me-1 align-middle"></i>
                        <span class="menu-arrow"></span>
                        <span>Tableau de bord</span>
                    </a>

                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('dashboard.analytics') }}"
                                   class="text-muted">
                                    <i class="mdi mdi-chart-line me-1 align-middle"></i>
                                    Analytics
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Solidarité Plus -->
                <li>
                    <a href="#sidebarContent"
                       data-bs-toggle="collapse"
                       aria-expanded="false"
                       aria-controls="sidebarContent"
                       class="waves-effect text-muted">

                        <i class="mdi mdi-hand-heart-outline me-1 align-middle"></i>
                        <span class="menu-arrow"></span>
                        <span>Solidarité Plus</span>
                    </a>

                    <div class="collapse" id="sidebarContent">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('contents.index') }}"
                                   class="text-muted">
                                    <i class="mdi mdi-file-document-outline me-1 align-middle"></i>
                                    Contenus
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('donations.index') }}" class="text-muted">
                                    <i class="mdi mdi-cash-multiple me-1 align-middle"></i>
                                    Dons
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.events.index') }}"
                                   class="text-muted">
                                    <i class="mdi mdi-calendar-star me-1 align-middle"></i>
                                    Événements
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Utilisateurs -->
                <li>
                    <a href="#" class="waves-effect text-muted">
                        <i class="mdi mdi-account-group-outline me-1 align-middle"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
