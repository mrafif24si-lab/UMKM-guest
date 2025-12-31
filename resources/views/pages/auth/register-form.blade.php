<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UMKM</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">

    <style>
        /* Background Utama dengan Variabel PHP */
        body.auth-layout {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('{{ asset("images/backgrounds/main-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Background Sidebar Kiri dengan Variabel PHP */
        .image-section {
            background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(23, 162, 184, 0.85)),
                        url('{{ asset("images/backgrounds/sidebar-bg.jpg") }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

{{-- Tambahkan class "auth-layout" di sini --}}
<body class="auth-layout">

    <button class="customize-btn" onclick="openCustomizeModal()">
        <i class="fas fa-image"></i>
    </button>

    <div class="container-wrapper">
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
                    {{-- Gambar Default --}}
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" onclick="selectDefaultImage('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" onclick="selectDefaultImage('https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                    <div class="default-bg" style="background-image: url('https://images.unsplash.com/photo-1594046243099-6ed19e2c143e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80');" onclick="selectDefaultImage('https://images.unsplash.com/photo-1594046243099-6ed19e2c143e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Pengaturan Tambahan</label>
                <div class="form-check mb-2">
                    <input type="checkbox" id="darkOverlay" class="form-check-input" checked>
                    <label for="darkOverlay" class="form-check-label">Tambahkan overlay gelap</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="savePreference" class="form-check-input" checked>
                    <label for="savePreference" class="form-check-label">Simpan preferensi</label>
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
            } else {
                bgUrl = `url('${selectedImage}')`;
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
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
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
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
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