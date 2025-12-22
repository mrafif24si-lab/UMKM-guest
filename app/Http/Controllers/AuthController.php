<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // === FITUR PROFIL ===
    public function profile()
    {
        $user = Auth::user();
        return view('pages.auth.profile', compact('user'));
    }

   public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    if ($request->hasFile('avatar')) {
        
        // 1. Hapus foto lama (Cek disk 'public')
        if ($user->avatar) {
            // Cek di disk 'public' folder 'media'
            if(Storage::disk('public')->exists('media/' . $user->avatar->file_name)){
                Storage::disk('public')->delete('media/' . $user->avatar->file_name);
            }
            $user->avatar()->delete(); 
        }

        // 2. Simpan foto baru
        $file = $request->file('avatar');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // PERBAIKAN DISINI:
        // Simpan ke folder 'media', gunakan nama $fileName, di disk 'public'
        $file->storeAs('media', $fileName, 'public'); 

        // 3. Simpan ke Database
        Media::create([
            'ref_table' => 'users',         
            'ref_id'    => $user->id,       
            'file_name' => $fileName,       
            'mime_type' => $file->getMimeType(),
            'caption'   => 'Foto Profil ' . $user->name, 
            'sort_order'=> 0                
        ]);
    }

    return back()->with('success', 'Profil berhasil diperbarui!');
}

    // === FITUR AUTHENTICATION (LOGIN/REGISTER) ===
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.register-form');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,warga,user',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

      
        if ($user->role === 'admin') {
            return redirect()->route('user.index')->with('success', 'Selamat datang Admin!');
        } elseif ($user->role === 'warga') {
            return redirect()->route('umkm.index')->with('success', 'Selamat datang Warga!');
        }

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}