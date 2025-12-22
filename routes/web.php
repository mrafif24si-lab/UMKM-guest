<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UlasanProdukController;
use App\Http\Controllers\DetailPesananController;


// // --- 1. AREA TAMU (GUEST - BELUM LOGIN) ---
// Route::middleware('guest')->group(function(){
//     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//     Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
//     Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// });

// // --- 2. AREA LOGIN (SEMUA ROLE MASUK SINI) ---
// Route::middleware(['checkislogin'])->group(function () {

//     // --- FITUR UMUM (Bisa diakses Admin, Warga, dan User) ---

//     // 1. Logout
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//       // 2. Dashboard / Home
//     Route::get('/', [DashboardController::class, 'index'])->name('home'); // Ubah ini

//     // 3. Halaman Tentang (Permintaan Anda: User harus bisa akses ini)
//     Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang'); // Bisa juga pindah ke DashboardController

//     // 2. Dashboard / Home
//     Route::get('/', function () {
//         return view('pages.guest.dashboard');
//     })->name('home');

//     // 3. Halaman Tentang (Permintaan Anda: User harus bisa akses ini)
//     Route::get('/tentang', function () {
//         return view('pages.guest.tentang');
//     })->name('tentang');

//     // Route Profil
//     Route::get('/profile', [AuthController::class, 'profile'])->name('profile.edit');
//     Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');


//     // --- KELOMPOK 1: MANAJEMEN BISNIS (Admin & Warga) ---
//     // User biasa TIDAK BISA akses ini
//     Route::middleware(['checkrole:admin,warga'])->group(function () {
//         Route::resource('umkm', UmkmController::class);
//         Route::resource('produk', ProdukController::class);
//         Route::resource('warga', WargaController::class);
//     });

//     Route::delete('/umkm/media/{media}', [UmkmController::class, 'deleteMedia'])->name('umkm.delete-media');


//     // --- KELOMPOK 2: MANAJEMEN USER (Admin & User) ---
//     // PERBAIKAN DISINI: Menambahkan 'user' agar bisa akses data user
//     Route::middleware(['checkrole:admin,user'])->group(function () {
//         Route::resource('user', UserController::class);
//     });

// });

// // Fallback Route
// Route::fallback(function () {
//     return redirect()->route('home');
// });

// Route::get('/identitas', function () {
//     return view('pages.guest.identitas');
// })->name('identitas');

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// // Route untuk placeholder image
// // Route::get('/placeholder/{width}/{height}', function ($width = 300, $height = 300) {
// //     $image = imagecreatetruecolor($width, $height);
// //     $bgColor = imagecolorallocate($image, 240, 240, 240);
// //     $textColor = imagecolorallocate($image, 180, 180, 180);
    
// //     imagefill($image, 0, 0, $bgColor);
    
// //     // Tambahkan teks "No Image"
// //     $text = "No Image";
// //     $font = 5; // Font GD internal
// //     $textWidth = imagefontwidth($font) * strlen($text);
// //     $textHeight = imagefontheight($font);
// //     $x = ($width - $textWidth) / 2;
// //     $y = ($height - $textHeight) / 2;
    
// //     imagestring($image, $font, $x, $y, $text, $textColor);
    
// //     header('Content-Type: image/png');
// //     imagejpeg($image);
// //     imagedestroy($image);
// // })->name('placeholder.image');
// // Route untuk generate placeholder image
// Route::get('/placeholder/{width}/{height}', function ($width = 400, $height = 300) {
//     // Buat gambar dengan GD
//     $image = imagecreatetruecolor($width, $height);
    
//     // Warna background
//     $bgColor = imagecolorallocate($image, 240, 240, 240);
//     $textColor = imagecolorallocate($image, 150, 150, 150);
//     $borderColor = imagecolorallocate($image, 200, 200, 200);
    
//     // Isi background
//     imagefill($image, 0, 0, $bgColor);
    
//     // Tambahkan border
//     imagerectangle($image, 0, 0, $width-1, $height-1, $borderColor);
    
//     // Tambahkan ikon kamera
//     $iconSize = min($width, $height) / 4;
//     $cameraX = $width / 2;
//     $cameraY = $height / 2 - 20;
    
//     // Gambar lingkaran kamera
//     imagefilledellipse($image, $cameraX, $cameraY, $iconSize, $iconSize, $textColor);
//     imagefilledellipse($image, $cameraX, $cameraY, $iconSize/2, $iconSize/2, $bgColor);
    
//     // Tambahkan teks
//     $text = "Belum ada file";
//     $text2 = "yang diupload";
//     $font = 5; // GD internal font
//     $textWidth = imagefontwidth($font) * strlen($text);
//     $textX = ($width - $textWidth) / 2;
//     $textY = $cameraY + $iconSize/2 + 30;
    
//     imagestring($image, $font, $textX, $textY, $text, $textColor);
    
//     $textWidth2 = imagefontwidth($font) * strlen($text2);
//     $textX2 = ($width - $textWidth2) / 2;
//     imagestring($image, $font, $textX2, $textY + 20, $text2, $textColor);
    
//     // Output sebagai PNG
//     header('Content-Type: image/png');
//     imagepng($image);
//     imagedestroy($image);
// })->name('placeholder.image');

// // Produk Media Routes
// Route::delete('/produk/media/{media}', [ProdukController::class, 'deleteMedia'])->name('produk.delete-media');

// // User Routes
// Route::resource('user', UserController::class);
// Route::delete('/user/delete-media/{mediaId}', [UserController::class, 'deleteMedia'])->name('user.delete-media');




// // ... route resource warga yang sudah ada ...
// Route::resource('warga', WargaController::class);

// // TAMBAHKAN INI: Route khusus untuk hapus media warga
// // Kami menggunakan nama 'warga.deleteMedia' agar COCOK dengan edit.blade.php Anda
// Route::delete('/warga/delete-media/{mediaId}', [WargaController::class, 'deleteMedia'])->name('warga.delete-media');

// // Tambahkan dalam middleware checkrole:admin,warga
// Route::resource('pesanan', PesananController::class);
// Route::delete('/pesanan/media/{media}', [PesananController::class, 'deleteMedia'])->name('pesanan.delete-media');

// // Tambahkan juga di navbar untuk menu pesanan:
// // <a href="{{ route('pesanan.index') }}" class="nav-item nav-link {{ request()->is('pesanan*') ? 'active' : '' }}">Pesanan</a>

// // Detail Pesanan Routes
// Route::resource('detail-pesanan', DetailPesananController::class);

// // AJAX route for getting product price
// Route::get('/get-harga-produk/{produk}', [DetailPesananController::class, 'getHargaProduk'])
//     ->name('get.harga-produk');

// --- 1. AREA TAMU (GUEST - BELUM LOGIN) ---
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// --- 2. AREA LOGIN (SEMUA ROLE MASUK SINI) ---
Route::middleware(['checkislogin'])->group(function () {

    // --- FITUR UMUM ---

    // 1. Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 2. Dashboard / Home
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    // 3. Halaman Tentang
    Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang');

    // 4. Identitas
    Route::get('/identitas', function () {
        return view('pages.guest.identitas');
    })->name('identitas');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 5. Profil
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');


    // --- KELOMPOK 1: MANAJEMEN BISNIS (Admin & Warga) ---
    Route::middleware(['checkrole:admin,warga'])->group(function () {
        
        // UMKM
        Route::resource('umkm', UmkmController::class);
        Route::delete('/umkm/media/{media}', [UmkmController::class, 'deleteMedia'])->name('umkm.delete-media');
        
        // PRODUK
        Route::resource('produk', ProdukController::class);
        Route::delete('/produk/media/{media}', [ProdukController::class, 'deleteMedia'])->name('produk.delete-media');

        // WARGA
        Route::resource('warga', WargaController::class);
        Route::delete('/warga/delete-media/{mediaId}', [WargaController::class, 'deleteMedia'])->name('warga.delete-media');

        //   // USER
        // Route::resource('user', UserController::class);
        // Route::delete('/user/delete-media/{mediaId}', [UserController::class, 'deleteMedia'])->name('user.delete-media');

        // PESANAN (PERBAIKAN UTAMA DISINI)
        // Route::resource otomatis membuat route PUT untuk update
        Route::resource('pesanan', PesananController::class);
        Route::delete('/pesanan/media/{media}', [PesananController::class, 'deleteMedia'])->name('pesanan.delete-media');
        
        // // DETAIL PESANAN
        // Route::resource('detail-pesanan', DetailPesananController::class);
        // Route::get('/get-harga-produk/{produk}', [DetailPesananController::class, 'getHargaProduk'])->name('get.harga-produk');
    });


    // --- KELOMPOK 2: MANAJEMEN USER (Admin & User) ---
    Route::middleware(['checkrole:admin,user'])->group(function () {
        Route::resource('user', UserController::class);
        Route::delete('/user/delete-media/{mediaId}', [UserController::class, 'deleteMedia'])->name('user.delete-media');
    });

});


// --- ROUTE UTILITAS (IMAGE PLACEHOLDER) ---
Route::get('/placeholder/{width}/{height}', function ($width = 400, $height = 300) {
    // Buat gambar dengan GD
    $image = imagecreatetruecolor($width, $height);
    
    // Warna background
    $bgColor = imagecolorallocate($image, 240, 240, 240);
    $textColor = imagecolorallocate($image, 150, 150, 150);
    $borderColor = imagecolorallocate($image, 200, 200, 200);
    
    // Isi background
    imagefill($image, 0, 0, $bgColor);
    
    // Tambahkan border
    imagerectangle($image, 0, 0, $width-1, $height-1, $borderColor);
    
    // Tambahkan ikon kamera (simple circle representation)
    $iconSize = min($width, $height) / 4;
    $cameraX = $width / 2;
    $cameraY = $height / 2 - 20;
    
    imagefilledellipse($image, $cameraX, $cameraY, $iconSize, $iconSize, $textColor);
    imagefilledellipse($image, $cameraX, $cameraY, $iconSize/2, $iconSize/2, $bgColor);
    
    // Tambahkan teks
    $text = "Belum ada file";
    $text2 = "yang diupload";
    $font = 5; 
    $textWidth = imagefontwidth($font) * strlen($text);
    $textX = ($width - $textWidth) / 2;
    $textY = $cameraY + $iconSize/2 + 30;
    
    imagestring($image, $font, $textX, $textY, $text, $textColor);
    
    $textWidth2 = imagefontwidth($font) * strlen($text2);
    $textX2 = ($width - $textWidth2) / 2;
    imagestring($image, $font, $textX2, $textY + 20, $text2, $textColor);
    
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
})->name('placeholder.image');


// --- FALLBACK ROUTE (HARUS PALING BAWAH) ---
// Jika user mengakses halaman yang tidak ada, kembalikan ke home
Route::fallback(function () {
    return redirect()->route('home');
    });

    // routes/web.php
Route::prefix('detail-pesanan')->name('detail-pesanan.')->group(function () {
    Route::get('/', [DetailPesananController::class, 'index'])->name('index');
    Route::get('/create', [DetailPesananController::class, 'create'])->name('create');
    Route::post('/', [DetailPesananController::class, 'store'])->name('store');
    Route::get('/{detailPesanan}', [DetailPesananController::class, 'show'])->name('show');
    Route::get('/{detailPesanan}/edit', [DetailPesananController::class, 'edit'])->name('edit');
    Route::put('/{detailPesanan}', [DetailPesananController::class, 'update'])->name('update');
    Route::delete('/{detailPesanan}', [DetailPesananController::class, 'destroy'])->name('destroy');
    Route::get('/product/{id}/price', [DetailPesananController::class, 'getProductPrice'])->name('product.price');
});


// Ulasan Produk Routes
Route::resource('ulasan-produk', UlasanProdukController::class);
Route::get('/ulasan-produk/get-summary', [UlasanProdukController::class, 'getSummary'])->name('ulasan-produk.summary');
Route::get('/ulasan-produk/get-product-details/{id}', [UlasanProdukController::class, 'getProductDetails'])->name('ulasan-produk.product-details');

