@extends('layouts.guest.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Produk</h1>
        <p class="text-white lead">Form tambah produk UMKM</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-4 rounded-top-3">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Tambah Produk</h5>
                    </div>
                    <div class="card-body p-5">
                        
                        {{-- Alert Error Global --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Alert Success --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" id="produkForm">
                            @csrf
                            
                            {{-- Pilih UMKM --}}
                            <div class="mb-4">
                                <label for="umkm_id" class="form-label fw-bold">Pilih UMKM <span class="text-danger">*</span></label>
                                <select class="form-select @error('umkm_id') is-invalid @enderror" id="umkm_id" name="umkm_id" required>
                                    <option value="">-- Pilih UMKM --</option>
                                    @foreach($umkm as $u)
                                        <option value="{{ $u->umkm_id }}" {{ old('umkm_id') == $u->umkm_id ? 'selected' : '' }}>
                                            {{ $u->nama_usaha }} - {{ $u->pemilik->nama ?? 'Tidak diketahui' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('umkm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Nama Produk --}}
                                <div class="col-md-6 mb-4">
                                    <label for="nama_produk" class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                           id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" 
                                           placeholder="Masukkan nama produk" required>
                                    @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Jenis Produk --}}
                                <div class="col-md-6 mb-4">
                                    <label for="jenis_produk" class="form-label fw-bold">Jenis Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror" 
                                           id="jenis_produk" name="jenis_produk" value="{{ old('jenis_produk') }}" 
                                           placeholder="Contoh: Makanan, Kerajinan" required>
                                    @error('jenis_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4" 
                                          placeholder="Jelaskan detail produk Anda...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Harga --}}
                                <div class="col-md-4 mb-4">
                                    <label for="harga" class="form-label fw-bold">Harga (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                               id="harga" name="harga" value="{{ old('harga') }}" 
                                               min="0" step="100" placeholder="0" required>
                                    </div>
                                    @error('harga') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Stok --}}
                                <div class="col-md-4 mb-4">
                                    <label for="stok" class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                           id="stok" name="stok" value="{{ old('stok') }}" 
                                           min="0" placeholder="0" required>
                                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4 mb-4">
                                    <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- UPLOAD GAMBAR (PENTING: name="gambar[]") --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Upload Gambar Produk</label>
                                <div class="card bg-light border-dashed">
                                    <div class="card-body text-center p-4">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-secondary mb-3"></i>
                                        <p class="text-muted mb-2">Drag & drop gambar di sini atau klik tombol di bawah</p>
                                        <input type="file" class="form-control @error('gambar.*') is-invalid @enderror" 
                                               id="gambar" name="gambar[]" multiple 
                                               accept="image/jpeg,image/png,image/jpg,image/gif">
                                        <div class="form-text mt-2">
                                            Format: JPG, PNG, GIF. Maks: 2MB per file. Bisa pilih banyak sekaligus.
                                        </div>
                                        @error('gambar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        @error('gambar.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Preview Area --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <h6 class="fw-bold mb-3">Preview Gambar yang Dipilih:</h6>
                                <div class="row g-3" id="preview-images"></div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex gap-2 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Simpan Produk</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status"></div>
                                </button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Batal
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
document.addEventListener('DOMContentLoaded', function() {
    // 1. Preview Gambar
    const inputGambar = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview-container');
    const previewImages = document.getElementById('preview-images');

    inputGambar.addEventListener('change', function(event) {
        previewImages.innerHTML = '';
        const files = event.target.files;

        if (files.length > 0) {
            previewContainer.style.display = 'block';
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-sm-4 col-md-3 col-lg-2';
                        col.innerHTML = `
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="${e.target.result}" class="card-img-top rounded" style="height: 100px; object-fit: cover;">
                                <div class="card-body p-1 text-center">
                                    <small class="text-muted d-block text-truncate" style="font-size: 0.75rem;">${file.name}</small>
                                </div>
                            </div>
                        `;
                        previewImages.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // 2. Loading Spinner saat Submit
    const form = document.getElementById('produkForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function() {
        // Disable tombol biar ga double submit
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('d-none');
    });
});
</script>
@endsection