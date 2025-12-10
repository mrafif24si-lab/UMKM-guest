<!-- resources/views/pages/guest/warga/create.blade.php -->
@extends('layouts.guest')

@section('title', 'Tambah Data Warga')

@section('content')
<div class="container-fluid py-5">
    <!-- Background Pattern -->
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <!-- Main Card -->
                <div class="card border-0 overflow-hidden shadow-lg" style="border-radius: 20px;">
                    <!-- Header -->
                    <div class="card-header py-4 px-4 px-lg-5 position-relative" 
                         style="background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="text-white mb-0">
                                    <i class="fas fa-user-plus me-2"></i>Tambah Data Warga Baru
                                </h3>
                                <p class="text-white-50 mb-0">Form pendaftaran warga baru</p>
                            </div>
                            <a href="{{ route('warga.index') }}" class="btn btn-light btn-sm rounded-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Informasi Dasar -->
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" required>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                                id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('agama') is-invalid @enderror" 
                                               id="agama" name="agama" value="{{ old('agama') }}" required>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kontak -->
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-address-card me-2"></i>Informasi Kontak
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="telp" class="form-label">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                                               id="telp" name="telp" value="{{ old('telp') }}" required>
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
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
                                </div>
                            </div>

                            <!-- Upload File Section -->
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-upload me-2"></i>Upload Dokumen/Foto
                                </h5>
                                <div class="card border-dashed">
                                    <div class="card-body text-center p-5">
                                        <div class="mb-3">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                            <h5>Drag & Drop atau Klik untuk Upload</h5>
                                            <p class="text-muted">Format: JPG, PNG, PDF, DOC, DOCX, XLS, XLSX (Max: 2MB)</p>
                                        </div>
                                        <input type="file" class="form-control" id="files" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                        <div class="mt-3" id="file-preview"></div>
                                    </div>
                                </div>
                                <small class="text-muted">* Upload foto KTP, foto profil, atau dokumen pendukung lainnya</small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg px-5 rounded-4">
                                    <i class="fas fa-save me-2"></i> Simpan Data
                                </button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-redo me-2"></i> Reset
                                </button>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-lg ms-auto">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #F6B35C, #118AB2);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 600;
}

.border-dashed {
    border: 2px dashed #dee2e6 !important;
    border-radius: 15px !important;
}

.form-control:focus, .form-select:focus {
    border-color: #118AB2;
    box-shadow: 0 0 0 0.25rem rgba(17, 138, 178, 0.25);
}
</style>

<script>
// Preview file upload
document.getElementById('files').addEventListener('change', function(e) {
    const preview = document.getElementById('file-preview');
    preview.innerHTML = '';
    
    if (this.files.length > 0) {
        const list = document.createElement('ul');
        list.className = 'list-group';
        
        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];
            const item = document.createElement('li');
            item.className = 'list-group-item d-flex justify-content-between align-items-center';
            
            item.innerHTML = `
                <div>
                    <i class="fas fa-file me-2 text-primary"></i>
                    ${file.name}
                </div>
                <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
            `;
            
            list.appendChild(item);
        }
        
        preview.appendChild(list);
    }
});
</script>
@endsection