<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    public $timestamps = true;

    // Scope untuk mencari file berdasarkan referensi
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                    ->where('ref_id', $refId)
                    ->orderBy('sort_order', 'asc');
    }
}