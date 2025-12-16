@extends('layouts.guest')

@section('title', 'Tambah Detail Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Detail Pesanan</h1>
        <p class="text-white lead">Form penambahan detail pesanan baru</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0"><i class="fas fa-cart-plus me-2"></i>Form Tambah Detail Pesanan</h5>
                    </div>
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
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

                        <form action="{{ route('detail-pesanan.store') }}" method="POST" id="detailForm">
                            @csrf

                            <div class="mb-4">
                                <label for="pesanan_id" class="form-label">Pesanan <span class="text-danger">*</span></label>
                                <select class="form-select @error('pesanan_id') is-invalid @enderror" 
                                        id="pesanan_id" name="pesanan_id" required>
                                    <option value="">Pilih Pesanan</option>
                                    @foreach($pesanan as $p)
                                        <option value="{{ $p->pesanan_id }}" 
                                            {{ old('pesanan_id') == $p->pesanan_id ? 'selected' : '' }}>
                                            {{ $p->nomor_pesanan }} - {{ $p->warga->nama ?? 'Tidak diketahui' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pesanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="produk_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                <select class="form-select @error('produk_id') is-invalid @enderror" 
                                        id="produk_id" name="produk_id" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($produk as $prod)
                                        <option value="{{ $prod->produk_id }}" 
                                            data-harga="{{ $prod->harga }}"
                                            data-stok="{{ $prod->stok }}"
                                            {{ old('produk_id') == $prod->produk_id ? 'selected' : '' }}>
                                            {{ $prod->nama_produk }} 
                                            ({{ $prod->umkm->nama_usaha ?? '-' }}) 
                                            - Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                            @if($prod->stok <= 0)
                                                - Stok Habis
                                            @else
                                                - Stok: {{ $prod->stok }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted mt-1" id="produkInfo"></small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="qty" class="form-label">Jumlah (Qty) <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('qty') is-invalid @enderror" 
                                           id="qty" name="qty" 
                                           value="{{ old('qty', 1) }}" 
                                           min="1" required>
                                    @error('qty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted" id="stokInfo"></small>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="harga_satuan" class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" 
                                               class="form-control @error('harga_satuan') is-invalid @enderror" 
                                               id="harga_satuan" name="harga_satuan" 
                                               value="{{ old('harga_satuan') }}" 
                                               min="0" step="100" required>
                                    </div>
                                    @error('harga_satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Ringkasan</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1">Subtotal:</p>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <p class="mb-1 fw-bold" id="subtotalDisplay">Rp 0</p>
                                            </div>
                                        </div>
                                        <input type="hidden" id="subtotal" name="subtotal" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Data
                                </button>
                                <a href="{{ route('detail-pesanan.index') }}" class="btn btn-secondary btn-lg">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const hargaInput = document.getElementById('harga_satuan');
    const qtyInput = document.getElementById('qty');
    const subtotalDisplay = document.getElementById('subtotalDisplay');
    const subtotalInput = document.getElementById('subtotal');
    const produkInfo = document.getElementById('produkInfo');
    const stokInfo = document.getElementById('stokInfo');

    function calculateSubtotal() {
        const harga = parseFloat(hargaInput.value) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = harga * qty;
        
        subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        subtotalInput.value = subtotal;
    }

    function updateProdukInfo() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        if (selectedOption.value) {
            const harga = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stok');
            
            hargaInput.value = harga || '';
            hargaInput.readOnly = true;
            hargaInput.style.backgroundColor = '#f8f9fa';
            
            produkInfo.textContent = `Harga: Rp ${(harga || 0).toLocaleString('id-ID')} | Stok: ${stok || 0}`;
            
            if (parseInt(stok) <= 0) {
                stokInfo.innerHTML = '<i class="fas fa-exclamation-triangle text-danger"></i> Stok produk habis!';
                stokInfo.className = 'form-text text-danger';
                qtyInput.max = 0;
                qtyInput.value = 0;
            } else {
                stokInfo.textContent = `Maksimal pembelian: ${stok} unit`;
                stokInfo.className = 'form-text text-muted';
                qtyInput.max = stok;
                qtyInput.value = Math.min(parseInt(qtyInput.value) || 1, stok);
            }
            
            calculateSubtotal();
        } else {
            hargaInput.value = '';
            hargaInput.readOnly = false;
            hargaInput.style.backgroundColor = '';
            produkInfo.textContent = '';
            stokInfo.textContent = '';
            qtyInput.max = '';
            calculateSubtotal();
        }
    }

    produkSelect.addEventListener('change', updateProdukInfo);
    hargaInput.addEventListener('input', calculateSubtotal);
    qtyInput.addEventListener('input', calculateSubtotal);

    // Initialize on page load
    updateProdukInfo();
});
</script>
@endsection