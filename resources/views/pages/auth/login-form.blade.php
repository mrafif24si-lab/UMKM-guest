<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">

    <style>
        /* Background Utama dengan Variabel PHP */
        body.auth-layout {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Background Sidebar Kiri dengan Variabel PHP */
        .image-section {
            background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)),
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

{{-- Tambahkan class "auth-layout" di sini --}}
<body class="auth-layout">

    <div class="container-wrapper">
        <div class="image-section">
            <div class="logo-container">
                <img src="https://via.placeholder.com/150x150/28a745/ffffff?text=UMKM+Logo" 
                     alt="Logo UMKM" 
                     class="logo-img"
                     onerror="this.style.display='none'; document.querySelector('.logo-fallback').style.display='block';">
                <i class="fas fa-store logo-fallback" style="display: none;"></i>
            </div>
            <h1>Lapak UMKM</h1>
            <p>Bergabung dengan komunitas Lapak UMKM untuk mengembangkan usaha Anda dan terhubung dengan pelanggan setia.</p>
        </div>

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

    <button class="btn-customize" onclick="openCustomizeModal()">
        <i class="fas fa-paint-brush"></i>
        <span class="customize-tooltip">Kustomisasi Background</span>
    </button>

    <div class="modal-overlay" id="customizeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-image me-2"></i>Kustomisasi Background</h3>
            </div>
            <div class="modal-body">
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