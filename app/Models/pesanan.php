<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'pesanan_id';
    }

    protected $fillable = [
        'pesanan_id',
        'warga_id',
        'total',
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'pesanan_id')
                    ->where('ref_table', 'pesanan');
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