<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('pesanan_id');
            $table->string('nomor_pesanan', 50)->unique();
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->decimal('total', 15, 2);
            $table->enum('status', ['pending', 'proses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('alamat_kirim');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('metode_bayar', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};