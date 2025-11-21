<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
     public function index(Request $request) // Tambahkan parameter Request
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['huruf_awal'];
        
          // Daftar kolom yang bisa dicari saat searching
        $searchableColumns = ['name', 'email']; // Tambahkan ini
        
        
        // Gunakan scope filter untuk memproses query
        $users = User::filter($request, $filterableColumns)
         ->search($request, $searchableColumns) // Tambahkan ini
                    ->orderBy('name')
                    ->paginate(10)
                    ->withQueryString(); // Tambahkan ini untuk mempertahankan parameter filter

        return view('pages.guest.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.guest.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.guest.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}