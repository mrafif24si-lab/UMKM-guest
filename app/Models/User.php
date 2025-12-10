<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany; // 1. TAMBAHKAN INI
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI UNTUK SEMUA MEDIA (TAMBAHKAN INI) ---
    public function media(): HasMany // 2. GANTI DARI avatar() ke media()
    {
        // Hubungkan id user ke ref_id di tabel media
        // Filter hanya yang ref_table-nya 'user' (BUKAN 'users')
        return $this->hasMany(Media::class, 'ref_id', 'id')
                    ->where('ref_table', 'user') // 3. GANTI 'users' MENJADI 'user'
                    ->orderBy('sort_order') // 4. TAMBAHKAN INI
                    ->orderBy('created_at'); // 5. TAMBAHKAN INI
    }

    // --- RELASI AVATAR (UNTUK FOTO PROFIL PERTAMA) ---
    public function avatar(): HasOne
    {
        // Ambil media pertama (untuk foto profil di index)
        return $this->hasOne(Media::class, 'ref_id', 'id')
                    ->where('ref_table', 'user') // 6. GANTI 'users' MENJADI 'user'
                    ->where('mime_type', 'like', 'image/%') // 7. TAMBAHKAN INI: hanya gambar
                    ->orderBy('sort_order')
                    ->orderBy('created_at');
    }

    public function getAvatarUrlAttribute()
    {
        // Cek apakah relasi avatar ada dan filenya ada
        if ($this->avatar && $this->avatar->file_name) {
            return asset('storage/media/' . $this->avatar->file_name);
        }
        
        // Gambar default
        return asset('assets-guest/img/avatar.jpg'); 
    }
    // ----------------------------------------

    // 8. PERBAIKI SCOPE FILTER UNTUK MENANGANI 'role'
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'huruf_awal') {
                    if ($request->huruf_awal == 'other') {
                        // Untuk huruf selain A-Z (angka/simbol)
                        $query->whereRaw('LEFT(name, 1) NOT BETWEEN ? AND ?', ['A', 'Z']);
                    } else {
                        $query->where('name', 'LIKE', $request->input($column) . '%');
                    }
                } else if ($column === 'role') {
                    // Filter berdasarkan role
                    $query->where('role', $request->input($column));
                }
            }
        }
        return $query;
    }
    
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%'. $request->search . '%');
                }
            });
        }
        return $query;
    }
}