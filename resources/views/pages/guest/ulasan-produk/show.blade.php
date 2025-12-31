@extends('layouts.guest.app')

@section('title', 'Detail Ulasan Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Detail Ulasan Produk</h1>
        <p class="text-white lead">Detail lengkap ulasan produk</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0 overflow-hidden">
                    <!-- HEADER -->
                    <div class="card-header text-white py-4" 
                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 70px; height: 70px; background: rgba(255,255,255,0.2);">
                                        <i class="fas fa-star fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-white mb-1" style="font-weight: 700;">Detail Ulasan Produk</h2>
                                        <small class="opacity-75">ID: #{{ $ulasanProduk->ulasan_id }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('ulasan-produk.index') }}" class="btn btn-light btn-sm px-3 py-2">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <a href="{{ route('ulasan-produk.edit', $ulasanProduk->ulasan_id) }}" 
                                   class="btn btn-warning btn-sm px-3 py-2">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <!-- Info Warga -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header text-white py-3" 
                                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Info Warga</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(var(--secondary-rgb), 0.1) 100%);">
                                                <i class="fas fa-user fa-lg text-primary"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $ulasanProduk->warga->nama ?? '-' }}</h4>
                                                <p class="text-muted mb-0">{{ $ulasanProduk->warga->email ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%" class="text-muted">ID Warga</th>
                                                    <td>{{ $ulasanProduk->warga->warga_id ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Telepon</th>
                                                    <td>{{ $ulasanProduk->warga->telepon ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Alamat</th>
                                                    <td>{{ $ulasanProduk->warga->alamat ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Produk -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header text-white py-3" 
                                         style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                        <h5 class="mb-0"><i class="fas fa-box-open me-2"></i>Info Produk</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);">
                                                <i class="fas fa-box fa-lg text-success"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $ulasanProduk->produk->nama_produk ?? '-' }}</h4>
                                                <p class="text-muted mb-0">{{ $ulasanProduk->produk->umkm->nama_usaha ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%" class="text-muted">Jenis Produk</th>
                                                    <td>{{ $ulasanProduk->produk->jenis_produk ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Harga Produk</th>
                                                    <td>{{ 'Rp ' . number_format($ulasanProduk->produk->harga ?? 0, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Stok Produk</th>
                                                    <td>{{ $ulasanProduk->produk->stok ?? '0' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Status Produk</th>
                                                    <td>
                                                        <span class="badge rounded-pill bg-{{ $ulasanProduk->produk->status == 'aktif' ? 'success' : 'secondary' }}">
                                                            {{ ucfirst($ulasanProduk->produk->status ?? '-') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating & Komentar -->
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header text-white py-3" 
                                         style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Ulasan & Rating</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Rating Section -->
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <h6 class="mb-3 text-dark">Rating:</h6>
                                                <div class="text-center p-4 rounded" 
                                                     style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);">
                                                    <div class="rating-stars mb-3" style="font-size: 2.5rem;">
                                                        {!! $ulasanProduk->rating_bintang !!}
                                                    </div>
                                                    <h2 class="text-warning mb-2">{{ $ulasanProduk->rating }}/5</h2>
                                                    @php
                                                        $descriptions = [
                                                            1 => 'Sangat Buruk',
                                                            2 => 'Buruk',
                                                            3 => 'Cukup',
                                                            4 => 'Baik',
                                                            5 => 'Sangat Baik'
                                                        ];
                                                    @endphp
                                                    <p class="text-dark fw-bold mb-0">
                                                        {{ $descriptions[$ulasanProduk->rating] ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6 class="mb-3 text-dark">Komentar:</h6>
                                                @if($ulasanProduk->komentar)
                                                    <div class="p-4 rounded" 
                                                         style="background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(19, 132, 150, 0.1) 100%); height: 100%;">
                                                        <p class="mb-0">{{ $ulasanProduk->komentar }}</p>
                                                    </div>
                                                @else
                                                    <div class="p-4 rounded text-center" 
                                                         style="background: linear-gradient(135deg, rgba(108, 117, 125, 0.1) 0%, rgba(73, 80, 87, 0.1) 100%); height: 100%;">
                                                        <p class="text-muted mb-0"><i>Tidak ada komentar</i></p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header text-white py-3" 
                                         style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Informasi Waktu</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                         style="width: 50px; height: 50px; background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(19, 132, 150, 0.1) 100%);">
                                                        <i class="far fa-calendar-plus text-info"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-1 text-muted"><strong>Dibuat:</strong></p>
                                                        <p class="mb-0 text-dark">
                                                            {{ $ulasanProduk->created_at->translatedFormat('l, d F Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                         style="width: 50px; height: 50px; background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);">
                                                        <i class="far fa-calendar-check text-success"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-1 text-muted"><strong>Diperbarui:</strong></p>
                                                        <p class="mb-0 text-dark">
                                                            {{ $ulasanProduk->updated_at->translatedFormat('l, d F Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-3 mt-5 pt-4 border-top">
                            <a href="{{ route('ulasan-produk.edit', $ulasanProduk->ulasan_id) }}" 
                               class="btn btn-warning px-4 py-2"
                               style="background: linear-gradient(135deg, var(--primary) 0%, #e0a800 100%); border: none; color: #000;">
                                <i class="fas fa-edit me-2"></i> Edit Ulasan
                            </a>
                            <a href="{{ route('ulasan-produk.index') }}" 
                               class="btn btn-secondary px-4 py-2">
                                <i class="fas fa-list me-2"></i> Lihat Semua
                            </a>
                            <form action="{{ route('ulasan-produk.destroy', $ulasanProduk->ulasan_id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger px-4 py-2"
                                        style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border: none;"
                                        onclick="return confirm('Yakin menghapus ulasan ini?')">
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