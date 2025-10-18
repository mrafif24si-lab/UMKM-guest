<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $primaryKey = 'umkm_id';
    protected $fillable = [
        'nama_usaha',
        'pemilik_warga_id',
        'alamat',
        'rt',
        'rw',
        'kategori',
        'kontak',
        'deskripsi',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'umkm_id');
    }
}