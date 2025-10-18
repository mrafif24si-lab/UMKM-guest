<?php

namespace App\Models;

use App\Models\Umkm;
use Illuminate\Database\Eloquent\Model;

class warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',    
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // Relasi ke UMKM (satu warga bisa memiliki banyak UMKM)
    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'warga_id', 'warga_id');
    }
}
