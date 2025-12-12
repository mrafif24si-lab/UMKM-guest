@extends('layouts.guest')

@section('title', 'Tentang Kami')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tentang Kami</h1>
        <p class="text-white lead">Mengenal lebih dekat dengan UMKM </p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <!-- Visi Misi Section -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-bullseye fa-3x text-primary mb-3"></i>
                            <h3 class="card-title">Visi Kami</h3>
                        </div>
                        <p class="card-text text-center">
                            Menjadi platform terdepan dalam memberdayakan dan mempromosikan
                            Usaha Mikro, Kecil, dan Menengah (UMKM) lokal untuk bersaing
                            di pasar global dengan produk berkualitas dan berdaya saing tinggi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-tasks fa-3x text-secondary mb-3"></i>
                            <h3 class="card-title">Misi Kami</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-check text-primary me-2"></i>
                                Meningkatkan akses pasar bagi produk UMKM lokal
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check text-primary me-2"></i>
                                Memberikan pelatihan dan pendampingan kepada pelaku UMKM
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check text-primary me-2"></i>
                                Membangun ekosistem digital yang mendukung pertumbuhan UMKM
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check text-primary me-2"></i>
                                Mempromosikan produk lokal berkualitas ke kancah internasional
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sejarah Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="mb-4">Sejarah UMKM </h2>
                                <p class="mb-4">
                                    UMKM Store didirikan pada tahun 2023 dengan tujuan mulia untuk
                                    memberdayakan para pelaku Usaha Mikro, Kecil, dan Menengah
                                    di seluruh Indonesia. Berawal dari keprihatinan terhadap
                                    potensi besar UMKM lokal yang belum tergarap secara optimal
                                    di era digital.
                                </p>
                                <p class="mb-4">
                                    Dalam perjalanannya, kami telah membantu ratusan UMKM
                                    untuk go digital dan menjangkau pasar yang lebih luas.
                                    Setiap produk yang dijual di platform kami memiliki
                                    cerita dan nilai budaya yang unik dari masing-masing daerah.
                                </p>
                                <div class="row text-center mt-4">
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3">
                                            <h3 class="text-primary mb-1">100+</h3>
                                            <p class="mb-0">UMKM Terdaftar</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3">
                                            <h3 class="text-primary mb-1">500+</h3>
                                            <p class="mb-0">Produk Unggulan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3">
                                            <h3 class="text-primary mb-1">1K+</h3>
                                            <p class="mb-0">Pelanggan Setia</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3">
                                            <h3 class="text-primary mb-1">5+</h3>
                                            <p class="mb-0">Kota Terjangkau</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <img src="{{ asset('assets-guest/img/maskot.png') }}"
                                     class="img-fluid rounded shadow"
                                     alt="Sejarah UMKM Store"
                                     style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tim Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h2>Tim Kami</h2>
                    <p class="lead">Orang-orang di balik kesuksesan UMKM Store</p>
                </div>
                <div class="row justify-content-center">
                    
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <img src="{{ asset('assets-guest/img/potoprofil.jpg') }}"
                                         class="rounded-circle img-fluid"
                                         alt="COO"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="card-title">M.Rafif Zidane</h5>
                                <p class="text-primary mb-2">Founder & CEO</p>
                                <p class="card-text small">
                                    Ahli dalam operasional bisnis dan manajemen rantai pasok
                                    dengan pengalaman 10 tahun
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100 text-center">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <img src="{{ asset('assets-guest/img/team-3.jpg') }}"
                                         class="rounded-circle img-fluid"
                                         alt="CTO"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="card-title">Oza Okta Gistrada</h5>
                                <p class="text-primary mb-2">Chief Technology Officer</p>
                                <p class="card-text small">
                                    Developer handal dengan spesialisasi dalam pengembangan
                    platform e-commerce.
                                </p>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- Nilai Perusahaan -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2>Nilai-Nilai Perusahaan</h2>
                            <p class="lead">Prinsip yang kami pegang teguh dalam setiap langkah</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-handshake fa-3x text-primary"></i>
                                </div>
                                <h5>Integritas</h5>
                                <p>
                                    Kami menjunjung tinggi kejujuran dan transparansi
                                    dalam setiap transaksi dan kerjasama.
                                </p>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-users fa-3x text-secondary"></i>
                                </div>
                                <h5>Kolaborasi</h5>
                                <p>
                                    Kami percaya pada kekuatan kolaborasi untuk menciptakan
                                    nilai yang lebih besar bagi semua pihak.
                                </p>
                            </div>
                            <div class="col-md-4 text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-rocket fa-3x text-primary"></i>
                                </div>
                                <h5>Inovasi</h5>
                                <p>
                                    Terus berinovasi untuk memberikan solusi terbaik
                                    bagi UMKM di era digital.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
