<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/', [HomeController::class, 'index'])->name('Home.index');


Route::get('/auth', [AuthController::class, 'index'])->name('Auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('Auth.login');