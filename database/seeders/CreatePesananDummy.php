<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePesananDummy extends Seeder
{
    public function run(): void
    {
        // TANDA BAHWA KODE BARU SUDAH MASUK
        echo "\n--------------------------------------------\n";
        echo "   --- VERSI PERBAIKAN FINAL (DIJAMIN JALAN) ---   \n";
        echo "--------------------------------------------\n";

        $faker = Factory::create('id_ID');

        // 1. CEK KONEKSI DATABASE PRODUK
        echo "1. Mengambil data produk...\n";
        
        // Menggunakan array murni agar aman dari error object/collection
        $produkData = DB::table('produk')
            ->select('produk_id', 'umkm_id', 'harga')
            ->get()
            ->map(function ($item) {
                return (array) $item; // Paksa jadi array
            })
            ->toArray();

        // Debug: Tampilkan jumlah produk yang ditemukan
        $jumlahProduk = count($produkData);
        echo "   -> Ditemukan: " . $jumlahProduk . " produk.\n";

        if ($jumlahProduk === 0) {
            echo "❌ ERROR: Tabel 'produk' kosong di Server! Jalankan seeder produk dulu.\n";
            return;
        }

        // 2. CEK PELANGGAN
        echo "2. Mengambil data warga/pelanggan...\n";
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';
        
        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        if (empty($pelangganIds)) {
            echo "   -> Warning: Tidak ada warga. Menggunakan ID dummy [1].\n";
            $pelangganIds = [1];
        } else {
            echo "   -> Ditemukan: " . count($pelangganIds) . " warga.\n";
        }

        // 3. MULAI LOOPING
        echo "3. Mulai membuat pesanan...\n";
        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];
        
        $berhasil = 0;

        foreach (range(1, 50) as $index) {
            try {
                $produk = $faker->randomElement($produkData);
                $pelangganId = $faker->randomElement($pelangganIds);

                // Akses array (karena sudah dikonversi di atas)
                $harga = $produk['harga'];
                $umkmId = $produk['umkm_id'];
                
                $jumlah = $faker->numberBetween(1, 5);
                $total = $harga * $jumlah;
                $status = $faker->randomElement($statusPesanan);
                $createdAt = $status === 'completed' ? $faker->dateTimeBetween('-3 months', 'now') : now();

                // Insert
                DB::table('pesanan')->insert([
                    'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')),
                    'warga_id'      => $pelangganId,
                    'umkm_id'       => $umkmId,
                    'total'         => $total,
                    'status'        => $status,
                    'alamat_kirim'  => $faker->address(),
                    'rt'            => (string) $faker->numberBetween(1, 10),
                    'rw'            => (string) $faker->numberBetween(1, 10),
                    'metode_bayar'  => $faker->randomElement($metodePembayaran),
                    'bukti_bayar'   => $status === 'completed' ? 'dummy.jpg' : null,
                    'created_at'    => $createdAt,
                    'updated_at'    => $createdAt,
                ]);
                $berhasil++;
            } catch (\Exception $e) {
                echo "   ❌ Gagal di baris $index: " . $e->getMessage() . "\n";
            }
        }

        echo "\n✅ SUKSES! Total " . $berhasil . " pesanan berhasil dibuat.\n";
    }
}