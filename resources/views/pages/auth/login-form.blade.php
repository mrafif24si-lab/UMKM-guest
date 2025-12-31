@extends('layouts.guest.auth')

@section('title', 'Login')

@section('content')
    <div class="form-header text-center mb-4">
        <h2 class="fw-bold text-success">Login UMKM</h2>
        <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success py-2 small mb-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger py-2 small mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        {{-- Email --}}
        <div class="form-group mb-3">
            <label class="form-label fw-semibold small">Email Address</label>
            <div class="input-group-custom">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="form-control custom-input" 
                       placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        {{-- Password --}}
        <div class="form-group mb-4">
            <label class="form-label fw-semibold small">Password</label>
            <div class="input-group-custom">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="form-control custom-input" 
                       placeholder="••••••••" required>
                <button type="button" class="password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-primary-custom">
            <i class="fas fa-sign-in-alt me-2"></i>Login
        </button>
    </form>

    <div class="links-section text-center mt-4">
        <p class="mb-2 text-muted small">Belum punya akun? <a href="{{ route('register') }}" class="text-success fw-bold">Daftar di sini</a></p>
        <a href="{{ url('/') }}" class="text-secondary small">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
        </a>
    </div>
@endsection