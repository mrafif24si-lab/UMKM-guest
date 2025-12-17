<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    public $timestamps = true;

    // 1. FILLABLE (Sesuai dengan Migration Baru)
    protected $fillable = [
        'nomor_pesanan',
        'warga_id',
        'umkm_id',
        'total',         // Menggantikan total_harga
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar',
        'bukti_bayar'
    ];

    // 2. CASTING (Agar tipe data otomatis sesuai)
    protected $casts = [
        'total' => 'decimal:2', // Menggantikan total_harga
        // 'jumlah' dihapus karena kolomnya sudah tidak ada
    ];

    // 3. DEFINISI RELASI
    
    // Relasi ke Warga (Benar)
    public function warga(): BelongsTo
    {
        // belongsTo(ModelTujuan, 'Foreign_Key_di_Pesanan', 'Primary_Key_di_Warga')
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke UMKM (Benar)
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    /* CATATAN PENTING:
       Relasi public function produk() DIHAPUS.
       Alasannya: Di tabel 'pesanan' yang baru, kita sudah menghapus kolom 'produk_id'.
       Jika fungsi ini tetap ada dan dipanggil, akan menyebabkan error "Column not found: produk_id".
    */

    // 4. SCOPE SEARCH & FILTER

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
                
                // Cari berdasarkan kolom di tabel pesanan (misal: nomor_pesanan)
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $searchTerm);
                }
                
                // PERBAIKAN: Cari berdasarkan Nama Warga (Bukan Pelanggan)
                $q->orWhereHas('warga', function($qRel) use ($searchTerm) {
                    // Pastikan di tabel 'warga' nama kolomnya adalah 'nama'
                    $qRel->where('nama', 'LIKE', $searchTerm); 
                });
            });
        }
        return $query;
    }
}