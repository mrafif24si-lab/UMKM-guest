<?php

use App\Models\Media;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;

// Route utama
Route::get('/', function () {
    return view('pages.guest.dashboard');
})->name('home');

// Routes untuk Warga (Guest)
Route::resource('warga', WargaController::class);

// Routes untuk Produk (Guest)
Route::resource('produk', ProdukController::class);

// Route untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk halaman register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route untuk proses register
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('user', UserController::class);

Route::fallback(function () {
    return redirect('/');
});

Route::get('/tentang', function () {
    return view('pages/guest/tentang');
})->name('tentang');

Route::resource('umkm', UmkmController::class);


Route::delete('/umkm/media/{media}', [UmkmController::class, 'deleteMedia'])->name('umkm.delete-media');

// Debug routes
Route::get('/debug/files', function() {
    $files = Media::all();
    return view('debug.files', compact('files'));
});

Route::get('/debug/storage', function() {
    $storagePath = storage_path('app/public/uploads');
    $files = [];
    
    if (file_exists($storagePath)) {
        $files = scandir($storagePath);
        $files = array_diff($files, ['.', '..']);
    }
    
    return response()->json([
        'storage_path' => $storagePath,
        'files' => array_values($files),
        'storage_link_exists' => file_exists(public_path('storage')),
        'public_storage_files' => file_exists(public_path('storage')) ? scandir(public_path('storage')) : []
    ]);
});