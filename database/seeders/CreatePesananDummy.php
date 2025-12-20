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

        // ✅ PERBAIKAN 1: Konsisten menggunakan nama variabel $produkData
        // Kita ambil data produk HANYA untuk referensi harga dan umkm_id
        $produkData = DB::table('produk')->select('produk_id', 'umkm_id', 'harga')->get();
            
        // Cek apakah data kosong
        if ($produkData->isEmpty()) { 
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // 2. AMBIL DATA WARGA (PELANGGAN)
        // Mengecek apakah tabel 'warga' ada, jika tidak cek 'users'
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        // Menentukan nama kolom primary key (warga_id atau id)
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';

        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        // Fallback jika tidak ada data warga, pakai dummy ID 1
        if (empty($pelangganIds)) {
             echo "Warning: Tabel warga kosong. Menggunakan ID dummy [1].\n";
             $pelangganIds = [1]; 
        }

        echo "Membuat data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        // Sesuaikan metode bayar dengan screenshot atau kebiasaan umum
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];

        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // Pilih produk acak dari $produkData (Variabel sudah benar sekarang)
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            // Hitung dummy total (Total asli nanti sebaiknya dihitung dari detail_pesanan)
            $hargaProduk = $produk->harga;
            $jumlahDummy = $faker->numberBetween(1, 5); // Hanya untuk simulasi total harga
            $totalHarga = $hargaProduk * $jumlahDummy;
            
            $status = $faker->randomElement($statusPesanan);
            
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            // ✅ PERBAIKAN 2: Insert data SESUAI struktur tabel 'pesanan'
            // Hapus 'produk_id' dan 'jumlah' karena tidak ada di tabel pesanan (adanya di detail_pesanan)
            
            $pesananId = DB::table('pesanan')->insertGetId([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')), // Kolom ini ada di struktur tabel
                'warga_id'      => $pelangganId,      // Sesuai tabel (bukan pelanggan_id)
                'umkm_id'       => $produk->umkm_id,
                'total'         => $totalHarga,       // Sesuai tabel (bukan total_harga)
                'status'        => $status,
                'alamat_kirim'  => $faker->address(), // Kolom ini wajib diisi (kecuali nullable)
                'rt'            => (string) $faker->numberBetween(1, 10), // Konversi ke string agar aman
                'rw'            => (string) $faker->numberBetween(1, 10),
                'metode_bayar'  => $faker->randomElement($metodePembayaran), // Sesuai tabel (bukan metode_pembayaran)
                'bukti_bayar'   => $status === 'completed' ? 'bukti_' . $faker->uuid() . '.jpg' : null, // Sesuai tabel
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
        }

        echo "✅ Seeder pesanan berhasil dijalankan! (ID Pesanan dibuat: " . count($pesananIds) . ")\n";
    }
}