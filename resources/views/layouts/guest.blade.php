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
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Raleway:wght@600;700;800;900&display=swap"
        rel="stylesheet">


    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets-guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">


    <!-- Advanced UMKM Animations & Effects -->
    <style>
        /* PERBAIKAN: Compact Navigation Items */
.nav-item.nav-link {
    position: relative;
    padding: 10px 15px !important; /* Dikurangi dari 15px 25px */
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    color: var(--dark) !important;
    font-weight: 600;
    font-size: 1rem; /* Dikurangi dari 1.1rem */
    letter-spacing: 0.5px; /* Dikurangi dari 0.8px */
    margin: 0 5px; /* Dikurangi dari 0 8px */
    border-radius: 8px; /* Dikurangi dari 12px */
    overflow: hidden;
    z-index: 1;
}

/* Untuk mobile, buat lebih kecil */
@media (max-width: 768px) {
    .nav-item.nav-link {
        padding: 8px 12px !important;
        font-size: 0.9rem;
        margin: 0 3px;
    }
}

/* PERBAIKAN: Navbar yang lebih compact */
.navbar {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%) !important;
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.8);
    transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    padding: 0.5rem 0 !important; /* Dikurangi dari 1rem 0 */
}

.navbar.scrolled {
    padding: 0.4rem 0 !important; /* Dikurangi dari 0.8rem 0 */
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.98) 100%) !important;
    transform: translateY(-2px);
}
        :root {
            --primary: #F6B35C;
            --secondary: #118AB2;
            --accent: #C2185B;
            --yellow: #F1D166;
            --white: #FFFFFF;
            --light: #F8F9FA;
            --dark: #343A40;
            --darker: #1a1a2e;
            --card-bg: rgba(255, 255, 255, 0.92);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.3);
            --gradient-primary: linear-gradient(135deg, #F6B35C 0%, #F8C471 100%);
            --gradient-secondary: linear-gradient(135deg, #118AB2 0%, #1E95C0 100%);
            --gradient-hero: linear-gradient(135deg, #F6B35C 0%, #F8C471 50%, #F1D166 100%);
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }


        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(246, 179, 92, 0.08) 0%, transparent 25%),
                radial-gradient(circle at 90% 80%, rgba(17, 138, 178, 0.08) 0%, transparent 25%),
                radial-gradient(circle at 50% 50%, rgba(241, 209, 102, 0.05) 0%, transparent 50%);
            z-index: -1;
            animation: backgroundShift 15s ease infinite;
        }


        @keyframes backgroundShift {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }


        /* Advanced Loading System */



        /* Enhanced Spinner */
        #spinner {
            z-index: 99998;
            background: transparent;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }


        .spinner-grow {
            width: 5rem;
            height: 5rem;
            animation: advancedPulse 2s infinite, rotate3D 3s infinite linear;
            background: conic-gradient(from 0deg, var(--primary), var(--secondary), var(--accent), var(--primary));
            border-radius: 50%;
            position: relative;
        }


        .spinner-grow::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: conic-gradient(from 180deg, var(--secondary), var(--primary), var(--yellow), var(--secondary));
            border-radius: 50%;
            z-index: -1;
            animation: rotate3D 4s infinite linear reverse;
            opacity: 0.7;
        }


        @keyframes advancedPulse {
            0% { transform: scale(0.8) rotate(0deg); box-shadow: 0 0 0 0 rgba(246, 179, 92, 0.7); }
            50% { transform: scale(1.2) rotate(180deg); box-shadow: 0 0 0 20px rgba(246, 179, 92, 0); }
            100% { transform: scale(0.8) rotate(360deg); box-shadow: 0 0 0 0 rgba(246, 179, 92, 0.7); }
        }


        @keyframes rotate3D {
            0% { transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg); }
            33% { transform: rotateX(120deg) rotateY(60deg) rotateZ(120deg); }
            66% { transform: rotateX(240deg) rotateY(120deg) rotateZ(240deg); }
            100% { transform: rotateX(360deg) rotateY(180deg) rotateZ(360deg); }
        }


        /* FIXED: Enhanced Navbar - Consistent Design */
        .topbar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 10px 0;
            position: relative;
            overflow: hidden;
        }


        .topbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 4s infinite;
        }


        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }


        FIXED: Navbar dengan design yang konsisten
        .navbar {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8);

            transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            padding: 1rem 0;
        }


        .navbar.scrolled {
            padding: 0.8rem 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.98) 100%) !important;

            transform: translateY(-2px);
        }

     /* PERBAIKAN: Navbar Logo */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            height: 50px; /* Atur tinggi logo */
            width: auto; /* Biarkan lebar menyesuaikan */
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            border-radius: 8px; /* Opsional: untuk logo dengan sudut lembut */
        }

        .navbar-brand:hover .navbar-logo {
            transform: scale(1.1) rotate(5deg);
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        .navbar-brand-text {
            font-weight: 900;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 6s ease infinite;
            background-size: 200% auto;
            font-size: 2.4rem; /* Diperkecil sedikit untuk memberi ruang logo */
            letter-spacing: 2px;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin: 0;
            line-height: 1;
        }

        .navbar-brand-text::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .navbar-brand:hover .navbar-brand-text::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Responsive untuk logo */
        @media (max-width: 768px) {
            .navbar-logo {
                height: 40px; /* Logo lebih kecil di mobile */
            }

            .navbar-brand-text {
                font-size: 1.8rem; /* Teks lebih kecil di mobile */
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                gap: 8px;
            }

            .navbar-logo {
                height: 35px;
            }

            .navbar-brand-text {
                font-size: 1.5rem;
            }
        }

        /* Opsional: Alternatif jika hanya ingin logo tanpa teks */
        .navbar-brand.logo-only {
            gap: 0;
        }

        .navbar-brand.logo-only .navbar-logo {
            height: 55px;
        }

        .navbar-brand.logo-only .navbar-brand-text {
            display: none;
        }
        /* .navbar-brand h1 {
            font-weight: 900;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 6s ease infinite;
            background-size: 200% auto;
            font-size: 2.8rem;
            letter-spacing: 2px;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }


        .navbar-brand h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }


        .navbar-brand:hover h1::after {
            transform: scaleX(1);
            transform-origin: left;
        } */


        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }


        /* FIXED: Navigation Items dengan efek yang konsisten */
        /* .nav-item.nav-link {
            position: relative;
            padding: 15px 25px !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: var(--dark) !important;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.8px;
            margin: 0 8px;
            border-radius: 12px;
            overflow: hidden;
            z-index: 1;
        } */


        .nav-item.nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            transition: all 0.6s ease;
            z-index: -1;
        }


        .nav-item.nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: translateX(-50%);
        }


        .nav-item.nav-link:hover::before {
            left: 100%;
        }


        .nav-item.nav-link:hover::after,
        .nav-item.nav-link.active::after {
            width: 80%;
        }


        .nav-item.nav-link:hover,
        .nav-item.nav-link.active {
            color: var(--primary) !important;
            transform: translateY(-3px);
            text-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }


        .btn-search, .position-relative i {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }


        .btn-search:hover, .position-relative i:hover {
            color: var(--primary) !important;
            transform: scale(1.2) rotate(12deg);
            filter: drop-shadow(0 4px 8px rgba(246, 179, 92, 0.4));
        }


        /* Advanced Hero Section */
        .hero-header {
            background: var(--gradient-hero);
            position: relative;
            overflow: hidden;
            padding: 200px 0 150px;
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
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.3) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.2) 0%, transparent 40%);
            animation: floatMulti 8s ease-in-out infinite;
        }


        @keyframes floatMulti {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(2deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }


        .hero-header h1 {
            font-weight: 900;
            font-size: 5rem;
            color: var(--white);
            text-shadow: 0 6px 20px rgba(0,0,0,0.3);
            animation: fadeInDown 1s ease-out, textGlow 3s ease-in-out infinite alternate;
            margin-bottom: 25px;
            position: relative;
        }


        @keyframes textGlow {
            from {
                text-shadow: 0 6px 20px rgba(0,0,0,0.3), 0 0 20px rgba(255,255,255,0.2);
            }
            to {
                text-shadow: 0 6px 30px rgba(0,0,0,0.5), 0 0 30px rgba(255,255,255,0.4), 0 0 40px rgba(255,255,255,0.2);
            }
        }


        .hero-header p {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            animation: fadeInUp 1s ease-out 0.4s both;
            max-width: 650px;
            margin: 0 auto 40px;
            font-weight: 500;
            line-height: 1.6;
        }


        .btn-hero {
            animation: fadeInUp 1s ease-out 0.8s both;
            transform: translateY(30px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 18px 45px;
            font-weight: 700;
            letter-spacing: 1.5px;
            border-radius: 60px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            font-size: 1.2rem;
        }


        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: all 0.8s ease;
            z-index: -1;
        }


        .btn-hero:hover::before {
            left: 100%;
        }


        .btn-hero:hover {
            transform: translateY(-10px) scale(1.08);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }


        /* Advanced Floating System */
        .floating-system {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
        }


        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: floatAdvanced 20s infinite linear;
            box-shadow: 0 8px 25px rgba(255,255,255,0.1);
        }


        .floating-element:nth-child(2n) {
            background: rgba(255, 255, 255, 0.1);
            animation-duration: 25s;
            animation-direction: reverse;
        }


        .floating-element:nth-child(3n) {
            background: rgba(255, 255, 255, 0.2);
            animation-duration: 30s;
        }


        @keyframes floatAdvanced {
            0% {
                transform: translate(0, 0) rotate(0deg) scale(1);
                opacity: 0.7;
            }
            25% {
                transform: translate(100px, -150px) rotate(90deg) scale(1.1);
                opacity: 1;
            }
            50% {
                transform: translate(200px, 0) rotate(180deg) scale(1);
                opacity: 0.7;
            }
            75% {
                transform: translate(100px, 150px) rotate(270deg) scale(0.9);
                opacity: 0.5;
            }
            100% {
                transform: translate(0, 0) rotate(360deg) scale(1);
                opacity: 0.7;
            }
        }


        /* Advanced Feature Cards */
        .featurs-item {
            background: var(--card-bg);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
            padding: 45px 35px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            transform-style: preserve-3d;
            perspective: 1000px;
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
            border-radius: 25px;
            transition: all 0.6s ease;
            transform: translateZ(-10px);
        }


        .featurs-item:hover {
            transform: translateY(-25px) rotateX(8deg) rotateY(5deg) scale(1.05);
            box-shadow: 0 40px 80px rgba(0,0,0,0.2);
        }


        .featurs-item:hover::before {
            opacity: 0.15;
        }


        .featurs-icon {
            background: linear-gradient(135deg, var(--accent), #e91e63);
            width: 130px;
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 35px;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 3.5rem;
            box-shadow: 0 20px 35px rgba(194, 24, 91, 0.4);
            position: relative;
            overflow: hidden;
        }


        .featurs-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.8s ease;
        }


        .featurs-item:hover .featurs-icon {
            transform: scale(1.25) rotate(20deg);
            box-shadow: 0 30px 50px rgba(194, 24, 91, 0.6);
        }


        .featurs-item:hover .featurs-icon::before {
            transform: rotate(225deg);
        }


        .featurs-item h5 {
            font-weight: 800;
            color: var(--darker);
            margin-bottom: 15px;
            font-size: 1.6rem;
            position: relative;
        }


        .featurs-item h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
            transition: width 0.4s ease;
        }


        .featurs-item:hover h5::after {
            width: 80px;
        }


        /* Advanced Product Cards */
        .fruite-item {
            background: var(--card-bg);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
        }


        .fruite-item:hover {
            transform: translateY(-20px) rotateY(5deg) scale(1.05);
            box-shadow: 0 35px 70px rgba(0,0,0,0.2);
        }


        .fruite-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: brightness(0.95);
        }


        .fruite-item:hover .fruite-img {
            transform: scale(1.2);
            filter: brightness(1.1);
        }


        .fruite-name {
            font-weight: 700;
            color: var(--dark);
            transition: all 0.4s ease;
            font-size: 1.4rem;
            position: relative;
        }


        .fruite-item:hover .fruite-name {
            color: var(--primary);
            transform: translateX(10px);
        }


        .fruite-price {
            color: var(--accent);
            font-weight: 800;
            font-size: 1.5rem;
            position: relative;
        }


        .fruite-price::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.4s ease;
        }


        .fruite-item:hover .fruite-price::before {
            width: 100%;
        }


        /* Advanced Particle System */
        .particle-system {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            pointer-events: none;
        }


        .particle {
            position: absolute;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0;
            animation: particleFloat 20s infinite linear;
            box-shadow: 0 0 20px currentColor;
        }


        .particle:nth-child(2n) {
            background: var(--secondary);
            animation-duration: 25s;
            animation-delay: -5s;
        }


        .particle:nth-child(3n) {
            background: var(--accent);
            animation-duration: 30s;
            animation-delay: -10s;
        }


        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
                transform: translateY(80vh) rotate(36deg) scale(1);
            }
            90% {
                opacity: 0.3;
                transform: translateY(20vh) rotate(324deg) scale(0.8);
            }
            100% {
                transform: translateY(-100px) rotate(360deg) scale(0);
                opacity: 0;
            }
        }


        /* Advanced Table Styles */
        .table-container {
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 3rem;
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            transform: translateY(20px);
            animation: tableSlideIn 1s ease-out forwards;
        }


        @keyframes tableSlideIn {
            to { transform: translateY(0); }
        }


        .table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }


        .table th {
            border: none;
            padding: 25px 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }


        .table th::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s ease;
        }


        .table th:hover::before {
            left: 100%;
        }


        .table td {
            padding: 22px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }


        .table tr:nth-child(even) {
            background-color: rgba(248, 249, 250, 0.5);
        }


        .table tr:hover td {
            background-color: rgba(246, 179, 92, 0.15);
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }


        /* Advanced Form Container */
        .form-container {
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
            overflow: hidden;
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            padding: 50px;
            position: relative;
            overflow: hidden;
            transform: translateY(30px);
            opacity: 0;
            animation: formSlideIn 1s ease-out 0.3s forwards;
        }


        @keyframes formSlideIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }


        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, var(--primary), var(--secondary), var(--accent), var(--primary));
            opacity: 0.05;
            animation: rotate 15s linear infinite;

            /* TAMBAHKAN 2 BARIS INI AGAR TIDAK MENUTUPI FORM */
    z-index: -1;
    pointer-events: none;
        }


        /* Advanced Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 120px 0;
            margin-bottom: 80px;
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
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.2) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.15) 0%, transparent 40%);
            animation: floatMulti 10s ease-in-out infinite;
        }


        .page-header h1 {
            color: var(--white);
            font-weight: 900;
            font-size: 4rem;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: fadeInDown 1s ease-out, textShine 4s ease-in-out infinite;
        }


        @keyframes textShine {
            0%, 100% {
                text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            }
            50% {
                text-shadow: 0 4px 30px rgba(0,0,0,0.5), 0 0 20px rgba(255,255,255,0.3);
            }
        }


        /* Advanced Footer */
        .footer {
            background: linear-gradient(135deg, var(--darker) 0%, var(--accent) 100%);
            color: var(--light);
            padding-top: 100px;
            position: relative;
            overflow: hidden;
        }


        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 30%);
            animation: backgroundShift 20s ease infinite;
        }


        .footer h4 {
            position: relative;
            padding-bottom: 20px;
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 25px;
        }


        .footer h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }


        .footer h4:hover::after {
            width: 100px;
            background: linear-gradient(to right, var(--primary), var(--yellow));
        }


        .btn-footer {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            color: var(--light);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 12px 25px;
            border-radius: 50px;
            margin-bottom: 15px;
            display: block;
            width: 100%;
            text-align: left;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }


        .btn-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: all 0.6s ease;
            z-index: -1;
        }


        .btn-footer:hover::before {
            left: 0;
        }


        .btn-footer:hover {
            border-color: var(--primary);
            color: white;
            transform: translateX(15px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }


        .copyright {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 25px 0;
            position: relative;
        }


        /* Advanced WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            width: 80px;
            height: 80px;
            bottom: 40px;
            right: 40px;
            background: linear-gradient(135deg, #25d366, #128C7E);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 36px;
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: pulseAdvanced 2s infinite, bounceFloat 4s infinite;
            text-decoration: none;
            border: 4px solid white;
        }


        .whatsapp-float:hover {
            transform: scale(1.2) rotate(15deg);
            box-shadow: 0 25px 50px rgba(37, 211, 102, 0.7);
            animation: none;
        }


        @keyframes pulseAdvanced {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7),
                           0 0 0 0 rgba(37, 211, 102, 0.5);
            }
            70% {
                box-shadow: 0 0 0 20px rgba(37, 211, 102, 0),
                           0 0 0 40px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0),
                           0 0 0 0 rgba(37, 211, 102, 0);
            }
        }


        @keyframes bounceFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(5deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(-8px) rotate(-3deg); }
        }


        .whatsapp-tooltip {
            position: fixed;
            bottom: 135px;
            right: 40px;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 15px 25px;
            border-radius: 30px;
            font-size: 16px;
            opacity: 0;
            transform: translateY(20px) scale(0.9);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000;
            white-space: nowrap;
            pointer-events: none;
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(15px);
        }


        .whatsapp-float:hover+.whatsapp-tooltip {
            opacity: 1;
            transform: translateY(0) scale(1);
        }


        /* Advanced Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 140px;
            right: 40px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 99;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: 3px solid white;
            transform: scale(0.8);
        }


        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }


        .back-to-top:hover {
            transform: scale(1.2) translateY(-8px);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }


        /* Advanced Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-80px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(80px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        /* Advanced Utility Classes */
        .section-padding {
            padding: 140px 0;
        }


        .section-title {
            text-align: center;
            margin-bottom: 90px;
            position: relative;
        }


        .section-title h2 {
            font-weight: 900;
            color: var(--darker);
            display: inline-block;
            position: relative;
            z-index: 1;
            font-size: 3.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }


        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 8px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 4px;
            animation: widthPulseAdvanced 4s infinite;
        }


        @keyframes widthPulseAdvanced {
            0%, 100% {
                width: 150px;
                box-shadow: 0 0 0 0 rgba(246, 179, 92, 0.4);
            }
            50% {
                width: 200px;
                box-shadow: 0 0 0 10px rgba(246, 179, 92, 0);
            }
        }


        /* Advanced Alert Animations */
        .alert {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            transform: translateY(-40px) scale(0.9);
            animation: alertSlideIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            backdrop-filter: blur(20px);
            border-left: 6px solid var(--primary);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }


        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(246, 179, 92, 0.1), rgba(17, 138, 178, 0.1));
            opacity: 0;
            animation: alertShine 3s ease-in-out infinite;
        }


        @keyframes alertSlideIn {
            to {
                transform: translateY(0) scale(1);
            }
        }


        @keyframes alertShine {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }


        /* Advanced Ripple Effect */
        .btn {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            letter-spacing: 0.8px;
            font-weight: 600;
        }


        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            border-radius: 50%;
        }


        .btn:hover::before {
            width: 300px;
            height: 300px;
        }


        /* Advanced Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 14px;
        }


        ::-webkit-scrollbar-track {
            background: linear-gradient(180deg, #f1f1f1 0%, #e8e8e8 100%);
            border-radius: 10px;
        }


        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 10px;
            border: 3px solid #f1f1f1;
            box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
        }


        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--secondary) 0%, var(--primary) 100%);
            box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        }


        /* Advanced Responsive Design */
        @media (max-width: 768px) {
            .hero-header h1 {
                font-size: 3.5rem;
            }


            .hero-header p {
                font-size: 1.2rem;
            }


            .whatsapp-float {
                width: 70px;
                height: 70px;
                bottom: 30px;
                right: 30px;
                font-size: 32px;
            }


            .whatsapp-tooltip {
                bottom: 115px;
                right: 30px;
                font-size: 14px;
            }


            .nav-item.nav-link {
                padding: 12px 20px !important;
            }


            .featurs-item, .fruite-item {
                margin-bottom: 40px;
            }


            .section-title h2 {
                font-size: 2.5rem;
            }


            .navbar-brand h1 {
                font-size: 2.2rem;
            }
        }


        /* Advanced Cursor Effects */



        /* Advanced Text Effects */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientFlow 3s ease infinite;
            background-size: 200% auto;
        }


        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }


        /* Advanced Hover Effects */
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }


        .hover-lift:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }


        /* Advanced Background Patterns */
        .pattern-dots {
            background-image: radial-gradient(var(--primary) 2px, transparent 2px);
            background-size: 30px 30px;
            opacity: 0.1;
        }


        .pattern-grid {
            background-image:
                linear-gradient(rgba(246, 179, 92, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(246, 179, 92, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        /* Custom Dropdown Style */
.dropdown-menu {
    border-radius: 15px !important;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    border: 1px solid rgba(0,0,0,0.05) !important;
    animation: fadeInDown 0.3s ease-out;
    margin-top: 15px !important;
}

.dropdown-item {
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s;
}

.dropdown-item:hover {
    background-color: var(--light);
    color: var(--primary);
    transform: translateX(5px);
}
    </style>
</head>


<body>


    <!-- Advanced Loading System -->
     <img src="{{ asset('assets-guest/img/logo-umkm.png') }}"
         alt="Logo UMKM"
         class="loading-logo-img"
         style="height: 80px; margin-bottom: 20px;">

    <div class="loading-system" id="loadingSystem">
        <div class="loading-logo">UMKM</div>
        <div class="spinner-grow"></div>
        <div class="loading-bar-container">
            <div class="loading-bar"></div>
        </div>
    </div>


    <!-- Advanced Particle System -->
    <div class="particle-system" id="particleSystem"></div>


    <!-- Advanced Cursor Follower -->
   <!-- <div class="cursor-follower" id="cursorFollower"></div> -->


    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start - FIXED: Consistent Design -->
    <div class="container-fluid fixed-top">
        <div class="container topbar d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-accent"></i> <a href="#"
                            class="text-white"> Pekanbaru</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-accent"></i><a href="#"
                            class="text-white">hello@umkm.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Kebijakan Privasi</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Ketentuan Penggunaan</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Penjualan dan Pengembalian Dana</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
               <!-- Logo Gambar -->
                    <!-- GANTI SRC DENGAN PATH LOGO ANDA -->
            <nav class="navbar navbar-light navbar-expand-xl">
                <img src="{{ asset('assets-guest/img/logo4..jpg') }}"
                         alt="Logo UMKM"
                         class="navbar-logo">

                {{-- <a href="{{ url('/') }}" class="navbar-brand">
                    <h1 class="display-6"> UMKM </h1>
                </a> --}}
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('tentang') }}" class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>
                        <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
                        <!-- TAMBAHAN MENU UMKM -->
                        <a href="{{ route('umkm.index') }}" class="nav-item nav-link {{ request()->is('umkm*') ? 'active' : '' }}">UMKM</a>
                        <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Warga</a>
                        <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->is('user*') ? 'active' : '' }}">User</a>
                         <a href="{{ route('pesanan.index') }}" class="nav-item nav-link {{ request()->is('pesanan*') ? 'active' : '' }}">Pesanan</a>
                        <a href="{{ route('identitas') }}" class="nav-item nav-link {{ request()->is('identitas') ? 'active' : '' }}">Identitas</a>
                         <a href="{{ route('detail-pesanan.index') }}"class="nav-item nav-link {{ request()->is('detail-pesanan*') ? 'active' : '' }}"> <i class="fas fa-receipt me-1"></i> Detail Pesanan </a>
                        
                       

                

                        <!-- <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a> -->
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
            {{-- Jika Login: Tampilkan FOTO --}}
            <img src="{{ Auth::user()->avatar_url }}"
                 alt="User"
                 class="rounded-circle border border-white shadow-sm"
                 style="width: 40px; height: 40px; object-fit: cover;">
        @else
            {{-- Jika Guest: Tampilkan IKON --}}
            <i class="fas fa-user fa-2x text-primary"></i>
        @endauth
    </a>

    {{-- BAGIAN 2: ISI MENU DROPDOWN --}}
    <div class="dropdown-menu dropdown-menu-end bg-white border-0 rounded-0 shadow-sm m-0">

        {{-- OPSI UNTUK YANG SUDAH LOGIN --}}
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

        {{-- OPSI UNTUK TAMU (BELUM LOGIN) --}}
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
        {{-- LOGIKA: Jika User BELUM Login (Guest) --}}
        @guest
            <a href="{{ route('login') }}" class="dropdown-item">Login</a>
            <a href="{{ route('register') }}" class="dropdown-item">Register</a>
        @endguest

        {{-- LOGIKA: Jika User SUDAH Login (Auth) --}}
        @auth
            <div class="dropdown-item text-muted disabled" style="font-size: 0.8rem;">
                Hai, {{ Auth::user()->name }}
            </div>

            <div class="dropdown-divider"></div>


        @endauth

    </div>
</div>
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
<div class="container-fluid footer">
    <div class="container py-4"> <!-- Diubah dari py-5 ke py-4 -->
        <div class="row g-4"> <!-- Diubah dari g-5 ke g-4 -->
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">UMKM</h4> <!-- Diubah dari mb-4 ke mb-3 -->
                <p class="mb-3 small"> <!-- Diubah dari mb-4 ke mb-3, tambahkan small -->
                    Kami menyediakan Produk-Produk berkualitas tinggi dengan desain unik dengan pengerjaan yang sangat baik.
                </p>
                <div class="d-flex pt-1"> <!-- Diubah dari pt-2 ke pt-1 -->
                    <a class="btn btn-square btn-footer me-1 d-flex align-items-center justify-content-center" href="" style="width: 40px; height: 40px;"> <!-- Tambahkan style untuk ukuran tetap -->
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="btn btn-square btn-footer me-1 d-flex align-items-center justify-content-center" href="" style="width: 40px; height: 40px;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="btn btn-square btn-footer me-1 d-flex align-items-center justify-content-center" href="" style="width: 40px; height: 40px;">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a class="btn btn-square btn-footer me-1 d-flex align-items-center justify-content-center" href="" style="width: 40px; height: 40px;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Akses Cepat</h4>
                <a class="btn btn-link btn-footer d-block mb-2" href="">Tentang Kami</a>
                <a class="btn btn-link btn-footer d-block mb-2" href="">Kontak Kami</a>
                <a class="btn btn-link btn-footer d-block mb-2" href="">Servis Kami</a>
                <a class="btn btn-link btn-footer d-block mb-2" href="">Privasi & Kebijakan</a>
                <a class="btn btn-link btn-footer d-block mb-2" href="">Syarat & Ketentuan</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Kontak</h4>
                <p class="mb-2 small"><i class="fa fa-map-marker-alt me-2"></i>Jalan Paus, Pekanbaru, Indonesia</p>
                <p class="mb-2 small"><i class="fa fa-phone-alt me-2"></i>+62 826 5345 7890</p>
                <p class="mb-2 small"><i class="fa fa-envelope me-2"></i>info@umkm.com</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Email</h4>
                <div class="position-relative" style="max-width: 100%;">
                    <input class="form-control border-0 w-100 py-2 ps-3 pe-4" type="text"   placeholder="Masukan Email">
                    <button type="button"
                            class="btn btn-primary border-0 py-2 position-absolute top-0 end-0 mt-0 me-0">SignUp</button>
                </div>
                <small class="text-muted mt-2 d-block">Dapatkan info terbaru dari kami</small>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright py-3"> <!-- Diubah dari py-0, tambahkan py-3 -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    &copy; <a class="text-white" href="#">UMKM</a>, Hak Cipta Dilindungi Undang-Undang.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->





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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1200,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });


            // Advanced Loading System
            const loadingSystem = document.getElementById('loadingSystem');
            const loadingBar = document.querySelector('.loading-bar');
            let loadProgress = 0;

            const loadingInterval = setInterval(() => {
                if (loadProgress >= 100) {
                    clearInterval(loadingInterval);
                    setTimeout(() => {
                        loadingSystem.style.opacity = '0';
                        loadingSystem.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            loadingSystem.style.display = 'none';
                        }, 800);
                    }, 500);
                } else {
                    loadProgress += 2;
                    loadingBar.style.width = loadProgress + '%';
                }
            }, 40);


            // Create advanced particles
            createAdvancedParticles();


            // Create cursor follower
            createCursorFollower();


            // Spinner fade out
            setTimeout(() => {
                const spinner = document.getElementById('spinner');
                if (spinner) {
                    spinner.style.opacity = '0';
                    spinner.style.visibility = 'hidden';
                    setTimeout(() => spinner.remove(), 800);
                }
            }, 2000);


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
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });


            // Enhanced navbar scroll effect
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });


            // Advanced parallax effect
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.hero-header, .page-header');
                parallaxElements.forEach(element => {
                    if (element) {
                        const speed = scrolled * 0.4;
                        element.style.backgroundPosition = `center ${speed}px`;
                    }
                });
            });


            // Create advanced floating elements in hero
            createAdvancedFloatingElements();


            // Advanced hover effects for cards
            document.querySelectorAll('.featurs-item, .fruite-item').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '20';
                    this.classList.add('hover-lift');
                });

                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                    this.classList.remove('hover-lift');
                });
            });


            // Advanced ripple effect to buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height) * 2;
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple-effect');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            });


            // Text animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };


            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);


            document.querySelectorAll('.featurs-item, .fruite-item, .section-title').forEach(el => {
                observer.observe(el);
            });
        });


        function createAdvancedParticles() {
            const particleSystem = document.getElementById('particleSystem');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                const size = Math.random() * 20 + 5;
                const posX = Math.random() * 100;
                const delay = Math.random() * 20;
                const duration = Math.random() * 15 + 20;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.opacity = Math.random() * 0.3 + 0.1;

                particleSystem.appendChild(particle);
            }
        }


        function createCursorFollower() {
            const cursor = document.getElementById('cursorFollower');
            let mouseX = 0, mouseY = 0;
            let cursorX = 0, cursorY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function animateCursor() {
                cursorX += (mouseX - cursorX) * 0.1;
                cursorY += (mouseY - cursorY) * 0.1;

                cursor.style.left = cursorX + 'px';
                cursor.style.top = cursorY + 'px';

                requestAnimationFrame(animateCursor);
            }

            animateCursor();
        }


        function createAdvancedFloatingElements() {
            const hero = document.querySelector('.hero-header');
            if (!hero) return;

            const floatingSystem = document.createElement('div');
            floatingSystem.classList.add('floating-system');

            for (let i = 0; i < 12; i++) {
                const element = document.createElement('div');
                element.classList.add('floating-element');

                const size = Math.random() * 80 + 30;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const delay = Math.random() * 15;
                const duration = Math.random() * 15 + 20;

                element.style.width = `${size}px`;
                element.style.height = `${size}px`;
                element.style.left = `${posX}%`;
                element.style.top = `${posY}%`;
                element.style.animationDelay = `${delay}s`;
                element.style.animationDuration = `${duration}s`;
                element.style.opacity = Math.random() * 0.2 + 0.1;

                floatingSystem.appendChild(element);
            }

            hero.appendChild(floatingSystem);
        }


        // Advanced ripple effect style
        const advancedStyle = document.createElement('style');
        advancedStyle.textContent = `
            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
                transform: scale(0);
                animation: advancedRipple 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                pointer-events: none;
            }

            @keyframes advancedRipple {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                50% {
                    transform: scale(1);
                    opacity: 0.5;
                }
                100% {
                    transform: scale(2);
                    opacity: 0;
                }
            }


            /* Advanced text selection */
            ::selection {
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                color: white;
                text-shadow: none;
            }


            /* Advanced focus styles */
            .btn:focus,
            .form-control:focus,
            .nav-link:focus {
                box-shadow: 0 0 0 3px rgba(246, 179, 92, 0.3) !important;
                border-color: var(--primary) !important;
            }


            /* Advanced print styles */
            @media print {
                .navbar, .footer, .whatsapp-float, .back-to-top {
                    display: none !important;
                }
            }
        `;
        document.head.appendChild(advancedStyle);
    </script>


    @yield('scripts')
</body>


</html>
