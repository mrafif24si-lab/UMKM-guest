@extends('layouts.guest.app') {{-- Menggunakan layout baru --}}

@section('title', 'UMKM - Home')

@section('content')
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-white">Produk 100% Buatan Tangan</h4>
                    <h1 class="mb-5 display-3 text-white">Produk Olahan & Barang Kerajinan</h1>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-2 border-white w-75 py-3 px-4 rounded-pill" type="text" placeholder="Cari Produk...">
                        <button type="submit" class="btn btn-secondary border-2 border-white py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Cari Sekarang</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('assets-guest/img/jj2.jpg') }}" class="img-fluid w-100 h-100 bg-white rounded" alt="First slide">
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('assets-guest/img/jj1.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            </div>
                             <div class="carousel-item rounded">
                                <img src="{{ asset('assets-guest/img/jj3.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="Third slide">
                            </div>
                             <div class="carousel-item rounded">
                                <img src="{{ asset('assets-guest/img/jj6.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="Fourth slide">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Pengiriman Gratis</h5>
                            <p class="mb-0">Gratis untuk pesanan di atas Rp.300.000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Keamanan Dalam Transaksi</h5>
                            <p class="mb-0">100% Transaksi Aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Pengembalian 30 Hari</h5>
                            <p class="mb-0">Garansi uang kembali 30 hari</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Dukungan 24/7</h5>
                            <p class="mb-0">Dukungan setiap saat dengan cepat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid banner py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="banner-item text-center rounded p-4" style="background-color: var(--white);">
                        <h4 class="text-primary">Bersama</h4>
                        <h5 class="text-secondary">Membangkitkan</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner-item text-center rounded p-4" style="background-color: var(--white);">
                        <h4 class="text-primary">Membangun</h4>
                        <h5 class="text-secondary">Kreativitas</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner-item text-center rounded p-4" style="background-color: var(--white);">
                        <h4 class="text-primary">UMKM</h4>
                        <h5 class="text-secondary">Masyarakat</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Produk Terbaik Kami</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">Semua Produk</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Kerajinan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Jasa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Elektronik</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                    <span class="text-dark" style="width: 130px;">Kuliner</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @forelse($produkTerbaik as $produk)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item h-100">
                                                <div class="fruite-img">
                                                    {{-- LOGIKA PENAMPILAN GAMBAR --}}
                                                    @if($produk->media->count() > 0)
                                                        @php
                                                            $gambarPertama = $produk->media->first();
                                                        @endphp
                                                        
                                                        <img src="{{ asset('storage/media/' . $gambarPertama->file_name) }}" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="height: 200px; object-fit: cover;"
                                                             alt="{{ $produk->nama_produk }}"
                                                             onerror="this.onerror=null; this.src='{{ asset('assets-guest/img/placeholder.jpg') }}'">
                                                    @else
                                                        {{-- Tampilkan Placeholder jika memang tidak ada gambar di database --}}
                                                        <img src="{{ asset('assets-guest/img/placeholder.jpg') }}" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="height: 200px; object-fit: cover;"
                                                             alt="No Image">
                                                    @endif
                                                </div>
                                                
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                                    {{ $produk->jenis_produk }}
                                                </div>
                                                
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom h-100 d-flex flex-column">
                                                    <h4 class="mb-2">{{ $produk->nama_produk }}</h4>
                                                    <p class="mb-3 flex-grow-1" style="min-height: 60px;">
                                                        {{ Str::limit($produk->deskripsi, 80) }}
                                                    </p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
                                                        <p class="text-dark fs-5 fw-bold mb-0">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                                        {{-- TOMBOL BELI DENGAN IKON KERANJANG --}}
                                                        <button type="button" 
                                                                class="btn btn-success border-0 rounded-pill px-3 text-white beli-produk"
                                                                data-produk-id="{{ $produk->produk_id }}"
                                                                data-produk-nama="{{ $produk->nama_produk }}"
                                                                data-produk-harga="{{ $produk->harga }}">
                                                            <i class="fas fa-shopping-cart me-2"></i>Beli
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>Belum ada produk yang tersedia.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        
                        @if($produkTerbaik->count() > 0)
                        <div class="text-center mt-5">
                            <a href="{{ route('produk.index') }}" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-boxes me-2"></i>Lihat Semua Produk
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    <div id="tab-2" class="tab-pane fade show p-0">
                        </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        </div>
                    <div id="tab-5" class="tab-pane fade show p-0">
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Memindahkan Script ke section khusus agar dibaca setelah jQuery diload di layout --}}
@section('scripts')
<script>
    // Fungsi untuk memuat produk berdasarkan kategori
    function loadProdukByKategori(kategori) {
        $.ajax({
            url: '{{ route("home") }}',
            type: 'GET',
            data: { kategori: kategori },
            beforeSend: function() {
                $('#tab-1 .row.g-4').html('<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
            },
            success: function(response) {
                // Update konten produk
                // Catatan: Ini perlu penyesuaian jika Anda menggunakan AJAX
            },
            error: function() {
                alert('Terjadi kesalahan saat memuat produk');
            }
        });
    }

    // Event listener untuk tab
    $('.nav-pills a').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href");
        
        // Reset semua tab
        $('.nav-pills a').removeClass('active');
        $(e.target).addClass('active');
        
        // Reset semua tab content
        $('.tab-pane').removeClass('show active');
        $(target).addClass('show active');
        
        // Anda bisa tambahkan AJAX di sini untuk memuat produk per kategori
        // var kategori = $(e.target).text().trim();
        // loadProdukByKategori(kategori);
    });
</script>
@endsection