@extends('layouts.guest.auth')

@section('title', 'Register')

@section('content')
    <div class="form-header text-center mb-4">
        <h2 class="fw-bold text-success">Register UMKM Desa</h2>
        <p class="text-muted">Buat akun baru untuk memulai usaha Anda</p>
    </div>

    {{-- Alert Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <div>
                    <strong>Perhatian!</strong>
                    <ul class="mb-0 ps-3 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        
        {{-- Nama Lengkap --}}
        <div class="form-group mb-3">
            <label class="form-label fw-semibold small">Nama Lengkap</label>
            <div class="input-group-custom">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="name" class="form-control custom-input" 
                       placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
            </div>
        </div>

        {{-- Email --}}
        <div class="form-group mb-3">
            <label class="form-label fw-semibold small">Email</label>
            <div class="input-group-custom">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="form-control custom-input" 
                       placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
            </div>
        </div>

        {{-- Role Select --}}
        <div class="form-group mb-3">
            <label class="form-label fw-semibold small">Daftar Sebagai</label>
            <div class="input-group-custom">
                <i class="fas fa-users input-icon"></i>
                <select name="role" class="form-select custom-input" required>
                    <option value="" disabled selected>Pilih peran...</option>
                    <option value="user">User</option>
                    <option value="warga">Warga</option>
                    <option value="admin">Admin</option>
                </select>
                <i class="fas fa-chevron-down arrow-icon"></i>
            </div>
        </div>

        {{-- Password --}}
        <div class="form-group mb-3">
            <label class="form-label fw-semibold small">Password</label>
            <div class="input-group-custom">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="form-control custom-input" 
                       placeholder="Minimal 8 karakter" required>
                <button type="button" class="password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group mb-4">
            <label class="form-label fw-semibold small">Konfirmasi Password</label>
            <div class="input-group-custom">
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" name="password_confirmation" class="form-control custom-input" 
                       placeholder="Ulangi password" required>
                <button type="button" class="password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        {{-- Tombol Register --}}
        <button type="submit" class="btn-primary-custom mb-3">
            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
        </button>
    </form>

    {{-- Link Footer --}}
    <div class="links-section text-center">
        <p class="mb-2 text-muted small">Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Login di sini</a></p>
        <a href="{{ url('/') }}" class="text-secondary small text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
        </a>
    </div>
@endsection