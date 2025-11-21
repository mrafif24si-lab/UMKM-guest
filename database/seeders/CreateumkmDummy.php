<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateumkmDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');// INISIALISASI FAKER

        // Kosongkan tabel terlebih dahulu (urutan penting karena foreign key)
        DB::table('produk')->delete();
        DB::table('umkm')->delete();
        DB::table('warga')->delete();

        // Array untuk menyimpan ID warga yang dibuat
        $wargaIds = [];

        echo "Membuat data warga...\n";

        // 1. Buat data warga dummy (50 data)
        foreach (range(1, 100) as $index) {
            $wargaId = DB::table('warga')->insertGetId([
                'no_ktp' => $faker->unique()->numerify('14############'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']), // SESUAIKAN DENGAN ENUM
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'pekerjaan' => $faker->randomElement([
                    'Wiraswasta', 'Pegawai Swasta', 'PNS', 'Petani', 'Nelayan', 
                    'Pedagang', 'Karyawan', 'Pengusaha', 'Freelancer', 'Ibu Rumah Tangga'
                ]),
                'telp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $wargaIds[] = $wargaId;
        }

        echo "Membuat data UMKM...\n";

        // 2. Buat data UMKM dummy (30 data)
        $kategoriUmkm = [
            'Makanan & Minuman',
            'Kerajinan Tangan',
            'Fashion',
            'Jasa',
            'Pertanian',
            'Perdagangan',
            'Teknologi',
            'Kesehatan & Kecantikan'
        ];

        $umkmIds = [];

        foreach (range(1, 100) as $index) {
            $umkmId = DB::table('umkm')->insertGetId([
                'nama_usaha' => $faker->company(),
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'alamat' => $faker->streetAddress(),
                'rt' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'kategori' => $faker->randomElement($kategoriUmkm),
                'kontak' => $faker->phoneNumber(),
                'deskripsi' => $faker->paragraph(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $umkmIds[] = $umkmId;
        }

        echo "Membuat data produk...\n";

        // 3. Buat data produk untuk setiap UMKM
        $jenisProduk = ['Makanan', 'Minuman', 'Pakaian', 'Aksesoris', 'Kerajinan', 'Elektronik', 'Kosmetik', 'Lainnya'];

        foreach ($umkmIds as $umkmId) {
            // Setiap UMKM punya 2-5 produk
            $jumlahProduk = $faker->numberBetween(2, 5);
            
            foreach (range(1, $jumlahProduk) as $productIndex) {
                DB::table('produk')->insert([
                    'umkm_id' => $umkmId,
                    'nama_produk' => $faker->words(3, true),
                    'jenis_produk' => $faker->randomElement($jenisProduk),
                    'deskripsi' => $faker->paragraph(2),
                    'harga' => $faker->numberBetween(10000, 500000),
                    'stok' => $faker->numberBetween(0, 100),
                    'status' => $faker->randomElement(['Aktif', 'Nonaktif']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Seeder berhasil dijalankan!\n";
        echo "- " . count($wargaIds) . " data warga dibuat\n";
        echo "- " . count($umkmIds) . " data UMKM dibuat\n";
        echo "- Data produk untuk setiap UMKM dibuat\n";
    }
}
