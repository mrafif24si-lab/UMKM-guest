<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}