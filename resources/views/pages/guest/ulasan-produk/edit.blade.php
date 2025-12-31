@extends('layouts.guest.app')

@section('title', 'Edit Ulasan Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Edit Ulasan Produk</h1>
        <p class="text-white lead">Form edit data ulasan produk</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-4">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Ulasan Produk</h5>
                    </div>
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal Update!</strong> Periksa inputan berikut:
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('ulasan-produk.update', $ulasanProduk->ulasan_id) }}" method="POST" id="ulasanForm">
                            @csrf
                            @method('PUT')

                            <!-- Warga -->
                            <div class="mb-4">
                                <label for="warga_id" class="form-label">Warga <span class="text-danger">*</span></label>
                                <select class="form-select @error('warga_id') is-invalid @enderror" 
                                        id="warga_id" name="warga_id" required>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" 
                                            {{ old('warga_id', $ulasanProduk->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} 
                                            @if($w->email)
                                                ({{ $w->email }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Produk -->
                            <div class="mb-4">
                                <label for="produk_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                <select class="form-select @error('produk_id') is-invalid @enderror" 
                                        id="produk_id" name="produk_id" required>
                                    @foreach($produk as $p)
                                        <option value="{{ $p->produk_id }}" 
                                            {{ old('produk_id', $ulasanProduk->produk_id) == $p->produk_id ? 'selected' : '' }}>
                                            {{ $p->nama_produk }} 
                                            ({{ $p->umkm->nama_usaha ?? '-' }}) 
                                            - Rp {{ number_format($p->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div class="mb-4">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <div class="rating-input mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                               {{ old('rating', $ulasanProduk->rating) == $i ? 'checked' : '' }} class="d-none">
                                        <label for="star{{ $i }}" class="star-label" data-value="{{ $i }}">
                                            <i class="far fa-star fa-2x"></i>
                                            <i class="fas fa-star fa-2x"></i>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">Rating saat ini: {{ $ulasanProduk->rating }}/5</small>
                                    <div id="rating-description" class="fst-italic text-muted"></div>
                                </div>
                            </div>

                            <!-- Komentar -->
                            <div class="mb-4">
                                <label for="komentar" class="form-label">Komentar</label>
                                <textarea class="form-control @error('komentar') is-invalid @enderror" 
                                          id="komentar" name="komentar" rows="4" 
                                          placeholder="Tuliskan komentar tentang produk ini..."
                                          maxlength="1000">{{ old('komentar', $ulasanProduk->komentar) }}</textarea>
                                @error('komentar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">Maksimal 1000 karakter. <span id="char-count">0/1000</span></small>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning flex-grow-1">
                                    <i class="fas fa-save me-2"></i> Update Ulasan
                                </button>
                                <a href="{{ route('ulasan-produk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');
    const ratingDescription = document.getElementById('rating-description');
    
    // Rating descriptions
    const ratingDescriptions = {
        1: "Sangat Buruk - Produk tidak sesuai ekspektasi",
        2: "Buruk - Produk memiliki banyak kekurangan",
        3: "Cukup - Produk biasa saja, sesuai harga",
        4: "Baik - Produk berkualitas, rekomendasi",
        5: "Sangat Baik - Produk luar biasa, sangat direkomendasikan"
    };

    // Update char count
    function updateCharCount() {
        const length = komentarTextarea.value.length;
        charCount.textContent = `${length}/1000`;
        
        if (length > 1000) {
            charCount.classList.add('text-danger');
            charCount.classList.remove('text-muted');
        } else {
            charCount.classList.remove('text-danger');
            charCount.classList.add('text-muted');
        }
    }

    // Update rating description
    function updateRatingDescription() {
        const selectedRating = document.querySelector('input[name="rating"]:checked');
        if (selectedRating) {
            const value = selectedRating.value;
            ratingDescription.textContent = ratingDescriptions[value];
            ratingDescription.classList.remove('text-muted');
            ratingDescription.classList.add('text-warning');
        } else {
            ratingDescription.textContent = '';
        }
    }

    // Star click handlers
    document.querySelectorAll('.star-label').forEach(label => {
        label.addEventListener('click', function() {
            const value = this.dataset.value;
            
            // Update all stars
            document.querySelectorAll('.star-label').forEach((star, index) => {
                const starId = index + 1;
                const starInput = document.getElementById(`star${starId}`);
                
                if (starId <= value) {
                    starInput.checked = true;
                }
            });
            
            updateRatingDescription();
        });
    });

    // Event listeners
    komentarTextarea.addEventListener('input', updateCharCount);
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', updateRatingDescription);
    });

    // Initial update
    updateCharCount();
    updateRatingDescription();
});
</script>
@endsection