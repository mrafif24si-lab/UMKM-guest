<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne; // <--- PENTING: Ganti MorphOne jadi HasOne
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

    // --- RELASI AVATAR (PERBAIKAN UTAMA) ---
    public function avatar(): HasOne
    {
        // Hubungkan id user ke ref_id di tabel media
        // Filter hanya yang ref_table-nya 'users'
        return $this->hasOne(Media::class, 'ref_id', 'id')
                    ->where('ref_table', 'users')
                    ->latest(); // Ambil yang paling baru
    }

    public function getAvatarUrlAttribute()
    {
        // Cek apakah relasi avatar ada dan filenya ada
        if ($this->avatar && $this->avatar->file_name) {
            // PERBAIKAN DISINI: Arahkan ke folder 'media'
            return asset('storage/media/' . $this->avatar->file_name);
        }
        
        // Gambar default
        return asset('assets-guest/img/avatar.jpg'); 
    }
    // ----------------------------------------

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'huruf_awal') {
                    $query->where('name', 'LIKE', $request->input($column) . '%');
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