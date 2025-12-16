<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
           // 1. Rename kolom yang namanya beda agar sesuai Controller
        // Pastikan package doctrine/dbal terinstall jika error (composer require doctrine/dbal)
        // Jika rename gagal, lakukan manual di phpMyAdmin (lihat Cara B)
        
        $table->renameColumn('total_harga', 'total'); 
        $table->renameColumn('metode_pembayaran', 'metode_bayar');
        $table->renameColumn('bukti_pembayaran', 'bukti_bayar');
        $table->renameColumn('pelanggan_id', 'warga_id'); // Asumsi pelanggan adalah warga

        // 2. Tambahkan kolom baru yang belum ada (termasuk nomor_pesanan yang bikin error)
        $table->string('nomor_pesanan', 50)->unique()->after('pesanan_id'); // SOLUSI UTAMA ERROR ANDA
        $table->string('alamat_kirim', 255)->after('status')->nullable();
        $table->string('rt', 3)->after('alamat_kirim')->nullable();
        $table->string('rw', 3)->after('rt')->nullable();

        // 3. Hapus kolom yang tidak dipakai di controller (Opsional, agar bersih)
        // $table->dropColumn(['produk_id', 'umkm_id', 'jumlah']);

        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn('nomor_pesanan');
        });
    }
};