@extends('layouts.guest.app')

@section('title', $user->name)

@section('content')
<div class="container-fluid py-5">
    <!-- Background Pattern -->
    <div class="pattern-dots position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; opacity: 0.05;"></div>
    
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-11 col-xl-10 mx-auto">
                <!-- Main Card with Enhanced Shadow -->
                <div class="card border-0 overflow-hidden" 
                     style="border-radius: 30px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15), 0 15px 30px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Enhanced Gradient Header -->
                    <div class="card-header py-5 px-4 px-lg-5 position-relative" 
                         style="background: linear-gradient(135deg, #F6B35C 0%, #118AB2 100%);">
                         <!-- Header Shadow -->
                         <div class="position-absolute top-0 start-0 w-100 h-100" 
                              style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                         
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 position-relative">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <!-- Foto Profil -->
                                    <div class="profile-picture">
                                        @if($user->media->count() > 0 && $user->media->where('mime_type', 'like', 'image/%')->first())
                                            @php
                                                $firstImage = $user->media->where('mime_type', 'like', 'image/%')->first();
                                            @endphp
                                            <img src="{{ asset('storage/media/' . $firstImage->file_name) }}" 
                                                 class="rounded-circle border border-4 border-white shadow-lg" 
                                                 style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 10px 25px rgba(0,0,0,0.25) !important;" 
                                                 alt="{{ $user->name }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                        @else
                                            <div class="rounded-circle border border-4 border-white d-inline-flex align-items-center justify-content-center bg-white shadow-lg" 
                                                 style="width: 100px; height: 100px; box-shadow: 0 10px 25px rgba(0,0,0,0.25) !important;">
                                                <i class="fas fa-user fa-3x text-primary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h1 class="text-white mb-2" style="font-weight: 900; font-size: 2.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                            {{ $user->name }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                                <i class="fas fa-user-tag me-2"></i>{{ ucfirst($user->role) }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                                <i class="fas fa-calendar me-2"></i>
                                                Bergabung: {{ $user->created_at->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('user.index') }}" class="btn btn-light btn-lg px-4 py-3 rounded-4 shadow-lg" 
                                   style="box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <!-- <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-lg px-4 py-3 rounded-4 shadow-lg"
                                   style="background: linear-gradient(135deg, #F6B35C, #F8C471); border: none; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Body with Enhanced Shadows -->
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <!-- Informasi User -->
                        <div class="row g-4 mb-5">
                            <!-- Informasi Dasar -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-right"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #F6B35C; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Informasi User</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-user text-primary me-2"></i>
                                            <span class="fw-bold">Nama Lengkap: </span>
                                            <span>{{ $user->name }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <span class="fw-bold">Email: </span>
                                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-user-tag text-primary me-2"></i>
                                            <span class="fw-bold">Role: </span>
                                            <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-id-card text-primary me-2"></i>
                                            <span class="fw-bold">ID User: </span>
                                            <span class="font-monospace">{{ $user->id }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Aktivitas -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-left"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #118AB2; box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                            <i class="fas fa-chart-line text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Status & Aktivitas</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-clock text-success me-2"></i>
                                            <span class="fw-bold">Terdaftar Sejak: </span>
                                            <span>{{ $user->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-sync-alt text-success me-2"></i>
                                            <span class="fw-bold">Terakhir Update: </span>
                                            <span>{{ $user->updated_at->translatedFormat('d F Y H:i') }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-file-alt text-success me-2"></i>
                                            <span class="fw-bold">Total File: </span>
                                            <span class="badge bg-success">{{ $user->media->count() }}</span>
                                        </div>
                                        @if($user->email_verified_at)
                                        <div class="detail-item">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <span class="fw-bold">Email Terverifikasi: </span>
                                            <span class="badge bg-success">Ya</span>
                                        </div>
                                        @else
                                        <div class="detail-item">
                                            <i class="fas fa-times-circle text-danger me-2"></i>
                                            <span class="fw-bold">Email Terverifikasi: </span>
                                            <span class="badge bg-danger">Belum</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Section -->
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-images me-3"></i>Gallery User
                                </h2>
                                <p class="text-muted">Koleksi gambar dan dokumen dari {{ $user->name }}</p>
                            </div>
                            
                            @if($user->media->count() > 0)
                                <div class="row g-4">
                                    @foreach($user->media as $media)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="gallery-item position-relative shadow-lg" 
                                             style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;">
                                            @if(Str::startsWith($media->mime_type, 'image/'))
                                                <img src="{{ asset('storage/media/' . $media->file_name) }}" 
                                                     class="img-fluid w-100" 
                                                     style="height: 200px; object-fit: cover;"
                                                     alt="{{ $media->caption }}"
                                                     onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                                <div class="gallery-overlay">
                                                    <div class="overlay-content">
                                                        <h6 class="text-white mb-2">{{ $media->caption }}</h6>
                                                        <small class="text-light">Gambar</small>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="file-card h-100 d-flex flex-column align-items-center justify-content-center p-4 shadow-sm"
                                                     style="background: white; border-radius: 20px; min-height: 200px; box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;">
                                                    <i class="fas fa-file fa-4x text-primary mb-3"></i>
                                                    <h6 class="text-center mb-2">{{ $media->caption }}</h6>
                                                    <small class="text-muted">
                                                        {{ Str::upper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state text-center py-5 shadow-lg" 
                                     style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;">
                                    <div class="empty-icon mb-4">
                                        <i class="fas fa-image fa-4x text-muted"></i>
                                    </div>
                                    <h4 class="text-muted mb-3">Belum ada File</h4>
                                    <p class="text-muted mb-4">User ini belum mengupload file atau gambar</p>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-lg px-4 py-3 rounded-4 shadow-lg"
                                       style="background: linear-gradient(135deg, #F6B35C, #118AB2); border: none; box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                        <i class="fas fa-upload me-2"></i> Upload File
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-section mt-5 pt-5 border-top" data-aos="fade-up">
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
                                <div class="btn-group-vertical btn-group-lg gap-3">
                                    <!-- <a href="{{ route('user.edit', $user->id) }}" 
                                       class="btn btn-warning px-5 py-3 rounded-4 shadow-lg"
                                       style="background: linear-gradient(135deg, #F6B35C, #F8C471); border: none; box-shadow: 0 12px 25px rgba(246, 179, 92, 0.4) !important;">
                                        <i class="fas fa-edit me-2"></i> Edit Data User
                                    </a> -->
                                    <a href="{{ route('user.index') }}" 
                                       class="btn btn-secondary px-5 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 12px 25px rgba(108, 117, 125, 0.4) !important;">
                                        <i class="fas fa-list me-2"></i> Lihat Semua User
                                    </a>
                                </div>
                                
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-5 py-3 rounded-4 shadow-lg"
                                            style="background: linear-gradient(135deg, #dc3545, #c82333); border: none; box-shadow: 0 12px 25px rgba(220, 53, 69, 0.4) !important;" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus User
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="card-footer bg-white py-4 text-center shadow-lg"
                         style="box-shadow: 0 -5px 20px rgba(0,0,0,0.05) !important;">
                        <div class="footer-info">
                            <p class="mb-0 text-muted">
                                <i class="fas fa-shield-alt me-2 text-primary"></i>
                                Data User terlindungi
                                <span class="mx-2">•</span>
                                <i class="far fa-clock me-2 text-secondary"></i>
                                Terakhir dilihat: {{ now()->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus User {{ $user->name }}?\\n\\nTindakan ini tidak dapat dibatalkan!');
}

// Add animation to cards on load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.info-card, .gallery-item');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});

// Add hover effects dynamically
document.querySelectorAll('.info-card, .gallery-item, .btn').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
    });
});
</script>
@endsection