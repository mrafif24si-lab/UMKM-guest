<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Akun Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun WARGA (Pemilik UMKM)
        User::create([
            'name' => 'Akun Warga',
            'email' => 'warga@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
        ]);

        // 3. Buat Akun USER (Pembeli)
        User::create([
            'name' => 'Akun User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}