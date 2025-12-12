@extends('layouts.guest')

@section('title', 'UMKM - Home')

@section('content')
    <!-- Hero Start -->
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
    <!-- Hero End -->

    <!-- Featurs Section Start -->
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
    <!-- Featurs Section End -->

    <!-- Banners Section Start -->
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
    <!-- Banners Section End -->

    {{-- <!-- Fresh Vegetables Section Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h1 class="mb-4">Fresh Organic Vegetables</h1>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="service-content bg-light rounded p-4">
                                <h5 class="text-primary">Vegetable</h5>
                                <h6 class="mb-3">Parsely</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tat incididunt.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-content bg-light rounded p-4">
                                <h5 class="text-primary">Vegetable</h5>
                                <h6 class="mb-3">Banana</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tat incididunt.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-content bg-light rounded p-4">
                                <h5 class="text-primary">Vegetable</h5>
                                <h6 class="mb-3">Bell Papper</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tat incididunt.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-content bg-light rounded p-4">
                                <h5 class="text-primary">Vegetable</h5>
                                <h6 class="mb-3">Potatoes</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tat incididunt.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets-guest/img/vegetable-banner.png') }}" class="img-fluid rounded" alt="Fresh Vegetables">
                </div>
            </div>
        </div>
    </div>
    <!-- Fresh Vegetables Section End --> --}}

    <!-- Products Shop Start-->
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
                                    <!-- Product items here (sama seperti yang asli) -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g1.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Makanan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Nasi Telur</h4>
                                                <p>Nasi dan Telur dengan sambal terasi yang memiliki Citarasa yang Menarik dan Enak,Serta harganya terjangkau</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.15 k</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g2.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Ikan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Ikan Nila</h4>
                                                <p>Ikan Nila segar yang sudah di potong-potong dan Dicuci Bersih Agar Lebih enak saat diolah nantinya</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.45 K </p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g13.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Buah</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Jagung Madu</h4>
                                                <p>Jagung yang memiliki Rasa yang Cenderung lebih Manis dan Bercitarasa Gurih dari padaJagung Biasanya</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.10 K</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g4.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Ikan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Nila Marinasi</h4>
                                                <p>Ikan Nila yang sudah di cuci bersih lal Diberi dengan racikan Bumbu khas Nusantara, Sehingga Memiliki Citarasa yang Enak</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.55 k</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g5.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Makanan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Ayam Telur Asin</h4>
                                                <p>Ayam yanf dibalut dengan tepung,Lalu di SIram dengan Saos Telur Asin dan Diberikan Telur Ceplok</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.20 K</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g6.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Buah</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Kurma Muda</h4>
                                                <p>Kurma yang Berasal dari Saudi Arabia yang Memiliki Citarasa yang Manis dan Lebih Cruncy dari pada kurma biasanya</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.90 K</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g9.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Makanan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Ikan Lele Marinasi</h4>
                                                <p>Lele Yang sudah di Cuci Bersih dan Diberikan Bumbu-Bumbu khas Musantara yang Bercitarasa sangat Enak</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.40 K</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('assets-guest/img/g8.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Hewan</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Ayam Kate</h4>
                                                <p>Ayam yang Memiliki ciri Khas Tersendiri yaitu Postur Badan yang lebih Pendek dan Dadanya lebih Membusung </p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.400 K</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tambahkan product items lainnya sesuai kebutuhan -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Shop End-->
@endsection
