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
        $faker = Factory::create('id_ID');

        echo "Memulai seeder pesanan...\n";

        // ✅ PERBAIKAN 1: Nama variabel disamakan menjadi $produkData
        $produkData = DB::table('produk')->select('produk_id', 'umkm_id', 'harga')->get();
            
        // Cek apakah data kosong
        if ($produkData->isEmpty()) { 
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // 2. AMBIL/BUAT DATA PELANGGAN (WARGA)
        // Cek tabel mana yang ada: 'warga' atau 'users'
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';

        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        // Fallback jika tidak ada data warga
        if (empty($pelangganIds)) {
             echo "Warning: Tabel warga kosong. Menggunakan ID dummy [1].\n";
             $pelangganIds = [1]; 
        }

        echo "Membuat data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];

        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // Pilih produk acak untuk mendapatkan ID UMKM & referensi harga
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            // Hitung dummy total (total asli nanti dihitung ulang oleh seeder detail_pesanan)
            $hargaProduk = $produk->harga;
            $jumlah = $faker->numberBetween(1, 5);
            $totalHarga = $hargaProduk * $jumlah;
            
            $status = $faker->randomElement($statusPesanan);
            
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            // ✅ PERBAIKAN 2: Sesuaikan nama kolom dengan tabel 'pesanan'
            // Tabel pesanan (Header) tidak butuh 'produk_id' atau 'jumlah', itu masuk di detail_pesanan.
            
            $pesananId = DB::table('pesanan')->insertGetId([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')),
                'warga_id'      => $pelangganId,      // Sesuai tabel (bukan pelanggan_id)
                'umkm_id'       => $produk->umkm_id,
                'total'         => $totalHarga,       // Sesuai tabel (bukan total_harga)
                'status'        => $status,
                'alamat_kirim'  => $faker->address(), // Tabel mewajibkan kolom ini jika tidak null
                'rt'            => $faker->numberBetween(1, 10),
                'rw'            => $faker->numberBetween(1, 10),
                'metode_bayar'  => $faker->randomElement($metodePembayaran), // Sesuai tabel (bukan metode_pembayaran)
                'bukti_bayar'   => $status === 'completed' ? 'bukti_' . $faker->uuid() . '.jpg' : null,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
        }

        echo "✅ Seeder pesanan berhasil dijalankan! (ID Pesanan dibuat: " . count($pesananIds) . ")\n";
    }
}