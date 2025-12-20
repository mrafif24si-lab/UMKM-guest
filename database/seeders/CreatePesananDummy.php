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

        // ------------------------------------------------------------------
        // 1. AMBIL DATA PRODUK (Reference)
        // ------------------------------------------------------------------
        // Kita gunakan ->toArray() agar kompatibel dengan $faker->randomElement()
        $produkData = DB::table('produk')
            ->select('produk_id', 'umkm_id', 'harga')
            ->get()
            ->toArray(); 
            
        // Validasi jika produk kosong
        if (empty($produkData)) { 
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // ------------------------------------------------------------------
        // 2. AMBIL DATA WARGA (Pelanggan)
        // ------------------------------------------------------------------
        // Deteksi nama tabel (warga vs users)
        $tabelWarga = Schema::hasTable('warga') ? 'warga' : 'users';
        // Deteksi nama primary key (warga_id vs id)
        $kolomIdWarga = Schema::hasColumn($tabelWarga, 'warga_id') ? 'warga_id' : 'id';

        // Ambil ID pelanggan sebagai Array
        $pelangganIds = DB::table($tabelWarga)->pluck($kolomIdWarga)->toArray();

        // Fallback jika data warga kosong (Untuk mencegah error array kosong)
        if (empty($pelangganIds)) {
             echo "Warning: Tabel warga kosong. Menggunakan ID dummy [1].\n";
             $pelangganIds = [1]; 
        }

        // ------------------------------------------------------------------
        // 3. PROSES PEMBUATAN DUMMY
        // ------------------------------------------------------------------
        echo "Membuat 50 data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];
        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // A. Pilih Produk & Pelanggan Random
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            // B. Hitung Simulasi Harga
            // (Ingat: ini hanya dummy header, detail item biasanya ada di tabel detail_pesanan)
            $hargaProduk = $produk->harga;
            $jumlahDummy = $faker->numberBetween(1, 5);
            $totalHarga = $hargaProduk * $jumlahDummy;
            
            $status = $faker->randomElement($statusPesanan);
            
            // Atur tanggal: jika completed, tanggal mundur ke belakang.
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            // C. Insert ke Database
            // PERBAIKAN PENTING: Nama kolom disesuaikan dengan tabel 'pesanan'
            $pesananId = DB::table('pesanan')->insertGetId([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('??####')), 
                'warga_id'      => $pelangganId,        // Primary Key Warga
                'umkm_id'       => $produk->umkm_id,    // ID UMKM dari produk
                'total'         => $totalHarga,         // Nama kolom: 'total' (bukan total_harga)
                'status'        => $status,
                'alamat_kirim'  => $faker->address(),
                'rt'            => (string) $faker->numberBetween(1, 10), // Cast ke string agar aman (VARCHAR)
                'rw'            => (string) $faker->numberBetween(1, 10), // Cast ke string agar aman (VARCHAR)
                'metode_bayar'  => $faker->randomElement($metodePembayaran), // Nama kolom: 'metode_bayar'
                'bukti_bayar'   => $status === 'completed' ? 'bukti_dummy.jpg' : null,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
        }

        echo "✅ Sukses! " . count($pesananIds) . " data pesanan berhasil dibuat.\n";
    }
}