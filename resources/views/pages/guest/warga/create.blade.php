<!-- resources/views/warga/create.blade.php -->
@extends('layouts.guest')

@section('title', 'Tambah Data Warga')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Data Warga</h1>
        <p class="text-white lead">Form pendaftaran warga baru</p>
    </div>
</div>

<div class="container-fluid py-5">
    <!-- <div class="container"> -->
        {{-- Tambahkan style inline atau class baru --}}
<div class="form-container" style="position: relative; z-index: 10; background: white; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Form Tambah Data Warga Baru</h5>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('warga.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" 
                                               placeholder="Masukkan nomor KTP" required>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Nomor KTP harus unik dan belum terdaftar.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama') }}" 
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                                id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('agama') is-invalid @enderror" 
                                               id="agama" name="agama" value="{{ old('agama') }}" 
                                               placeholder="Masukkan agama" required>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" 
                                               placeholder="Masukkan pekerjaan" required>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="telp" class="form-label">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                                               id="telp" name="telp" value="{{ old('telp') }}" 
                                               placeholder="Masukkan nomor telepon" required>
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Masukkan email (opsional)">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Email bersifat opsional untuk komunikasi.</div>
                            </div>
                            
                            <div class="mb-4">
    <label for="role" class="form-label">Role  <span class="text-danger">*</span></label>
    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User </option>
        <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga </option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Data
                                </button>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-auto">
                                    <i class="fas fa-redo me-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection