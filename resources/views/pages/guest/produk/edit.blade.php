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
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-4 custom-card-header">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Produk - {{ $produk->nama_produk }}</h5>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
    <label for="umkm_id" class="form-label">Pilih UMKM <span class="text-danger">*</span></label>
    <select class="form-select @error('umkm_id') is-invalid @enderror" 
            id="umkm_id" name="umkm_id" required>
        <option value="">Pilih UMKM</option>
        @foreach($umkm as $u)
            <option value="{{ $u->umkm_id }}" {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                {{ $u->nama_usaha }} - {{ $u->pemilik->nama ?? 'Tidak diketahui' }}
            </option>
        @endforeach
    </select>
    @error('umkm_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                               id="nama_produk" name="nama_produk"
                                               value="{{ old('nama_produk', $produk->nama_produk) }}"
                                               placeholder="Masukkan nama Produk" required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_produk" class="form-label">Jenis Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror"
                                               id="jenis_produk" name="jenis_produk"
                                               value="{{ old('jenis_produk', $produk->jenis_produk) }}"
                                               placeholder="Masukkan jenis produk" required>
                                        @error('jenis_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          id="deskripsi" name="deskripsi" rows="4"
                                          placeholder="Deskripsikan produk Anda...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                               id="harga" name="harga"
                                               value="{{ old('harga', $produk->harga) }}"
                                               min="0" step="100" placeholder="0" required>
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                               id="stok" name="stok"
                                               value="{{ old('stok', $produk->stok) }}"
                                               min="0" placeholder="0" required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Ketersediaan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Aktif" {{ old('status', $produk->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Nonaktif" {{ old('status', $produk->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-custom btn-lg">
                                    <i class="fas fa-save me-2"></i> Update Produk
                                </button>
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

<style>
.btn-custom {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%);
    border: none;
    color: white;
    transition: transform 0.3s ease;
    font-weight: 600;
}

.btn-custom:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

.custom-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.form-control:focus {
    border-color: #fd7e14;
    box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
}

.form-select:focus {
    border-color: #fd7e14;
    box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
}
</style>
@endsection
