<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id'); // Konsisten menggunakan id()
            $table->unsignedBigInteger('umkm_id'); // Diubah ke unsignedBigInteger
            $table->string('nama_produk', 100);
            $table->string('jenis_produk',100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            // $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->enum('status', ['Aktif', 'Nonaktif', 'Pre-Order'])->default('Aktif');
            $table->timestamps();

            $table->foreign('umkm_id')
                  ->references('umkm_id')
                  ->on('umkm')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};