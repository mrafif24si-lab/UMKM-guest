@extends('layouts.guest')

@section('title', 'Data Warga')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Warga</h1>
        <p class="text-white lead">Daftar warga terdaftar dalam sistem</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-users me-2"></i>Daftar Warga</h3>
            <a href="{{ route('warga.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah Warga
            </a>
        </div>

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('warga.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari Warga:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nama, agama, pekerjaan..."
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

                        <!-- Filter Jenis Kelamin -->
                        <div class="col-md-3">
                            <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin:</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Filter Role -->
                        <div class="col-md-3">
                            <label for="role" class="form-label fw-bold">Filter Role:</label>
                            <select name="role" id="role" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="warga" {{ request('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('warga.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($dataWarga->count() > 0)
        <div class="row">
            @foreach($dataWarga as $warga)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 warga-card-header">
                        <!-- Foto Profil atau Placeholder -->
                        <div class="text-center mb-2">
                            @if($warga->media->count() > 0 && $warga->media->where('mime_type', 'like', 'image/%')->first())
                                @php
                                    $firstImage = $warga->media->where('mime_type', 'like', 'image/%')->first();
                                @endphp
                                <img src="{{ asset('storage/media/' . $firstImage->file_name) }}" 
                                     class="rounded-circle border border-3 border-white" 
                                     style="width: 80px; height: 80px; object-fit: cover;" 
                                     alt="{{ $warga->nama }}"
                                     onerror="this.src='{{ asset('images/placeholder.png') }}'">
                            @else
                                <!-- Placeholder Gambar -->
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light border border-3 border-white" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x text-secondary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-0">{{ $warga->nama }}</h5>
                        <small class="opacity-75">
                            <i class="fas fa-user-tag me-1"></i>{{ ucfirst($warga->role) }}
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-id-card me-1"></i>No KTP:</strong><br>
                            <span class="font-monospace">{{ $warga->no_ktp }}</span>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <strong><i class="fas fa-venus-mars me-1"></i>Jenis Kelamin:</strong><br>
                                <span class="badge bg-info">{{ $warga->jenis_kelamin }}</span>
                            </div>
                            <div class="col-6 mb-2">
                                <strong><i class="fas fa-briefcase me-1"></i>Pekerjaan:</strong><br>
                                <small>{{ $warga->pekerjaan }}</small>
                            </div>
                        </div>
                        @if($warga->email)
                        <div class="mb-2">
                            <strong><i class="fas fa-envelope me-1"></i>Email:</strong><br>
                            <a href="mailto:{{ $warga->email }}" class="text-decoration-none small">{{ $warga->email }}</a>
                        </div>
                        @endif
                        <div class="mb-2">
                            <strong><i class="fas fa-file me-1"></i>Jumlah File:</strong> 
                            <span class="badge bg-secondary">{{ $warga->media_count ?? 0 }}</span>
                        </div>
                        <div class="mb-2">
                            <strong><i class="fas fa-calendar me-1"></i>Terdaftar Sejak:</strong><br>
                            <small>{{ $warga->created_at->translatedFormat('d M Y') }}</small>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 pt-3">
                        <div class="action-buttons d-flex justify-content-between align-items-center">
                            <!-- Tombol Detail -->
                            <a href="{{ route('warga.show', $warga->warga_id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <div class="d-flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            title="Hapus" 
                                            onclick="return confirm('Yakin ingin menghapus Warga {{ $warga->nama }}?')">
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
                {{ $dataWarga->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            <i class="fas fa-users me-2"></i>Total: <strong>{{ $dataWarga->total() }}</strong> Warga
                            @if(request('search'))
                                | Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            @if(request('jenis_kelamin'))
                                | Filter: <strong>{{ request('jenis_kelamin') }}</strong>
                            @endif
                            @if(request('role'))
                                | Role: <strong>{{ ucfirst(request('role')) }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('warga.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-1"></i> Tambah Warga Baru
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
                    <i class="fas fa-user-friends fa-4x text-muted"></i>
                </div>
            </div>
            <h4 class="text-muted">
                @if(request('search') && (request('jenis_kelamin') || request('role')))
                    Tidak ada Warga dengan 
                    {{ request('jenis_kelamin') ? 'jenis kelamin "' . request('jenis_kelamin') . '"' : '' }}
                    {{ request('role') ? 'role "' . request('role') . '"' : '' }}
                    {{ request('search') ? 'dan pencarian "' . request('search') . '"' : '' }}
                @elseif(request('search'))
                    Tidak ada Warga dengan pencarian "{{ request('search') }}"
                @elseif(request('jenis_kelamin'))
                    Tidak ada Warga dengan jenis kelamin "{{ request('jenis_kelamin') }}"
                @elseif(request('role'))
                    Tidak ada Warga dengan role "{{ request('role') }}"
                @else
                    Belum ada data Warga
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('jenis_kelamin') || request('role'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah data Warga terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('jenis_kelamin') || request('role'))
                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('warga.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Warga Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<style>
.btn-custom {
    background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%);
    border: none;
    color: white;
    transition: transform 0.3s ease;
    font-weight: 600;
}

.btn-custom:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 15px rgba(246, 179, 92, 0.4);
}

.warga-card-header {
    background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%) !important;
    text-align: center;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px !important;
    overflow: hidden;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Variasi warna untuk card yang berbeda dengan skema UMKM */
.warga-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%) !important;
}

.warga-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #118AB2 0%, #C2185B 100%) !important;
}

.warga-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #C2185B 0%, #F6B35C 100%) !important;
}

/* Custom Pagination Styles */
.page-link {
    border: 1px solid #dee2e6;
    color: #118AB2;
    font-weight: 600;
    padding: 8px 16px;
    margin: 0 3px;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%);
    border-color: #118AB2;
    color: white;
    box-shadow: 0 2px 8px rgba(17, 138, 178, 0.3);
}

.page-link:hover {
    background-color: rgba(246, 179, 92, 0.1);
    border-color: #F6B35C;
    color: #118AB2;
    transform: translateY(-1px);
}

/* Style untuk action buttons */
.action-buttons .btn {
    min-width: 80px;
    border-radius: 8px;
}

.action-buttons .btn-sm i {
    font-size: 0.9rem;
}

/* Badge styling */
.badge {
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 8px;
}

/* Font styling */
.font-monospace {
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
}

/* Card body styling */
.card-body {
    padding: 1.25rem;
}

.card-body strong {
    color: #343a40;
    font-weight: 600;
}

.card-body small {
    color: #6c757d;
}
</style>

<script>
// Auto submit form saat filter berubah (sudah tidak perlu karena menggunakan onchange)
// Namun kita tetap pertahankan untuk kompatibilitas

// Tambahan untuk animasi card hover
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-hover');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});
</script>
@endsection