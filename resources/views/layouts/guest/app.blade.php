<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> UMKM - {{ $title ?? 'Lapak UMKM' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    {{-- Memanggil Partial CSS --}}
    @include('layouts.guest.css')
    
</head>

<body>

    <img src="{{ asset('assets-guest/img/logo-umkm.png') }}" alt="Logo UMKM" class="loading-logo-img" style="height: 80px; margin-bottom: 20px;">
    
    <div class="loading-system" id="loadingSystem">
        <div class="loading-logo">UMKM</div>
        <div class="spinner-grow"></div>
        <div class="loading-bar-container">
            <div class="loading-bar"></div>
        </div>
    </div>

    <div class="particle-system" id="particleSystem"></div>

    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    {{-- Memanggil Partial Header (Navbar) --}}
    @include('layouts.guest.header')

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        @if (session('success'))
            <div class="container mt-5 pt-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mt-5 pt-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        {{-- Tempat konten halaman akan dirender --}}
        @yield('content')
    </main>
    {{-- Memanggil Partial Footer --}}
    @include('layouts.guest.footer')

    <a href="https://wa.me/6281234567890?text=Halo%20UMKM%2C%20saya%20ingin%20bertanya%20tentang%20produk%20Anda" class="whatsapp-float" target="_blank" aria-label="Hubungi kami via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <div class="whatsapp-tooltip">Hubungi Kami via WhatsApp</div>

    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    {{-- Memanggil Partial JS --}}
    @include('layouts.guest.js')

    {{-- Script tambahan dari halaman tertentu (jika ada) --}}
    @yield('scripts')

</body>

</html>