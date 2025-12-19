@extends('layouts.guest')

@section('title', 'Data Detail Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Detail Pesanan</h1>
        <p class="text-white lead">Kelola semua detail item pesanan</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-list-alt me-2"></i>Daftar Detail Pesanan</h3>
            <a href="{{ route('detail-pesanan.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Detail
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('detail-pesanan.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-5">
                            <label for="search" class="form-label fw-bold">Cari Detail Pesanan:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nomor pesanan, produk, UMKM..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                                   class="btn btn-outline-secondary" title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label fw-bold">Filter Tanggal:</label>
                            <select name="tanggal" id="tanggal" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Tanggal</option>
                                <option value="hari_ini" {{ request('tanggal') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu_ini" {{ request('tanggal') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan_ini" {{ request('tanggal') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="tahun_ini" {{ request('tanggal') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 d-flex align-items-end">
                            <a href="{{ route('detail-pesanan.index') }}" class="btn btn-secondary w-100 mt-2">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($detailPesanan->count() > 0)
        <div class="row">
            @foreach($detailPesanan as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 detail-card-header">
                        <div class="text-center mb-2">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light border border-3 border-white" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-box fa-2x text-secondary"></i>
                            </div>
                        </div>
                        <h5 class="mb-0 text-center">#{{ $item->pesanan->nomor_pesanan ?? '-' }}</h5>
                        <small class="opacity-75 d-block text-center">{{ $item->pesanan->warga->nama ?? 'Pelanggan' }}</small>
                    </div>
                    <div class="card-body">
                        <!-- Info Produk -->
                        <div class="mb-3">
                            <h6 class="card-title text-primary mb-2">
                                <i class="fas fa-box-open me-2"></i>{{ $item->produk->nama_produk ?? '-' }}
                            </h6>
                            <p class="card-text mb-1">
                                <i class="fas fa-store me-2 text-muted"></i>
                                <small class="text-muted">{{ $item->produk->umkm->nama_usaha ?? '-' }}</small>
                            </p>
                            <p class="card-text mb-1">
                                <i class="fas fa-tag me-2 text-muted"></i>
                                <small class="text-muted">{{ $item->produk->jenis_produk ?? '-' }}</small>
                            </p>
                        </div>

                        <!-- Detail Transaksi -->
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1">
                                        <i class="fas fa-hashtag me-1 text-primary"></i>
                                        <strong>Qty:</strong>
                                    </p>
                                    <h4 class="text-primary mb-0">{{ $item->qty }}</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="mb-1">
                                        <i class="fas fa-money-bill-wave me-1 text-success"></i>
                                        <strong>Subtotal:</strong>
                                    </p>
                                    <h4 class="text-success mb-0">{{ $item->subtotal_formatted }}</h4>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                <p class="mb-1">
                                    <i class="fas fa-dollar-sign me-1 text-info"></i>
                                    <strong>Harga Satuan:</strong>
                                    <span class="float-end">{{ $item->harga_satuan_formatted }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="mt-3 pt-3 border-top">
                            <p class="mb-0 text-center text-muted">
                                <i class="far fa-calendar me-1"></i>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </p>
                            <p class="mb-0 text-center text-muted">
                                <i class="far fa-clock me-1"></i>
                                {{ $item->created_at->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 pt-3">
                        <div class="action-buttons d-flex justify-content-between align-items-center">
                            <!-- Tombol Detail -->
                            <a href="{{ route('detail-pesanan.show', $item->detail_id) }}" 
                               class="btn btn-info btn-sm text-white" 
                               title="Detail">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <div class="d-flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('detail-pesanan.edit', $item->detail_id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('detail-pesanan.destroy', $item->detail_id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            title="Hapus" 
                                            onclick="return confirm('Yakin menghapus detail pesanan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Horizontal -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{ $detailPesanan->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <!-- Summary -->
        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            Total: <strong>{{ $detailPesanan->total() }}</strong> item detail pesanan
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('tanggal'))
                                | Filter: <strong>
                                    @if(request('tanggal') == 'hari_ini') Hari Ini
                                    @elseif(request('tanggal') == 'minggu_ini') Minggu Ini
                                    @elseif(request('tanggal') == 'bulan_ini') Bulan Ini
                                    @elseif(request('tanggal') == 'tahun_ini') Tahun Ini
                                    @endif
                                </strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-primary mb-1">Total Item</h5>
                                    <h3 class="mb-0">{{ $detailPesanan->total() }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-success mb-1">Total Qty</h5>
                                    <h3 class="mb-0">{{ $detailPesanan->sum('qty') }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-danger mb-1">Total Nilai</h5>
                                    <h3 class="mb-0">Rp {{ number_format($detailPesanan->sum('subtotal'), 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <i class="fas fa-list-alt fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">
                @if(request('search') || request('tanggal'))
                    Tidak ada detail pesanan ditemukan
                @else
                    Belum ada data detail pesanan
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('tanggal'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah detail pesanan terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('tanggal'))
                <a href="{{ route('detail-pesanan.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('detail-pesanan.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Detail Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<style>
.btn-custom {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border: none;
    color: white;
    transition: transform 0.3s ease;
}

.btn-custom:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 15px rgba(246, 179, 92, 0.4);
}

.detail-card-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Variasi warna untuk card yang berbeda */
.detail-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
}

.detail-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%) !important;
}

.detail-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%) !important;
}

/* Action Buttons */
.action-buttons .btn {
    min-width: 80px;
    transition: all 0.3s ease;
}

.action-buttons .btn-sm i {
    font-size: 0.9rem;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.action-buttons .btn-info {
    background: linear-gradient(135deg, var(--secondary) 0%, #138496 100%);
    border-color: #117a8b;
}

.action-buttons .btn-info:hover {
    background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
}

.action-buttons .btn-warning {
    background: linear-gradient(135deg, var(--primary) 0%, #e0a800 100%);
    border-color: #d39e00;
}

.action-buttons .btn-warning:hover {
    background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
}

.action-buttons .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-color: #bd2130;
}

.action-buttons .btn-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
    flex-wrap: nowrap;
    justify-content: center;
}

.page-link {
    border: 1px solid #dee2e6;
    color: var(--primary);
    font-weight: 600;
    padding: 8px 16px;
    margin: 0 3px;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border-color: var(--primary);
    color: white;
    box-shadow: 0 2px 8px rgba(246, 179, 92, 0.3);
}

.page-link:hover {
    background-color: rgba(246, 179, 92, 0.1);
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Responsive pagination */
@media (max-width: 768px) {
    .page-link {
        padding: 6px 12px;
        font-size: 0.9rem;
        margin: 0 2px;
    }
    
    .pagination {
        flex-wrap: wrap;
    }
    
    .detail-card-header {
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .action-buttons .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .page-link {
        padding: 5px 10px;
        margin: 2px;
        font-size: 0.85rem;
    }
    
    .action-buttons .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .card-body {
        padding: 1rem !important;
    }
}

/* Memastikan pagination horizontal */
.pagination {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
}

.page-item {
    display: inline-block !important;
    float: none !important;
}

/* Style untuk input group search */
.input-group .btn {
    border-radius: 0 0.375rem 0.375rem 0;
}
.btn-custom {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%);
    border: none;
    color: white;
    transition: transform 0.3s ease;
}

.btn-custom:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

.detail-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
}

/* Variasi warna untuk card yang berbeda */
.detail-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%) !important;
}

.detail-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%) !important;
}

.detail-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #fd7e14 0%, #28a745 100%) !important;
}

/* Action Buttons */
.action-buttons .btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    border-color: #117a8b;
    color: white;
}

.action-buttons .btn-info:hover {
    background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
    color: white;
}

.action-buttons .btn-warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    border-color: #d39e00;
    color: white;
}

.action-buttons .btn-warning:hover {
    background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
    color: white;
}

/* Pagination Styles */
.page-link {
    border: 1px solid #dee2e6;
    color: #28a745;
    font-weight: 600;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
    border-color: #28a745;
    color: white;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.page-link:hover {
    background-color: rgba(40, 167, 69, 0.1);
    border-color: #28a745;
    color: #28a745;
}
</style>

<script>
// Auto submit form ketika search diisi dan enter ditekan
document.getElementById('search').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('searchForm').submit();
    }
});

// Show/hide reset button berdasarkan kondisi filter
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const tanggalSelect = document.getElementById('tanggal');
    const resetBtn = document.querySelector('a[href="{{ route('detail-pesanan.index') }}"]');
    
    // Check jika ada filter aktif
    if (searchInput.value || tanggalSelect.value) {
        resetBtn.classList.remove('btn-secondary');
        resetBtn.classList.add('btn-danger');
        resetBtn.innerHTML = '<i class="fas fa-times me-1"></i> Reset Filter';
    }
});
</script>
@endsection