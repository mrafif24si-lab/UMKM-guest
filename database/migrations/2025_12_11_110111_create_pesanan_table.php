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
            // Primary Key
            $table->id('pesanan_id');
            
            // 1. Identitas Pesanan (Sesuai Blade)
            $table->string('nomor_pesanan')->unique(); // name="nomor_pesanan"
            
            // 2. Foreign Keys
            // Menggunakan warga_id sesuai form select option
            $table->unsignedBigInteger('warga_id'); 
            
            // Asumsi: UMKM ID diambil dari sistem/login, bukan input user
            // Jika pesanan ini spesifik untuk satu UMKM
            $table->unsignedBigInteger('umkm_id')->nullable(); 

            // 3. Data Keuangan & Status
            $table->decimal('total', 15, 2); // name="total"
            $table->string('status'); // name="status" (pending, proses, dll)
            
            // 4. Data Pengiriman (Sesuai Blade)
            $table->text('alamat_kirim'); // name="alamat_kirim"
            $table->string('rt', 3); // name="rt"
            $table->string('rw', 3); // name="rw"
            
            // 5. Pembayaran
            $table->string('metode_bayar'); // name="metode_bayar"
            $table->string('bukti_bayar')->nullable(); // name="bukti_bayar"
            
            // 6. Timestamps (created_at, updated_at)
            $table->timestamps();

            // ================= DEFINISI FOREIGN KEY =================
            
            // Relasi ke tabel warga (Pastikan tabel 'warga' sudah ada sebelumnya)
            // Asumsi Primary Key di tabel warga adalah 'warga_id'
            $table->foreign('warga_id')
                ->references('warga_id') 
                ->on('warga') // Pastikan nama tabelnya 'warga' atau 'wargas'
                ->onDelete('cascade');

            // Relasi ke tabel umkm (Opsional/Jika diperlukan)
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