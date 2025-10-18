<?php
// app/Models/Produk.php

namespace App\Models;

use App\Models\Umkm;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    protected $fillable = [
        'nama_produk',
        'jenis_produk',
        'deskripsi',
        'harga',
        'stok',
        'status',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}