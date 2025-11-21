<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = true;

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

    // Relasi ke model Umkm
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
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
     // Tambahkan scopeSearch untuk fitur pencarian
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    // Untuk kolom stok, cari exact match atau konversi ke string
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