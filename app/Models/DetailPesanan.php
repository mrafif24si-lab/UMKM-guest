<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

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
        'qty' => 'integer',
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // RELASI KE PESANAN
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }

    // RELASI KE PRODUK - Menggunakan model Produk Anda
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    // HELPER UNTUK FORMAT HARGA
    public function getHargaSatuanFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    public function getSubtotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // HELPER UNTUK TANGGAL FORMATTED
    public function getTanggalFormattedAttribute(): string
    {
        return $this->created_at->translatedFormat('d F Y');
    }

    public function getWaktuFormattedAttribute(): string
    {
        return $this->created_at->format('H:i') . ' WIB';
    }

    // AUTOMATIC CALCULATE SUBTOTAL
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->subtotal = $model->qty * $model->harga_satuan;
        });

        static::updating(function ($model) {
            $model->subtotal = $model->qty * $model->harga_satuan;
        });
    }

    // SCOPE UNTUK SEARCH (mencari di multiple tabel)
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function($q) use ($search) {
            // Search di tabel detail_pesanan (qty, harga_satuan, subtotal)
            $q->where('qty', 'LIKE', "%{$search}%")
              ->orWhere('harga_satuan', 'LIKE', "%{$search}%")
              ->orWhere('subtotal', 'LIKE', "%{$search}%")
              
              // Search melalui relasi pesanan (nomor_pesanan)
              ->orWhereHas('pesanan', function($q2) use ($search) {
                  $q2->where('nomor_pesanan', 'LIKE', "%{$search}%")
                     ->orWhere('alamat_kirim', 'LIKE', "%{$search}%");
              })
              
              // Search melalui relasi pesanan->warga (nama warga)
              ->orWhereHas('pesanan.warga', function($q2) use ($search) {
                  $q2->where('nama', 'LIKE', "%{$search}%");
              })
              
              // Search melalui relasi produk (nama_produk, jenis_produk)
              ->orWhereHas('produk', function($q2) use ($search) {
                  $q2->where('nama_produk', 'LIKE', "%{$search}%")
                     ->orWhere('jenis_produk', 'LIKE', "%{$search}%");
              })
              
              // Search melalui relasi produk->umkm (nama_usaha)
              ->orWhereHas('produk.umkm', function($q2) use ($search) {
                  $q2->where('nama_usaha', 'LIKE', "%{$search}%");
              });
        });
    }

    // SCOPE UNTUK FILTER BERDASARKAN TANGGAL
    public function scopeFilterByDate($query, $period)
    {
        if (!$period) {
            return $query;
        }

        $now = Carbon::now();
        
        switch ($period) {
            case 'hari_ini':
                return $query->whereDate('created_at', $now->toDateString());
                
            case 'minggu_ini':
                return $query->whereBetween('created_at', [
                    $now->startOfWeek()->toDateTimeString(),
                    $now->endOfWeek()->toDateTimeString()
                ]);
                
            case 'bulan_ini':
                return $query->whereBetween('created_at', [
                    $now->startOfMonth()->toDateTimeString(),
                    $now->endOfMonth()->toDateTimeString()
                ]);
                
            case 'tahun_ini':
                return $query->whereYear('created_at', $now->year);
                
            default:
                return $query;
        }
    }

    // SCOPE UNTUK FILTER BERDASARKAN PESANAN_ID
    public function scopeFilterByPesanan($query, $pesananId)
    {
        if (!$pesananId) {
            return $query;
        }
        
        return $query->where('pesanan_id', $pesananId);
    }

    // SCOPE UNTUK FILTER BERDASARKAN PRODUK_ID
    public function scopeFilterByProduk($query, $produkId)
    {
        if (!$produkId) {
            return $query;
        }
        
        return $query->where('produk_id', $produkId);
    }

    // SCOPE UNTUK FILTER BERDASARKAN RENTANG TANGGAL
    public function scopeFilterByDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        
        if ($startDate) {
            return $query->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }
        
        if ($endDate) {
            return $query->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }
        
        return $query;
    }

    // SCOPE UNTUK ORDER BY
    public function scopeOrderByField($query, $field, $direction = 'asc')
    {
        $allowedFields = ['created_at', 'updated_at', 'qty', 'harga_satuan', 'subtotal'];
        
        if (in_array($field, $allowedFields)) {
            return $query->orderBy($field, $direction);
        }
        
        return $query->orderBy('created_at', 'desc');
    }

    // SCOPE UNTUK GET SUMMARY STATISTICS
    public function scopeGetSummary($query)
    {
        return [
            'total_items' => $query->count(),
            'total_qty' => $query->sum('qty'),
            'total_subtotal' => $query->sum('subtotal'),
            'avg_qty' => $query->avg('qty'),
            'avg_subtotal' => $query->avg('subtotal'),
            'min_subtotal' => $query->min('subtotal'),
            'max_subtotal' => $query->max('subtotal')
        ];
    }

    // Untuk Route Resource
    public function getRouteKeyName()
    {
        return 'detail_id';
    }

    // HELPER METHOD UNTUK VALIDASI STOK
    public function validateStock($requestedQty = null)
    {
        $qty = $requestedQty ?? $this->qty;
        
        if (!$this->produk) {
            return false;
        }
        
        return $this->produk->stok >= $qty;
    }

    // HELPER METHOD UNTUK UPDATE STOK PRODUK
    public function updateProductStock($isNew = false, $oldQty = null)
    {
        if (!$this->produk) {
            return false;
        }
        
        if ($isNew) {
            // Untuk detail pesanan baru: kurangi stok
            $this->produk->decrement('stok', $this->qty);
        } else {
            // Untuk update: hitung selisih qty
            $diff = $this->qty - $oldQty;
            
            if ($diff > 0) {
                // Qty bertambah: kurangi stok
                $this->produk->decrement('stok', $diff);
            } elseif ($diff < 0) {
                // Qty berkurang: tambah stok
                $this->produk->increment('stok', abs($diff));
            }
        }
        
        return true;
    }

    // HELPER METHOD UNTUK RESTORE STOK SAAT DELETE
    public function restoreProductStock()
    {
        if (!$this->produk) {
            return false;
        }
        
        // Kembalikan stok yang dipakai
        $this->produk->increment('stok', $this->qty);
        
        return true;
    }
}