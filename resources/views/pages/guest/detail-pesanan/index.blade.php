@extends('layouts.guest')

@section('title', 'Data Detail Pesanan')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Detail Pesanan</h1>
        <p class="text-white lead">Daftar detail pesanan dalam sistem</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-shopping-cart me-2"></i>Daftar Detail Pesanan</h3>
            <a href="{{ route('detail-pesanan.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Detail
            </a>
        </div>

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('detail-pesanan.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nomor pesanan, nama produk, atau jumlah..."
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

                        <!-- Filter Pesanan -->
                        <div class="col-md-4">
                            <label for="pesanan_id" class="form-label fw-bold">Filter Pesanan:</label>
                            <select name="pesanan_id" id="pesanan_id" class="form-select" 
                                    onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Pesanan</option>
                                @foreach($pesananList as $pesanan)
                                <option value="{{ $pesanan->pesanan_id }}" 
                                    {{ request('pesanan_id') == $pesanan->pesanan_id ? 'selected' : '' }}>
                                    {{ $pesanan->nomor_pesanan }} - {{ $pesanan->warga->nama ?? '-' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('detail-pesanan.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($detailPesanan->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Pesanan</th>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailPesanan as $index => $detail)
                            <tr>
                                <td>{{ $detailPesanan->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold">{{ $detail->pesanan->nomor_pesanan ?? '-' }}</div>
                                    <small class="text-muted">
                                        {{ $detail->pesanan->warga->nama ?? 'Tidak diketahui' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $detail->produk->nama_produk ?? '-' }}</div>
                                    <small class="text-muted">
                                        {{ $detail->produk->umkm->nama_usaha ?? '-' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        {{ $detail->qty }}
                                    </span>
                                </td>
                                <td class="text-end fw-bold">
                                    {{ $detail->harga_satuan_formatted }}
                                </td>
                                <td class="text-end fw-bold text-success">
                                    {{ $detail->subtotal_formatted }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('detail-pesanan.show', $detail->detail_id) }}" 
                                           class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('detail-pesanan.edit', $detail->detail_id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('detail-pesanan.destroy', $detail->detail_id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus detail pesanan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $detailPesanan->firstItem() }} - {{ $detailPesanan->lastItem() }} 
                dari {{ $detailPesanan->total() }} detail pesanan
            </div>
            <nav aria-label="Page navigation">
                {{ $detailPesanan->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        @else
        <div class="text-center py-5">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" 
                     style="width: 120px; height: 120px;">
                    <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                </div>
            </div>
            <h4 class="text-muted">
                @if(request('search') || request('pesanan_id'))
                    Tidak ada detail pesanan yang ditemukan
                @else
                    Belum ada data detail pesanan
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('pesanan_id'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah detail pesanan terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('pesanan_id'))
                <a href="{{ route('detail-pesanan.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('detail-pesanan.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Detail Pesanan Pertama
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

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #495057;
}

.table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
}

.badge.bg-primary {
    font-size: 0.9em;
    font-weight: 600;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .btn-group {
        flex-direction: column;
        gap: 2px;
    }
    
    .btn-group .btn {
        margin-right: 0;
        margin-bottom: 2px;
        width: 100%;
    }
}
</style>
@endsection