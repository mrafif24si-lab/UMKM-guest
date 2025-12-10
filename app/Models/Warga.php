<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'role', // TAMBAHKAN INI
    ];

    // Relasi ke UMKM
    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'pemilik_warga_id', 'warga_id');
    }

    // Relasi ke Media (Upload File)
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'ref', 'ref_table', 'ref_id');
    }

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