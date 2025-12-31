@extends('layouts.guest.app')

@section('title', 'Detail Item Pesanan')

@section('content')
<div class="container-fluid py-5">
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 overflow-hidden" 
                     style="border-radius: 25px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);">
                    
                    <!-- HEADER -->
                    <div class="card-header py-4 px-5 position-relative" 
                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                             style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                         
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 position-relative">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-wrapper" 
                                         style="background: rgba(255,255,255,0.25); padding: 12px; border-radius: 12px; backdrop-filter: blur(10px);">
                                        <i class="fas fa-box fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-white mb-1" style="font-weight: 800; font-size: 2rem;">
                                            Detail Item Pesanan
                                        </h1>
                                        <small class="text-white opacity-75">ID: {{ $detailPesanan->detail_id }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('detail-pesanan.index') }}" class="btn btn-light btn-sm px-3 py-2 rounded-4">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <a href="{{ route('detail-pesanan.edit', $detailPesanan->detail_id) }}" class="btn btn-warning btn-sm px-3 py-2 rounded-4">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BODY -->
                    <div class="card-body p-5">
                        <div class="row">
                            <!-- Info Pesanan -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Info Pesanan</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Nomor Pesanan</th>
                                                <td>#{{ $detailPesanan->pesanan->nomor_pesanan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pemesan</th>
                                                <td>{{ $detailPesanan->pesanan->warga->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pesanan</th>
                                                <td>{{ $detailPesanan->pesanan->created_at->translatedFormat('d F Y H:i') ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pesanan</th>
                                                <td>
                                                    <span class="badge bg-{{ $detailPesanan->pesanan->status_color ?? 'secondary' }}">
                                                        {{ ucfirst($detailPesanan->pesanan->status ?? '-') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Produk -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="fas fa-box-open me-2"></i>Info Produk</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Nama Produk</th>
                                                <td>{{ $detailPesanan->produk->nama_produk ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga Produk</th>
                                                <td>{{ $detailPesanan->produk->harga_formatted ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Stok Produk</th>
                                                <td>{{ $detailPesanan->produk->stok ?? '0' }}</td>
                                            </tr>
                                            <tr>
                                                <th>UMKM</th>
                                                <td>{{ $detailPesanan->produk->umkm->nama_usaha ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Transaksi -->
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Detail Transaksi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 bg-light rounded">
                                                    <h6 class="text-muted mb-2">Jumlah (Qty)</h6>
                                                    <h2 class="text-primary">{{ $detailPesanan->qty }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 bg-light rounded">
                                                    <h6 class="text-muted mb-2">Harga Satuan</h6>
                                                    <h3 class="text-success">{{ $detailPesanan->harga_satuan_formatted }}</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 bg-light rounded">
                                                    <h6 class="text-muted mb-2">Subtotal</h6>
                                                    <h2 class="text-danger">{{ $detailPesanan->subtotal_formatted }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Perhitungan -->
                                        <div class="mt-4 p-3 bg-light rounded">
                                            <h6 class="mb-3">Rincian Perhitungan:</h6>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Harga Satuan</span>
                                                <span>{{ $detailPesanan->harga_satuan_formatted }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Jumlah (Qty)</span>
                                                <span>{{ $detailPesanan->qty }} ×</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <strong>Subtotal</strong>
                                                <strong>{{ $detailPesanan->subtotal_formatted }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="col-12 mt-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Informasi Waktu</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><i class="far fa-calendar-plus me-2 text-primary"></i> 
                                                   <strong>Dibuat:</strong> {{ $detailPesanan->created_at->translatedFormat('l, d F Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><i class="far fa-calendar-check me-2 text-success"></i> 
                                                   <strong>Diperbarui:</strong> {{ $detailPesanan->updated_at->translatedFormat('l, d F Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-3 mt-5 pt-4 border-top">
                            <a href="{{ route('detail-pesanan.edit', $detailPesanan->detail_id) }}" 
                               class="btn btn-warning px-4 py-2">
                                <i class="fas fa-edit me-2"></i> Edit Detail
                            </a>
                            <a href="{{ route('detail-pesanan.index') }}" 
                               class="btn btn-secondary px-4 py-2">
                                <i class="fas fa-list me-2"></i> Lihat Semua
                            </a>
                            <form action="{{ route('detail-pesanan.destroy', $detailPesanan->detail_id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger px-4 py-2"
                                        onclick="return confirm('Yakin menghapus detail pesanan ini?')">
                                    <i class="fas fa-trash-alt me-2"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endsection