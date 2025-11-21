@extends('layouts.guest')

@section('title', 'Data Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Produk UMKM</h1>
        <p class="text-white lead">Temukan berbagai produk unggalan dari UMKM lokal kami</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-boxes me-2"></i>Daftar Produk</h3>
            <a href="{{ route('produk.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Produk
            </a>
        </div>

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('produk.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari Produk:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nama produk, jenis, atau stok..."
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

                        <!-- Filter Jenis Produk -->
                        <div class="col-md-4">
                            <label for="jenis_produk" class="form-label fw-bold">Filter Jenis Produk:</label>
                            <select name="jenis_produk" id="jenis_produk" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Jenis Produk</option>
                                <option value="Makanan" {{ request('jenis_produk') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ request('jenis_produk') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Pakaian" {{ request('jenis_produk') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Aksesoris" {{ request('jenis_produk') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="Kerajinan" {{ request('jenis_produk') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                <option value="Elektronik" {{ request('jenis_produk') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Kosmetik" {{ request('jenis_produk') == 'Kosmetik' ? 'selected' : '' }}>Kosmetik</option>
                                <option value="Jasa" {{ request('jenis_produk') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="Pertanian" {{ request('jenis_produk') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="Perdagangan" {{ request('jenis_produk') == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($dataProduk->count() > 0)
        <div class="row">
            @foreach($dataProduk as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 produk-card-header">
                        <h5 class="mb-0">{{ $item->nama_produk }}</h5>
                        <small class="opacity-75">{{ $item->umkm->nama_usaha ?? '-' }}</small>
                    </div>
                    <div class="card-body">
                        @if($item->deskripsi)
                        <div class="mb-3">
                            <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                        </div>
                        @endif

                        <div class="mb-2">
                            <strong>Jenis:</strong> 
                            <span class="badge custom-badge">{{ $item->jenis_produk }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Harga:</strong>
                            <span class="fw-bold" style="color: #28a745;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Stok:</strong>
                            <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                                {{ $item->stok }} pcs
                            </span>
                        </div>
                        <div class="mb-2">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'danger' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="action-buttons d-flex justify-content-between">
                            <a href="{{ route('produk.edit', $item->produk_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk {{ $item->nama_produk }}?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Horizontal -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{ $dataProduk->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            Total: <strong>{{ $dataProduk->total() }}</strong> produk
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('jenis_produk'))
                                | Filter: <strong>{{ request('jenis_produk') }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('produk.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-1"></i> Tambah Produk Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">
                @if(request('search') && request('jenis_produk'))
                    Tidak ada produk dengan jenis "{{ request('jenis_produk') }}" dan pencarian "{{ request('search') }}"
                @elseif(request('search'))
                    Tidak ada produk dengan pencarian "{{ request('search') }}"
                @elseif(request('jenis_produk'))
                    Tidak ada produk dengan jenis "{{ request('jenis_produk') }}"
                @else
                    Belum ada data produk
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('jenis_produk'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah produk terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('jenis_produk'))
                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('produk.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Produk Pertama
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

.produk-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
}

.custom-badge {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%);
    color: white;
    border: none;
    font-size: 0.8rem;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Variasi warna untuk card yang berbeda */
.produk-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%) !important;
}

.produk-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%) !important;
}

.produk-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #fd7e14 0%, #28a745 100%) !important;
}

/* Custom Pagination Styles - Horizontal seperti gambar */
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
}

@media (max-width: 576px) {
    .page-link {
        padding: 5px 10px;
        margin: 2px;
        font-size: 0.85rem;
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