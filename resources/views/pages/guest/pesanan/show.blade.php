@extends('layouts.guest.app')

@section('title', 'Pesanan #' . $pesanan->nomor_pesanan)

@section('content')
<div class="container-fluid py-5">
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-11 col-xl-10 mx-auto">
                <div class="card border-0 overflow-hidden" 
                     style="border-radius: 30px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15), 0 15px 30px rgba(0, 0, 0, 0.1);">
                    
                    <!-- HEADER - Ganti warna gradient sesuai UMKM -->
                    <div class="card-header py-5 px-4 px-lg-5 position-relative" 
                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
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
                                            Order #{{ $pesanan->nomor_pesanan }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;">
                                                <i class="fas fa-user me-2"></i>{{ $pesanan->warga->nama ?? 'Pelanggan' }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;">
                                                <i class="fas fa-calendar me-2"></i>
                                                {{ $pesanan->created_at->translatedFormat('d F Y') }}
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
                                   style="background: linear-gradient(135deg, var(--primary), #F8C471); border: none; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BODY -->
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        
                        <!-- INFO GRID -->
                        <div class="row g-4 mb-5">
                            <!-- DETAIL TRANSAKSI -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-right">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <!-- Ganti warna icon circle -->
                                        <div class="icon-circle shadow-lg" style="background: var(--primary); box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Detail Transaksi</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- TOTAL HARGA -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--primary); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                            <span class="fw-bold">Total Harga: </span>
                                            <span class="font-monospace fs-4 text-success">{{ $pesanan->total_formatted }}</span>
                                        </div>

                                        <!-- STATUS PESANAN -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--secondary); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-truck text-primary me-2"></i>
                                            <span class="fw-bold">Status Pesanan: </span>
                                            <span class="badge bg-{{ $pesanan->status_color }}">
                                                {{ ucfirst($pesanan->status) }}
                                            </span>
                                        </div>

                                        <!-- METODE BAYAR -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--yellow); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-credit-card text-primary me-2"></i>
                                            <span class="fw-bold">Metode Pembayaran: </span>
                                            <span>{{ $pesanan->metode_bayar }}</span>
                                        </div>

                                        <!-- TANGGAL DIBUAT -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--accent); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-clock text-primary me-2"></i>
                                            <span class="fw-bold">Tanggal Pesanan: </span>
                                            <span>{{ $pesanan->created_at->translatedFormat('l, d F Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INFO PELANGGAN & PENGIRIMAN -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-left">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <!-- Ganti warna icon circle -->
                                        <div class="icon-circle shadow-lg" style="background: var(--secondary); box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Info Pelanggan & Pengiriman</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- INFO PELANGGAN -->
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <!-- Ganti warna avatar -->
                                            <div class="avatar-placeholder shadow-lg" style="background: var(--yellow); box-shadow: 0 8px 20px rgba(241, 209, 102, 0.4) !important;">
                                                <i class="fas fa-user fa-2x text-white"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $pesanan->warga->nama ?? 'Pelanggan' }}</h4>
                                                <small class="text-muted">Pelanggan</small>
                                            </div>
                                        </div>

                                        <!-- ALAMAT PENGIRIMAN -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--primary); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <span class="fw-bold">Alamat Kirim: </span>
                                            <span>{{ $pesanan->alamat_kirim }}</span>
                                        </div>

                                        <!-- RT/RW -->
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--secondary); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-map-pin text-primary me-2"></i>
                                            <span class="fw-bold">RT/RW: </span>
                                            <span>{{ $pesanan->rt }}/{{ $pesanan->rw }}</span>
                                        </div>

                                        <!-- KONTAK PELANGGAN -->
                                        @if($pesanan->warga && $pesanan->warga->telp)
                                        <div class="detail-item mt-3 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--accent); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <span class="fw-bold">Kontak: </span>
                                            <span>{{ $pesanan->warga->telp }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BUKTI PEMBAYARAN SECTION -->
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-image me-3"></i>Bukti Pembayaran
                                </h2>
                                <p class="text-muted">Dokumen dan gambar bukti pembayaran</p>
                            </div>
                            
                            @if($pesanan->has_bukti_bayar)
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="gallery-item position-relative shadow-lg text-center bg-white p-3" 
                                             style="border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;">
                                            <img src="{{ asset('storage/' . $pesanan->bukti_bayar) }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 500px; object-fit: contain;"
                                                 alt="Bukti Pembayaran {{ $pesanan->nomor_pesanan }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                            
                                            <div class="mt-3">
                                                <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}" 
                                                   target="_blank" 
                                                   class="btn btn-primary btn-sm me-2 rounded-4"
                                                   style="box-shadow: 0 4px 12px rgba(17, 138, 178, 0.3) !important;">
                                                    <i class="fas fa-expand me-1"></i> Lihat Full Size
                                                </a>
                                                <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}" 
                                                   download 
                                                   class="btn btn-success btn-sm rounded-4"
                                                   style="box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3) !important;">
                                                    <i class="fas fa-download me-1"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state text-center py-5 shadow-lg" 
                                     style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;">
                                    <div class="empty-icon mb-4">
                                        <img src="{{ asset('images/placeholder.png') }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 150px; width: auto;"
                                             alt="Belum ada bukti pembayaran">
                                    </div>
                                    <h4 class="text-muted mb-3">Belum ada Bukti Pembayaran</h4>
                                    <p class="text-muted mb-4">Belum ada bukti pembayaran yang diupload</p>
                                    <a href="{{ route('pesanan.edit', $pesanan->pesanan_id) }}" class="btn btn-primary btn-lg px-4 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                        <i class="fas fa-upload me-2"></i> Upload Bukti Bayar
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="action-section mt-5 pt-5 border-top" data-aos="fade-up">
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
                                <div class="btn-group-vertical btn-group-lg gap-3">
                                    <a href="{{ route('pesanan.edit', $pesanan->pesanan_id) }}" 
                                       class="btn btn-warning px-5 py-3 rounded-4 shadow-lg"
                                       style="background: linear-gradient(135deg, var(--primary), #F8C471); border: none; box-shadow: 0 12px 25px rgba(246, 179, 92, 0.4) !important;">
                                        <i class="fas fa-edit me-2"></i> Edit Pesanan
                                    </a>
                                    <a href="{{ route('pesanan.index') }}" 
                                       class="btn btn-secondary px-5 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 12px 25px rgba(108, 117, 125, 0.4) !important;">
                                        <i class="fas fa-list me-2"></i> Lihat Semua Pesanan
                                    </a>
                                </div>
                                
                                <form action="{{ route('pesanan.destroy', $pesanan->pesanan_id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-5 py-3 rounded-4 shadow-lg"
                                            style="box-shadow: 0 12px 25px rgba(220, 53, 69, 0.4) !important;" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Pesanan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- FOOTER -->
                    <div class="card-footer bg-white py-4 text-center shadow-lg"
                         style="box-shadow: 0 -5px 20px rgba(0,0,0,0.05) !important;">
                        <div class="footer-info">
                            <p class="mb-0 text-muted">
                                <i class="fas fa-shield-alt me-2 text-primary"></i>
                                Data pesanan terlindungi
                                <span class="mx-2">•</span>
                                <i class="far fa-clock me-2 text-secondary"></i>
                                Terakhir diperbarui: {{ $pesanan->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus pesanan #{{ $pesanan->nomor_pesanan }}?\n\nTindakan ini tidak dapat dibatalkan!');
}

// Add animation to cards - SAMA DENGAN UMKM
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.info-card, .gallery-item');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});

// Add hover effects dynamically - SAMA DENGAN UMKM
document.querySelectorAll('.info-card, .gallery-item, .btn').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
    });
});
</script>
@endsection