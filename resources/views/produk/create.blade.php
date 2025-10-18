<!-- resources/views/produk/create.blade.php -->
@extends('layouts.guest')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Pembelian Produk</h1>
        <p class="text-white lead">Form pembelian produk UMKM</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Pembelian Produk</h5>
                    </div>
                    <div class="card-body p-5">
                        {{-- Tambahkan alert untuk success/error --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('produk.store') }}" method="POST" id="produkForm">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                               id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" 
                                               placeholder="Masukkan nama produk" required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_produk" class="form-label">Jenis Produk <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('jenis_produk') is-invalid @enderror" 
                                               id="jenis_produk" name="jenis_produk" value="{{ old('jenis_produk') }}" 
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
                                          placeholder="Deskripsikan produk yang ingin dibeli..">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                               id="harga" name="harga" value="{{ old('harga') }}" 
                                               min="0" step="100" placeholder="0" required>
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="stok" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                               id="stok" name="stok" value="{{ old('stok') }}" 
                                               min="1" placeholder="0" required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">ketersediaan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status" required>
                                            <option value="">Pilih Kertesediaan</option>
                                            <option value="Aktif">Tersedia</option>
                                            <option value="Nonaktif">Tidak Tersedia</option>
                                        </select>
                                        @error('ketersediaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                            </div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Simpan</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-auto">
                                    <i class="fas fa-redo me-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tambahkan JavaScript untuk handling form --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('produkForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function(e) {
        // Validasi client-side sederhana
        const harga = document.getElementById('harga').value;
        const stok = document.getElementById('stok').value;
        
        if (harga <= 0) {
            alert('Harga harus lebih dari 0');
            e.preventDefault();
            return;
        }
        
        if (stok <= 0) {
            alert('Jumlah harus lebih dari 0');
            e.preventDefault();
            return;
        }

        // Tampilkan loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('d-none');
    });

    // Reset loading state ketika form direset
    form.addEventListener('reset', function() {
        submitBtn.disabled = false;
        submitText.textContent = 'Simpan';
        submitSpinner.classList.add('d-none');
    });
});
</script>
@endsection