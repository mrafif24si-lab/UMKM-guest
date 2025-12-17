<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasan_produk', function (Blueprint $table) {
            $table->id('ulasan_id'); // Primary key
            
            // --- PERBAIKAN DI SINI ---
            // Menggunakan unsignedInteger karena tabel induk (warga) bertipe INT(10)
            $table->unsignedInteger('produk_id'); 
            $table->unsignedInteger('warga_id');  
            // -------------------------

            $table->tinyInteger('rating')->unsigned(); // Rating 1-5
            $table->text('komentar')->nullable(); // Komentar bisa kosong
            $table->timestamps(); // created_at dan updated_at

            // Foreign key constraints
            $table->foreign('produk_id')
                  ->references('produk_id')
                  ->on('produk')
                  ->onDelete('cascade'); 

            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade'); 

            // Unique constraint: satu warga hanya bisa kasih 1 ulasan per produk
            $table->unique(['produk_id', 'warga_id']);

            // Indexes untuk performa query
            $table->index('rating');
            $table->index('created_at');
            $table->index(['produk_id', 'rating']);
        });

        // Untuk database yang support check constraint
        if (config('database.default') !== 'mysql') {
            Schema::table('ulasan_produk', function (Blueprint $table) {
                $table->check('rating >= 1 AND rating <= 5');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_produk');
    }
};