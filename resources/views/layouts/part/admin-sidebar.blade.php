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
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">

            <div class="info">
                <a href="#" class="d-block">Pesantren Imam Syafi'i</a>
            </div>
        </div>



        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can(['Kelola Santri'])
                <li class="nav-item {{ Request::is('admin/santri/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('admin/santri/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Santri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa.aktif') }}"
                                class="nav-link {{ Request::routeIs('admin.siswa.aktif') ? 'active' :'' }}">
                                <i class="fas fa-dot nav-icon text-warning"></i>
                                <p>Santri Aktif</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa.yatim') }}"
                                class="nav-link {{ Request::routeIs('admin.siswa.yatim') ? 'active' :'' }}">
                                <i class="fas fa-dot nav-icon text-warning"></i>
                                <p>Santri Yatim</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa.lulus') }}"
                                class="nav-link {{ Request::routeIs('admin.siswa.lulus') ? 'active' :'' }}">
                                <i class="fas fa-dot nav-icon text-warning"></i>
                                <p>Santri Lulus</p>
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa.mutasi.keluar') }}"
                                class="nav-link {{ Request::routeIs('admin.siswa.mutasi.keluar') ? 'active' :'' }}">
                                <i class="fas fa-dot nav-icon text-warning"></i>
                                <p>Santri Pindah</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('Kelola Pegawai')
                <li class="nav-item {{ Request::is('admin/pegawai/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('admin/pegawai/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Pegawai
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.pegawai.index') }}"
                                class="nav-link {{ Request::routeIs('admin.pegawai.index') ? 'active' :'' }}">
                                <i class="fas fa-dot nav-icon text-warning"></i>
                                <p>Pegawai Aktif</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    
                @endcan
                @can('kelola Master Data')
                <li class="nav-item {{ Request::is('admin/master/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('admin/master/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.tahun-semester') }}"
                                class="nav-link {{ Request::routeIs('admin.master.tahun-semester') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Tahun/Semester</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.sekolah') }}"
                                class="nav-link {{ Request::routeIs('admin.master.sekolah') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Sekolah</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.rombel') }}"
                                class="nav-link {{ Request::routeIs('admin.master.rombel') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Kelas/Rombel</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.matapelajaran') }}"
                                class="nav-link {{ Request::routeIs('admin.master.matapelajaran') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('Kelola Data Kepengasuhan')
                <li class="nav-item {{ Request::is('admin/kesantrian/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('admin/kesantrian/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Kesantrian
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.kesantrian.rekap') }}"
                                class="nav-link {{ Request::routeIs('admin.kesantrian.rekap') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Rekap</p>
                            </a>
                            <a href="{{ route('admin.kesantrian.prestasi') }}"
                                class="nav-link {{ Request::routeIs('admin.kesantrian.prestasi') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Prestasi</p>
                            </a>
                            <a href="{{ route('admin.kesantrian.beasiswa') }}"
                                class="nav-link {{ Request::routeIs('admin.kesantrian.beasiswa') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Beasiswa</p>
                            </a>
                            <a href="{{ route('admin.kesantrian.pelanggaran') }}"
                                class="nav-link {{ Request::routeIs('admin.kesantrian.pelanggaran') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Pelanggaran</p>
                            </a>
                            
                        </li>
                    </ul>
                </li>
                    
                @endcan

                
                
                <li class="nav-item {{ Request::is('admin/cetak/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('admin/cetak/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Cetak
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.cetak.surat-aktif') }}"
                                class="nav-link {{ Request::routeIs('admin.cetak.surat-aktif') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Surat Aktif</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('Cetak Surat')
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}"
                        class="nav-link {{ Request::routeIs('admin.profile') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p class="text">Profile</p>
                    </a>
                </li>
                @endcan

                
                @role('Super Admin')
                <li class="nav-header">Area Super Admin</li>
                <li class="nav-item {{ Request::is('admin/akun/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href=""
                        class="nav-link {{ Request::is('admin/akun/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Akun
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.akun.pegawai') }}"
                                class="nav-link {{ Request::routeIs('admin.akun.pegawai') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Akun Pegawai</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.akun.role') }}"
                                class="nav-link {{ Request::routeIs('admin.akun.role') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Role Access</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.akun.permission') }}"
                                class="nav-link {{ Request::routeIs('admin.akun.permission') ? 'active' :'' }}">
                                <i class="far fa-minus nav-icon text-warning"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                
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
