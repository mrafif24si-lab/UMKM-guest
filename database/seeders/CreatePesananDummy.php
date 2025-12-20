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

        // ✅ PERBAIKAN 1: Nama variabel disamakan menjadi $produkData (bukan $produk)
        // Kita ambil data produk untuk referensi harga dan umkm_id
        $produkData = DB::table('produk')->select('produk_id', 'umkm_id', 'harga')->get();
            
        // Cek apakah data produk ada
        if ($produkData->isEmpty()) { 
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // 2. AMBIL DATA WARGA (PELANGGAN)
        // Cek tabel mana yang tersedia (warga atau users)
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';

        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        // Fallback jika tabel warga kosong
        if (empty($pelangganIds)) {
             echo "Warning: Tabel warga kosong. Menggunakan ID dummy [1].\n";
             $pelangganIds = [1]; 
        }

        echo "Membuat data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];

        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // Pilih produk acak (hanya untuk referensi harga/umkm saat bikin dummy)
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            // Hitung dummy total
            $hargaProduk = $produk->harga;
            $jumlah = $faker->numberBetween(1, 5);
            $totalHarga = $hargaProduk * $jumlah;
            
            $status = $faker->randomElement($statusPesanan);
            
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            // ✅ PERBAIKAN 2: Insert data SESUAI struktur tabel 'pesanan' Anda
            // Hapus 'produk_id' dan 'jumlah' dari sini karena kolom itu tidak ada di tabel pesanan.
            
            $pesananId = DB::table('pesanan')->insertGetId([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')), // Wajib ada (berdasarkan screenshot)
                'warga_id'      => $pelangganId,      // Sesuai tabel (bukan pelanggan_id)
                'umkm_id'       => $produk->umkm_id,
                'total'         => $totalHarga,       // Sesuai tabel (bukan total_harga)
                'status'        => $status,
                'alamat_kirim'  => $faker->address(), // Kolom alamat_kirim ada di tabel
                'rt'            => $faker->numberBetween(1, 10),
                'rw'            => $faker->numberBetween(1, 10),
                'metode_bayar'  => $faker->randomElement($metodePembayaran), // Sesuai tabel (bukan metode_pembayaran)
                'bukti_bayar'   => $status === 'completed' ? 'bukti_' . $faker->uuid() . '.jpg' : null, // Sesuai tabel
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
            
            // CATATAN: Pengurangan stok produk sebaiknya dilakukan di Seeder DetailPesanan
            // karena tabel pesanan (header) tidak tahu produk apa yang dibeli secara spesifik.
        }

        echo "✅ Seeder pesanan berhasil dijalankan! (Dibuat: " . count($pesananIds) . " data)\n";
    }
}