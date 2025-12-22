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
        // Gunakan locale Indonesia
        $faker = Factory::create('id_ID');

        echo "Memulai seeder pesanan...\n";

        // ------------------------------------------------------------------
        // 1. AMBIL DATA PRODUK (Referensi)
        // ------------------------------------------------------------------
        // PENTING: Gunakan ->toArray() agar kompatibel dengan $faker->randomElement()
        // Kita butuh harga untuk simulasi 'total' dan umkm_id untuk relasi
        $produkData = DB::table('produk')
            ->select('produk_id', 'umkm_id', 'harga')
            ->get()
            ->toArray(); 
            
        // Validasi: Jika tabel produk kosong, berhenti.
        if (empty($produkData)) { 
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // ------------------------------------------------------------------
        // 2. AMBIL DATA WARGA (Pelanggan)
        // ------------------------------------------------------------------
        // Cek nama tabel (warga atau users)
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';

        // Ambil ID pelanggan sebagai Array
        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        // Fallback jika tidak ada warga (mencegah error array kosong)
        if (empty($pelangganIds)) {
             echo "Warning: Tabel warga kosong. Menggunakan ID dummy [1].\n";
             $pelangganIds = [1]; 
        }

        // ------------------------------------------------------------------
        // 3. PROSES INSERT DATA PESANAN
        // ------------------------------------------------------------------
        echo "Membuat 50 data pesanan dummy...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];
        
        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // A. Pilih Data Random
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            // B. Hitung Simulasi Total Harga
            // (Catatan: Total asli idealnya hitungan dari detail_pesanan, tapi untuk dummy pesanan kita tembak dulu)
            $hargaProduk = $produk->harga;
            $jumlahDummy = $faker->numberBetween(1, 5);
            $totalBayar = $hargaProduk * $jumlahDummy;
            
            // C. Tentukan Status & Tanggal
            $status = $faker->randomElement($statusPesanan);
            // Jika completed, buat tanggal mundur ke belakang
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            // D. Insert ke Tabel 'pesanan'
            // Struktur kolom disesuaikan dengan gambar database Anda
            $pesananId = DB::table('pesanan')->insertGetId([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')), 
                'warga_id'      => $pelangganId,        // FK ke Warga
                'umkm_id'       => $produk->umkm_id,    // FK ke UMKM (diambil dari produk)
                'total'         => $totalBayar,         // Nama kolom di tabel adalah 'total'
                'status'        => $status,
                'alamat_kirim'  => $faker->address(),
                'rt'            => (string) $faker->numberBetween(1, 10), // Cast string untuk kolom VARCHAR
                'rw'            => (string) $faker->numberBetween(1, 10), // Cast string untuk kolom VARCHAR
                'metode_bayar'  => $faker->randomElement($metodePembayaran),
                'bukti_bayar'   => $status === 'completed' ? 'bukti_dummy.jpg' : null,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
        }

        echo "✅ Sukses! " . count($pesananIds) . " data pesanan berhasil dibuat.\n";
    }
}