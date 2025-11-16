@extends('layouts.guest')

@section('title', 'Data UMKM')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data UMKM</h1>
        <p class="text-white lead">Daftar Usaha Mikro, Kecil, dan Menengah yang terdaftar</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="table-container">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="mb-0"><i class="fas fa-store me-2"></i>Daftar UMKM</h5>
                <a href="{{ route('umkm.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah UMKM
                </a>
            </div>
            
            @if($umkm->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Usaha</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kategori</th>
                            <th>Kontak</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($umkm as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->nama_usaha }}</strong></td>
                            <td>{{ $item->pemilik->nama ?? '-' }}</td>
                            <td>{{ Str::limit($item->alamat, 30) }}</td>
                            <td>{{ $item->rt }}/{{ $item->rw }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('umkm.show', $item->umkm_id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('umkm.edit', $item->umkm_id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('umkm.destroy', $item->umkm_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus UMKM {{ $item->nama_usaha }}?')">
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
                        <p class="mb-0">Total: <strong>{{ $umkm->count() }}</strong> UMKM</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('umkm.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah UMKM Baru
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-store fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data UMKM</h4>
                <p class="text-muted mb-4">Silakan tambah data UMKM terlebih dahulu</p>
                <a href="{{ route('umkm.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah UMKM Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection