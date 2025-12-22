<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UMKM</title>
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
            /* Background default */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('{{ asset("images/backgrounds/main-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            transition: background-image 0.5s ease;
        }

        .container-wrapper {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            position: relative;
        }

        .image-section {
            flex: 1;
            /* Background default untuk bagian kiri */
            background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)),
                        url('{{ asset("images/backgrounds/sidebar-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
            transition: background-image 0.5s ease;
        }

        /* Overlay untuk section kiri */
        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .image-section > * {
            position: relative;
            z-index: 2;
        }

        .image-section h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
            margin-top: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .image-section p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.6;
            max-width: 90%;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        /* Container untuk logo */
        .logo-container {
            width: 150px;
            height: 150px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            backdrop-filter: blur(8px);
            border: 3px solid rgba(255, 255, 255, 0.25);
            padding: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Styling untuk gambar logo */
        .logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }

        .form-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.98);
            overflow-y: auto;
            max-height: 600px;
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

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border-left: 4px solid #28a745;
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
            background: rgba(255, 255, 255, 0.9);
        }

        .form-select {
            padding-left: 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            outline: none;
            background: white;
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
            color: #28a745;
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
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
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

        /* Alternatif jika logo tidak muncul */
        .logo-fallback {
            font-size: 3.5rem;
            color: white;
        }

        /* Tombol Kustomisasi Background */
        .customize-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .customize-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .customize-btn i {
            font-size: 1.5rem;
        }

        /* Modal Kustomisasi */
        .customize-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .modal-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }

        .modal-header h3 {
            color: #333;
            font-weight: 700;
            margin: 0;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #999;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #333;
        }

        .bg-options {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .bg-option {
            flex: 1;
            text-align: center;
            padding: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .bg-option:hover {
            border-color: #28a745;
        }

        .bg-option.active {
            border-color: #28a745;
            background: rgba(40, 167, 69, 0.1);
        }

        .preview-area {
            margin: 20px 0;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .preview-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
            margin-top: 10px;
            display: none;
        }

        .upload-btn {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: #5a6268;
        }

        .apply-btn {
            background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .default-bgs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .default-bg {
            height: 80px;
            border-radius: 5px;
            cursor: pointer;
            background-size: cover;
            background-position: center;
            transition: all 0.3s ease;
        }

        .default-bg:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            body {
                background-attachment: scroll;
                padding: 10px;
            }
            
            .container-wrapper {
                flex-direction: column;
                max-width: 450px;
                min-height: auto;
            }

            .image-section {
                padding: 30px 20px;
                min-height: 250px;
            }

            .image-section h1 {
                font-size: 1.8rem;
            }

            .logo-container {
                width: 120px;
                height: 120px;
                margin-bottom: 20px;
            }

            .form-section {
                padding: 30px 20px;
                max-height: none;
            }

            .customize-btn {
                width: 50px;
                height: 50px;
                bottom: 15px;
                right: 15px;
            }

            .default-bgs {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Tombol untuk membuka modal kustomisasi -->
    <button class="customize-btn" onclick="openCustomizeModal()">
        <i class="fas fa-image"></i>
    </button>

    <div class="container-wrapper">
        <!-- Bagian Gambar & Logo -->
        <div class="image-section" id="imageSection">
            <div class="logo-container">
                <img src="{{ asset('images/logo1.jpg') }}" 
                     alt="Logo UMKM" 
                     class="logo-img"
                     onerror="this.style.display='none'; document.querySelector('.logo-fallback').style.display='block';">
                <i class="fas fa-store logo-fallback" style="display: none;"></i>
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

    <!-- Modal untuk kustomisasi background -->
    <div class="customize-modal" id="customizeModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeCustomizeModal()">&times;</button>
            <div class="modal-header">
                <h3><i class="fas fa-paint-brush me-2"></i>Kustomisasi Background</h3>
            </div>
            
            <div class="bg-options">
                <div class="bg-option active" onclick="selectBgType('main')">
                    <i class="fas fa-expand me-1"></i>Background Utama
                </div>
                <div class="bg-option" onclick="selectBgType('sidebar')">
                    <i class="fas fa-columns me-1"></i>Background Samping
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Unggah Gambar Baru</label>
                <div class="preview-area" id="previewArea">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #ccc; margin-bottom: 10px;"></i>
                    <p>Klik untuk memilih gambar atau seret ke sini</p>
                    <img id="previewImage" class="preview-image" alt="Preview">
                    <input type="file" id="imageUpload" accept="image/*" style="display: none;" onchange="previewImage(event)">
                    <label for="imageUpload" class="upload-btn mt-3">
                        <i class="fas fa-upload me-2"></i>Pilih File
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Atau pilih gambar default UMKM Indonesia:</label>
                <div class="default-bgs">
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1594046243099-6ed19e2c143e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1594046243099-6ed19e2c143e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" 
                         onclick="selectDefaultImage('https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Pengaturan Tambahan</label>
                <div class="form-check mb-2">
                    <input type="checkbox" id="darkOverlay" class="form-check-input" checked>
                    <label for="darkOverlay" class="form-check-label">Tambahkan overlay gelap (untuk keterbacaan teks)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="savePreference" class="form-check-input" checked>
                    <label for="savePreference" class="form-check-label">Simpan preferensi untuk kunjungan berikutnya</label>
                </div>
            </div>

            <button class="apply-btn" onclick="applyBackground()">
                <i class="fas fa-check me-2"></i>Terapkan Background
            </button>
        </div>
    </div>

    <script>
        // Variabel global
        let selectedBgType = 'main';
        let selectedImage = null;

        // Fungsi untuk membuka modal
        function openCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'none';
            resetPreview();
        }

        // Pilih tipe background
        function selectBgType(type) {
            selectedBgType = type;
            document.querySelectorAll('.bg-option').forEach(opt => {
                opt.classList.remove('active');
            });
            event.target.closest('.bg-option').classList.add('active');
        }

        // Preview gambar yang diupload
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImage = e.target.result;
                    const previewImage = document.getElementById('previewImage');
                    const previewArea = document.getElementById('previewArea');
                    
                    previewImage.src = selectedImage;
                    previewImage.style.display = 'block';
                    previewArea.querySelector('p').style.display = 'none';
                    previewArea.querySelector('.fa-cloud-upload-alt').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }

        // Pilih gambar default
        function selectDefaultImage(url) {
            selectedImage = url;
            const previewImage = document.getElementById('previewImage');
            const previewArea = document.getElementById('previewArea');
            
            previewImage.src = url;
            previewImage.style.display = 'block';
            previewArea.querySelector('p').style.display = 'none';
            previewArea.querySelector('.fa-cloud-upload-alt').style.display = 'none';
        }

        // Reset preview
        function resetPreview() {
            selectedImage = null;
            const previewImage = document.getElementById('previewImage');
            const previewArea = document.getElementById('previewArea');
            
            previewImage.style.display = 'none';
            previewArea.querySelector('p').style.display = 'block';
            previewArea.querySelector('.fa-cloud-upload-alt').style.display = 'block';
            document.getElementById('imageUpload').value = '';
        }

        // Terapkan background
        function applyBackground() {
            if (!selectedImage) {
                alert('Silakan pilih gambar terlebih dahulu!');
                return;
            }

            const darkOverlay = document.getElementById('darkOverlay').checked;
            const savePreference = document.getElementById('savePreference').checked;

            let bgUrl = selectedImage;
            
            // Tambahkan overlay jika dipilih
            if (darkOverlay) {
                if (selectedBgType === 'main') {
                    bgUrl = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('${selectedImage}')`;
                } else {
                    bgUrl = `linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)), url('${selectedImage}')`;
                }
            }

            // Terapkan background
            if (selectedBgType === 'main') {
                document.body.style.backgroundImage = bgUrl;
                if (savePreference) {
                    localStorage.setItem('umkm_main_bg', bgUrl);
                }
            } else {
                document.getElementById('imageSection').style.backgroundImage = bgUrl;
                if (savePreference) {
                    localStorage.setItem('umkm_sidebar_bg', bgUrl);
                }
            }

            // Simpan preferensi
            if (savePreference) {
                localStorage.setItem('umkm_bg_type', selectedBgType);
                localStorage.setItem('umkm_dark_overlay', darkOverlay);
            }

            alert('Background berhasil diubah!');
            closeCustomizeModal();
        }

        // Load preferensi yang disimpan
        window.addEventListener('load', function() {
            const savedMainBg = localStorage.getItem('umkm_main_bg');
            const savedSidebarBg = localStorage.getItem('umkm_sidebar_bg');
            
            if (savedMainBg) {
                document.body.style.backgroundImage = savedMainBg;
            }
            
            if (savedSidebarBg) {
                document.getElementById('imageSection').style.backgroundImage = savedSidebarBg;
            }
        });

        // Event listener untuk toggle password
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password untuk password
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

            // Toggle password untuk confirm password
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

            // Fallback untuk logo
            const logoImg = document.querySelector('.logo-img');
            if (logoImg) {
                logoImg.addEventListener('error', function() {
                    this.style.display = 'none';
                    const fallback = document.querySelector('.logo-fallback');
                    if (fallback) {
                        fallback.style.display = 'block';
                    }
                });
            }

            // Drag and drop untuk upload
            const previewArea = document.getElementById('previewArea');
            if (previewArea) {
                previewArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#28a745';
                });

                previewArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#ddd';
                });

                previewArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#ddd';
                    
                    const file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const input = document.getElementById('imageUpload');
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        input.files = dataTransfer.files;
                        previewImage({ target: { files: [file] } });
                    } else {
                        alert('Hanya file gambar yang diperbolehkan!');
                    }
                });
            }
        });

        // Tutup modal jika klik di luar
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('customizeModal');
            if (modal && event.target === modal) {
                closeCustomizeModal();
            }
        });
    </script>
</body>
</html>