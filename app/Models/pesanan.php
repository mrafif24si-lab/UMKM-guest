<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    // 1. Konfigurasi Tabel
    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id'; // Sesuai database Anda
    public $timestamps = true;

    // Agar Route Model Binding (di edit/update) membaca pesanan_id, bukan id biasa
    public function getRouteKeyName()
    {
        return 'pesanan_id';
    }

    // 2. Fillable (HARUS SESUAI KOLOM DATABASE ANDA)
    // Lihat gambar image_589e8f.png Anda
    protected $fillable = [
        'produk_id',
        'warga_id',      // Database Anda pakai pelanggan_id, BUKAN warga_id
        'umkm_id',
        'jumlah',
        'total_harga',       // Database Anda pakai total_harga, BUKAN total
        'status',
        'metode_pembayaran', // Database Anda pakai ini, BUKAN metode_bayar
        'bukti_pembayaran',  // Database Anda pakai ini, BUKAN bukti_bayar
        'catatan',
        'no_resi'
    ];

    // Casting data agar formatnya benar saat diambil
    protected $casts = [
        'total_harga' => 'decimal:2',
        'jumlah' => 'integer',
    ];

    // 3. Relasi (PENTING AGAR TIDAK ERROR "Relation Not Found")

    // Relasi ke User (Pelanggan)
    // Controller memanggil: ->with('pelanggan')
    public function pelanggan(): BelongsTo
    {
        // belongsTo(ModelTujuan, 'foreign_key_di_pesanan', 'primary_key_di_user')
        return $this->belongsTo(User::class, 'pelanggan_id', 'id');
    }

    // Relasi ke Produk
    // Controller memanggil: ->with('produk')
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    // Relasi ke UMKM
    // Controller memanggil: ->with('umkm')
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    // 4. Scope Search & Filter (Untuk Fitur Pencarian di Controller)
    
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
                $searchTerm = '%' . $request->search . '%';
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $searchTerm);
                }
                
                // Opsional: Jika ingin search berdasarkan nama pelanggan juga
                $q->orWhereHas('pelanggan', function($qRel) use ($searchTerm) {
                    $qRel->where('name', 'LIKE', $searchTerm);
                });
            });
        }
        return $query;
    }
}