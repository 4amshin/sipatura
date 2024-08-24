{{-- <header class="mb-5">
    <!--Nama Perusahaan-->
    <div class="header-top">
        <div class="container justify-content-center">
            <div class="logo">
                <img src="{{ asset('assets/compiled/logo-horizontal.svg') }}" alt="Logo">
            </div>
        </div>

        <!-- Burger button responsive -->
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </div>

    <!--Navbar-->
    <nav class="main-navbar">
        <div class="container">
            <ul>
                <!--Beranda -->
                <li class="menu-item  {{ Request::is('home*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class='menu-link'>
                        <span> Beranda </span>
                    </a>
                </li>

                @can('super-user')
                    <!--Surat Masuk-->
                    <li class="menu-item  {{ Request::is('suratMasuk*') ? 'active' : '' }}">
                        <a href="{{ route('suratMasuk.index') }}" class='menu-link'>
                            <span></i> Surat Masuk</span>
                        </a>
                    </li>

                    <!--Surat Keluar-->
                    <li class="menu-item  {{ Request::is('suratKeluar*') ? 'active' : '' }}">
                        <a href="{{ route('suratKeluar.index') }}" class='menu-link'>
                            <span></i> Surat Keluar</span>
                        </a>
                    </li>
                @endcan

                <!--Laporan-->
                <li class="menu-item  {{ Request::is('laporan*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}" class='menu-link'>
                        <span></i> Laporan</span>
                    </a>
                </li>

                <!--LogOut-->
                <li class="menu-item">
                    <a href="#" class='menu-link' data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <span>LogOut</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header> --}}

<header class="mb-5">
    <div class="header-top">
        <div class="container justify-content-center">
            <div class="logo">
                <img src="{{ asset('assets/compiled/logo-horizontal.svg') }}" alt="Logo">
            </div>
        </div>

        <!-- Burger button responsive -->
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </div>

    <!-- Navbar -->
    <nav class="main-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Menu Lainnya -->
            <ul class="menu-items d-flex">
                <!--Beranda -->
                <li class="menu-item  {{ Request::is('home*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class='menu-link'>
                        <span> Beranda </span>
                    </a>
                </li>

                @can('super-user')
                    <!--Surat Masuk-->
                    <li class="menu-item  {{ Request::is('suratMasuk*') ? 'active' : '' }}">
                        <a href="{{ route('suratMasuk.index') }}" class='menu-link'>
                            <span></i> Surat Masuk</span>
                        </a>
                    </li>

                    <!--Surat Keluar-->
                    <li class="menu-item  {{ Request::is('suratKeluar*') ? 'active' : '' }}">
                        <a href="{{ route('suratKeluar.index') }}" class='menu-link'>
                            <span></i> Surat Keluar</span>
                        </a>
                    </li>
                @endcan

                <!--Laporan-->
                <li class="menu-item  {{ Request::is('laporan*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}" class='menu-link'>
                        <span></i> Laporan</span>
                    </a>
                </li>
            </ul>

            <!-- Toggle Theme dan Logout -->
            <div class="menu-right d-flex align-items-center gap-3">
                <ul class="menu-items d-flex">
                    <!--Theme Toggle-->
                    <li class="menu-item">
                        @include('layout.component.theme_toggle')
                    </li>

                    <!--LogOut-->
                    <li class="menu-item">
                        <a href="#" class='menu-link' data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <span>LogOut</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<!-- Modal Konfirmasi Logout -->
@include('layout.component.modal_logout')
