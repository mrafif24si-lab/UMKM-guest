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

    // SESUAIKAN DENGAN DATABASE YANG ADA
    protected $fillable = [
        'nomor_pesanan',
        'warga_id',
        'umkm_id',       // TAMBAHKAN KARENA MASIH ADA DI DB
        'total',
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar',
        'bukti_bayar'    // PAKAI SINGLE FILE DULU UNTUK DEMO
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // RELASI KE WARGA
    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // RELASI KE UMKM (OPSIONAL)
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    // RELASI KE DETAIL PESANAN
    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'pesanan_id');
    }

    // HELPER UNTUK STATUS COLOR
    public function getStatusColorAttribute(): string
    {
        // SESUAIKAN DENGAN STATUS DI FORM ANDA
        return match($this->status) {
            'pending' => 'warning',
            'proses' => 'info',
            'dikirim' => 'primary',
            'selesai' => 'success',
            'dibatalkan' => 'danger',
            default => 'secondary'
        };
    }

    // HELPER UNTUK FORMAT TOTAL
    public function getTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    // HELPER UNTUK CEK ADA BUKTI BAYAR
    public function getHasBuktiBayarAttribute(): bool
    {
        return !empty($this->bukti_bayar);
    }

    // HELPER UNTUK GET STATUS TEXT
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'proses' => 'Proses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst($this->status)
        };
    }
}