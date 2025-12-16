<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            // Primary Key custom name sesuai model Anda
            $table->id('detail_id'); 
            
            // Foreign Keys
            // Asumsi tabel referensi bernama 'pesanan' dan PK-nya 'pesanan_id'
            $table->foreignId('pesanan_id')
                  ->constrained('pesanan', 'pesanan_id')
                  ->onDelete('cascade'); 
            
            // Asumsi tabel referensi bernama 'produk' dan PK-nya 'produk_id'
            $table->foreignId('produk_id')
                  ->constrained('produk', 'produk_id')
                  ->onDelete('restrict');

            // Kolom Data
            $table->integer('qty');
            $table->decimal('harga_satuan', 15, 2); // Decimal untuk uang
            $table->decimal('subtotal', 15, 2);     // Decimal untuk uang

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};