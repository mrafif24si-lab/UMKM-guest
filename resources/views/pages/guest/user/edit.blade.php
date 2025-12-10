@extends('layouts.guest')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit User</h1>
        <p class="text-white lead">Form edit data user</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-4">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit User - {{ $user->name }}</h5>
                    </div>
                    <div class="card-body p-5">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal Update!</strong> Periksa inputan berikut:
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

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

                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="userForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $user->name) }}"
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
                                               id="email" name="email" value="{{ old('email', $user->email) }}"
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password"
                                               placeholder="Kosongkan jika tidak ingin mengubah">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               id="password_confirmation" name="password_confirmation"
                                               placeholder="Konfirmasi password">
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
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- UPLOAD FILE BARU --}}
                            <div class="mb-4">
                                <label for="files" class="form-label">Upload File Baru</label>
                                <input type="file" class="form-control @error('files') is-invalid @enderror" 
                                       id="files" name="files[]" multiple
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                <div class="form-text">
                                    Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX. Maksimal 2MB per file.
                                </div>
                                @error('files') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- LIST FILE LAMA --}}
                            @if($user->media->count() > 0)
                            <div class="mb-4">
                                <label class="form-label">File Terupload Saat Ini</label>
                                <div class="row">
                                    @foreach($user->media as $media)
                                    <div class="col-md-3 mb-3">
                                        <div class="card file-card h-100">
                                            <div class="card-body text-center">
                                                @if(Str::startsWith($media->mime_type, 'image/'))
                                                    <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                         class="img-thumbnail mb-2" 
                                                         style="height: 120px; width: 100%; object-fit: cover;" 
                                                         alt="{{ $media->caption }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center" style="height: 120px;">
                                                        <i class="fas fa-file fa-3x text-secondary"></i>
                                                    </div>
                                                @endif
                                                <p class="small mb-1 text-truncate" title="{{ $media->caption }}">
                                                    {{ $media->caption }}
                                                </p>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm w-100" 
                                                        onclick="confirmDeleteMedia('{{ route('user.delete-media', $media->media_id) }}')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="text-center py-4 mb-4 border rounded bg-light">
                                <div class="mb-3">
                                    <img src="{{ asset('images/placeholder.png') }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 150px; width: auto;"
                                         alt="Belum ada file yang diupload">
                                </div>
                                <h5 class="text-muted">Belum ada file yang diupload</h5>
                                <p class="text-muted small">Upload file melalui form di atas</p>
                            </div>
                            @endif

                            {{-- Preview Upload Baru --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview Gambar Baru:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-warning btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Update User</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-lg">
                                    <i class="fas fa-eye me-2"></i> Detail
                                </a>
                            </div>
                        </form>

                        <form id="deleteMediaForm" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('userForm');
                                const submitBtn = document.getElementById('submitBtn');
                                const submitText = document.getElementById('submitText');
                                const submitSpinner = document.getElementById('submitSpinner');

                                // Preview gambar baru
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
                                    // Validasi password jika diisi
                                    const password = document.getElementById('password').value;
                                    const passwordConfirmation = document.getElementById('password_confirmation').value;

                                    if (password !== '') {
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
                                    }

                                    // Tampilkan loading state
                                    submitBtn.disabled = true;
                                    submitText.textContent = 'Mengupdate...';
                                    submitSpinner.classList.remove('d-none');
                                });

                                // Reset loading state ketika form direset
                                form.addEventListener('reset', function() {
                                    submitBtn.disabled = false;
                                    submitText.textContent = 'Update User';
                                    submitSpinner.classList.add('d-none');
                                    document.getElementById('preview-container').style.display = 'none';
                                    document.getElementById('preview-images').innerHTML = '';
                                });
                            });

                            function confirmDeleteMedia(url) {
                                if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                                    var form = document.getElementById('deleteMediaForm');
                                    form.action = url;
                                    form.submit();
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection