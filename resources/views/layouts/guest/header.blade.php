<div class="container-fluid fixed-top">
    <div class="container topbar d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-accent"></i> <a href="#" class="text-white"> Pekanbaru</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-accent"></i><a href="#" class="text-white">hello@umkm.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Kebijakan Privasi</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Ketentuan Penggunaan</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Penjualan dan Pengembalian Dana</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light navbar-expand-xl">
            <img src="{{ asset('assets-guest/img/logo4..jpg') }}" alt="Logo UMKM" class="navbar-logo">

            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('tentang') }}" class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
                    <a href="{{ route('umkm.index') }}" class="nav-item nav-link {{ request()->is('umkm*') ? 'active' : '' }}">UMKM</a>
                    <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Warga</a>
                    <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->is('user*') ? 'active' : '' }}">User</a>
                    <a href="{{ route('pesanan.index') }}" class="nav-item nav-link {{ request()->is('pesanan*') ? 'active' : '' }}">Pesanan</a>
                    <a href="{{ route('detail-pesanan.index') }}" class="nav-item nav-link {{ request()->is('detail-pesanan') ? 'active' : '' }}">Detail </a>
                    <a href="{{ route('ulasan-produk.index') }}" class="nav-item nav-link {{ request()->is('ulasan-produk') ? 'active' : '' }}">Ulasan </a>
                    <a href="{{ route('identitas') }}" class="nav-item nav-link {{ request()->is('identitas') ? 'active' : '' }}">Identitas</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="#" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x text-primary"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    <div class="nav-item dropdown my-auto">
                        {{-- BAGIAN 1: TOMBOL PEMICU (TRIGGER) --}}
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" style="padding: 0 !important;">
                            @auth
                                <img src="{{ Auth::user()->avatar_url }}" alt="User" class="rounded-circle border border-white shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <i class="fas fa-user fa-2x text-primary"></i>
                            @endauth
                        </a>

                        {{-- BAGIAN 2: ISI MENU DROPDOWN --}}
                        <div class="dropdown-menu dropdown-menu-end bg-white border-0 rounded-0 shadow-sm m-0">
                            @auth
                                <div class="dropdown-item text-muted disabled" style="font-size: 0.8rem; font-weight: bold;">
                                    Hai, {{ Auth::user()->name }}
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="fas fa-user-circle me-2"></i> Profil Saya
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="dropdown-item">
                                    <i class="fas fa-sign-in-alt me-2"></i> Login
                                </a>
                                <a href="{{ route('register') }}" class="dropdown-item">
                                    <i class="fas fa-user-plus me-2"></i> Register
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>