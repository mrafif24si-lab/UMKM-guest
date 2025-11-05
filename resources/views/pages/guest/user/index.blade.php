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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark"><i class="fas fa-users-cog me-2"></i>Daftar User</h3>
            <a href="{{ route('user.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-1"></i> Tambah User
            </a>
        </div>

        @if($users->count() > 0)
        <div class="row">
            @foreach($users as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 user-card-header">
                        <h5 class="mb-0">{{ $item->name }}</h5>
                        <small class="opacity-75">Bergabung: {{ $item->created_at->format('d/m/Y') }}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Email:</strong><br>
                            <a href="mailto:{{ $item->email }}" class="text-decoration-none">{{ $item->email }}</a>
                        </div>
                        <div class="mb-2">
                            <strong>ID User:</strong> {{ $item->id }}
                        </div>
                        <div class="mb-2">
                            <strong>Terakhir Update:</strong><br>
                            {{ $item->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="action-buttons d-flex justify-content-between">
                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
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
                        <p class="mb-0">Total: <strong>{{ $users->count() }}</strong> user</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-1"></i> Tambah User Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada data user</h4>
            <p class="text-muted mb-4">Silakan tambah data user terlebih dahulu</p>
            <a href="{{ route('user.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah User Pertama
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

.user-card-header {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 50%, #fd7e14 100%) !important;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Warna untuk card yang berbeda */
.user-card-header:nth-child(3n+1) {
    background: linear-gradient(135deg, #28a745 0%, #17a2b8 100%) !important;
}

.user-card-header:nth-child(3n+2) {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%) !important;
}

.user-card-header:nth-child(3n+3) {
    background: linear-gradient(135deg, #fd7e14 0%, #28a745 100%) !important;
}
</style>
@endsection
