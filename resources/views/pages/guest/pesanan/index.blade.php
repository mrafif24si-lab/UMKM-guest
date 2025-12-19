@extends('layouts.guest')

@section('title', 'Data Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Pesanan UMKM</h1>
        <p class="text-white lead">Kelola semua pesanan dari warga</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-shopping-cart me-2"></i>Daftar Pesanan</h3>
            <a href="{{ route('pesanan.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Pesanan
            </a>
        </div>

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('pesanan.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari Pesanan:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nomor pesanan atau alamat..."
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

                        <!-- Filter Status -->
                        <div class="col-md-3">
                            <label for="status" class="form-label fw-bold">Filter Status:</label>
                            <select name="status" id="status" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>

                        <!-- Filter Metode Bayar -->
                        <div class="col-md-3">
                            <label for="metode_bayar" class="form-label fw-bold">Metode Bayar:</label>
                            <select name="metode_bayar" id="metode_bayar" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Metode</option>
                                <option value="Transfer Bank" {{ request('metode_bayar') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="Tunai" {{ request('metode_bayar') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="E-Wallet" {{ request('metode_bayar') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($dataPesanan->count() > 0)
        <div class="row">
            @foreach($dataPesanan as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 pesanan-card-header">
                        <!-- Icon atau Logo -->
                        <div class="text-center mb-2">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light border border-3 border-white" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-receipt fa-2x text-secondary"></i>
                            </div>
                        </div>
                        <h5 class="mb-0">{{ $item->nomor_pesanan }}</h5>
                        <small class="opacity-75">{{ $item->warga->nama ?? '-' }}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="card-text">
                                <i class="fas fa-calendar me-2"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <strong>Total:</strong>
                            <span class="fw-bold" style="color: #28a745;">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong><br>
                            @php
                                $statusColor = [
                                    'pending' => 'warning',
                                    'proses' => 'info',
                                    'dikirim' => 'primary',
                                    'selesai' => 'success',
                                    'dibatalkan' => 'danger'
                                ][$item->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Alamat:</strong><br>
                            <span class="badge custom-badge">{{ $item->rt }}/{{ $item->rw }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Metode Bayar:</strong><br>
                            <span class="badge bg-secondary">{{ $item->metode_bayar }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 pt-3">
                        <div class="action-buttons d-flex justify-content-between align-items-center">
                            <!-- Tombol Detail -->
                            <a href="{{ route('pesanan.show', $item->pesanan_id) }}" 
                               class="btn btn-info btn-sm" 
                               title="Detail">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <div class="d-flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('pesanan.edit', $item->pesanan_id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pesanan.destroy', $item->pesanan_id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            title="Hapus" 
                                            onclick="return confirm('Yakin ingin menghapus pesanan {{ $item->nomor_pesanan }}?')">
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
                {{ $dataPesanan->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            Total: <strong>{{ $dataPesanan->total() }}</strong> pesanan
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('status'))
                                | Filter: <strong>{{ ucfirst(request('status')) }}</strong>
                            @endif
                            @if(request('metode_bayar'))
                                | Pembayaran: <strong>{{ request('metode_bayar') }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('pesanan.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-1"></i> Tambah Pesanan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <!-- Placeholder untuk tidak ada data -->
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" 
                     style="width: 120px; height: 120px;">
                    <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                </div>
            </div>
            <h4 class="text-muted">
                @if(request('search') || request('status') || request('metode_bayar'))
                    Tidak ada pesanan ditemukan
                @else
                    Belum ada data pesanan
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('status') || request('metode_bayar'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah pesanan terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('status') || request('metode_bayar'))
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('pesanan.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Pesanan Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<style>
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

.pesanan-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
    text-align: center;
}

.custom-badge {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
    color: white;
    border: none;
    font-size: 0.85em;
    padding: 5px 10px;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Variasi warna untuk card yang berbeda (sama seperti UMKM) */
.pesanan-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%) !important;
}

.pesanan-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%) !important;
}

.pesanan-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #fd7e14 0%, #28a745 100%) !important;
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

.action-buttons .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-color: #bd2130;
    color: white;
}

.action-buttons .btn-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    color: white;
}

/* Custom Pagination Styles */
.pagination {
    margin-bottom: 0;
    flex-wrap: nowrap;
    justify-content: center;
}

.page-link {
    border: 1px solid #dee2e6;
    color: #28a745;
    font-weight: 600;
    padding: 8px 16px;
    margin: 0 3px;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
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
    transform: translateY(-1px);
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-link {
        padding: 6px 12px;
        font-size: 0.9rem;
        margin: 0 2px;
    }
    
    .pagination {
        flex-wrap: wrap;
    }
    
    .pesanan-card-header {
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
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .btn-custom {
        width: 100%;
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
</style>
@endsection