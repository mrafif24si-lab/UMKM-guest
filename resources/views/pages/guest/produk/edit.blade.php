@extends('layouts.guest')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit Produk</h1>
        <p class="text-white lead">Form edit data produk</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-4">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Produk - {{ $produk->nama_produk }}</h5>
                    </div>
                    <div class="card-body p-5">

                        {{-- [FIX] TAMBAHKAN INI (ERROR VALIDASI) --}}
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

                        <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Input Nama Produk --}}
                            <div class="mb-4">
                                <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                       id="nama_produk" name="nama_produk" 
                                       value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input UMKM --}}
                            <div class="mb-4">
                                <label for="umkm_id" class="form-label">Pilih UMKM <span class="text-danger">*</span></label>
                                <select class="form-select @error('umkm_id') is-invalid @enderror" 
                                        id="umkm_id" name="umkm_id" required>
                                    @foreach($umkm as $u)
                                        <option value="{{ $u->umkm_id }}" {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                            {{ $u->nama_usaha }} - {{ $u->pemilik->nama ?? 'Tidak diketahui' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('umkm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_produk" class="form-label">Jenis Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror" 
                                               id="jenis_produk" name="jenis_produk" 
                                               value="{{ old('jenis_produk', $produk->jenis_produk) }}" required>
                                        @error('jenis_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                               id="harga" name="harga" 
                                               value="{{ old('harga', $produk->harga) }}" 
                                               min="0" step="100" required>
                                        @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                               id="stok" name="stok" 
                                               value="{{ old('stok', $produk->stok) }}" 
                                               min="0" required>
                                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status" required>
                                            <option value="Aktif" {{ old('status', $produk->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Nonaktif" {{ old('status', $produk->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- UPLOAD MULTIPLE FILE BARU --}}
                            <div class="mb-4">
                                <label for="gambar" class="form-label">Upload Gambar Baru (Multiple)</label>
                                <input type="file" class="form-control @error('gambar.*') is-invalid @enderror" 
                                       id="gambar" name="gambar[]" multiple 
                                       accept=".jpg,.jpeg,.png,.gif">
                                <div class="form-text">
                                    Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB per file.
                                    Anda dapat memilih multiple file sekaligus.
                                </div>
                                @error('gambar.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Preview Upload --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview Gambar Baru:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            {{-- LIST GAMBAR LAMA --}}
                            @if($produk->media->count() > 0)
                            <div class="mb-4">
                                <label class="form-label">Gambar Terupload Saat Ini</label>
                                <div class="row">
                                    @foreach($produk->media as $media)
                                    <div class="col-md-3 col-lg-2 mb-3">
                                        <div class="card file-card h-100">
                                            <div class="card-body text-center p-2">
                                                @if(Str::startsWith($media->mime_type, 'image/'))
                                                    <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                         class="img-thumbnail mb-2" 
                                                         style="height: 100px; width: 100%; object-fit: cover;" 
                                                         alt="{{ $media->caption }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
                                                        <i class="fas fa-file fa-2x text-secondary"></i>
                                                    </div>
                                                @endif
                                                <p class="small mb-1 text-truncate" title="{{ $media->caption }}">
                                                    {{ Str::limit($media->caption, 15) }}
                                                </p>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm w-100" 
                                                        onclick="confirmDeleteMedia('{{ route('produk.delete-media', $media->media_id) }}')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            {{-- Placeholder untuk tidak ada gambar --}}
                            <div class="text-center py-4 mb-4 border rounded bg-light">
                                <div class="mb-3">
                                    <img src="{{ asset('images/placeholder.png') }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 120px; width: auto;"
                                         alt="Belum ada gambar produk">
                                </div>
                                <h5 class="text-muted">Belum ada gambar produk</h5>
                                <p class="text-muted small">Upload gambar melalui form di atas</p>
                            </div>
                            @endif

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-save me-2"></i> Update Data
                                </button>
                                <a href="{{ route('produk.show', $produk->produk_id) }}" class="btn btn-info btn-lg">
                                    <i class="fas fa-eye me-2"></i> Lihat Detail
                                </a>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg">
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

{{-- Hidden form untuk delete media --}}
<form id="deleteMediaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Preview gambar baru sebelum upload
document.getElementById('gambar').addEventListener('change', function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('preview-container');
    const previewImages = document.getElementById('preview-images');
    previewImages.innerHTML = '';
    
    if (files.length > 0) {
        previewContainer.style.display = 'block';
        
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-lg-2 mb-2';
                    col.innerHTML = `
                        <div class="preview-card">
                            <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 100px; object-fit: cover;">
                            <small class="d-block mt-1 text-truncate">${file.name}</small>
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

// Delete media confirmation
function confirmDeleteMedia(url) {
    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        // Ambil form hidden
        var form = document.getElementById('deleteMediaForm');
        // Set action url sesuai tombol yang diklik
        form.action = url;
        // Submit form
        form.submit();
    }
}
</script>

<style>
.file-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #007bff;
}

.preview-card {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 5px;
    background: white;
}

.preview-card img {
    border-radius: 3px;
}
</style>
@endsection