<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateProdukDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Kosongkan tabel produk terlebih dahulu
        DB::table('produk')->delete();

        // Ambil semua UMKM yang sudah ada
        $umkmList = DB::table('umkm')->get();
        
        if ($umkmList->isEmpty()) {
            echo "Warning: Tidak ada data UMKM. Jalankan CreateumkmDummy seeder terlebih dahulu.\n";
            return;
        }

        echo "Membuat data produk...\n";

        $jenisProduk = ['Makanan', 'Minuman', 'Pakaian', 'Aksesoris', 'Kerajinan', 'Elektronik', 'Kosmetik', 'Jasa', 'Pertanian', 'Perdagangan'];

        $descriptorOptions = [
            'Produk handmade dengan kualitas terbaik',
            'Dibuat dengan bahan-bahan pilihan',
            'Ramah lingkungan dan sustainable',
            'Desain eksklusif dan limited edition',
            'Harga terjangkau dengan kualitas premium'
        ];

        $products = [];

        foreach ($umkmList as $umkm) {
            // Setiap UMKM memiliki 3-8 produk
            $jumlahProduk = $faker->numberBetween(3, 8);
            
            // Cek nama primary key tabel umkm (biasanya umkm_id atau id)
            // Kita gunakan null coalescing operator untuk jaga-jaga
            $umkmId = $umkm->umkm_id ?? $umkm->id; 

            foreach (range(1, $jumlahProduk) as $index) {
                $stok = $faker->numberBetween(0, 200);
                
                $products[] = [
                    // 'product_id' => null, // Tidak perlu ditulis jika auto_increment
                    'umkm_id' => $umkmId, // PERBAIKAN: Sesuaikan dengan nama kolom di DB
                    'nama_produk' => $this->generateProductName($faker, $umkm->kategori), // PERBAIKAN: name_product -> nama_produk
                    'jenis_produk' => $faker->randomElement($jenisProduk), // PERBAIKAN: jenis_product -> jenis_produk
                    'deskripsi' => $faker->randomElement($descriptorOptions) . '. ' . $faker->paragraph(1), // PERBAIKAN: descriptor -> deskripsi
                    'harga' => $faker->numberBetween(10000, 1000000), // PERBAIKAN: range -> harga
                    'stok' => $stok, // PERBAIKAN: stock -> stok
                    'status' => $stok > 0 ? 'Aktif' : 'Nonaktif', // PERBAIKAN: Hanya gunakan Aktif/Nonaktif
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert menggunakan chunk untuk menghindari error jika data terlalu banyak
        foreach (array_chunk($products, 100) as $chunk) {
            DB::table('produk')->insert($chunk);
        }

        echo "Seeder produk berhasil dijalankan!\n";
    }

    private function generateProductName($faker, $kategoriUmkm)
    {
        $prefixes = [
            'Makanan & Minuman' => ['Renyah', 'Lezat', 'Segar'],
            'Kerajinan Tangan' => ['Handmade', 'Eksklusif', 'Unik'],
            'Fashion' => ['Trendy', 'Elegant', 'Modern'],
            'Jasa' => ['Professional', 'Expert', 'Quality'],
            // ... (opsional ditambahkan)
        ];

        $baseNames = [
            'Makanan & Minuman' => ['Kue', 'Snack', 'Minuman'],
            'Kerajinan Tangan' => ['Vas', 'Lukisan', 'Patung'],
            'Fashion' => ['Baju', 'Celana', 'Dress'],
            // ... (opsional ditambahkan)
        ];

        $defaultPrefix = ['Premium', 'Quality', 'Best'];
        $defaultBase = ['Produk', 'Item', 'Barang'];

        $prefix = $faker->randomElement($prefixes[$kategoriUmkm] ?? $defaultPrefix);
        $base = $faker->randomElement($baseNames[$kategoriUmkm] ?? $defaultBase);

        return $prefix . ' ' . $base . ' ' . $faker->word();
    }
}