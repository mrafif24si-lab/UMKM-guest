<!-- resources/views/warga/index.blade.php -->
@extends('layouts.guest')

@section('title', 'Data Warga')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data Warga</h1>
        <p class="text-white lead">Daftar warga yang terdaftar dalam sistem UMKM kami</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="table-container">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Warga</h5>
                <a href="{{ route('warga.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Warga
                </a>
            </div>
            
            @if($dataWarga->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataWarga as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->no_ktp }}</strong></td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->jenis_kelamin }}</span>
                            </td>
                            <td>{{ $item->agama }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->telp }}</td>
                            <td>
                                @if($item->email)
                                    <a href="mailto:{{ $item->email }}" class="text-decoration-none">{{ $item->email }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data warga {{ $item->nama }}?')">
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
                        <p class="mb-0">Total: <strong>{{ $dataWarga->count() }}</strong> warga</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Warga Baru
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data warga</h4>
                <p class="text-muted mb-4">Silakan tambah data warga terlebih dahulu</p>
                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah Warga Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection