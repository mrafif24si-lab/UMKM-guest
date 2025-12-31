@extends('layouts.guest.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit Produk</h1>
        <p class="text-white lead">Perbarui informasi produk UMKM</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-warning text-dark py-4 rounded-top-3">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk: <strong>{{ $produk->nama_produk }}</strong></h5>
                    </div>
                    <div class="card-body p-5">

                        {{-- Alert Error Global --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle me-2"></i>Gagal Update!</strong> Periksa inputan berikut:
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Alert Sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data" id="editProdukForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- Nama Produk --}}
                                <div class="col-md-6 mb-4">
                                    <label for="nama_produk" class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                           id="nama_produk" name="nama_produk" 
                                           value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                    @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Jenis Produk --}}
                                <div class="col-md-6 mb-4">
                                    <label for="jenis_produk" class="form-label fw-bold">Jenis Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror" 
                                           id="jenis_produk" name="jenis_produk" 
                                           value="{{ old('jenis_produk', $produk->jenis_produk) }}" required>
                                    @error('jenis_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Pilih UMKM --}}
                            <div class="mb-4">
                                <label for="umkm_id" class="form-label fw-bold">UMKM <span class="text-danger">*</span></label>
                                <select class="form-select @error('umkm_id') is-invalid @enderror" id="umkm_id" name="umkm_id" required>
                                    @foreach($umkm as $u)
                                        <option value="{{ $u->umkm_id }}" {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                            {{ $u->nama_usaha }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('umkm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Harga --}}
                                <div class="col-md-4 mb-4">
                                    <label for="harga" class="form-label fw-bold">Harga (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                               id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" 
                                               min="0" step="100" required>
                                    </div>
                                    @error('harga') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Stok --}}
                                <div class="col-md-4 mb-4">
                                    <label for="stok" class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                           id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" 
                                           min="0" required>
                                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4 mb-4">
                                    <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="Aktif" {{ old('status', $produk->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ old('status', $produk->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-5">

                            {{-- SECTION GAMBAR --}}
                            <h5 class="fw-bold mb-3"><i class="fas fa-images me-2 text-primary"></i>Galeri Produk</h5>
                            
                            {{-- 1. Daftar Gambar Lama --}}
                            <div class="mb-4">
                                <label class="form-label">Gambar Saat Ini:</label>
                                @if($produk->media && $produk->media->count() > 0)
                                    <div class="row g-3">
                                        @foreach($produk->media as $media)
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                                <div class="card h-100 border shadow-sm position-relative group-action">
                                                    <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                         class="card-img-top" 
                                                         style="height: 120px; object-fit: cover;"
                                                         onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                                    
                                                    {{-- Tombol Hapus Overlay --}}
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle shadow" 
                                                            onclick="confirmDeleteMedia('{{ route('produk.delete-media', $media->media_id) }}')"
                                                            title="Hapus gambar ini">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-light border text-center text-muted">
                                        <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                        Belum ada gambar yang diupload.
                                    </div>
                                @endif
                            </div>

                            {{-- 2. Upload Gambar Baru --}}
                            <div class="mb-4">
                                <label for="gambar" class="form-label fw-bold">Tambah Gambar Baru</label>
                                <input type="file" class="form-control @error('gambar.*') is-invalid @enderror" 
                                       id="gambar" name="gambar[]" multiple accept="image/*">
                                <div class="form-text">Bisa pilih banyak file sekaligus (JPG, PNG). Maks 2MB/file.</div>
                                @error('gambar.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Preview Upload Baru --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <h6 class="fw-bold mb-3 text-success">Akan Diupload:</h6>
                                <div class="row g-3" id="preview-images"></div>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="d-flex gap-2 pt-4 border-top">
                                <button type="submit" class="btn btn-warning btn-lg px-4" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Update Produk</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none ms-2"></div>
                                </button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg px-4">
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

{{-- Hidden Form untuk Delete Media --}}
<form id="deleteMediaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Preview Gambar Baru
    const inputGambar = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview-container');
    const previewImages = document.getElementById('preview-images');

    inputGambar.addEventListener('change', function(e) {
        previewImages.innerHTML = '';
        const files = e.target.files;

        if (files.length > 0) {
            previewContainer.style.display = 'block';
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-sm-4 col-md-3 col-lg-2';
                        col.innerHTML = `
                            <div class="card h-100 border-success shadow-sm">
                                <img src="${event.target.result}" class="card-img-top rounded" style="height: 100px; object-fit: cover;">
                                <div class="card-footer p-1 text-center bg-success text-white">
                                    <small style="font-size: 0.7rem;">Baru</small>
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

    // 2. Loading saat Submit
    const form = document.getElementById('editProdukForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('d-none');
    });
});

// 3. Fungsi Hapus Gambar Lama
function confirmDeleteMedia(url) {
    if (confirm('Yakin ingin menghapus gambar ini secara permanen?')) {
        const form = document.getElementById('deleteMediaForm');
        form.action = url;
        form.submit();
    }
}
</script>
@endsection