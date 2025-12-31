@extends('layouts.guest.app')

@section('title', 'Tambah Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Pesanan</h1>
        <p class="text-white lead">Form tambah pesanan UMKM</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Tambah Pesanan</h5>
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

                        <form action="{{ route('pesanan.store') }}" method="POST" id="pesananForm" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- ROW 1: Nomor Pesanan & Warga -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nomor_pesanan" class="form-label">Nomor Pesanan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nomor_pesanan') is-invalid @enderror" 
                                               id="nomor_pesanan" name="nomor_pesanan" 
                                               value="{{ old('nomor_pesanan', 'P-' . date('Ymd') . '-' . rand(1000,9999)) }}" 
                                               placeholder="Contoh: P-20231225-001" required>
                                        @error('nomor_pesanan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="warga_id" class="form-label">Pilih Warga <span class="text-danger">*</span></label>
                                        <select class="form-select @error('warga_id') is-invalid @enderror" 
                                                id="warga_id" name="warga_id" required>
                                            <option value="">Pilih Warga</option>
                                            @foreach($warga as $w)
                                                <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} ({{ $w->no_ktp }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ROW 2: Total & Status -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="total" class="form-label">Total Harga (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control @error('total') is-invalid @enderror" 
                                                   id="total" name="total" value="{{ old('total') }}" 
                                                   min="1000" step="100" placeholder="1000" required>
                                        </div>
                                        @error('total')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Minimal Rp 1.000</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status Pesanan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ROW 3: UMKM & Metode Bayar -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="umkm_id" class="form-label">Pilih UMKM (Opsional)</label>
                                        <select class="form-select @error('umkm_id') is-invalid @enderror" 
                                                id="umkm_id" name="umkm_id">
                                            <option value="">-- Pilih UMKM --</option>
                                            @foreach($umkm as $u)
                                                <option value="{{ $u->umkm_id }}" {{ old('umkm_id') == $u->umkm_id ? 'selected' : '' }}>
                                                    {{ $u->nama_usaha }} ({{ $u->pemilik->nama ?? '-' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('umkm_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Kosongkan jika pesanan tidak untuk UMKM tertentu</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="metode_bayar" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-select @error('metode_bayar') is-invalid @enderror" 
                                                id="metode_bayar" name="metode_bayar" required>
                                            <option value="">Pilih Metode</option>
                                            <option value="Transfer Bank" {{ old('metode_bayar') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                            <option value="Tunai" {{ old('metode_bayar') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                            <option value="E-Wallet" {{ old('metode_bayar') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="QRIS" {{ old('metode_bayar') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                        </select>
                                        @error('metode_bayar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat Kirim -->
                            <div class="mb-4">
                                <label for="alamat_kirim" class="form-label">Alamat Kirim <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat_kirim') is-invalid @enderror" 
                                          id="alamat_kirim" name="alamat_kirim" rows="3" 
                                          placeholder="Masukkan alamat lengkap pengiriman (jalan, nomor, kecamatan, kota)..." required>{{ old('alamat_kirim') }}</textarea>
                                @error('alamat_kirim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- RT & RW -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                               id="rt" name="rt" value="{{ old('rt') }}" 
                                               maxlength="3" placeholder="001" required>
                                        @error('rt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                               id="rw" name="rw" value="{{ old('rw') }}" 
                                               maxlength="3" placeholder="002" required>
                                        @error('rw')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                                        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                                  id="catatan" name="catatan" rows="1" 
                                                  placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan') }}</textarea>
                                        @error('catatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Bukti Bayar -->
                            <div class="mb-4">
                                <label for="bukti_bayar" class="form-label">Upload Bukti Pembayaran (Opsional)</label>
                                <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" 
                                       id="bukti_bayar" name="bukti_bayar" 
                                       accept=".jpg,.jpeg,.png,.gif,.pdf">
                                <div class="form-text">
                                    Format yang didukung: JPG, JPEG, PNG, GIF, PDF. Maksimal 2MB.
                                </div>
                                @error('bukti_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Upload -->
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview File:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-save me-2"></i> <span id="submitText">Simpan Pesanan</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-auto">
                                    <i class="fas fa-redo me-2"></i> Reset Form
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
    const form = document.getElementById('pesananForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    // Preview bukti bayar
    document.getElementById('bukti_bayar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        previewImages.innerHTML = '';
        
        if (file) {
            previewContainer.style.display = 'block';
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-6';
                    col.innerHTML = `
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="${e.target.result}" class="img-thumbnail" 
                                     style="width: 100%; height: 200px; object-fit: contain;">
                                <small class="d-block mt-2 text-truncate">${file.name}</small>
                                <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                            </div>
                        </div>
                    `;
                    previewImages.appendChild(col);
                };
                reader.readAsDataURL(file);
            } else {
                const col = document.createElement('div');
                col.className = 'col-md-6';
                col.innerHTML = `
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                            <p class="mb-1">${file.name}</p>
                            <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>
                    </div>
                `;
                previewImages.appendChild(col);
            }
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Validasi form sebelum submit
    form.addEventListener('submit', function(e) {
        const total = document.getElementById('total').value;
        const wargaId = document.getElementById('warga_id').value;
        const metodeBayar = document.getElementById('metode_bayar').value;
        
        if (!wargaId) {
            alert('Pilih Warga terlebih dahulu');
            e.preventDefault();
            return;
        }
        
        if (total < 1000) {
            alert('Total harus minimal Rp 1.000');
            e.preventDefault();
            return;
        }
        
        if (!metodeBayar) {
            alert('Pilih Metode Pembayaran');
            e.preventDefault();
            return;
        }

        // Disable button dan tampilkan loading
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('d-none');
    });

    // Reset form
    form.addEventListener('reset', function() {
        submitBtn.disabled = false;
        submitText.textContent = 'Simpan Pesanan';
        submitSpinner.classList.add('d-none');
        
        // Clear preview
        const previewContainer = document.getElementById('preview-container');
        const previewImages = document.getElementById('preview-images');
        previewImages.innerHTML = '';
        previewContainer.style.display = 'none';
    });
});
</script>

@endsection