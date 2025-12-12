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
                                               min="0" step="100" required>
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

                            <div class="mb-4">
                                <label for="bukti_bayar" class="form-label">Upload Bukti Bayar Baru (Opsional)</label>
                                <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" 
                                       id="bukti_bayar" name="bukti_bayar" 
                                       accept=".jpg,.jpeg,.png,.gif">
                                <div class="form-text">
                                    Kosongkan jika tidak ingin mengubah bukti bayar.
                                </div>
                                @error('bukti_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Preview Upload Baru --}}
                            <div class="mb-4" id="preview-container" style="display: none;">
                                <label class="form-label">Preview Bukti Bayar Baru:</label>
                                <div class="row" id="preview-images"></div>
                            </div>

                            {{-- LIST BUKTI BAYAR LAMA --}}
                            @if($pesanan->media->count() > 0)
                            <div class="mb-4">
                                <label class="form-label">Bukti Bayar Saat Ini</label>
                                <div class="row">
                                    @foreach($pesanan->media as $media)
                                    <div class="col-md-4 mb-3">
                                        <div class="card file-card h-100">
                                            <div class="card-body text-center p-2">
                                                @if(Str::startsWith($media->mime_type, 'image/'))
                                                    <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                         class="img-thumbnail mb-2" 
                                                         style="height: 150px; width: 100%; object-fit: cover;" 
                                                         alt="{{ $media->caption }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center" style="height: 150px;">
                                                        <i class="fas fa-file fa-2x text-secondary"></i>
                                                    </div>
                                                @endif
                                                <p class="small mb-1 text-truncate" title="{{ $media->caption }}">
                                                    {{ Str::limit($media->caption, 20) }}
                                                </p>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm w-100" 
                                                        onclick="confirmDeleteMedia('{{ route('pesanan.delete-media', $media->media_id) }}')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
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

{{-- Hidden form untuk delete media --}}
<form id="deleteMediaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Preview gambar baru sebelum upload
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
                col.className = 'col-md-4';
                col.innerHTML = `
                    <div class="preview-card">
                        <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                        <small class="d-block mt-1 text-truncate">${file.name}</small>
                    </div>
                `;
                previewImages.appendChild(col);
            };
            reader.readAsDataURL(file);
        }
    } else {
        previewContainer.style.display = 'none';
    }
});

// Delete media confirmation
function confirmDeleteMedia(url) {
    if (confirm('Apakah Anda yakin ingin menghapus bukti bayar ini?')) {
        var form = document.getElementById('deleteMediaForm');
        form.action = url;
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
    padding: 10px;
    background: white;
}

.preview-card img {
    border-radius: 3px;
}
</style>
@endsection