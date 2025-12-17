@extends('layouts.guest')

@section('title', 'Tambah Detail Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Detail Pesanan</h1>
        <p class="text-white lead">Form tambah item pesanan</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                        <h5 class="mb-0 text-white"><i class="fas fa-plus-circle me-2"></i>Form Tambah Detail Pesanan</h5>
                    </div>
                    <div class="card-body p-5">

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

                        <form action="{{ route('detail-pesanan.store') }}" method="POST" id="detailForm">
                            @csrf
                            
                            <!-- Pesanan -->
                            <div class="mb-4">
                                <label for="pesanan_id" class="form-label">Pilih Pesanan <span class="text-danger">*</span></label>
                                <select class="form-select @error('pesanan_id') is-invalid @enderror" 
                                        id="pesanan_id" name="pesanan_id" required>
                                    <option value="">-- Pilih Pesanan --</option>
                                    @foreach($pesanan as $p)
                                        <option value="{{ $p->pesanan_id }}" 
                                                data-warga="{{ $p->warga->nama ?? '-' }}"
                                                {{ old('pesanan_id') == $p->pesanan_id ? 'selected' : '' }}>
                                            #{{ $p->nomor_pesanan }} - {{ $p->warga->nama ?? 'Pelanggan' }} 
                                            ({{ $p->total_formatted }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pesanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">Pemesan: <span id="selected-warga">-</span></small>
                                </div>
                            </div>

                            <!-- Produk -->
                            <div class="mb-4">
                                <label for="produk_id" class="form-label">Pilih Produk <span class="text-danger">*</span></label>
                                <select class="form-select @error('produk_id') is-invalid @enderror" 
                                        id="produk_id" name="produk_id" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produk as $pr)
                                        <option value="{{ $pr->produk_id }}" 
                                                data-harga="{{ $pr->harga }}"
                                                data-stok="{{ $pr->stok }}"
                                                data-jenis="{{ $pr->jenis_produk }}"
                                                data-umkm="{{ $pr->umkm->nama_usaha ?? '-' }}"
                                                {{ old('produk_id') == $pr->produk_id ? 'selected' : '' }}>
                                            {{ $pr->nama_produk }} 
                                            ({{ $pr->jenis_produk }}) - 
                                            {{ 'Rp ' . number_format($pr->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">
                                        UMKM: <span id="selected-umkm">-</span> | 
                                        Jenis: <span id="selected-jenis">-</span> | 
                                        Stok: <span id="selected-stok">0</span>
                                    </small>
                                </div>
                            </div>

                            <!-- Qty dan Harga -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="qty" class="form-label">Jumlah (Qty) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('qty') is-invalid @enderror" 
                                               id="qty" name="qty" value="{{ old('qty', 1) }}" 
                                               min="1" required>
                                        @error('qty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Stok tersedia: <span id="available-stock">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="harga_satuan" class="form-label">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" 
                                                   id="harga_satuan" name="harga_satuan" 
                                                   value="{{ old('harga_satuan') }}" 
                                                   min="100" step="100" required>
                                        </div>
                                        @error('harga_satuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Harga default produk: <span id="product-price">Rp 0</span></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subtotal Preview -->
                            <div class="mb-4">
                                <div class="alert alert-info">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>Subtotal:</strong>
                                        <h4 class="mb-0 text-success" id="subtotal-preview">Rp 0</h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Detail
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
    const pesananSelect = document.getElementById('pesanan_id');
    const produkSelect = document.getElementById('produk_id');
    const qtyInput = document.getElementById('qty');
    const hargaInput = document.getElementById('harga_satuan');
    const subtotalPreview = document.getElementById('subtotal-preview');
    const selectedWarga = document.getElementById('selected-warga');
    const selectedUmkm = document.getElementById('selected-umkm');
    const selectedJenis = document.getElementById('selected-jenis');
    const selectedStok = document.getElementById('selected-stok');
    const availableStock = document.getElementById('available-stock');
    const productPrice = document.getElementById('product-price');

    // Update selected warga
    function updateSelectedWarga() {
        const selectedOption = pesananSelect.options[pesananSelect.selectedIndex];
        selectedWarga.textContent = selectedOption.dataset.warga || '-';
    }

    // Update product info
    function updateProductInfo() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        if (selectedOption.value) {
            const harga = selectedOption.dataset.harga;
            const stok = selectedOption.dataset.stok;
            const jenis = selectedOption.dataset.jenis;
            const umkm = selectedOption.dataset.umkm;
            
            hargaInput.value = harga;
            selectedUmkm.textContent = umkm;
            selectedJenis.textContent = jenis;
            selectedStok.textContent = stok;
            availableStock.textContent = stok;
            productPrice.textContent = 'Rp ' + parseFloat(harga).toLocaleString('id-ID');
            
            // Set max qty based on stock
            qtyInput.max = stok;
            if (parseInt(qtyInput.value) > parseInt(stok)) {
                qtyInput.value = stok;
                alert('Jumlah melebihi stok tersedia! Jumlah otomatis disesuaikan.');
            }
        } else {
            hargaInput.value = '';
            selectedUmkm.textContent = '-';
            selectedJenis.textContent = '-';
            selectedStok.textContent = '0';
            availableStock.textContent = '0';
            productPrice.textContent = 'Rp 0';
        }
        calculateSubtotal();
    }

    // Calculate subtotal
    function calculateSubtotal() {
        const qty = parseInt(qtyInput.value) || 0;
        const harga = parseFloat(hargaInput.value) || 0;
        const subtotal = qty * harga;
        
        subtotalPreview.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    // Event listeners
    pesananSelect.addEventListener('change', updateSelectedWarga);
    produkSelect.addEventListener('change', updateProductInfo);
    qtyInput.addEventListener('input', calculateSubtotal);
    hargaInput.addEventListener('input', calculateSubtotal);

    // Form validation
    document.getElementById('detailForm').addEventListener('submit', function(e) {
        const qty = parseInt(qtyInput.value);
        const harga = parseFloat(hargaInput.value);
        const stock = parseInt(availableStock.textContent);
        
        if (qty < 1) {
            alert('Jumlah harus minimal 1');
            e.preventDefault();
            return;
        }
        
        if (qty > stock) {
            alert('Jumlah melebihi stok tersedia! Stok: ' + stock);
            e.preventDefault();
            return;
        }
        
        if (harga < 100) {
            alert('Harga harus minimal Rp 100');
            e.preventDefault();
            return;
        }
        
        if (!pesananSelect.value) {
            alert('Pilih pesanan terlebih dahulu');
            e.preventDefault();
            return;
        }
        
        if (!produkSelect.value) {
            alert('Pilih produk terlebih dahulu');
            e.preventDefault();
            return;
        }
    });

    // Initial update
    updateSelectedWarga();
    if (produkSelect.value) {
        updateProductInfo();
    }
});
</script>

<style>
.card {
    border-radius: 20px;
    overflow: hidden;
}

.card-header {
    padding: 20px;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(246, 179, 92, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(246, 179, 92, 0.3);
}

.alert-info {
    background: rgba(23, 162, 184, 0.1);
    border-color: rgba(23, 162, 184, 0.3);
}
</style>
@endsection