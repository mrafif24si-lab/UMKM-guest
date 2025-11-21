<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Kosongkan tabel produk terlebih dahulu
        DB::table('produk')->delete();

        // Ambil semua UMKM yang sudah ada
        $umkm = DB::table('umkm')->get();
        
        if ($umkm->isEmpty()) {
            echo "Warning: Tidak ada data UMKM. Jalankan CreateumkmDummy seeder terlebih dahulu.\n";
            return;
        }

        echo "Membuat data produk...\n";

        $jenisProduk = [
            'Makanan',
            'Minuman', 
            'Pakaian',
            'Aksesoris',
            'Kerajinan',
            'Elektronik',
            'Kosmetik',
            'Jasa',
            'Pertanian',
            'Perdagangan'
        ];

        $descriptorOptions = [
            'Produk handmade dengan kualitas terbaik',
            'Dibuat dengan bahan-bahan pilihan',
            'Ramah lingkungan dan sustainable',
            'Desain eksklusif dan limited edition',
            'Cocok untuk semua kalangan',
            'Harga terjangkau dengan kualitas premium',
            'Produk lokal dengan sentuhan modern',
            'Terinspirasi dari budaya lokal',
            'Dibuat oleh pengrajin berpengalaman',
            'Packaging eco-friendly dan menarik'
        ];

        $products = [];

        foreach ($umkm as $umkm) {
            // Setiap UMKM memiliki 3-8 produk
            $jumlahProduk = $faker->numberBetween(3, 8);
            
            foreach (range(1, $jumlahProduk) as $index) {
                $harga = $faker->numberBetween(10000, 1000000);
                $stok = $faker->numberBetween(0, 200);
                
                $products[] = [
                    'product_id' => null, // AUTO_INCREMENT
                    'union_id' => $umkm->id, // Referensi ke UMKM
                    'name_product' => $this->generateProductName($faker, $umkm->kategori),
                    'jenis_product' => $faker->randomElement($jenisProduk),
                    'descriptor' => $faker->randomElement($descriptorOptions) . '. ' . $faker->paragraph(1),
                    'range' => $harga, // DECIMAL field untuk harga
                    'stock' => $stok,
                    'status' => $stok > 0 ? 'Aktif' : 'Nonaktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert semua produk sekaligus untuk optimasi
        DB::table('produk')->insert($products);

        echo "Seeder produk berhasil dijalankan!\n";
        echo "- " . count($products) . " data produk dibuat\n";
        echo "- Terkait dengan " . $umkm->count() . " UMKM\n";
    }

    /**
     * Generate nama produk berdasarkan kategori UMKM
     */
    private function generateProductName($faker, $kategoriUmkm)
    {
        $prefixes = [
            'Makanan & Minuman' => ['Renyah', 'Lezat', 'Segar', 'Gurih', 'Manis'],
            'Kerajinan Tangan' => ['Handmade', 'Eksklusif', 'Unik', 'Traditional', 'Artistic'],
            'Fashion' => ['Trendy', 'Elegant', 'Modern', 'Classic', 'Stylish'],
            'Jasa' => ['Professional', 'Expert', 'Quality', 'Premium', 'Reliable'],
            'Pertanian' => ['Organic', 'Fresh', 'Natural', 'Healthy', 'Local'],
            'Perdagangan' => ['Quality', 'Best', 'Premium', 'Original', 'Genuine'],
            'Teknologi' => ['Smart', 'Digital', 'Advanced', 'Innovative', 'Tech'],
            'Kesehatan & Kecantikan' => ['Natural', 'Healthy', 'Beauty', 'Care', 'Fresh']
        ];

        $baseNames = [
            'Makanan & Minuman' => ['Kue', 'Snack', 'Minuman', 'Kudapan', 'Camilan'],
            'Kerajinan Tangan' => ['Vas', 'Lukisan', 'Patung', 'Anyaman', 'Ukiran'],
            'Fashion' => ['Baju', 'Celana', 'Dress', 'Aksesori', 'Tas'],
            'Jasa' => ['Konsultasi', 'Service', 'Reparasi', 'Treatment', 'Pelatihan'],
            'Pertanian' => ['Sayur', 'Buah', 'Bibit', 'Pupuk', 'Hasil Bumi'],
            'Perdagangan' => ['Barang', 'Produk', 'Item', 'Merchandise', 'Goods'],
            'Teknologi' => ['Gadget', 'Device', 'Tool', 'Equipment', 'App'],
            'Kesehatan & Kecantikan' => ['Skincare', 'Suplemen', 'Obat', 'Kosmetik', 'Treatment']
        ];

        // Default jika kategori tidak ditemukan
        $defaultPrefix = ['Premium', 'Quality', 'Best', 'Excellent', 'Super'];
        $defaultBase = ['Produk', 'Item', 'Barang', 'Goods', 'Merchandise'];

        $prefix = $faker->randomElement(
            $prefixes[$kategoriUmkm] ?? $defaultPrefix
        );
        
        $base = $faker->randomElement(
            $baseNames[$kategoriUmkm] ?? $defaultBase
        );

        return $prefix . ' ' . $base . ' ' . $faker->word();
    }
}