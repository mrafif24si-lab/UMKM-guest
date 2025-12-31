@extends('layouts.guest.app')

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

        <!-- Form Filter dan Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('user.index') }}" id="searchForm">
                    <div class="row align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-bold">Cari User:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       id="search" placeholder="Cari nama user atau email..."
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

                        <!-- Filter Role -->
                        <div class="col-md-4">
                            <label for="role" class="form-label fw-bold">Filter Role:</label>
                            <select name="role" id="role" class="form-select" onchange="document.getElementById('searchForm').submit()">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="warga" {{ request('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-4">Reset Semua</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($users->count() > 0)
        <div class="row">
            @foreach($users as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-header text-white py-3 user-card-header">
                        <!-- Foto Profil atau Placeholder -->
                        <div class="text-center mb-2">
                            @if($item->media->count() > 0)
                                @php
                                    $firstImage = $item->media->first();
                                @endphp
                                @if(Str::startsWith($firstImage->mime_type, 'image/'))
                                    <img src="{{ asset('storage/media/' . $firstImage->file_name) }}" 
                                         class="rounded-circle border border-3 border-white" 
                                         style="width: 80px; height: 80px; object-fit: cover;" 
                                         alt="{{ $item->name }}"
                                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                @else
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light border border-3 border-white" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x text-secondary"></i>
                                    </div>
                                @endif
                            @else
                                <!-- Placeholder Gambar -->
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-light border border-3 border-white" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x text-secondary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-0">{{ $item->name }}</h5>
                        <small class="opacity-75">Role: {{ ucfirst($item->role) }}</small>
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
                            <strong>Jumlah File:</strong> {{ $item->media->count() }}
                        </div>
                        <div class="mb-2">
                            <strong>Terakhir Update:</strong><br>
                            {{ $item->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 pt-3">
                        <div class="action-buttons d-flex justify-content-between align-items-center">
                            <!-- Tombol Detail -->
                            <a href="{{ route('user.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <div class="d-flex gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            title="Hapus" 
                                            onclick="return confirm('Yakin ingin menghapus User {{ $item->name }}?')">
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
    <!-- Pagination Horizontal -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        {{ $users->links('pagination::bootstrap-5') }}
    </nav>
</div>

<div class="card bg-light mt-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">
                    Total: <strong>{{ $users->total() }}</strong> User
                    @if(request('search'))
                        | Pencarian: <strong>"{{ request('search') }}"</strong>
                    @endif
                    @if(request('role'))
                        | Filter: <strong>{{ ucfirst(request('role')) }}</strong>
                    @endif
                </p>
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
            <!-- Placeholder untuk tidak ada data -->
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" 
                     style="width: 120px; height: 120px;">
                    <i class="fas fa-users fa-4x text-muted"></i>
                </div>
            </div>
            <h4 class="text-muted">
                @if(request('search') && request('role'))
                    Tidak ada User dengan role "{{ request('role') }}" dan pencarian "{{ request('search') }}"
                @elseif(request('search'))
                    Tidak ada User dengan pencarian "{{ request('search') }}"
                @elseif(request('role'))
                    Tidak ada User dengan role "{{ request('role') }}"
                @else
                    Belum ada data User
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if(request('search') || request('role'))
                    Silakan coba pencarian/filter lain atau reset filter
                @else
                    Silakan tambah data User terlebih dahulu
                @endif
            </p>
            @if(request('search') || request('role'))
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg me-2">
                    <i class="fas fa-times me-1"></i> Reset Semua
                </a>
            @endif
            <a href="{{ route('user.create') }}" class="btn btn-custom btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah User Pertama
            </a>
        </div>
        @endif
    </div>
</div>


@endsection