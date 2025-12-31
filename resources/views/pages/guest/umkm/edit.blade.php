@extends('layouts.guest.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit UMKM</h1>
        <p class="text-white lead">Form edit data UMKM</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-4">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit UMKM</h5>
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

                        <form action="{{ route('umkm.update', $umkm->umkm_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Input Nama Usaha --}}
                            <div class="mb-4">
                                <label for="nama_usaha" class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_usaha') is-invalid @enderror" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                                @error('nama_usaha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Pemilik --}}
                            <div class="mb-4">
                                <label for="pemilik_warga_id" class="form-label">Pemilik <span class="text-danger">*</span></label>
                                <select class="form-select @error('pemilik_warga_id') is-invalid @enderror" id="pemilik_warga_id" name="pemilik_warga_id" required>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id', $umkm->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} ({{ $w->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemilik_warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Alamat, RT, RW --}}
                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2">{{ old('alamat', $umkm->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror" name="rt" value="{{ old('rt', $umkm->rt) }}">
                                    @error('rt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror" name="rw" value="{{ old('rw', $umkm->rw) }}">
                                    @error('rw') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Input Kategori --}}
                            <div class="mb-4">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select @error('kategori') is-invalid @enderror" name="kategori">
                                    <option value="Makanan & Minuman" {{ old('kategori', $umkm->kategori) == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                    <option value="Jasa" {{ old('kategori', $umkm->kategori) == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                    <option value="Kerajinan" {{ old('kategori', $umkm->kategori) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                    <option value="Lainnya" {{ old('kategori', $umkm->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            {{-- Input Kontak & Deskripsi --}}
                            <div class="mb-4">
                                <label class="form-label">Kontak</label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{ old('kontak', $umkm->kontak) }}">
                                @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                            </div>

                            {{-- UPLOAD FILE --}}
                            <div class="mb-4">
                                <label for="files" class="form-label">Upload File Baru</label>
                                <input type="file" class="form-control @error('files') is-invalid @enderror" id="files" name="files[]" multiple>
                                @error('files') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- LIST FILE LAMA (GALERI) --}}
                           <!-- Di bagian Tampilkan File yang Sudah Diupload (di edit.blade.php) -->
@if($umkm->media->count() > 0)
<div class="mb-4">
    <label class="form-label">File Terupload Saat Ini</label>
    <div class="row">
        @foreach($umkm->media as $media)
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
                            onclick="confirmDeleteMedia('{{ route('umkm.delete-media', $media->media_id) }}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<!-- Placeholder untuk tidak ada file -->
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

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning flex-grow-1">Update Data</button>
                                <a href="{{ route('umkm.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                        <form id="deleteMediaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
