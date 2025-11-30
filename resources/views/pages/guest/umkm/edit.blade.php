@extends('layouts.guest')

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
                               f </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
<form action="{{ route('umkm.update', $umkm->umkm_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
                            <div class="mb-4">
                                <label for="nama_usaha" class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_usaha') is-invalid @enderror" 
                                       id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" 
                                       placeholder="Masukkan nama usaha" required>
                                @error('nama_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pemilik_warga_id" class="form-label">Pemilik <span class="text-danger">*</span></label>
                                <select class="form-select @error('pemilik_warga_id') is-invalid @enderror" 
                                        id="pemilik_warga_id" name="pemilik_warga_id" required>
                                    <option value="">Pilih Pemilik</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id', $umkm->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} ({{ $w->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemilik_warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3" 
                                          placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $umkm->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                               id="rt" name="rt" value="{{ old('rt', $umkm->rt) }}" 
                                               placeholder="Contoh: 001" maxlength="3" required>
                                        @error('rt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                               id="rw" name="rw" value="{{ old('rw', $umkm->rw) }}" 
                                               placeholder="Contoh: 002" maxlength="3" required>
                                        @error('rw')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" 
                                        id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Makanan & Minuman" {{ old('kategori', $umkm->kategori) == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                    <option value="Fashion & Pakaian" {{ old('kategori', $umkm->kategori) == 'Fashion & Pakaian' ? 'selected' : '' }}>Fashion & Pakaian</option>
                                    <option value="Kerajinan Tangan" {{ old('kategori', $umkm->kategori) == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                    <option value="Pertanian & Perkebunan" {{ old('kategori', $umkm->kategori) == 'Pertanian & Perkebunan' ? 'selected' : '' }}>Pertanian & Perkebunan</option>
                                    <option value="Jasa" {{ old('kategori', $umkm->kategori) == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                    <option value="Perdagangan" {{ old('kategori', $umkm->kategori) == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                    <option value="Elektronik & Teknologi" {{ old('kategori', $umkm->kategori) == 'Elektronik & Teknologi' ? 'selected' : '' }}>Elektronik & Teknologi</option>
                                    <option value="Kecantikan & Kosmetik" {{ old('kategori', $umkm->kategori) == 'Kecantikan & Kosmetik' ? 'selected' : '' }}>Kecantikan & Kosmetik</option>
                                    <option value="Otomotif" {{ old('kategori', $umkm->kategori) == 'Otomotif' ? 'selected' : '' }}>Otomotif</option>
                                    <option value="Pendidikan" {{ old('kategori', $umkm->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Kesehatan" {{ old('kategori', $umkm->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Lainnya" {{ old('kategori', $umkm->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                       id="kontak" name="kontak" value="{{ old('kontak', $umkm->kontak) }}" 
                                       placeholder="Contoh: 08123456789" required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi Usaha</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4" 
                                          placeholder="Deskripsikan usaha Anda...">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Multiple File Upload Section -->
                            <div class="mb-4">
                                <label for="files" class="form-label">Upload File Pendukung Baru (Logo/Foto Usaha)</label>
                                <input type="file" class="form-control @error('files.*') is-invalid @enderror" 
                                       id="files" name="files[]" multiple 
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                <div class="form-text">
                                    Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX. Maksimal 2MB per file.
                                    Anda dapat memilih multiple file sekaligus.
                                </div>
                                @error('files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tampilkan File yang Sudah Diupload -->
                            @if($umkm->media->count() > 0)
                            <div class="mb-4">
                                <label class="form-label">File Terupload Saat Ini</label>
                                <div class="row">
                                    @foreach($umkm->media as $media)
                                    <div class="col-md-4 mb-3">
                                        <div class="card file-card h-100">
                                            <div class="card-body text-center">
                                                @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/gif']))
                                                    <img src="{{ Storage::url('public/uploads/' . $media->file_name) }}" 
                                                         class="img-thumbnail mb-2" 
                                                         style="max-height: 120px; width: 100%; object-fit: cover;" 
                                                         alt="{{ $media->caption }}">
                                                @else
                                                    <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                                                @endif
                                                <p class="small mb-1 text-truncate" title="{{ $media->caption }}">
                                                    {{ $media->caption }}
                                                </p>
                                                <form action="{{ route('umkm.delete-media', $media->media_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Yakin ingin menghapus file ini?')">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Belum ada file yang diupload untuk UMKM ini.
                            </div>
                            @endif

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-save me-2"></i> Update Data
                                </button>
                                <a href="{{ route('umkm.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <a href="{{ route('umkm.create') }}" class="btn btn-success btn-lg ms-auto">
                                    <i class="fas fa-plus me-2"></i> Tambah Baru
                                </a>
                            </div>
                            <!-- Preview Upload -->
<div class="mb-4" id="preview-container" style="display: none;">
    <label class="form-label">Preview Gambar:</label>
    <div class="row" id="preview-images"></div>
</div>

<script>
    document.getElementById('files').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        previewImages.innerHTML = '';
        previewContainer.style.display = 'block';

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
</script>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection