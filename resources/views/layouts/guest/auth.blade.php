<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - UMKM</title>
    
    {{-- Memanggil semua CSS dan Favicon dari file css.blade.php --}}
    @include('layouts.guest.css')

    <style>
        /* =========================================
           STYLE KHUSUS HALAMAN AUTH (LOGIN/REGISTER)
           ========================================= */
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            /* Background Body */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("assets-guest/img/gambar.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
            min-height: 600px;
        }

        /* Bagian Kiri (Banner Gambar) */
        .auth-banner {
            flex: 1;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.9), rgba(23, 162, 184, 0.9)), url('{{ asset("assets-guest/img/gambar.jpg") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 40px;
        }

        .logo-circle {
            width: 100px; height: 100px; background: rgba(255,255,255,0.15);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px; border: 2px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(5px);
        }

        /* Bagian Kanan (Form Wrapper) */
        .auth-form {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
            position: relative;
        }

        /* =========================================
           CUSTOM FORM INPUT STYLES (Agar Input Cantik)
           ========================================= */
        
        .form-header h2 { font-weight: 700; color: #333; }
        
        /* Container Input Khusus */
        .input-group-custom {
            position: relative;
            width: 100%;
        }

        /* Input Fieldnya */
        .custom-input {
            height: 50px;
            padding-left: 45px; /* Ruang untuk ikon kiri */
            padding-right: 45px; /* Ruang untuk tombol mata */
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            border-color: #28a745;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1);
        }

        /* Ikon di dalam Input (Kiri) */
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 5;
            transition: color 0.3s;
        }

        .custom-input:focus + .input-icon, 
        .custom-input:focus ~ .input-icon {
            color: #28a745;
        }

        /* Tombol Toggle Password (Kanan) */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: #aaa; cursor: pointer; padding: 0;
            z-index: 10;
        }
        .password-toggle:hover { color: #28a745; }

        /* Ikon Panah Select (Kanan) */
        .arrow-icon {
            position: absolute;
            right: 15px; top: 50%; transform: translateY(-50%);
            color: #aaa; pointer-events: none; font-size: 0.8rem;
        }

        /* Tombol Utama (Login/Register) */
        .btn-primary-custom {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none; color: #fff; padding: 12px; border-radius: 10px;
            font-weight: 600; width: 100%; transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            color: white;
        }

        /* Link Styles */
        .links-section a { text-decoration: none; transition: 0.2s; }
        .links-section a:hover { text-decoration: underline; }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .auth-card { flex-direction: column; max-width: 450px; }
            .auth-banner { padding: 30px; min-height: 200px; }
            .auth-form { padding: 30px 20px; }
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="auth-banner">
            <div class="logo-circle">
                <i class="fas fa-store fa-3x"></i>
                {{-- Jika mau pakai gambar logo, uncomment baris bawah ini --}}
                {{-- <img src="{{ asset('assets-guest/img/logo.png') }}" alt="Logo" style="max-width:60%; max-height:60%;"> --}}
            </div>
            <h2>Lapak UMKM</h2>
            <p>Platform digital untuk kemajuan UMKM Desa.</p>
        </div>

        <div class="auth-form">
            @yield('content')
        </div>
    </div>
    
    <script>
        // Script Toggle Password (Show/Hide)
        document.querySelectorAll('.password-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                // Cari input di dalam parent yang sama
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>