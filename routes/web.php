<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;


// --- 1. AREA TAMU (GUEST - BELUM LOGIN) ---
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// --- 2. AREA LOGIN (SEMUA ROLE MASUK SINI) ---
Route::middleware(['checkislogin'])->group(function () {

    // --- FITUR UMUM (Bisa diakses Admin, Warga, dan User) ---

    // 1. Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

      // 2. Dashboard / Home
    Route::get('/', [DashboardController::class, 'index'])->name('home'); // Ubah ini

    // 3. Halaman Tentang (Permintaan Anda: User harus bisa akses ini)
    Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang'); // Bisa juga pindah ke DashboardController

    // 2. Dashboard / Home
    Route::get('/', function () {
        return view('pages.guest.dashboard');
    })->name('home');

    // 3. Halaman Tentang (Permintaan Anda: User harus bisa akses ini)
    Route::get('/tentang', function () {
        return view('pages.guest.tentang');
    })->name('tentang');

    // Route Profil
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');


    // --- KELOMPOK 1: MANAJEMEN BISNIS (Admin & Warga) ---
    // User biasa TIDAK BISA akses ini
    Route::middleware(['checkrole:admin,warga'])->group(function () {
        Route::resource('umkm', UmkmController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('warga', WargaController::class);
    });

    Route::delete('/umkm/media/{media}', [UmkmController::class, 'deleteMedia'])->name('umkm.delete-media');


    // --- KELOMPOK 2: MANAJEMEN USER (Admin & User) ---
    // PERBAIKAN DISINI: Menambahkan 'user' agar bisa akses data user
    Route::middleware(['checkrole:admin,user'])->group(function () {
        Route::resource('user', UserController::class);
    });

});

// Fallback Route
Route::fallback(function () {
    return redirect()->route('home');
});

Route::get('/identitas', function () {
    return view('pages.guest.identitas');
})->name('identitas');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
