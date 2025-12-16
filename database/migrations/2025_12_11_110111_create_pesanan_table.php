<?php
// File: database/migrations/create_pesanan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('pesanan_id');
            
            // PERBAIKAN: Ubah sesuai dengan nama kolom yang sebenarnya
            $table->unsignedBigInteger('produk_id'); // Harus sesuai dengan produk
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('umkm_id');
            
            $table->integer('jumlah');
            $table->decimal('total_harga', 15, 2);
            $table->string('status')->default('pending');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan')->nullable();
            $table->string('no_resi')->nullable();
            $table->timestamps();

            // PERBAIKAN FOREIGN KEY:
            
            // 1. Untuk produk, refer ke product_id (bukan id)
            $table->foreign('produk_id')
                ->references('produk_id') // INI YANG DIPERBAIKI!
                ->on('produk')
                ->onDelete('cascade');

            // 2. Untuk pelanggan, perlu cek dulu apakah tabelnya ada
            // Jika tabel pelanggan belum ada, buat dulu
            $table->foreign('pelanggan_id')
                ->references('id') // atau 'pelanggan_id' sesuai struktur
                ->on('pelanggan')
                ->onDelete('cascade');

            // 3. Untuk umkm sudah benar
            $table->foreign('umkm_id')
                ->references('umkm_id')
                ->on('umkm')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};