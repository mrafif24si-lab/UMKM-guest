<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('pesanan_id')
                  ->constrained('pesanan', 'pesanan_id')
                  ->onDelete('cascade');
            $table->foreignId('produk_id')
                  ->constrained('produk', 'produk_id')
                  ->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
            
            $table->index(['pesanan_id', 'produk_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
};