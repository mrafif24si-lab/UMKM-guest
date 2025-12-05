<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UMKM Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container-wrapper {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .image-section {
            flex: 1;
            background: linear-gradient(rgba(23, 162, 184, 0.9), rgba(40, 167, 69, 0.9)), 
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
        }

        .image-section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .image-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .image-icon {
            font-size: 4rem;
            margin-bottom: 30px;
            background: rgba(255,255,255,0.1);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255,255,255,0.2);
        }

        .form-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 2;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 50px 12px 45px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-select {
            padding-left: 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            z-index: 2;
            padding: 5px;
            font-size: 1rem;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #17a2b8;
        }

        .btn-register {
            background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
        }

        .links-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .link-item {
            margin-bottom: 10px;
        }

        .link-item a {
            color: #17a2b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .link-item a:hover {
            color: #28a745;
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .container-wrapper {
                flex-direction: column;
                max-width: 450px;
            }
            
            .image-section {
                padding: 30px 20px;
                min-height: 200px;
            }
            
            .image-section h1 {
                font-size: 1.8rem;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <!-- Bagian Gambar -->
        <div class="image-section">
            <div class="image-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Bergabung Dengan Kami</h1>
            <p>Daftarkan UMKM Anda dan mulai kembangkan usaha Anda bersama komunitas UMKM desa. Akses fitur lengkap untuk pemasaran dan manajemen usaha.</p>
        </div>

        <!-- Bagian Form Register -->
        <div class="form-section">
            <div class="form-header">
                <h2>Register UMKM Desa</h2>
                <p>Buat akun baru Anda</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                    <span class="error-message">
                        @error('name') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control"
                               value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                    </div>
                    <span class="error-message">
                        @error('email') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">Daftar Sebagai</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Buat password (minimal 8 karakter)" required>
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message">
                        @error('password') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="Konfirmasi password Anda" required>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword" aria-label="Show confirm password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message">
                        @error('password_confirmation') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </button>
            </form>

            <div class="links-section">
                <div class="link-item">
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                </div>
                <div class="link-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility untuk password
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        this.setAttribute('aria-label', 'Show password');
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        this.setAttribute('aria-label', 'Hide password');
                    }
                });
            }

            // Toggle password visibility untuk confirm password
            const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
            const confirmPassword = document.querySelector('#password_confirmation');

            if (toggleConfirmPassword && confirmPassword) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPassword.setAttribute('type', type);
                    
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        this.setAttribute('aria-label', 'Show confirm password');
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        this.setAttribute('aria-label', 'Hide confirm password');
                    }
                });
            }
        });
    </script>
</body>
</html>