<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahan
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'produk_id'; // Kunci utama kamu
    public $timestamps = true;

    // [PENTING] Tambahkan ini agar Route Resource tahu ID mana yang dipakai
    public function getRouteKeyName()
    {
        return 'produk_id';
    }

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'jenis_produk',
        'deskripsi',
        'harga',
        'stok',
        'status'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    // Relasi ke Media (PENTING untuk hapus gambar)
    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'produk_id')
                    ->where('ref_table', 'produk');
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
                    if ($column === 'stok') {
                        $q->orWhere($column, '=', $request->search);
                    } else {
                        $q->orWhere($column, 'LIKE', '%'. $request->search . '%');
                    }
                }
            });
        }
        return $query;
    }
}