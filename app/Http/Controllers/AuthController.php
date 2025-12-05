<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // MENAMPILKAN FORM LOGIN
    public function showLoginForm()
    {
        // Logika Modul: Jika sudah login, lempar ke dashboard (home)
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.login-form');
    }

    // PROSES LOGIN (Logika Modul: Manual Hash Check)
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek password manual
        if ($user && Hash::check($request->password, $user->password)) {

            // Login manual sesuai modul
            Auth::login($user);

            $request->session()->regenerate();

            // Redirect ke home/dashboard
            return redirect()->route('home')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }

    // MENAMPILKAN FORM REGISTER
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.register-form');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {
        // 1. Tambahkan validasi untuk 'role'
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => 'required|in:admin,warga,user', // Validasi role yang diizinkan
        ]);

        // 2. Simpan role sesuai pilihan di form ($request->role)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // <--- UBAH BAGIAN INI
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect sesuai role (Opsional, agar lebih rapi)
        if ($user->role === 'admin') {
            return redirect()->route('user.index')->with('success', 'Selamat datang Admin!');
        } elseif ($user->role === 'warga') {
            return redirect()->route('umkm.index')->with('success', 'Selamat datang Warga!');
        }

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    // LOGOUT (Sesuai Modul)
    // app/Http/Controllers/AuthController.php

    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus session agar tidak bisa di-back
        $request->session()->invalidate();

        // Regenerate token untuk keamanan (CSRF)
        $request->session()->regenerateToken();

        // Redirect ke halaman utama atau login dengan pesan sukses
        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}
