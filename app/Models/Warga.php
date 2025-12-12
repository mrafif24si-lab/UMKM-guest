<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    public $timestamps = true;

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',    
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // Relasi ke UMKM
    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'pemilik_warga_id', 'warga_id');
    }

    // --- RELASI UNTUK SEMUA MEDIA ---
    public function media(): HasMany
    {
        // Hubungkan warga_id ke ref_id di tabel media
        return $this->hasMany(Media::class, 'ref_id', 'warga_id')
                    ->where('ref_table', 'warga')
                    ->orderBy('sort_order')
                    ->orderBy('created_at');
    }

    // --- RELASI AVATAR (UNTUK FOTO PROFIL PERTAMA) ---
    public function avatar()
    {
        // Ambil media pertama (untuk foto profil di index)
        return $this->hasOne(Media::class, 'ref_id', 'warga_id')
                    ->where('ref_table', 'warga')
                    ->where('mime_type', 'like', 'image/%')
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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
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