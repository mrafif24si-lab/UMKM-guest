@extends('layouts.guest')

@section('title', 'Data User')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Data User</h1>
        <p class="text-white lead">Daftar user yang terdaftar dalam sistem UMKM kami</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="table-container">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i>Daftar User</h5>
                <a href="{{ route('user.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
            
            @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
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
                        <p class="mb-0">Total: <strong>{{ $users->count() }}</strong> user</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah User Baru
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data user</h4>
                <p class="text-muted mb-4">Silakan tambah data user terlebih dahulu</p>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah User Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection