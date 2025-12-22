    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM</title>
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
                        url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
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
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .image-section {
            flex: 1;
            /* Background default untuk bagian kiri */
            background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)),
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
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
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .image-section p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.6;
            max-width: 90%;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
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

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
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
        }

        .btn-login {
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

        .btn-login:hover {
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

        /* Modal untuk upload gambar */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
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
            font-size: 1.5rem;
        }

        .modal-body {
            margin-bottom: 25px;
        }

        .btn-upload {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-upload:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-customize {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .btn-customize:hover {
            transform: scale(1.1);
            background: #218838;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .customize-tooltip {
            position: absolute;
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
            background: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .btn-customize:hover .customize-tooltip {
            opacity: 1;
        }

        .preview-container {
            margin-top: 20px;
            padding: 15px;
            border: 2px dashed #ddd;
            border-radius: 10px;
            text-align: center;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .preview-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
            margin-top: 10px;
            display: none;
        }

        .form-radio-group {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .radio-option {
            flex: 1;
            text-align: center;
        }

        .radio-option input[type="radio"] {
            display: none;
        }

        .radio-option label {
            display: block;
            padding: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .radio-option input[type="radio"]:checked + label {
            border-color: #28a745;
            background: rgba(40, 167, 69, 0.1);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
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
            }

            .btn-customize {
                width: 50px;
                height: 50px;
                bottom: 15px;
                right: 15px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Container Utama -->
    <div class="container-wrapper">
        <!-- Bagian Gambar & Logo -->
        <div class="image-section">
            <!-- Logo sebagai gambar -->
            <div class="logo-container">
                <!-- GANTI LOGO DI SINI -->
                <img src="https://via.placeholder.com/150x150/28a745/ffffff?text=UMKM+Logo" 
                     alt="Logo UMKM" 
                     class="logo-img"
                     onerror="this.style.display='none'; document.querySelector('.logo-fallback').style.display='block';">
                <!-- Fallback jika gambar tidak dimuat -->
                <i class="fas fa-store logo-fallback" style="display: none;"></i>
            </div>
            <h1>Lapak UMKM</h1>
            <p>Bergabung dengan komunitas Lapak UMKM untuk mengembangkan usaha Anda dan terhubung dengan pelanggan setia.</p>
        </div>

        <!-- Bagian Form Login -->
        <div class="form-section">
            <div class="form-header">
                <h2>Login UMKM</h2>
                <p>Masuk ke akun Anda</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <strong><i class="fas fa-check-circle me-2"></i>Sukses!</strong>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control"
                               value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                    </div>
                    <span class="error-message">
                        @error('email') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Masukkan password Anda" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message">
                        @error('password') <i class="fas fa-exclamation-circle me-1"></i>{{ $message }} @enderror
                    </span>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>

            <div class="links-section">
                <div class="link-item">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
                <div class="link-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol untuk membuka modal kustomisasi -->
    <button class="btn-customize" onclick="openCustomizeModal()">
        <i class="fas fa-paint-brush"></i>
        <span class="customize-tooltip">Kustomisasi Background</span>
    </button>

    <!-- Modal untuk kustomisasi background -->
    <div class="modal-overlay" id="customizeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-image me-2"></i>Kustomisasi Background</h3>
            </div>
            <div class="modal-body">
                <!-- Form untuk upload gambar -->
                <form id="backgroundForm">
                    <div class="form-group">
                        <label class="form-label">Pilih Background</label>
                        <div class="form-radio-group">
                            <div class="radio-option">
                                <input type="radio" id="bgTypeFull" name="bgType" value="full" checked>
                                <label for="bgTypeFull">
                                    <i class="fas fa-expand me-1"></i>Full Background
                                </label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="bgTypeLeft" name="bgType" value="left">
                                <label for="bgTypeLeft">
                                    <i class="fas fa-columns me-1"></i>Background Kiri
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Upload Gambar dari Komputer</label>
                        <input type="file" id="backgroundImage" class="form-control" 
                               accept="image/*" style="padding-left: 12px;">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal: 5MB</small>
                    </div>

                    <div class="preview-container" id="previewContainer">
                        <i class="fas fa-image" style="font-size: 2rem; color: #ccc; margin-bottom: 10px;"></i>
                        <p style="color: #666;">Preview akan muncul di sini</p>
                        <img id="imagePreview" class="preview-image" alt="Preview">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Atau gunakan gambar default:</label>
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <button type="button" class="btn btn-secondary" onclick="useDefaultImage(1)">
                                <i class="fas fa-store"></i> Gambar 1
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="useDefaultImage(2)">
                                <i class="fas fa-industry"></i> Gambar 2
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="useDefaultImage(3)">
                                <i class="fas fa-shopping-basket"></i> Gambar 3
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="resetBackground()">
                    <i class="fas fa-undo me-2"></i>Reset Default
                </button>
                <button class="btn-upload" onclick="applyBackground()">
                    <i class="fas fa-check me-2"></i>Terapkan
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const fileInput = document.getElementById('backgroundImage');
            const previewImage = document.getElementById('imagePreview');
            const previewContainer = document.getElementById('previewContainer');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                const icon = this.querySelector('i');
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });

            // Fallback untuk logo jika gambar gagal dimuat
            const logoImg = document.querySelector('.logo-img');
            logoImg.addEventListener('error', function() {
                this.style.display = 'none';
                document.querySelector('.logo-fallback').style.display = 'block';
            });

            // Preview gambar yang diupload
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar! Maksimal 5MB.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.style.display = 'block';
                        previewContainer.querySelector('p').style.display = 'none';
                        previewContainer.querySelector('.fa-image').style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Load background yang disimpan
            const savedFullBg = localStorage.getItem('umkm_full_background');
            const savedLeftBg = localStorage.getItem('umkm_left_background');
            
            if (savedFullBg) {
                document.body.style.backgroundImage = savedFullBg;
            }
            if (savedLeftBg) {
                document.querySelector('.image-section').style.backgroundImage = savedLeftBg;
            }
        });

        // Fungsi untuk membuka modal kustomisasi
        function openCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'none';
            // Reset preview
            document.getElementById('backgroundImage').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('previewContainer').querySelector('p').style.display = 'block';
            document.getElementById('previewContainer').querySelector('.fa-image').style.display = 'block';
        }

        // Fungsi untuk menerapkan background
        function applyBackground() {
            const bgType = document.querySelector('input[name="bgType"]:checked').value;
            const fileInput = document.getElementById('backgroundImage');
            const previewImage = document.getElementById('imagePreview');

            // Jika ada file yang diupload
            if (fileInput.files.length > 0 && previewImage.src) {
                const file = fileInput.files[0];
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const imageUrl = event.target.result;
                    
                    if (bgType === 'full') {
                        // Terapkan ke background utama
                        const fullBg = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('${imageUrl}')`;
                        document.body.style.backgroundImage = fullBg;
                        localStorage.setItem('umkm_full_background', fullBg);
                    } else {
                        // Terapkan ke background kiri
                        const leftBg = `linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)), url('${imageUrl}')`;
                        document.querySelector('.image-section').style.backgroundImage = leftBg;
                        localStorage.setItem('umkm_left_background', leftBg);
                    }
                    
                    alert('Background berhasil diubah!');
                    closeCustomizeModal();
                };
                
                reader.readAsDataURL(file);
            } else {
                alert('Silakan pilih gambar terlebih dahulu!');
            }
        }

        // Fungsi untuk menggunakan gambar default
        function useDefaultImage(type) {
            const bgType = document.querySelector('input[name="bgType"]:checked').value;
            
            let imageUrl;
            switch(type) {
                case 1:
                    imageUrl = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
                    break;
                case 2:
                    imageUrl = 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
                    break;
                case 3:
                    imageUrl = 'https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
                    break;
            }

            if (bgType === 'full') {
                const fullBg = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('${imageUrl}')`;
                document.body.style.backgroundImage = fullBg;
                localStorage.setItem('umkm_full_background', fullBg);
            } else {
                const leftBg = `linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)), url('${imageUrl}')`;
                document.querySelector('.image-section').style.backgroundImage = leftBg;
                localStorage.setItem('umkm_left_background', leftBg);
            }

            alert('Background default berhasil diterapkan!');
            closeCustomizeModal();
        }

        // Fungsi untuk reset background ke default
        function resetBackground() {
            const bgType = document.querySelector('input[name="bgType"]:checked').value;
            
            const defaultFullBg = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')`;
            const defaultLeftBg = `linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)), url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')`;

            if (bgType === 'full') {
                document.body.style.backgroundImage = defaultFullBg;
                localStorage.removeItem('umkm_full_background');
            } else {
                document.querySelector('.image-section').style.backgroundImage = defaultLeftBg;
                localStorage.removeItem('umkm_left_background');
            }

            alert('Background berhasil direset ke default!');
            closeCustomizeModal();
        }

        // Tutup modal jika klik di luar
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('customizeModal');
            const modalContent = document.querySelector('.modal-content');
            
            if (modal && modalContent && event.target === modal) {
                closeCustomizeModal();
            }
        });
    </script>
</body>
</html>
