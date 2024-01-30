<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('images/favicon.ico') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light font-weight-bold">PIS Akademik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">Pesantren Imam Syafi'i</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('student.dashboard') }}"
                        class="nav-link {{ Request::routeIs('student.dashboard') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                
                <li class="nav-item {{ Request::is('student/kesantrian/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('student/kesantrian/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Kesantrian
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.kesantrian.beasiswa') }}"
                                class="nav-link {{ Request::routeIs('student.kesantrian.beasiswa') ? 'active' :'' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Beasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.kesantrian.prestasi') }}"
                                class="nav-link {{ Request::routeIs('student.kesantrian.prestasi') ? 'active' :'' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.kesantrian.pelanggaran') }}"
                                class="nav-link {{ Request::routeIs('student.kesantrian.pelanggaran') ? 'active' :'' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Pelanggaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('student/cetak/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('student/cetak/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Cetak
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.cetak.surat-aktif') }}"
                                class="nav-link {{ Request::routeIs('student.cetak.surat-aktif') ? 'active' :'' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Surat Aktif</p>
                            </a>
                        </li>
                    </ul>
                </li>




                <li class="nav-header">LABELS</li>
                <li class="nav-item">
                    <a href="{{ route('student.kalender') }}"
                        class="nav-link {{ Request::routeIs('student.kalender') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p class="text">Kalender Akademik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.profile') }}"
                        class="nav-link {{ Request::routeIs('student.profile') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p class="text">Profile</p>
                    </a>
                </li>
                 <!-- Authentication -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('student.profile') }}"
                            class="nav-link" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p class="text">Logout</p>
                        </a>
                    </form>
                </li>
                 <!-- Authentication -->

            </ul>
        </nav>

    </div>
</aside>
