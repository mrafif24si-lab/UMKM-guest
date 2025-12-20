@extends('layouts.guest')

@section('title', 'Data Ulasan Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Ulasan Produk</h1>
        <p class="text-white lead">Kelola semua ulasan produk dari warga</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-star me-2"></i>Daftar Ulasan Produk</h3>
            <a href="{{ route('ulasan-produk.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Ulasan
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
                <form method="GET" action="{{ route('ulasan-produk.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari Ulasan:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari produk, warga, komentar..."
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

                        <!-- Filter Rating -->
                        <div class="col-md-3">
                            <label for="rating" class="form-label fw-bold">Filter Rating:</label>
                            <select name="rating" id="rating" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Rating</option>
                                @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                    {{ str_repeat('★ ', $i) }}{{ str_repeat('☆ ', 5-$i) }}
                                </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label fw-bold">Filter Tanggal:</label>
                            <select name="tanggal" id="tanggal" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Tanggal</option>
                                <option value="hari_ini" {{ request('tanggal') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu_ini" {{ request('tanggal') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan_ini" {{ request('tanggal') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="tahun_ini" {{ request('tanggal') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2 d-flex align-items-end">
                            <a href="{{ route('ulasan-produk.index') }}" class="btn btn-secondary w-100 mt-2">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($ulasan->count() > 0)
        <div class="row">
            @foreach($ulasan as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <!-- HEADER CARD - SESUAI PESANAN -->
                    <div class="card-header text-white py-3" 
                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">{{ $item->produk->nama_produk ?? '-' }}</h5>
                                <small class="opacity-75">{{ $item->produk->umkm->nama_usaha ?? '-' }}</small>
                            </div>
                            <div class="text-end">
                                <div class="rating-stars fs-4">
                                    {!! $item->rating_bintang !!}
                                </div>
                                <small class="opacity-75">{{ $item->rating }}/5</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Info Warga -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center me-3"
                                     style="width: 50px; height: 50px; background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(var(--secondary-rgb), 0.1) 100%);">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-dark">{{ $item->warga->nama ?? '-' }}</h6>
                                    <small class="text-muted">{{ $item->warga->email ?? '-' }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Komentar -->
                        <div class="border-top pt-3">
                            <p class="mb-2"><strong><i class="fas fa-comment me-1 text-primary"></i>Komentar:</strong></p>
                            <div class="bg-light p-3 rounded" style="background-color: #f8f9fa !important;">
                                @if($item->komentar)
                                    <p class="mb-0">{{ Str::limit($item->komentar, 150) }}</p>
                                    @if(strlen($item->komentar) > 150)
                                        <small class="text-muted">...lihat detail</small>
                                    @endif
                                @else
                                    <p class="text-muted mb-0"><i>Tidak ada komentar</i></p>
                                @endif
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="mt-3 pt-3 border-top">
                            <p class="mb-0 text-center text-muted">
                                <i class="far fa-calendar me-1 text-primary"></i>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </p>
                            <p class="mb-0 text-center text-muted">
                                <i class="far fa-clock me-1 text-primary"></i>
                                {{ $item->created_at->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    
                    <!-- FOOTER CARD - SESUAI PESANAN -->
                    <div class="card-footer bg-light border-0 pt-3" style="background-color: #f8f9fa !important;">
                        <div class="action-buttons d-flex justify-content-between align-items-center">
                            <!-- Tombol Detail -->
                            <a href="{{ route('ulasan-produk.show', $item->ulasan_id) }}" 
                               class="btn btn-info btn-sm text-white" 
                               style="background: linear-gradient(135deg, var(--secondary) 0%, #138496 100%); border: none;">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <div class="d-flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('ulasan-produk.edit', $item->ulasan_id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   style="background: linear-gradient(135deg, var(--primary) 0%, #e0a800 100%); border: none; color: #000;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('ulasan-produk.destroy', $item->ulasan_id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border: none;"
                                            title="Hapus" 
                                            onclick="return confirm('Yakin menghapus ulasan ini?')">
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

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{ $ulasan->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <!-- Summary -->
        <div class="card bg-light mt-4" style="border: 1px solid #dee2e6;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            Total: <strong>{{ $ulasan->total() }}</strong> ulasan produk
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('rating'))
                                | Rating: <strong>{{ request('rating') }} ★</strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-primary mb-1">Total Ulasan</h5>
                                    <h3 class="mb-0" style="color: var(--primary);">{{ $summary['total_ulasan'] }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-warning mb-1">Rating Rata-rata</h5>
                                    <h3 class="mb-0" style="color: #ffc107;">{{ $summary['avg_rating'] }} <small class="text-muted">/5</small></h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-success mb-1">Ulasan 5★</h5>
                                    <h3 class="mb-0" style="color: #198754;">{{ $summary['rating_5'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rating Distribution -->
                <div class="mt-3">
                    <h6 class="mb-2">Distribusi Rating:</h6>
                    <div class="row text-center">
                        @for($i = 5; $i >= 1; $i--)
                        <div class="col">
                            <div class="p-2 border rounded" style="background-color: #f8f9fa;">
                                <div class="rating-stars mb-1">
                                    {!! str_repeat('<i class="fas fa-star text-warning"></i>', $i) !!}
                                    {!! str_repeat('<i class="far fa-star text-muted"></i>', 5-$i) !!}
                                </div>
                                <h5 class="mb-0" style="color: var(--primary);">{{ $summary["rating_$i"] }}</h5>
                                <small class="text-muted">
                                    @if($summary['total_ulasan'] > 0)
                                        {{ round(($summary["rating_$i"] / $summary['total_ulasan']) * 100) }}%
                                    @else
                                        0%
                                    @endif
                                </small>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                 style="width: 100px; height: 100px; background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(var(--secondary-rgb), 0.1) 100%);">
                <i class="fas fa-star fa-3x" style="color: var(--primary);"></i>
            </div>
            <h4 class="text-dark mb-3">
                @if(request('search') || request('rating') || request('tanggal'))
                    Tidak ada ulasan ditemukan
                @else
                    Belum ada data ulasan produk
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('rating') || request('tanggal'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah ulasan produk terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('rating') || request('tanggal'))
                <a href="{{ route('ulasan-produk.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('ulasan-produk.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Ulasan Pertama
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
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
}

.btn-custom:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 15px rgba(246, 179, 92, 0.4);
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.rating-stars {
    line-height: 1;
}

.rating-stars .fa-star {
    margin-right: 2px;
}

/* Warna rating sesuai tema */
.fa-star.text-warning {
    color: #ffc107 !important;
}

/* Action button styles */
.action-buttons .btn {
    min-width: 80px;
    transition: all 0.3s ease;
    border-radius: 6px;
    padding: 6px 12px;
    font-weight: 500;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    
    .action-buttons .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
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

/* Style untuk tombol action */
.action-buttons .btn {
    min-width: 80px;
}

.action-buttons .btn-sm i {
    font-size: 0.9rem;
}

/* Tambahan untuk warna badge */
.badge.custom-badge {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%);
    color: white;
    border: none;
}

/* Card header variants for different ratings */
.card-header[data-rating="5"] {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
}

.card-header[data-rating="4"] {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
}

.card-header[data-rating="3"] {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
}

.card-header[data-rating="2"] {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
}

.card-header[data-rating="1"] {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .card-hover {
        margin-bottom: 20px;
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
</style>

<script>
// Auto submit form ketika search diisi dan enter ditekan
document.getElementById('search').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('searchForm').submit();
    }
});

// Tambahkan data-rating attribute ke card header
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.card-header').forEach(header => {
        const rating = header.querySelector('.rating-stars').textContent.match(/\★/g)?.length || 0;
        if (rating > 0) {
            header.setAttribute('data-rating', rating);
        }
    });
});
</script>
@endsection