@extends('layouts.guest')

{{-- Menggunakan pesanan_id karena nomor_pesanan tidak ada di DB --}}
@section('title', 'Pesanan #' . $pesanan->pesanan_id)

@section('content')
<div class="container-fluid py-5">
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-11 col-xl-10 mx-auto">
                <div class="card border-0 overflow-hidden" 
                     style="border-radius: 30px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15), 0 15px 30px rgba(0, 0, 0, 0.1);">
                    
                    <div class="card-header py-5 px-4 px-lg-5 position-relative" 
                         style="background: linear-gradient(135deg, #6f42c1 0%, #17a2b8 100%);">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                             style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                         
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 position-relative">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-wrapper shadow-lg" 
                                         style="background: rgba(255,255,255,0.25); padding: 15px; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                                        <i class="fas fa-receipt fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-white mb-2" style="font-weight: 900; font-size: 2.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                            {{-- PERBAIKAN: Gunakan pesanan_id --}}
                                            Order #{{ $pesanan->pesanan_id }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;">
                                                {{-- PERBAIKAN: Gunakan relasi pelanggan --}}
                                                <i class="fas fa-user me-2"></i>{{ $pesanan->pelanggan->name ?? 'User Terhapus' }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;">
                                                <i class="fas fa-calendar me-2"></i>
                                                {{ \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('pesanan.index') }}" class="btn btn-light btn-lg px-4 py-3 rounded-4 shadow-lg" 
                                   style="box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <a href="{{ route('pesanan.edit', $pesanan->pesanan_id) }}" class="btn btn-warning btn-lg px-4 py-3 rounded-4 shadow-lg"
                                   style="background: linear-gradient(135deg, #ffc107, #fd7e14); border: none; box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4) !important;">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <div class="row g-4 mb-5">
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-right">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #6f42c1;">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Detail Transaksi</h3>
                                    </div>
                                    <div class="card-body">
                                        {{-- PERBAIKAN: Menambah Info Produk --}}
                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-box text-primary me-2"></i>
                                            <span class="fw-bold">Produk: </span>
                                            <span>{{ $pesanan->produk->nama_produk ?? 'Produk dihapus' }} ({{ $pesanan->jumlah }} Pcs)</span>
                                        </div>

                                        {{-- PERBAIKAN: total -> total_harga --}}
                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                            <span class="fw-bold">Total Harga: </span>
                                            <span class="font-monospace fs-4 text-success">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-truck text-primary me-2"></i>
                                            <span class="fw-bold">Status Pesanan: </span>
                                            <span class="badge {{ $pesanan->status == 'selesai' ? 'bg-success' : ($pesanan->status == 'dibatalkan' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ ucfirst($pesanan->status) }}
                                            </span>
                                        </div>

                                        {{-- PERBAIKAN: metode_bayar -> metode_pembayaran --}}
                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-credit-card text-primary me-2"></i>
                                            <span class="fw-bold">Metode Pembayaran: </span>
                                            <span>{{ $pesanan->metode_pembayaran }}</span>
                                        </div>

                                        {{-- PERBAIKAN: Menambah No Resi --}}
                                        @if($pesanan->no_resi)
                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-barcode text-primary me-2"></i>
                                            <span class="fw-bold">No. Resi: </span>
                                            <span class="font-monospace">{{ $pesanan->no_resi }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-left">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #17a2b8;">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Info Pelanggan & UMKM</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="avatar-placeholder shadow-lg" style="background: #ffc107;">
                                                <i class="fas fa-user fa-2x text-white"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $pesanan->pelanggan->name ?? 'User tidak ditemukan' }}</h4>
                                                <small class="text-muted">Pelanggan</small>
                                            </div>
                                        </div>

                                        <div class="detail-item mt-3 p-3 shadow-sm">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <span class="fw-bold">Email: </span>
                                            <span>{{ $pesanan->pelanggan->email ?? '-' }}</span>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="avatar-placeholder shadow-lg" style="background: #28a745;">
                                                <i class="fas fa-store fa-2x text-white"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $pesanan->umkm->nama_umkm ?? 'UMKM tidak ditemukan' }}</h4>
                                                <small class="text-muted">Penjual</small>
                                            </div>
                                        </div>
                                        
                                        @if($pesanan->catatan)
                                        <div class="detail-item mt-3 p-3 shadow-sm bg-light">
                                            <i class="fas fa-sticky-note text-warning me-2"></i>
                                            <span class="fw-bold">Catatan Pesanan: </span>
                                            <p class="mb-0 mt-1 fst-italic">"{{ $pesanan->catatan }}"</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PERBAIKAN: Menggunakan bukti_pembayaran single file --}}
                        @if($pesanan->bukti_pembayaran)
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-image me-3"></i>Bukti Pembayaran
                                </h2>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="gallery-item position-relative shadow-lg text-center bg-white p-3">
                                        {{-- Pastikan path storage sesuai dengan Controller --}}
                                        <img src="{{ asset('storage/bukti_bayar/' . $pesanan->bukti_pembayaran) }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 500px; object-fit: contain;"
                                             alt="Bukti Pembayaran"
                                             onerror="this.onerror=null; this.src='https://via.placeholder.com/500x300?text=Gambar+Tidak+Ditemukan'">
                                        
                                        <div class="mt-2 text-muted small">
                                            Klik kanan "Open Image in New Tab" untuk memperbesar
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-secondary text-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> Belum ada bukti pembayaran yang diupload.
                        </div>
                        @endif

                        <div class="action-section mt-5 pt-5 border-top" data-aos="fade-up">
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
                                <form action="{{ route('pesanan.destroy', $pesanan->pesanan_id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-5 py-3 rounded-4 shadow-lg" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Pesanan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white py-4 text-center shadow-lg">
                        <div class="footer-info">
                            <p class="mb-0 text-muted">
                                <i class="fas fa-history me-2 text-primary"></i>
                                Dibuat: {{ $pesanan->created_at->translatedFormat('d F Y H:i') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-sync-alt me-2 text-secondary"></i>
                                Terakhir diperbarui: {{ $pesanan->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #6f42c1, #17a2b8);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 30px;
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.detail-item {
    background: white;
    padding: 15px;
    border-radius: 12px;
    border-left: 4px solid #6f42c1;
}

.gallery-item {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
}
</style>

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus pesanan #{{ $pesanan->pesanan_id }}?\n\nTindakan ini tidak dapat dibatalkan!');
}
</script>
@endsection