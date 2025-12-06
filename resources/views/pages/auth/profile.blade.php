@extends('layouts.guest')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Profil Saya</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                <div class="card-body p-5">
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-5">
                            <div class="position-relative d-inline-block">
                                {{-- Preview Gambar --}}
                                <img src="{{ Auth::user()->avatar_url }}" 
                                     alt="Profile" 
                                     class="rounded-circle border border-3 border-white shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     id="avatarPreview">
                                
                                {{-- Tombol Kamera --}}
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow" style="cursor: pointer; width: 40px; height: 40px;">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                            <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection