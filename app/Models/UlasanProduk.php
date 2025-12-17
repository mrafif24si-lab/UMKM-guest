<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class UlasanProduk extends Model
{
    use HasFactory;

    protected $table = 'ulasan_produk';
    protected $primaryKey = 'ulasan_id';
    public $timestamps = true;

    protected $fillable = [
        'produk_id',
        'warga_id',
        'rating',
        'komentar'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // RELASI KE PRODUK
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    // RELASI KE WARGA
    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // HELPER UNTUK RATING BINTANG
    public function getRatingBintangAttribute(): string
    {
        $bintang = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $bintang .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $bintang .= '<i class="far fa-star text-muted"></i>';
            }
        }
        return $bintang;
    }

    public function getRatingBintangPlainAttribute(): string
    {
        $fullStars = str_repeat('★ ', $this->rating);
        $emptyStars = str_repeat('☆ ', 5 - $this->rating);
        return trim($fullStars . $emptyStars);
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

    // HELPER UNTUK PREVIEW KOMENTAR
    public function getKomentarSingkatAttribute(): string
    {
        if (strlen($this->komentar) > 100) {
            return substr($this->komentar, 0, 100) . '...';
        }
        return $this->komentar;
    }

    // SCOPE UNTUK SEARCH
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function($q) use ($search) {
            $q->where('rating', 'LIKE', "%{$search}%")
              ->orWhere('komentar', 'LIKE', "%{$search}%")
              
              // Search melalui relasi produk
              ->orWhereHas('produk', function($q2) use ($search) {
                  $q2->where('nama_produk', 'LIKE', "%{$search}%")
                     ->orWhere('jenis_produk', 'LIKE', "%{$search}%");
              })
              
              // Search melalui relasi warga
              ->orWhereHas('warga', function($q2) use ($search) {
                  $q2->where('nama', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%");
              });
        });
    }

    // SCOPE UNTUK FILTER BERDASARKAN RATING
    public function scopeFilterByRating($query, $rating)
    {
        if (!$rating) {
            return $query;
        }
        
        return $query->where('rating', $rating);
    }

    // SCOPE UNTUK FILTER BERDASARKAN PRODUK
    public function scopeFilterByProduk($query, $produkId)
    {
        if (!$produkId) {
            return $query;
        }
        
        return $query->where('produk_id', $produkId);
    }

    // SCOPE UNTUK FILTER BERDASARKAN WARGA
    public function scopeFilterByWarga($query, $wargaId)
    {
        if (!$wargaId) {
            return $query;
        }
        
        return $query->where('warga_id', $wargaId);
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

    // SCOPE UNTUK GET SUMMARY STATISTICS
    public function scopeGetSummary($query)
    {
        return [
            'total_ulasan' => $query->count(),
            'avg_rating' => round($query->avg('rating'), 1),
            'rating_1' => $query->where('rating', 1)->count(),
            'rating_2' => $query->where('rating', 2)->count(),
            'rating_3' => $query->where('rating', 3)->count(),
            'rating_4' => $query->where('rating', 4)->count(),
            'rating_5' => $query->where('rating', 5)->count(),
        ];
    }

    // Untuk Route Resource
    public function getRouteKeyName()
    {
        return 'ulasan_id';
    }

    // VALIDASI RATING (1-5)
    public function validateRating()
    {
        return $this->rating >= 1 && $this->rating <= 5;
    }
}