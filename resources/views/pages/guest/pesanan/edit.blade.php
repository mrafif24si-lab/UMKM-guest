@extends('layouts.guest')

@section('title', 'Edit Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit Pesanan</h1>
        <p class="text-white lead">Form edit data pesanan</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-4">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Pesanan - {{ $pesanan->nomor_pesanan }}</h5>
                    </div>
                    <div class="card-body p-5">

                        {{-- Tampilkan Error Validasi --}}
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

                        {{-- Tampilkan Pesan Sukses/Gagal Session --}}
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

                        {{-- Form Update --}}
                        <form action="{{ route('pesanan.update', $pesanan->pesanan_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nomor_pesanan" class="form-label">Nomor Pesanan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nomor_pesanan') is-invalid @enderror"
                                               id="nomor_pesanan" name="nomor_pesanan"
                                               value="{{ old('nomor_pesanan', $pesanan->nomor_pesanan) }}" required>
                                        @error('nomor_pesanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="warga_id" class="form-label">Pilih Warga <span class="text-danger">*</span></label>
                                        <select class="form-select @error('warga_id') is-invalid @enderror"
                                                id="warga_id" name="warga_id" required>
                                            <option value="">-- Pilih Warga --</option>
                                            @foreach($warga as $w)
                                                <option value="{{ $w->warga_id }}" {{ old('warga_id', $pesanan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} - {{ $w->no_ktp }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="total" class="form-label">Total Harga (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('total') is-invalid @enderror"
                                               id="total" name="total"
                                               value="{{ old('total', $pesanan->total) }}"
                                               min="1000" step="100" required>
                                        @error('total') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status Pesanan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                            <option value="pending" {{ old('status', $pesanan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ old('status', $pesanan->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="dikirim" {{ old('status', $pesanan->status) == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ old('status', $pesanan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ old('status', $pesanan->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat_kirim" class="form-label">Alamat Kirim <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat_kirim') is-invalid @enderror"
                                          id="alamat_kirim" name="alamat_kirim" rows="3" required>{{ old('alamat_kirim', $pesanan->alamat_kirim) }}</textarea>
                                @error('alamat_kirim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                               id="rt" name="rt"
                                               value="{{ old('rt', $pesanan->rt) }}"
                                               maxlength="3" required>
                                        @error('rt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                               id="rw" name="rw"
                                               value="{{ old('rw', $pesanan->rw) }}"
                                               maxlength="3" required>
                                        @error('rw') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="metode_bayar" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-select @error('metode_bayar') is-invalid @enderror"
                                                id="metode_bayar" name="metode_bayar" required>
                                            <option value="Transfer Bank" {{ old('metode_bayar', $pesanan->metode_bayar) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                            <option value="Tunai" {{ old('metode_bayar', $pesanan->metode_bayar) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                            <option value="E-Wallet" {{ old('metode_bayar', $pesanan->metode_bayar) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="QRIS" {{ old('metode_bayar', $pesanan->metode_bayar) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                        </select>
                                        @error('metode_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION UPLOAD FILE --}}
                            <div class="mb-4">
                                <label for="bukti_bayar" class="form-label">Upload Bukti Bayar Baru (Opsional)</label>
                                <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror"
                                       id="bukti_bayar" name="bukti_bayar"
                                       accept=".jpg,.jpeg,.png,.gif,.pdf">
                                <div class="form-text">
                                    Format: JPG, JPEG, PNG, GIF, PDF. Maksimal 2MB.
                                </div>
                                @error('bukti_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PREVIEW UPLOAD BARU --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview File Baru:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            {{-- TAMPILKAN FILE LAMA --}}
                            @if($pesanan->bukti_bayar)
                            <div class="mb-4">
                                <label class="form-label">Bukti Bayar Saat Ini</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card file-card h-100">
                                            <div class="card-body text-center p-2">
                                                @if(in_array(pathinfo($pesanan->bukti_bayar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                                                         class="img-thumbnail mb-2"
                                                         style="height: 200px; width: 100%; object-fit: contain;"
                                                         alt="Bukti Bayar {{ $pesanan->nomor_pesanan }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    </div>
                                                @endif
                                                <p class="small mb-1 text-truncate">{{ $pesanan->nomor_pesanan }}</p>
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                                                       target="_blank"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Lihat File
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-secondary text-center mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i> Belum ada bukti bayar yang diupload.
                            </div>
                            @endif

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-save me-2"></i> Update Data
                                </button>
                                <a href="{{ route('pesanan.show', $pesanan->pesanan_id) }}" class="btn btn-info btn-lg">
                                    <i class="fas fa-eye me-2"></i> Lihat Detail
                                </a>
                                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-lg">
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

<script>
// Preview file baru
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
                            <small class="d-block mt-2">${file.name}</small>
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
</script>

<style>
.file-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn {
    transition: all 0.3s ease !important;
}

.btn:hover {
    transform: translateY(-2px) !important;
}
</style>
@endsection