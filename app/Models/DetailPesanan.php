<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'detail_id';
    public $timestamps = true;

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'qty',
        'harga_satuan',
        'subtotal'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
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
                    if ($column === 'pesanan.nomor_pesanan') {
                        $q->orWhereHas('pesanan', function($subQuery) use ($request) {
                            $subQuery->where('nomor_pesanan', 'LIKE', '%'. $request->search . '%');
                        });
                    } elseif ($column === 'produk.nama_produk') {
                        $q->orWhereHas('produk', function($subQuery) use ($request) {
                            $subQuery->where('nama_produk', 'LIKE', '%'. $request->search . '%');
                        });
                    } else {
                        $q->orWhere($column, 'LIKE', '%'. $request->search . '%');
                    }
                }
            });
        }
        return $query;
    }

    // Accessor untuk format harga
    public function getHargaSatuanFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    public function getSubtotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Hitung subtotal otomatis
    public function calculateSubtotal(): void
    {
        $this->subtotal = $this->qty * $this->harga_satuan;
    }
}