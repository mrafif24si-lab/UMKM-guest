@extends('layouts.guest')

@section('title', 'Data UMKM')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data UMKM</h1>
        <p class="text-white lead">Daftar UMKM yang terdaftar dalam sistem kami</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-store me-2"></i>Daftar UMKM</h3>
            <a href="{{ route('umkm.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah UMKM
            </a>
        </div>

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('umkm.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari UMKM:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nama UMKM, jenis usaha, atau nama pemilik..."
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

                        <!-- Filter Jenis Usaha -->
                        <div class="col-md-4">
                            <label for="kategori" class="form-label fw-bold">Filter Jenis Usaha:</label>
                            <select name="kategori" id="kategori" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Jenis Usaha</option>
                                <option value="Makanan & Minuman" {{ request('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                <option value="Fashion & Pakaian" {{ request('kategori') == 'Fashion & Pakaian' ? 'selected' : '' }}>Fashion & Pakaian</option>
                                <option value="Kerajinan Tangan" {{ request('kategori') == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                <option value="Pertanian & Perkebunan" {{ request('kategori') == 'Pertanian & Perkebunan' ? 'selected' : '' }}>Pertanian & Perkebunan</option>
                                <option value="Jasa" {{ request('kategori') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="Perdagangan" {{ request('kategori') == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                <option value="Elektronik & Teknologi" {{ request('kategori') == 'Elektronik & Teknologi' ? 'selected' : '' }}>Elektronik & Teknologi</option>
                                <option value="Kecantikan & Kosmetik" {{ request('kategori') == 'Kecantikan & Kosmetik' ? 'selected' : '' }}>Kecantikan & Kosmetik</option>
                                <option value="Otomotif" {{ request('kategori') == 'Otomotif' ? 'selected' : '' }}>Otomotif</option>
                                <option value="Pendidikan" {{ request('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Kesehatan" {{ request('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('umkm.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($umkm->count() > 0)
        <div class="row">
            @foreach($umkm as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 umkm-card-header">
                        <!-- Tambahkan logo jika ada -->
          
                        <h5 class="mb-0">{{ $item->nama_usaha }}</h5>
                        <small class="opacity-75">Pemilik: {{ $item->pemilik->nama ?? '-' }}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Jenis Usaha:</strong><br>
                            <span class="badge custom-badge">{{ $item->kategori }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Alamat:</strong> {{ Str::limit($item->alamat, 50) }}
                        </div>
                        <div class="mb-2">
                            <strong>RT/RW:</strong> {{ $item->rt }}/{{ $item->rw }}
                        </div>
                        <div class="mb-2">
                            <strong>Kontak:</strong> {{ $item->kontak }}
                        </div>
                        @if($item->deskripsi)
                        <div class="mb-2">
                            <strong>Deskripsi:</strong><br>
                            <p class="card-text small">{{ Str::limit($item->deskripsi, 80) }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="action-buttons d-flex justify-content-between">
                            <a href="{{ route('umkm.edit', $item->umkm_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('umkm.destroy', $item->umkm_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus UMKM {{ $item->nama_usaha }}?')">
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
                {{ $umkm->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            Total: <strong>{{ $umkm->total() }}</strong> UMKM
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('kategori'))
                                | Filter: <strong>{{ request('kategori') }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('umkm.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-1"></i> Tambah UMKM Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <i class="fas fa-store fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">
                @if(request('search') && request('kategori'))
                    Tidak ada UMKM dengan jenis usaha "{{ request('kategori') }}" dan pencarian "{{ request('search') }}"
                @elseif(request('search'))
                    Tidak ada UMKM dengan pencarian "{{ request('search') }}"
                @elseif(request('kategori'))
                    Tidak ada UMKM dengan jenis usaha "{{ request('kategori') }}"
                @else
                    Belum ada data UMKM
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('kategori'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah data UMKM terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('kategori'))
                <a href="{{ route('umkm.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('umkm.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah UMKM Pertama
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

.umkm-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
}

.custom-badge {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
    color: white;
    border: none;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Variasi warna untuk card yang berbeda */
.umkm-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%) !important;
}

.umkm-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%) !important;
}

.umkm-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #fd7e14 0%, #28a745 100%) !important;
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