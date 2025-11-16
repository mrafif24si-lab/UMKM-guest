<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model // Diubah menjadi Capital case
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
    ];

    // Relasi ke UMKM (satu warga bisa memiliki banyak UMKM)
    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'pemilik_warga_id', 'warga_id');
    }
}