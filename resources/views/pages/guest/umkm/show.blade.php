@extends('layouts.guest')

@section('title', $umkm->nama_usaha)

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $umkm->nama_usaha }}</h4>
                            <a href="{{ route('umkm.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                       
                        <!-- Gallery UMKM -->
@if($umkm->media->count() > 0)
<div class="mb-4">
    <h5 class="text-dark mb-3"><i class="fas fa-images me-2"></i>Gallery UMKM</h5>
    <div class="row">
        @foreach($umkm->media as $media)
        <div class="col-md-4 mb-3">
            <div class="card file-card h-100">
                <div class="card-body text-center">
                    @if(Str::startsWith($media->mime_type, 'image/'))
                        <img src="{{ Storage::url('public/uploads/' . $media->file_name) }}" 
                             class="img-thumbnail mb-2" style="height: 120px; object-fit: cover; width: 100%;"
                             alt="{{ $media->caption }}">
                    @else
                        <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                    @endif
                    <p class="small mb-0 text-truncate" title="{{ $media->caption }}">
                        {{ $media->caption }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<hr>
@endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i class="fas fa-user me-2"></i>Pemilik:</strong><br>
                                    {{ $umkm->pemilik->nama ?? '-' }}
                                </div>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-tag me-2"></i>Kategori:</strong><br>
                                    <span class="badge bg-primary">{{ $umkm->kategori }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-map-marker-alt me-2"></i>Alamat:</strong><br>
                                    {{ $umkm->alamat }}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i class="fas fa-map me-2"></i>RT/RW:</strong><br>
                                    {{ $umkm->rt }}/{{ $umkm->rw }}
                                </div>
                                
                                <div class="mb-3">
                                    <strong><i class="fas fa-phone me-2"></i>Kontak:</strong><br>
                                    {{ $umkm->kontak }}
                                </div>
                            </div>
                        </div>

                        @if($umkm->deskripsi)
                        <div class="mb-3">
                            <strong><i class="fas fa-info-circle me-2"></i>Deskripsi:</strong><br>
                            <p class="mt-2">{{ $umkm->deskripsi }}</p>
                        </div>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="{{ route('umkm.edit', $umkm->umkm_id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('umkm.destroy', $umkm->umkm_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Yakin ingin menghapus UMKM {{ $umkm->nama_usaha }}?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.file-card {
    transition: transform 0.2s;
}

.file-card:hover {
    transform: translateY(-5px);
}

.badge {
    font-size: 0.9em;
    padding: 8px 12px;
}
</style>
@endsection