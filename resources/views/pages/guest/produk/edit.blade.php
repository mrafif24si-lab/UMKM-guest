@extends('layouts.guest')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit Produk</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white py-4 custom-card-header">
                    <h5 class="mb-0">Form Edit Produk - {{ $produk->nama_produk }}</h5>
                </div>
                <div class="card-body p-5">
                    
                    {{-- [WAJIB ADA] UNTUK MELIHAT KENAPA UPDATE GAGAL --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h4><i class="fas fa-exclamation-triangle"></i> Gagal Disimpan!</h4>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Pilih UMKM --}}
                        <div class="mb-4">
                            <label class="form-label">Pilih UMKM</label>
                            <select class="form-select @error('umkm_id') is-invalid @enderror" name="umkm_id" required>
                                @foreach($umkm as $u)
                                    <option value="{{ $u->umkm_id }}" {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                        {{ $u->nama_usaha }}
                                    </option>
                                @endforeach
                            </select>
                            @error('umkm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Jenis Produk</label>
                                <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror" name="jenis_produk" value="{{ old('jenis_produk', $produk->jenis_produk) }}" required>
                                @error('jenis_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', $produk->harga) }}">
                                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $produk->stok) }}">
                                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option value="Aktif" {{ old('status', $produk->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status', $produk->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- UPLOAD GAMBAR --}}
                        <div class="mb-4">
                            <label class="form-label">Upload Foto Produk (Opsional)</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar[]" multiple accept="image/*">
                            <small class="text-muted">Max 2MB per file.</small>
                            @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- GALERI --}}
                        @if($produk->media->count() > 0)
                        <div class="mb-4">
                            <label class="form-label">Foto Produk Saat Ini:</label>
                            <div class="row">
                                @foreach($produk->media as $foto)
                                <div class="col-md-2 mb-2">
                                    <img src="{{ asset('storage/media/' . $foto->file_name) }}" class="img-thumbnail w-100" style="height: 80px; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-custom btn-lg flex-grow-1">Update Produk</button>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg">Kembali</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-card-header { background: linear-gradient(135deg, #28a745, #17a2b8); }
.btn-custom { background: linear-gradient(135deg, #28a745, #17a2b8); color: white; border: none; }
</style>
@endsection