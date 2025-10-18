<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UMKM - {{ $title ?? 'Lapak UMKM' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets-guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">

    <!-- Custom UMKM Color Scheme -->
    <style>
        :root {
            --primary: #F6B35C;
            --secondary: #118AB2;
            --accent: #C2185B;
            --yellow: #F1D166;
            --white: #FFFFFF;
            --light: #F8F9FA;
            --dark: #343A40;
        }
        
        .bg-primary {
            background-color: var(--primary) !important;
        }
        .bg-secondary {
            background-color: var(--secondary) !important;
        }
        .text-primary {
            color: var(--primary) !important;
        }
        .text-secondary {
            color: var(--secondary) !important;
        }
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-secondary {
            background-color: var(--secondary) !important;
            border-color: var(--secondary) !important;
        }
        .border-primary {
            border-color: var(--primary) !important;
        }
        .border-secondary {
            border-color: var(--secondary) !important;
        }
        .topbar {
            background-color: var(--accent) !important;
        }
        .hero-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--yellow) 100%) !important;
        }
        .featurs-icon {
            background-color: var(--accent) !important;
        }
        .service-content.bg-primary {
            background-color: var(--primary) !important;
        }
        .service-content.bg-secondary {
            background-color: var(--secondary) !important;
        }
        .banner {
            background-color: var(--yellow) !important;
        }
        .footer {
            background-color: var(--accent) !important;
        }
        .copyright {
            background-color: var(--accent) !important;
        }
        .back-to-top {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        
        /* Additional custom styles */
        .navbar-brand h1 {
            font-weight: 800;
        }
        .hero-header h1 {
            font-weight: 800;
            font-size: 3.5rem;
        }
        .featurs-item {
            transition: transform 0.3s;
        }
        .featurs-item:hover {
            transform: translateY(-10px);
        }
        .fruite-item {
            transition: transform 0.3s;
        }
        .fruite-item:hover {
            transform: translateY(-5px);
        }
        .nav-pills .nav-link.active {
            background-color: var(--primary) !important;
        }
        
        /* Table styles */
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .table thead {
            background: var(--primary);
            color: white;
        }
        .table th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        .table td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }
        .action-buttons .btn {
            margin: 2px;
        }
        
        /* Form styles */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 60px 0;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white"> Pekanbaru</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">hello@umkm.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="{{ url('/') }}" class="navbar-brand"><h1 class="text-primary display-6">UMKM</h1></a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
    <div class="navbar-nav mx-auto">
        <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
        <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Warga</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle {{ request()->is('produk/create') || request()->is('warga/create') ? 'active' : '' }}" data-bs-toggle="dropdown">Tambah Data</a>
            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                <a href="{{ route('produk.create') }}" class="dropdown-item">Tambah Produk</a>
                <a href="{{ route('warga.create') }}" class="dropdown-item">Tambah Warga</a>
            </div>
        </div>
    </div>
    <div class="d-flex m-3 me-0">
        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fas fa-search text-primary"></i>
        </button>
        <a href="#" class="position-relative me-4 my-auto">
            <i class="fa fa-shopping-bag fa-2x text-primary"></i>
            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
        </a>
        <a href="#" class="my-auto">
            <i class="fas fa-user fa-2x text-primary"></i>
        </a>
    </div>
</div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
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
    <!-- Modal Search End -->

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="container mt-5 pt-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-5 pt-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Start -->
    <div class="container-fluid footer mt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">UMKM Store</h4>
                    <p class="mb-4">We provide high quality handmade fashion and craft items with unique designs and excellent craftsmanship.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Links</h4>
                    <a class="btn btn-link text-white-50" href="">About Us</a>
                    <a class="btn btn-link text-white-50" href="">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="">Our Services</a>
                    <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                    <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Pekanbaru, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@umkm.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary border-0 py-3 position-absolute top-0 end-0 mt-0 me-0">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="text-white" href="#">UMKM Store</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>
    
    @yield('scripts')
</body>
</html>