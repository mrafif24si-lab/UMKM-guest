<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';
    protected $primaryKey = 'umkm_id';
    public $timestamps = true;

    protected $fillable = [
        'nama_usaha',
        'pemilik_warga_id',
        'alamat',
        'rt',
        'rw',
        'kategori',
        'kontak',
        'deskripsi'
    ];

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'umkm_id', 'umkm_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'umkm_id')
                    ->where('ref_table', 'umkm');
    }

    public function getLogoAttribute()
    {
        return $this->media->first();
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
                    if ($column === 'pemilik.nama') {
                        $q->orWhereHas('pemilik', function($subQuery) use ($request) {
                            $subQuery->where('nama', 'LIKE', '%'. $request->search . '%');
                        });
                    } else {
                        $q->orWhere($column, 'LIKE', '%'. $request->search . '%');
                    }
                }
            });
        }
        return $query;
    }
}