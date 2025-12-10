@extends('layouts.guest')

@section('title', $produk->nama_produk)

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
                         style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                         <!-- Header Shadow -->
                         <div class="position-absolute top-0 start-0 w-100 h-100" 
                              style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                         
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 position-relative">
                            <div class="text-center text-md-start">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-wrapper shadow-lg" 
                                         style="background: rgba(255,255,255,0.25); padding: 15px; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                                        <i class="fas fa-box fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-white mb-2" style="font-weight: 900; font-size: 2.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                            {{ $produk->nama_produk }}
                                        </h1>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge shadow-lg bg-white text-primary px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;">
                                                <i class="fas fa-tag me-2"></i>{{ $produk->jenis_produk }}
                                            </span>
                                            <span class="badge shadow-lg bg-light text-dark px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;">
                                                <i class="fas fa-store me-2"></i>
                                                {{ $produk->umkm->nama_usaha ?? 'Tidak diketahui' }}
                                            </span>
                                            <span class="badge shadow-lg {{ $produk->status == 'Aktif' ? 'bg-success' : 'bg-danger' }} text-white px-3 py-2 fs-6" 
                                                  style="font-weight: 600; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;">
                                                {{ $produk->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg px-4 py-3 rounded-4 shadow-lg" 
                                   style="box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <a href="{{ route('produk.edit', $produk->produk_id) }}" class="btn btn-warning btn-lg px-4 py-3 rounded-4 shadow-lg"
                                   style="background: linear-gradient(135deg, var(--primary), #F8C471); border: none; box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Body with Enhanced Shadows -->
                    <div class="card-body p-4 p-lg-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <!-- Main Product Image -->
                        <!-- <div class="text-center mb-5 py-4">
                            <div class="main-product-image position-relative d-inline-block" 
                                 style="width: 250px; height: 250px;">
                                @if($produk->media->count() > 0 && $produk->media->where('mime_type', 'like', 'image/%')->first())
                                    @php
                                        $firstImage = $produk->media->where('mime_type', 'like', 'image/%')->first();
                                    @endphp
                                    <img src="{{ asset('storage/media/' . $firstImage->file_name) }}" 
                                         class="img-fluid rounded-4 shadow-xxl" 
                                         style="width: 100%; height: 100%; object-fit: cover; border: 5px solid white; box-shadow: 0 20px 40px rgba(0,0,0,0.25);"
                                         alt="{{ $produk->nama_produk }}"
                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'">
                                @else
                                    Placeholder untuk produk tanpa gambar 
                                    <div class="product-placeholder w-100 h-100 rounded-4 d-flex align-items-center justify-content-center text-white shadow-xxl"
                                         style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: 5px solid white; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
                                        <i class="fas fa-box fa-4x"></i>
                                    </div>
                                @endif
                            </div>
                        </div> -->

                        <!-- Information Grid with Stronger Shadows -->
                        <div class="row g-4 mb-5">
                            <!-- UMKM Pemilik Card -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-right"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: var(--primary); box-shadow: 0 8px 20px rgba(246, 179, 92, 0.4) !important;">
                                            <i class="fas fa-store text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">UMKM Pemilik</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="avatar-placeholder shadow-lg" style="background: var(--yellow); box-shadow: 0 8px 20px rgba(241, 209, 102, 0.4) !important;">
                                                <i class="fas fa-building fa-2x text-white"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1">{{ $produk->umkm->nama_usaha ?? 'Tidak diketahui' }}</h4>
                                                <p class="text-muted mb-0">Pemilik: {{ $produk->umkm->pemilik->nama ?? '-' }}</p>
                                            </div>
                                        </div>
                                        @if($produk->umkm && $produk->umkm->kontak)
                                        <div class="detail-item mt-4 p-3 shadow-sm" 
                                             style="background: white; border-radius: 12px; border-left: 4px solid var(--primary); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <span class="fw-bold">Kontak UMKM: </span>
                                            <span class="font-monospace">{{ $produk->umkm->kontak }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Produk Card -->
                            <div class="col-lg-6">
                                <div class="info-card glass-card h-100 shadow-lg" data-aos="fade-left"
                                     style="box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;">
                                    <div class="card-header bg-transparent border-0 d-flex align-items-center gap-3 mb-4">
                                        <div class="icon-circle shadow-lg" style="background: var(--secondary); box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                        <h3 class="mb-0 text-gradient">Detail Produk</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="fw-bold text-muted">Harga:</span>
                                                    <span class="fs-4 fw-bold" style="color: var(--primary);">
                                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-item-small p-3 shadow-sm" style="background: white; border-radius: 10px;">
                                                    <i class="fas fa-cubes text-primary me-2"></i>
                                                    <span class="fw-bold">Stok:</span>
                                                    <span class="badge {{ $produk->stok > 0 ? 'bg-success' : 'bg-danger' }} ms-2">
                                                        {{ $produk->stok }} pcs
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-item-small p-3 shadow-sm" style="background: white; border-radius: 10px;">
                                                    <i class="fas fa-chart-line text-primary me-2"></i>
                                                    <span class="fw-bold">Status:</span>
                                                    <span class="badge {{ $produk->status == 'Aktif' ? 'bg-success' : 'bg-danger' }} ms-2">
                                                        {{ $produk->status }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Section - SAMA SEPERTI UMKM -->
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-5">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-images me-3"></i>Gallery Produk
                                </h2>
                                <p class="text-muted">Koleksi gambar produk {{ $produk->nama_produk }}</p>
                            </div>
                            
                            @if($produk->media->count() > 0)
                                <div class="row g-4">
                                    @foreach($produk->media as $media)
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
                                                        <small class="text-light">Foto Produk</small>
                                                    </div>
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
                                    <p class="text-muted mb-4">Produk ini belum mengupload file atau gambar</p>
                                    <a href="{{ route('produk.edit', $produk->produk_id) }}" class="btn btn-primary btn-lg px-4 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 8px 20px rgba(17, 138, 178, 0.4) !important;">
                                        <i class="fas fa-upload me-2"></i> Upload File
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Deskripsi Section -->
                        @if($produk->deskripsi)
                        <div class="mb-5" data-aos="fade-up">
                            <div class="section-header mb-4">
                                <h2 class="text-gradient mb-3">
                                    <i class="fas fa-file-alt me-3"></i>Deskripsi Produk
                                </h2>
                            </div>
                            <div class="deskripsi-card glass-card p-5 shadow-lg"
                                 style="box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;">
                                <div class="quote-icon mb-4">
                                    <i class="fas fa-quote-left fa-2x text-primary"></i>
                                </div>
                                <p class="fs-5 lh-lg text-dark mb-4" style="font-style: italic;">
                                    {{ $produk->deskripsi }}
                                </p>
                                <div class="text-end">
                                    <i class="fas fa-quote-right fa-2x text-secondary"></i>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="action-section mt-5 pt-5 border-top" data-aos="fade-up">
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
                                <div class="btn-group-vertical btn-group-lg gap-3">
                                    <a href="{{ route('produk.edit', $produk->produk_id) }}" 
                                       class="btn btn-warning px-5 py-3 rounded-4 shadow-lg"
                                       style="background: linear-gradient(135deg, var(--primary), #F8C471); border: none; box-shadow: 0 12px 25px rgba(246, 179, 92, 0.4) !important;">
                                        <i class="fas fa-edit me-2"></i> Edit Produk
                                    </a>
                                    <a href="{{ route('produk.index') }}" 
                                       class="btn btn-secondary px-5 py-3 rounded-4 shadow-lg"
                                       style="box-shadow: 0 12px 25px rgba(108, 117, 125, 0.4) !important;">
                                        <i class="fas fa-list me-2"></i> Lihat Semua Produk
                                    </a>
                                </div>
                                
                                <form action="{{ route('produk.destroy', $produk->produk_id) }}" method="POST" 
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-5 py-3 rounded-4 shadow-lg"
                                            style="box-shadow: 0 12px 25px rgba(220, 53, 69, 0.4) !important;" 
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Produk
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
                                Produk UMKM terlindungi dan terverifikasi
                                <span class="mx-2">•</span>
                                <i class="far fa-clock me-2 text-secondary"></i>
                                Terakhir diperbarui: {{ $produk->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles for Produk Detail Page */
:root {
    --primary: #F6B35C;
    --secondary: #118AB2;
    --accent: #C2185B;
    --yellow: #F1D166;
    --white: #FFFFFF;
    --light: #F8F9FA;
    --dark: #343A40;
    --darker: #1a1a2e;
    --glass-bg: rgba(255, 255, 255, 0.95);
    --glass-border: rgba(255, 255, 255, 0.4);
}

.card {
    border: none;
    backdrop-filter: blur(10px);
}

.shadow-xxl {
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2) !important;
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

.avatar-placeholder {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
}

.detail-item {
    background: white;
    padding: 15px;
    border-radius: 12px;
    border-left: 4px solid var(--primary);
}

.detail-item-small {
    background: white;
    padding: 12px;
    border-radius: 10px;
    border-left: 3px solid var(--secondary);
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

.deskripsi-card {
    background: linear-gradient(135deg, rgba(246, 179, 92, 0.1), rgba(17, 138, 178, 0.1));
    border: 1px solid rgba(246, 179, 92, 0.2);
}

.delete-form .btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    border: none;
    transition: all 0.3s ease;
}

.delete-form .btn-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(220, 53, 69, 0.5) !important;
}

.btn {
    transition: all 0.3s ease !important;
}

.btn:hover {
    transform: translateY(-3px) !important;
}

/* Enhanced Shadows for Depth */
.info-card, .gallery-item, .deskripsi-card, .empty-state {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

/* Hover Effects */
.info-card:hover, .gallery-item:hover {
    box-shadow: 0 25px 50px rgba(0,0,0,0.25) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header h1 {
        font-size: 2rem !important;
    }
    
    .main-product-image {
        width: 200px !important;
        height: 200px !important;
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
    
    .info-card {
        margin-bottom: 20px;
    }
    
    .detail-item-small {
        margin-bottom: 10px;
    }
}
</style>

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus produk {{ $produk->nama_produk }}?\\n\\nTindakan ini tidak dapat dibatalkan!');
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