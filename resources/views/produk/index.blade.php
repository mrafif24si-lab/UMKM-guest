@extends('layouts.guest')

@section('title', 'Data Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Produk UMKM</h1>
        <p class="text-white lead">Temukan berbagai produk unggulan dari UMKM lokal kami</p>
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
                            <strong>Jenis:</strong> {{ $item->jenis_produk }}
                        </div>
                        <div class="mb-2">
                            <strong>Harga:</strong>
                            <span class="fw-bold" style="color: #28a745;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Stok:</strong>
                            <span class="badge custom-badge">
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

        <div class="card bg-light mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">Total: <strong>{{ $dataProduk->count() }}</strong> produk</p>
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
            <h4 class="text-muted">Belum ada data produk</h4>
            <p class="text-muted mb-4">Silakan tambah produk terlebih dahulu</p>
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
</style>
@endsection
