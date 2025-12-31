@extends('layouts.guest.app')

@section('title', 'Tambah Ulasan Produk')

@section('content')
<div class="container-fluid page-header py-5">
    <div class="container text-center">
        <h1 class="text-white display-4">Tambah Ulasan Produk</h1>
        <p class="text-white lead">Form tambah ulasan produk dari warga</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h5 class="mb-0 text-white"><i class="fas fa-plus-circle me-2"></i>Form Tambah Ulasan Produk</h5>
                    </div>
                    <div class="card-body p-5">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('ulasan-produk.store') }}" method="POST" id="ulasanForm">
                            @csrf
                            
                            <!-- Warga -->
                            <div class="mb-4">
                                <label for="warga_id" class="form-label">Pilih Warga <span class="text-danger">*</span></label>
                                <select class="form-select @error('warga_id') is-invalid @enderror" 
                                        id="warga_id" name="warga_id" required>
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" 
                                                data-email="{{ $w->email ?? '-' }}"
                                                {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
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
                                <div class="mt-2">
                                    <small class="text-muted">Email: <span id="selected-email">-</span></small>
                                </div>
                            </div>

                            <!-- Produk -->
                            <div class="mb-4">
                                <label for="produk_id" class="form-label">Pilih Produk <span class="text-danger">*</span></label>
                                <select class="form-select @error('produk_id') is-invalid @enderror" 
                                        id="produk_id" name="produk_id" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produk as $p)
                                        <option value="{{ $p->produk_id }}" 
                                                data-harga="{{ $p->harga }}"
                                                data-jenis="{{ $p->jenis_produk }}"
                                                data-umkm="{{ $p->umkm->nama_usaha ?? '-' }}"
                                                {{ old('produk_id') == $p->produk_id ? 'selected' : '' }}>
                                            {{ $p->nama_produk }} 
                                            ({{ $p->jenis_produk }}) - 
                                            {{ $p->umkm->nama_usaha ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('produk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">
                                        UMKM: <span id="selected-umkm">-</span> | 
                                        Jenis: <span id="selected-jenis">-</span> | 
                                        Harga: <span id="selected-harga">Rp 0</span>
                                    </small>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="mb-4">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <div class="rating-input mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                               {{ old('rating') == $i ? 'checked' : '' }} class="d-none">
                                        <label for="star{{ $i }}" class="star-label" data-value="{{ $i }}">
                                            <i class="far fa-star fa-2x"></i>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">Pilih rating dari 1 (sangat buruk) sampai 5 (sangat baik)</small>
                                    <div id="rating-description" class="fst-italic text-muted"></div>
                                </div>
                            </div>

                            <!-- Komentar -->
                            <div class="mb-4">
                                <label for="komentar" class="form-label">Komentar</label>
                                <textarea class="form-control @error('komentar') is-invalid @enderror" 
                                          id="komentar" name="komentar" rows="4" 
                                          placeholder="Tuliskan komentar tentang produk ini..."
                                          maxlength="1000">{{ old('komentar') }}</textarea>
                                @error('komentar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <small class="text-muted">Maksimal 1000 karakter. <span id="char-count">0/1000</span></small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Ulasan
                                </button>
                                <a href="{{ route('ulasan-produk.index') }}" class="btn btn-secondary btn-lg">
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



<script>
document.addEventListener('DOMContentLoaded', function() {
    const wargaSelect = document.getElementById('warga_id');
    const produkSelect = document.getElementById('produk_id');
    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');
    const selectedEmail = document.getElementById('selected-email');
    const selectedUmkm = document.getElementById('selected-umkm');
    const selectedJenis = document.getElementById('selected-jenis');
    const selectedHarga = document.getElementById('selected-harga');
    const ratingDescription = document.getElementById('rating-description');
    
    // Rating descriptions
    const ratingDescriptions = {
        1: "Sangat Buruk - Produk tidak sesuai ekspektasi",
        2: "Buruk - Produk memiliki banyak kekurangan",
        3: "Cukup - Produk biasa saja, sesuai harga",
        4: "Baik - Produk berkualitas, rekomendasi",
        5: "Sangat Baik - Produk luar biasa, sangat direkomendasikan"
    };

    // Update selected email
    function updateSelectedEmail() {
        const selectedOption = wargaSelect.options[wargaSelect.selectedIndex];
        selectedEmail.textContent = selectedOption.dataset.email || '-';
    }

    // Update product info
    function updateProductInfo() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        if (selectedOption.value) {
            const harga = selectedOption.dataset.harga;
            const jenis = selectedOption.dataset.jenis;
            const umkm = selectedOption.dataset.umkm;
            
            selectedUmkm.textContent = umkm;
            selectedJenis.textContent = jenis;
            selectedHarga.textContent = 'Rp ' + parseFloat(harga).toLocaleString('id-ID');
        } else {
            selectedUmkm.textContent = '-';
            selectedJenis.textContent = '-';
            selectedHarga.textContent = 'Rp 0';
        }
    }

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
    wargaSelect.addEventListener('change', updateSelectedEmail);
    produkSelect.addEventListener('change', updateProductInfo);
    komentarTextarea.addEventListener('input', updateCharCount);
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', updateRatingDescription);
    });

    // Form validation
    document.getElementById('ulasanForm').addEventListener('submit', function(e) {
        const rating = document.querySelector('input[name="rating"]:checked');
        
        if (!rating) {
            alert('Pilih rating terlebih dahulu');
            e.preventDefault();
            return;
        }
        
        if (!wargaSelect.value) {
            alert('Pilih warga terlebih dahulu');
            e.preventDefault();
            return;
        }
        
        if (!produkSelect.value) {
            alert('Pilih produk terlebih dahulu');
            e.preventDefault();
            return;
        }
    });

    // Initial update
    updateSelectedEmail();
    if (produkSelect.value) {
        updateProductInfo();
    }
    updateCharCount();
    updateRatingDescription();
});
</script>
@endsection