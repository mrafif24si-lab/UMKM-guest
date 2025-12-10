@extends('layouts.guest')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah User</h1>
        <p class="text-white lead">Form pendaftaran user baru</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Form Tambah User Baru</h5>
                    </div>
                    <div class="card-body p-5">
                        <!-- Alert Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" 
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" 
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Email harus unik dan belum terdaftar.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Minimal 8 karakter.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               id="password_confirmation" name="password_confirmation" 
                                               placeholder="Konfirmasi password" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Multiple File Upload Section -->
                            <div class="mb-4">
                                <label for="files" class="form-label">Upload Foto/Dokumen User</label>
                                <input type="file" class="form-control @error('files.*') is-invalid @enderror" 
                                       id="files" name="files[]" multiple 
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                <div class="form-text">
                                    Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX. Maksimal 2MB per file.
                                    Anda dapat memilih multiple file sekaligus. Foto pertama akan menjadi foto profil.
                                </div>
                                @error('files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Upload -->
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview Gambar:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Simpan User</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-auto">
                                    <i class="fas fa-redo me-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    // Preview gambar
    document.getElementById('files').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        previewImages.innerHTML = '';
        
        if (files.length > 0) {
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
        }

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-2';
                    col.innerHTML = `
                        <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 120px; object-fit: cover;">
                    `;
                    previewImages.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    form.addEventListener('submit', function(e) {
        // Validasi password
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        
        if (password.length < 8) {
            alert('Password harus minimal 8 karakter');
            e.preventDefault();
            return;
        }
        
        if (password !== passwordConfirmation) {
            alert('Konfirmasi password tidak sesuai');
            e.preventDefault();
            return;
        }

        // Tampilkan loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('d-none');
    });

    // Reset loading state ketika form direset
    form.addEventListener('reset', function() {
        submitBtn.disabled = false;
        submitText.textContent = 'Simpan User';
        submitSpinner.classList.add('d-none');
        document.getElementById('preview-container').style.display = 'none';
        document.getElementById('preview-images').innerHTML = '';
    });
});
</script>
@endsection