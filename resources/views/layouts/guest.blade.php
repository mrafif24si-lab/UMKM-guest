<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> UMKM - {{ $title ?? 'Lapak UMKM' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets-guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">

    <!-- Custom UMKM Color Scheme & Enhanced Styles -->
    <style>
        :root {
            --primary: #F6B35C;
            --secondary: #118AB2;
            --accent: #C2185B;
            --yellow: #F1D166;
            --white: #FFFFFF;
            --light: #F8F9FA;
            --dark: #343A40;
            --darker: #1a1a2e;
            --card-bg: rgba(255, 255, 255, 0.85);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(246, 179, 92, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(17, 138, 178, 0.05) 0%, transparent 20%);
            z-index: -1;
        }

        /* Enhanced Spinner */
        #spinner {
            z-index: 99999;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .spinner-grow {
            width: 4rem;
            height: 4rem;
            animation: pulse-grow 1.5s infinite;
        }

        @keyframes pulse-grow {
            0% { transform: scale(0.8); opacity: 0.7; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.7; }
        }

        /* Enhanced Navbar */
        .topbar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 8px 0;
        }

        .navbar {
            backdrop-filter: blur(12px);
            background: var(--glass-bg) !important;
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            padding: 1rem 0;
        }

        .navbar-brand h1 {
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 8s ease infinite;
            background-size: 200% auto;
            font-size: 2.5rem;
            letter-spacing: 1px;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .nav-item.nav-link {
            position: relative;
            padding: 15px 20px !important;
            transition: all 0.3s ease;
            color: var(--dark) !important;
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
        }

        .nav-item.nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-item.nav-link:hover::after,
        .nav-item.nav-link.active::after {
            width: 70%;
        }

        .nav-item.nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-3px);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-search, .position-relative i {
            transition: all 0.3s ease;
        }

        .btn-search:hover, .position-relative i:hover {
            color: var(--primary) !important;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--yellow) 100%);
            position: relative;
            overflow: hidden;
            padding: 180px 0 120px;
            z-index: 1;
        }

        .hero-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 30%);
        }

        .hero-header h1 {
            font-weight: 800;
            font-size: 4.5rem;
            color: var(--white);
            text-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: fadeInDown 1s ease-out;
            margin-bottom: 20px;
        }

        .hero-header p {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            animation: fadeInUp 1s ease-out 0.3s both;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .btn-hero {
            animation: fadeInUp 1s ease-out 0.6s both;
            transform: translateY(20px);
            transition: all 0.3s ease;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .btn-hero:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
        }

        /* Feature Cards */
        .featurs-item {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .featurs-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0;
            z-index: -1;
            border-radius: 20px;
            transition: opacity 0.4s ease;
        }

        .featurs-item:hover {
            transform: translateY(-18px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.18);
        }

        .featurs-item:hover::before {
            opacity: 0.12;
        }

        .featurs-icon {
            background: linear-gradient(135deg, var(--accent), #e91e63);
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 25px;
            transition: all 0.3s ease;
            font-size: 2.5rem;
        }

        .featurs-item:hover .featurs-icon {
            transform: scale(1.15) rotate(15deg);
            box-shadow: 0 15px 25px rgba(194, 24, 91, 0.3);
        }

        .featurs-item h5 {
            font-weight: 700;
            color: var(--darker);
            margin-bottom: 10px;
        }

        /* Product Cards */
        .fruite-item {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .fruite-item:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0, 0.15);
        }

        .fruite-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .fruite-item:hover .fruite-img {
            transform: scale(1.1);
        }

        .fruite-name {
            font-weight: 600;
            color: var(--dark);
            transition: color 0.3s ease;
            font-size: 1.2rem;
        }

        .fruite-item:hover .fruite-name {
            color: var(--primary);
        }

        .fruite-price {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.3rem;
        }

        /* Enhanced Table Styles */
        .table-container {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        .table thead {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
        }

        .table th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            font-size: 0.9rem;
        }

        .table td {
            padding: 18px 15px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }

        .table tr:nth-child(even) {
            background-color: rgba(248, 249, 250, 0.4);
        }

        .table tr:hover {
            background-color: rgba(246, 179, 92, 0.08);
        }

        /* Form Container */
        .form-container {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            padding: 40px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 80px 0;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 30%);
        }

        .page-header h1 {
            color: var(--white);
            font-weight: 800;
            font-size: 2.8rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* Footer Enhancements */
        .footer {
            background: linear-gradient(135deg, var(--darker) 0%, var(--accent) 100%);
            color: var(--light);
            padding-top: 80px;
        }

        .footer h4 {
            position: relative;
            padding-bottom: 15px;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .footer h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .btn-footer {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.15);
            color: var(--light);
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 50px;
            margin-bottom: 10px;
            display: block;
            width: 100%;
        }

        .btn-footer:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .copyright {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            padding: 20px 0;
        }

        /* WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            width: 75px;
            height: 75px;
            bottom: 35px;
            right: 35px;
            background: linear-gradient(135deg, #25d366, #128C7E);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 32px;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
            text-decoration: none;
            border: 3px solid white;
        }

        .whatsapp-float:hover {
            transform: scale(1.12) rotate(12deg);
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.7);
        }

        .whatsapp-tooltip {
            position: fixed;
            bottom: 120px;
            right: 35px;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 15px;
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.3s ease;
            z-index: 1000;
            white-space: nowrap;
            pointer-events: none;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .whatsapp-float:hover+.whatsapp-tooltip {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 25px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 115px;
            right: 35px;
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            z-index: 99;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: 2px solid white;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Utility Classes */
        .section-padding {
            padding: 120px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 70px;
            position: relative;
        }

        .section-title h2 {
            font-weight: 800;
            color: var(--darker);
            display: inline-block;
            position: relative;
            z-index: 1;
            font-size: 2.5rem;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 6px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        /* Alert Animations */
        .alert {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-20px);
            animation: slideIn 0.5s ease-out forwards;
            backdrop-filter: blur(5px);
            border-left: 5px solid var(--primary);
        }

        @keyframes slideIn {
            to { transform: translateY(0); }
        }

        /* Hover Effects for Buttons */
        .btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: all 0.6s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .hero-header h1 {
                font-size: 3rem;
            }

            .hero-header p {
                font-size: 1.1rem;
            }

            .whatsapp-float {
                width: 65px;
                height: 65px;
                bottom: 25px;
                right: 25px;
                font-size: 28px;
            }

            .whatsapp-tooltip {
                bottom: 100px;
                right: 25px;
                font-size: 13px;
            }

            .nav-item.nav-link {
                padding: 10px 15px !important;
            }

            .featurs-item, .fruite-item {
                margin-bottom: 30px;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white"> Pekanbaru</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white">hello@umkm.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light navbar-expand-xl shadow-sm">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <h1 class="text-primary display-6"> UMKM </h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
                        <!-- TAMBAHAN MENU UMKM -->
                        <a href="{{ route('umkm.index') }}" class="nav-item nav-link {{ request()->is('umkm*') ? 'active' : '' }}">UMKM</a>
                        <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Warga</a>
                        <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->is('user*') ? 'active' : '' }}">User</a>
                        <a href="{{ route('tentang') }}" class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>
                        <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a>
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
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Main Content -->
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

        @yield('content')
    </main>
    <!-- end Content -->

    <!-- Footer Start -->
    <div class="container-fluid footer mt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">UMKM </h4>
                    <p class="mb-4">We provide high quality handmade fashion and craft items with unique designs and
                        excellent craftsmanship.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-footer me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-footer me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-footer me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-footer me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a class="btn btn-link text-white-50" href="">About Us</a>
                    <a class="btn btn-link text-white-50" href="">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="">Our Services</a>
                    <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                    <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Paus Street, Pekanbaru, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@umkm.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary border-0 py-3 position-absolute top-0 end-0 mt-0 me-0">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="text-white" href="#">UMKM</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281234567890?text=Halo%20UMKM%2C%20saya%20ingin%20bertanya%20tentang%20produk%20Anda"
        class="whatsapp-float" target="_blank" aria-label="Hubungi kami via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <div class="whatsapp-tooltip">Hubungi Kami via WhatsApp</div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Spinner fade out
            setTimeout(() => {
                const spinner = document.getElementById('spinner');
                if (spinner) {
                    spinner.style.opacity = '0';
                    spinner.style.visibility = 'hidden';
                    // Ensure it's removed from the DOM after animation
                    setTimeout(() => spinner.remove(), 500);
                }
            }, 1200);

            // Back to top button
            const backToTop = document.querySelector('.back-to-top');
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 400) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Enhanced navbar scroll effect
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.style.padding = '0.6rem 0';
                    navbar.style.boxShadow = '0 4px 25px rgba(0,0,0,0.12)';
                } else {
                    navbar.style.padding = '1rem 0';
                    navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';
                }
            });

            // Parallax effect on hero background
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.hero-header');
                if (parallax) {
                    const speed = scrolled * 0.4;
                    parallax.style.backgroundPosition = `0 ${speed}px`;
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>