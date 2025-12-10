<!-- resources/views/pages/guest/warga/show.blade.php -->
@extends('layouts.guest')

@section('title', $warga->nama)

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
                                        @if($warga->media->count() > 0 && $warga->media->where('mime_type', 'like', 'image/%')->first())
                                            @php
                                                $firstImage = $warga->media->where('mime_type', 'like', 'image/%')->first();
                                            @endphp
                                            <img src="{{ asset('storage/media/' . $firstImage->file_name) }}" 
                                                 class="rounded-circle border border-4 border-white shadow-lg" 
                                                 style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 10px 25px rgba(0,0,0,0.25) !important;" 
                                                 alt="{{ $warga->nama }}"
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
                                            {{ $warga->nama }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                                <i class="fas fa-user-tag me-2"></i>{{ ucfirst($warga->role) }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                                <i class="fas fa-id-card me-2"></i>
                                                KTP: {{ $warga->no_ktp }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('warga.index') }}" class="btn btn-light btn-lg px-4 py-3 rounded-4 shadow-lg" 
                                   style="box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-lg px-4 py-3 rounded-4 shadow-lg"
                                   style="background: linear-gradient(135deg, #F6B35C, #F8C471); border: none; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Body with Enhanced Shadows -->
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <!-- Informasi Warga -->
                        <div class="row g-4 mb-5">
                            <!-- Informasi Dasar -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-right"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #F6B35C; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Informasi Pribadi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-id-card text-primary me-2"></i>
                                            <span class="fw-bold">No KTP: </span>
                                            <span>{{ $warga->no_ktp }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-user text-primary me-2"></i>
                                            <span class="fw-bold">Nama Lengkap: </span>
                                            <span>{{ $warga->nama }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-venus-mars text-primary me-2"></i>
                                            <span class="fw-bold">Jenis Kelamin: </span>
                                            <span class="badge bg-primary">{{ $warga->jenis_kelamin }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-pray text-primary me-2"></i>
                                            <span class="fw-bold">Agama: </span>
                                            <span>{{ $warga->agama }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-user-tag text-primary me-2"></i>
                                            <span class="fw-bold">Role: </span>
                                            <span class="badge bg-primary">{{ ucfirst($warga->role) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak & Pekerjaan -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-left"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: #118AB2; box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                            <i class="fas fa-address-book text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Kontak & Pekerjaan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-briefcase text-success me-2"></i>
                                            <span class="fw-bold">Pekerjaan: </span>
                                            <span>{{ $warga->pekerjaan }}</span>
                                        </div>
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-phone text-success me-2"></i>
                                            <span class="fw-bold">Telepon: </span>
                                            <a href="tel:{{ $warga->telp }}" class="text-decoration-none">{{ $warga->telp }}</a>
                                        </div>
                                        @if($warga->email)
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-envelope text-success me-2"></i>
                                            <span class="fw-bold">Email: </span>
                                            <a href="mailto:{{ $warga->email }}" class="text-decoration-none">{{ $warga->email }}</a>
                                        </div>
                                        @endif
                                        <div class="detail-item mb-3">
                                            <i class="fas fa-calendar text-success me-2"></i>
                                            <span class="fw-bold">Terdaftar Sejak: </span>
                                            <span>{{ $warga->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-file-alt text-success me-2"></i>
                                            <span class="fw-bold">Total File: </span>
                                            <span class="badge bg-success">{{ $warga->media->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UMKM Milik Warga -->
                        @if($warga->umkm->count() > 0)
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-store me-3"></i>UMKM Milik Warga
                                </h2>
                                <p class="text-muted">Daftar usaha yang dimiliki oleh {{ $warga->nama }}</p>
                            </div>
                            
                            <div class="row g-4">
                                @foreach($warga->umkm as $umkm)
                                <div class="col-md-6 col-lg-4">
                                    <div class="umkm-card glass-card shadow-lg" 
                                         style="box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-radius: 15px;">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary mb-3">
                                                <i class="fas fa-store me-2"></i>{{ $umkm->nama_usaha }}
                                            </h5>
                                            <p class="card-text mb-2">
                                                <i class="fas fa-tag me-2 text-muted"></i>
                                                <small>Kategori: {{ $umkm->kategori }}</small>
                                            </p>
                                            <p class="card-text mb-3">
                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                <small>{{ $umkm->alamat }}</small>
                                            </p>
                                            <a href="{{ route('umkm.show', $umkm->umkm_id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Gallery Section -->
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-images me-3"></i>Dokumen & Foto Warga
                                </h2>
                                <p class="text-muted">Koleksi dokumen dan foto dari {{ $warga->nama }}</p>
                            </div>
                            
                            @if($warga->media->count() > 0)
                                <div class="row g-4">
                                    @foreach($warga->media as $media)
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
                                    <p class="text-muted mb-4">Warga ini belum mengupload dokumen atau foto</p>
                                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-primary btn-lg px-4 py-3 rounded-4 shadow-lg"
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
                                    <a href="{{ route('warga.edit', $warga->warga_id) }}" 
                                       class="btn btn-warning px-5 py-3 rounded-4 shadow-lg"
                                       style="background: linear-gradient(135deg, #F6B35C, #F8C471); border: none; box-shadow: 0 12px 25px rgba(246, 179, 92, 0.4) !important;">
                                        <i class="fas fa-edit me-2"></i> Edit Data Warga
                                    </a>
                                    <a href="{{ route('warga.index') }}" 
                                       class="btn btn-secondary px-5 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 12px 25px rgba(108, 117, 125, 0.4) !important;">
                                        <i class="fas fa-list me-2"></i> Lihat Semua Warga
                                    </a>
                                </div>
                                
                                <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-5 py-3 rounded-4 shadow-lg"
                                            style="background: linear-gradient(135deg, #dc3545, #c82333); border: none; box-shadow: 0 12px 25px rgba(220, 53, 69, 0.4) !important;" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Warga
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
                                Data Warga terlindungi
                                <span class="mx-2">•</span>
                                <i class="far fa-clock me-2 text-secondary"></i>
                                Terakhir diperbarui: {{ $warga->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles for Warga Detail Page */
:root {
    --primary: #F6B35C;
    --secondary: #118AB2;
    --accent: #C2185B;
    --yellow: #F1D166;
    --white: #FFFFFF;
    --light: #F8F9FA;
    --dark: #343A40;
    --glass-bg: rgba(255, 255, 255, 0.95);
    --glass-border: rgba(255, 255, 255, 0.4);
}

.glass-card {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 30px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.glass-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2) !important;
    border-color: var(--primary);
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.text-gradient {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 800;
}

.detail-item {
    background: white;
    padding: 12px 15px;
    border-radius: 10px;
    border-left: 4px solid var(--primary);
    margin-bottom: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    transition: all 0.3s ease;
}

.detail-item:hover {
    transform: translateX(5px);
    box-shadow: 0 8px 20px rgba(246, 179, 92, 0.2) !important;
}

.umkm-card {
    transition: all 0.3s ease;
}

.umkm-card:hover {
    transform: translateY(-5px);
    border-color: var(--secondary);
}

.gallery-item {
    cursor: pointer;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.25) !important;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 20px;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.overlay-content {
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.gallery-item:hover .overlay-content {
    transform: translateY(0);
}

.empty-state {
    background: white;
    border-radius: 20px;
    border: 2px dashed var(--primary);
}

.btn {
    transition: all 0.3s ease !important;
}

.btn:hover {
    transform: translateY(-3px) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header h1 {
        font-size: 2rem !important;
    }
    
    .glass-card {
        padding: 20px;
    }
    
    .btn-group-vertical {
        width: 100%;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .action-section .d-flex {
        flex-direction: column !important;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .icon-circle {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .profile-picture img,
    .profile-picture div {
        width: 80px !important;
        height: 80px !important;
    }
}
</style>

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus Warga {{ $warga->nama }}?\\n\\nTindakan ini tidak dapat dibatalkan!');
}

// Add animation to cards on load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.info-card, .gallery-item, .umkm-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endsection