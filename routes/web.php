<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController; // Pastikan ini ada jika dipakai

// --- 1. AREA TAMU (GUEST) ---
// Hanya bisa diakses jika BELUM login
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    // routes/web.php

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// --- 2. AREA LOGIN (SEMUA ROLE MASUK SINI) ---
// Middleware 'checkislogin' memastikan user sudah login
Route::middleware(['checkislogin'])->group(function () {

    // --- FITUR UMUM (Admin, Warga, User BOLEH AKSES) ---
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Halaman Home / Dashboard
    Route::get('/', function () {
        return view('pages.guest.dashboard'); // Sesuaikan view dashboard kamu
    })->name('home');

    // Halaman Tentang
    Route::get('/tentang', function () {
        return view('pages.guest.tentang');
    })->name('tentang');


    // --- FITUR MANAJEMEN BISNIS (Admin & Warga BOLEH AKSES) ---
    // User biasa TIDAK BOLEH masuk sini
    Route::middleware(['checkrole:admin,warga'])->group(function () {
        Route::resource('umkm', UmkmController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('warga', WargaController::class); 
        // Catatan: Jika 'warga' hanya boleh lihat data diri sendiri, 
        // logika pembatasan datanya nanti ada di WargaController, 
        // tapi secara menu mereka boleh akses route ini.
    });


    // --- FITUR SUPER ADMIN (Hanya Admin BOLEH AKSES) ---
    // Warga & User biasa TIDAK BOLEH masuk sini
    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

});

// Fallback: Jika url ngawur, kembalikan ke home
Route::fallback(function () {
    return redirect()->route('home');
});