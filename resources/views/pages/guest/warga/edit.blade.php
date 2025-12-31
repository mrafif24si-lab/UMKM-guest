@extends('layouts.guest.app')

@section('title', 'Edit Data Warga')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Produk</h1>
        <p class="text-white lead">Form tambah produk UMKM</p>
    </div>
</div>
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
                                    <i class="fas fa-edit me-2"></i>Edit Data Warga - {{ $warga->nama }}
                                </h3>
                                <p class="text-white-50 mb-0">Form edit data warga</p>
                            </div>
                            <a href="{{ route('warga.index') }}" class="btn btn-light btn-sm rounded-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Informasi Dasar -->
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}" required>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama', $warga->nama) }}" required>
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
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('agama') is-invalid @enderror" 
                                               id="agama" name="agama" value="{{ old('agama', $warga->agama) }}" required>
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
                                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="telp" class="form-label">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                                               id="telp" name="telp" value="{{ old('telp', $warga->telp) }}" required>
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $warga->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery Existing Files -->
                            @if($warga->media->count() > 0)
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-images me-2"></i>Dokumen/Foto Saat Ini
                                </h5>
                                <div class="row g-3">
                                    @foreach($warga->media as $media)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="card position-relative">
                                            @if(Str::startsWith($media->mime_type, 'image/'))
                                                <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                     class="card-img-top" 
                                                     style="height: 120px; object-fit: cover;"
                                                     alt="{{ $media->caption }}"
                                                     onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                            @else
                                                <div class="card-body text-center">
                                                    <i class="fas fa-file fa-3x text-primary mb-2"></i>
                                                    <p class="card-text small">{{ $media->caption }}</p>
                                                </div>
                                            @endif
                                            <div class="card-footer p-2">
                                                <form action="{{ route('warga.edit', $media->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus file ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Upload File Baru -->
                            <div class="mb-4">
                                <h5 class="text-gradient mb-4">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Dokumen/Foto Baru
                                </h5>
                                <div class="card border-dashed">
                                    <div class="card-body text-center p-5">
                                        <div class="mb-3">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                            <h5>Upload File Tambahan</h5>
                                            <p class="text-muted">Format: JPG, PNG, PDF, DOC, DOCX, XLS, XLSX (Max: 2MB)</p>
                                        </div>
                                        <input type="file" class="form-control" id="files" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                        <div class="mt-3" id="file-preview"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg px-5 rounded-4">
                                    <i class="fas fa-save me-2"></i> Update Data
                                </button>
                                <a href="{{ route('warga.show', $warga->warga_id) }}" class="btn btn-info btn-lg">
                                    <i class="fas fa-eye me-2"></i> Lihat Detail
                                </a>
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



<script>
// Preview file upload dengan gambar
document.getElementById('files').addEventListener('change', function(e) {
    const preview = document.getElementById('file-preview');
    preview.innerHTML = '';
    
    if (this.files.length > 0) {
        const row = document.createElement('div');
        row.className = 'row g-2';
        
        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-3';
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const card = document.createElement('div');
                    card.className = 'card h-100';
                    card.innerHTML = `
                        <img src="${e.target.result}" class="card-img-top" style="height: 120px; object-fit: cover; border-radius: 10px 10px 0 0;">
                        <div class="card-body p-2">
                            <small class="card-text d-block text-truncate" title="${file.name}">${file.name}</small>
                            <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>
                    `;
                    col.appendChild(card);
                };
                reader.readAsDataURL(file);
            } else {
                col.innerHTML = `
                    <div class="card h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center" style="min-height: 150px;">
                            <i class="fas fa-file fa-3x text-primary mb-2"></i>
                            <p class="card-text small text-truncate" title="${file.name}">${file.name}</p>
                            <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>
                    </div>
                `;
            }
            
            row.appendChild(col);
        }
        
        preview.appendChild(row);
    }
});
</script>   
@endsection