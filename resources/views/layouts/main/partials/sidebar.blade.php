<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.png') }}" style="width: 35px; height: 45px" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>{{ config('app.short_name') }}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile-information') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data-order.index') }}" class="nav-link {{ request()->routeIs('data-order.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Data Pesanan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('update.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('update.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-square"></i>
                        <p>
                            Update
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('update.status') }}" class="nav-link {{ request()->routeIs('update.status') ? 'active' : '' }}">
                                <i class="nav-icon far fa-dot-circle"></i>
                                <p>Status Pesanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('update.payment-status') }}" class="nav-link {{ request()->routeIs('update.payment-status') ? 'active' : '' }}">
                                <i class="nav-icon far fa-dot-circle"></i>
                                <p>Status Pembayaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link {{ request()->routeIs('report') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
