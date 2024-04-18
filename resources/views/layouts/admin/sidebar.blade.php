<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                        title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data-lila') }}" class="nav-link {{ request()->is('datalila') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>
                            Data Lila
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sekolah') }}" class="nav-link {{ request()->is('sekolah') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>
                            Data Sekolah
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu {{ request()->is('user') || request()->is('role') || request()->is('permission') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-people"></i> <span>User
                            management</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="User pages">
                        <li class="nav-item"><a href="{{ url('user') }}"
                                class="nav-link {{ request()->is('user') ? 'active' : '' }}" class="nav-link">User
                                list</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('role') }}"
                                class="nav-link {{ request()->is('role') ? 'active' : '' }}" class="nav-link">Role
                            </a></li>
                        <li class="nav-item"><a href="{{ url('permission') }}"
                                class="nav-link {{ request()->is('permission') ? 'active' : '' }}"
                                class="nav-link">Permission</a></li>
                    </ul>
                </li>

                <!-- /page kits -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
