<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;

// Route utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/', [HomeController::class, 'index'])->name('Home.index');


Route::get('/auth', [AuthController::class, 'index'])->name('Auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('Auth.login');

//Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::resource('pelanggan', WargaController::class);

// // Route untuk UMKM
// Route::resource('umkm', UmkmController::class);

// // Route untuk Warga
// Route::resource('warga', WargaController::class);

// // Route dashboard (jika sudah ada)

//Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
return view('guest.dashboard');
})->name('home');

// Routes untuk Warga (Guest)
Route::resource('warga', WargaController::class);

// Routes untuk Produk (Guest)  
Route::resource('produk', ProdukController::class);

Route::fallback(function () {
    return redirect('/');
});