<header class="mb-5">
    <!--Nama Perusahaan-->
    <div class="header-top">
        <div class="container justify-content-center">
            <div class="logo">
                <img src="{{ asset('assets/compiled/logo-horizontal.svg') }}" alt="Logo">
            </div>
            {{-- <h1>PERSURATAN KEMENAG LUTRA</h1> --}}
        </div>

        <!-- Burger button responsive -->
        {{-- <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a> --}}
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
                    <a href="{{ route('laporan') }}" class='menu-link'>
                        <span></i> Laporan</span>
                    </a>
                </li>

                <!--LogOut-->
                <li class="menu-item  ">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class='menu-link'
                            style="background: none; border: none; cursor: pointer;">
                            <span>LogOut</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
