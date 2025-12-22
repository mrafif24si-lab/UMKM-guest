    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('umkm', function (Blueprint $table) {
                $table->id('umkm_id');
                $table->string('nama_usaha');
                $table->unsignedInteger('pemilik_warga_id'); 
                $table->text('alamat');
                $table->string('rt', 3);
                $table->string('rw', 3);
                $table->string('kategori');
                $table->string('kontak');
                $table->text('deskripsi')->nullable();
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('pemilik_warga_id')
                    ->references('warga_id')
                    ->on('warga')
                    ->onDelete('cascade');
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('umkm');
        }
    };