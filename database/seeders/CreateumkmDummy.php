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
        $faker = Factory::create('id_ID');

        // Kosongkan tabel terlebih dahulu
        DB::table('produk')->delete();
        DB::table('umkm')->delete();
        DB::table('warga')->delete();

        // Array untuk menyimpan ID warga yang dibuat
        $wargaIds = [];

        echo "Membuat data warga...\n";

        // 1. Buat data warga dummy (100 data)
   foreach (range(1, 100) as $index) {
            $wargaId = DB::table('warga')->insertGetId([
                'no_ktp' => $faker->unique()->numerify('14############'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'pekerjaan' => 'Wiraswasta',
                'telp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $wargaIds[] = $wargaId;
        }

        echo "Membuat data UMKM...\n";

        // 2. Buat data UMKM dummy (30-100 data)
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

        // Nama usaha dalam bahasa Indonesia
        $namaUsaha = [
            // Makanan & Minuman
            'Warung Makan Sederhana', 'Kedai Kopi Nusantara', 'Toko Kue Tradisional', 'Minuman Segar Alami',
            'Rumah Makan Padang', 'Kafe Baca Nyaman', 'Restoran Seafood Segar', 'Kedai Jajanan Pasar',
            
            // Kerajinan Tangan
            'Galery Kerajinan Kayu', 'Toko Anyaman Rotan', 'Sentra Batik Tulis', 'Workshop Keramik',
            'Studio Lukisan Lokal', 'Tempat Rajutan Tangan', 'Bengkel Ukiran Tradisional', 'Kios Souvenir Khas',
            
            // Fashion
            'Boutique Batik Modern', 'Toko Pakaian Muslim', 'Distro Kaos Lokal', 'Tas Rajut Eksklusif',
            'Aksesoris Tangan Berkualitas', 'Sepatu Kulit Asli', 'Toko Kebaya Pengantin', 'Butik Anak Trendi',
            
            // Jasa
            'Jasa Fotografi Profesional', 'Bengkel Elektronik Terpercaya', 'Laundry Express', 'Kursus Komputer',
            'Jasa Desain Interior', 'Tempat Penyewaan Alat', 'Konsultan Pajak UMKM', 'Pijat Refleksi Sehat',
            
            // Pertanian
            'Kebun Sayur Organik', 'Peternakan Ayam Kampung', 'Budidaya Ikan Air Tawar', 'Toko Bibit Unggul',
            'Pupuk Organik Murah', 'Hasil Kebun Segar', 'Madu Murni Asli', 'Tanaman Hias Indah',
            
            // Perdagangan
            'Toko Kelontong 24 Jam', 'Grosir Sembako Murah', 'Toko Alat Tulis Lengkap', 'Supermarket Mini',
            'Toko Mainan Edukatif', 'Pusat Oleh-oleh Khas', 'Toko Perlengkapan Rumah', 'Kios Elektronik',
            
            // Teknologi
            'Service HP & Laptop', 'Toko Aksesori Gadget', 'Jasa Pembuatan Website', 'Rental Komputer',
            'Toko Sparepart Elektronik', 'Jasa Install Software', 'Workshop Drone', 'Servis AC & Kulkas',
            
            // Kesehatan & Kecantikan
            'Apotek Herbal Alami', 'Salon Kecantikan Modern', 'Spa Relaksasi', 'Toko Alat Kesehatan',
            'Klinik Pengobatan Tradisional', 'Tempat Pijat Panggilan', 'Studio Makeup Artist', 'Toko Kosmetik Aman'
        ];

        // Deskripsi UMKM dalam bahasa Indonesia
        $deskripsiOptions = [
            'UMKM yang berfokus pada produk berkualitas dengan harga terjangkau untuk masyarakat sekitar.',
            'Dikelola secara profesional oleh keluarga dengan pengalaman lebih dari 10 tahun di bidang ini.',
            'Menggunakan bahan-bahan lokal yang segar dan terjamin kualitasnya setiap hari.',
            'Berkomitmen memberikan pelayanan terbaik dengan senyum ramah dan responsif terhadap keluhan pelanggan.',
            'Menerapkan sistem manajemen modern namun tetap mempertahankan nilai-nilai kearifan lokal.',
            'Berkolaborasi dengan pengrajin dan petani lokal untuk menciptakan produk yang unik dan bermakna.',
            'Memiliki visi untuk mengembangkan ekonomi kreatif daerah dan menciptakan lapangan pekerjaan.',
            'Sudah mendapatkan berbagai sertifikasi kualitas dan keamanan produk dari instansi terkait.',
            'Menerapkan prinsip sustainable business dengan meminimalkan limbah dan menggunakan kemasan ramah lingkungan.',
            'Terus berinovasi mengikuti tren pasar tanpa meninggalkan ciri khas dan originalitas produk.',
            'Memberikan pelatihan dan pendampingan kepada masyarakat sekitar untuk mengembangkan usaha serupa.',
            'Buka setiap hari dengan jam operasional yang fleksibel sesuai kebutuhan pelanggan.',
            'Menerima pesanan dalam jumlah besar untuk keperluan wedding, corporate, atau event lainnya.',
            'Memiliki jaringan distribusi yang luas hingga ke beberapa kota besar di Indonesia.',
            'Aktif berpartisipasi dalam pameran dan bazaar untuk memperkenalkan produk kepada masyarakat luas.',
            'Menerapkan sistem online dan offline untuk memudahkan pelanggan berbelanja dari mana saja.',
            'Bekerja sama dengan beberapa influencer lokal untuk memperluas pasar dan brand awareness.',
            'Memberikan garansi dan after sales service yang memuaskan bagi setiap pembelian produk.',
            'Terdaftar resmi dan memiliki izin usaha dari pemerintah daerah setempat.',
            'Bagian dari komunitas UMKM yang saling mendukung dan berkembang bersama.'
        ];

        $umkmIds = [];

      foreach (range(1, 100) as $index) {
            $kecamatan = $faker->randomElement(['Sukajadi', 'Coblong']);
            
            DB::table('umkm')->insert([
                'nama_usaha' => $faker->company(),
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'alamat' => 'Jl. ' . $faker->streetName() . ', ' . $kecamatan,
                'rt' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'kategori' => $faker->randomElement($kategoriUmkm),
                'kontak' => $faker->phoneNumber(),
                'deskripsi' => $faker->paragraph(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            
        }

        echo "Membuat data produk...\n";

        // 3. Buat data produk untuk setiap UMKM
        $jenisProduk = ['Makanan', 'Minuman', 'Pakaian', 'Aksesoris', 'Kerajinan', 'Elektronik', 'Kosmetik', 'Lainnya'];
        
        // Deskripsi produk dalam bahasa Indonesia
        $deskripsiProduk = [
            'Terbuat dari bahan pilihan dengan kualitas terjamin dan harga bersaing.',
            'Dibuat dengan tangan oleh pengrajin profesional yang berpengalaman.',
            'Produk fresh langsung dari sumbernya tanpa bahan pengawet berbahaya.',
            'Desain elegan dan timeless cocok untuk semua kesempatan.',
            'Sudah melalui proses quality control yang ketat sebelum sampai ke tangan pelanggan.',
            'Ramah lingkungan dengan kemasan yang bisa didaur ulang.',
            'Best seller dengan ratusan testimoni positif dari pelanggan setia.',
            'Customizable sesuai permintaan dan keinginan khusus pelanggan.',
            'Mendapat sertifikat halal dari MUI dan BPOM untuk keamanan konsumsi.',
            'Edisi terbatas, hanya diproduksi dalam jumlah tertentu setiap bulannya.'
        ];

        foreach ($umkmIds as $umkmId) {
            $jumlahProduk = $faker->numberBetween(2, 5);
            
            foreach (range(1, $jumlahProduk) as $productIndex) {
                DB::table('produk')->insert([
                    'umkm_id' => $umkmId,
                    'nama_produk' => $faker->randomElement([
                        'Kue Lumpur', 'Es Cendol', 'Batik Tulis', 'Gelang Perak', 'Vas Keramik',
                        'Charger HP', 'Lipstik Matte', 'Jasa Fotografi', 'Sayur Organik', 'Buku Tulis'
                    ]) . ' ' . $faker->randomElement(['Premium', 'Special', 'Original', 'Eksklusif']),
                    'jenis_produk' => $faker->randomElement($jenisProduk),
                    'deskripsi' => $faker->randomElement($deskripsiProduk) . ' ' . $faker->paragraph(1),
                    'harga' => $faker->numberBetween(10000, 500000),
                    'stok' => $faker->numberBetween(0, 100),
                    'status' => $faker->randomElement(['Aktif', 'Habis', 'Pre-Order']),
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