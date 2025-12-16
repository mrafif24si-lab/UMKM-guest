@extends('layouts.guest')

@section('title', 'Detail Pesanan #' . $detailPesanan->detail_id)

@section('content')
<div class="container-fluid py-5">
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <!-- Main Card -->
                <div class="card border-0 overflow-hidden" 
                     style="border-radius: 25px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);">
                    
                    <!-- Header -->
                    <div class="card-header py-4 px-4 px-lg-5 position-relative" 
                         style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                              style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                         
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 position-relative">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="icon-wrapper shadow-lg" 
                                         style="background: rgba(255,255,255,0.25); padding: 12px; border-radius: 12px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                                        <i class="fas fa-receipt fa-xl text-white"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-white mb-1" style="font-weight: 800; font-size: 2.2rem; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                            Detail Pesanan #{{ $detailPesanan->detail_id }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-1" 
                                                  style="font-weight: 600; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;">
                                                <i class="fas fa-hashtag me-1"></i>{{ $detailPesanan->pesanan->nomor_pesanan ?? '-' }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-1" 
                                                  style="font-weight: 600; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $detailPesanan->created_at->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('detail-pesanan.index') }}" class="btn btn-light btn-sm px-3 py-2 rounded-3 shadow-lg" 
                                   style="box-shadow: 0 6px 16px rgba(0,0,0,0.15) !important;">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <a href="{{ route('detail-pesanan.edit', $detailPesanan->detail_id) }}" class="btn btn-warning btn-sm px-3 py-2 rounded-3 shadow-lg"
                                   style="background: linear-gradient(135deg, #f6b35c, #f8c471); border: none; box-shadow: 0 6px 16px rgba(246, 179, 92, 0.3) !important;">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <!-- Information Grid -->
                        <div class="row g-4 mb-5">
                            <!-- Pesanan Info -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow" style="border-radius: 15px;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-3">
                                        <div class="icon-circle" style="background: #4e73df; box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);">
                                            <i class="fas fa-file-invoice text-white"></i>
                                        </div>
                                        <h4 class="mb-0" style="color: #4e73df;">Informasi Pesanan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-hashtag me-2 text-primary"></i>Nomor Pesanan:</strong>
                                            <div class="fw-bold fs-5">{{ $detailPesanan->pesanan->nomor_pesanan ?? '-' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-user me-2 text-primary"></i>Pemesan:</strong>
                                            <div>{{ $detailPesanan->pesanan->warga->nama ?? 'Tidak diketahui' }}</div>
                                        </div>
                                        <div class="mb-0">
                                            <strong><i class="fas fa-calendar me-2 text-primary"></i>Tanggal Pesanan:</strong>
                                            <div>{{ $detailPesanan->pesanan->tanggal_pesanan ? \Carbon\Carbon::parse($detailPesanan->pesanan->tanggal_pesanan)->translatedFormat('d F Y') : '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Produk Info -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow" style="border-radius: 15px;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-3">
                                        <div class="icon-circle" style="background: #1cc88a; box-shadow: 0 6px 15px rgba(28, 200, 138, 0.3);">
                                            <i class="fas fa-box text-white"></i>
                                        </div>
                                        <h4 class="mb-0" style="color: #1cc88a;">Informasi Produk</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-cube me-2 text-success"></i>Nama Produk:</strong>
                                            <div class="fw-bold fs-5">{{ $detailPesanan->produk->nama_produk ?? '-' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-store me-2 text-success"></i>UMKM:</strong>
                                            <div>{{ $detailPesanan->produk->umkm->nama_usaha ?? '-' }}</div>
                                        </div>
                                        <div class="mb-0">
                                            <strong><i class="fas fa-tag me-2 text-success"></i>Kategori:</strong>
                                            <div>{{ $detailPesanan->produk->kategori ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Transaksi -->
                            <div class="col-12">
                                <div class="info-card glass-card shadow" style="border-radius: 15px;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle" style="background: #f6c23e; box-shadow: 0 6px 15px rgba(246, 194, 62, 0.3);">
                                            <i class="fas fa-money-bill-wave text-white"></i>
                                        </div>
                                        <h4 class="mb-0" style="color: #f6c23e;">Detail Transaksi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 text-center mb-3">
                                                <div class="p-3 bg-light rounded-3 shadow-sm">
                                                    <div class="fw-bold text-primary mb-1">Qty</div>
                                                    <div class="fs-3 fw-bold">{{ $detailPesanan->qty }}</div>
                                                    <small class="text-muted">Unit</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-center mb-3">
                                                <div class="p-3 bg-light rounded-3 shadow-sm">
                                                    <div class="fw-bold text-success mb-1">Harga Satuan</div>
                                                    <div class="fs-3 fw-bold">{{ $detailPesanan->harga_satuan_formatted }}</div>
                                                    <small class="text-muted">Per unit</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center mb-3">
                                                <div class="p-3 bg-success bg-opacity-10 rounded-3 shadow-sm">
                                                    <div class="fw-bold text-success mb-1">Subtotal</div>
                                                    <div class="fs-3 fw-bold">{{ $detailPesanan->subtotal_formatted }}</div>
                                                    <small class="text-success">Qty × Harga Satuan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-section mt-5 pt-4 border-top">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('detail-pesanan.edit', $detailPesanan->detail_id) }}" 
                                       class="btn btn-warning px-4 py-2 rounded-3 shadow"
                                       style="background: linear-gradient(135deg, #f6b35c, #f8c471); border: none; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.3) !important;">
                                        <i class="fas fa-edit me-2"></i> Edit Detail
                                    </a>
                                    <a href="{{ route('detail-pesanan.index') }}" 
                                       class="btn btn-secondary px-4 py-2 rounded-3 shadow"
                                       style="box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3) !important;">
                                        <i class="fas fa-list me-2"></i> Semua Detail
                                    </a>
                                </div>
                                
                                <form action="{{ route('detail-pesanan.destroy', $detailPesanan->detail_id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 shadow"
                                            style="box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3) !important;" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Detail
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-card {
    background: white;
    border: 1px solid rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

.icon-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.glass-card {
    background: white;
    backdrop-filter: blur(10px);
}

@media (max-width: 768px) {
    .card-header h1 {
        font-size: 1.8rem !important;
    }
    
    .icon-wrapper {
        padding: 10px !important;
    }
    
    .info-card {
        margin-bottom: 20px;
    }
    
    .action-section .d-flex {
        flex-direction: column !important;
        width: 100%;
    }
    
    .action-section .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus detail pesanan ini?\\n\\nTindakan ini akan mengubah total pesanan terkait!');
}
</script>
@endsection