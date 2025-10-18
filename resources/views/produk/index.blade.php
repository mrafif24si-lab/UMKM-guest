<!-- resources/views/produk/index.blade.php -->
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
        <div class="table-container">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Daftar Produk</h5>
                <a href="{{ route('produk.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </a>
            </div>
            
            @if($dataProduk->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>UMKM</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>ketersediaan</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataProduk as $item)
                        <tr>
                            
                            <td>
                                <strong>{{ $item->nama_produk }}</strong>
                                @if($item->deskripsi)
                                    <br><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                @endif
                            </td>
                            <td>{{ $item->umkm->nama_usaha ?? '-' }}</td>
                            <td>
                                <strong class="text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                                    {{ $item->stok }} pcs
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'danger' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('produk.edit', $item->produk_id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk {{ $item->nama_produk }}?')">
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
            
            <div class="card-footer bg-light py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">Total: <strong>{{ $dataProduk->count() }}</strong> produk</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('produk.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Produk Baru
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data produk</h4>
                <p class="text-muted mb-4">Silakan tambah produk terlebih dahulu</p>
                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah Produk Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection