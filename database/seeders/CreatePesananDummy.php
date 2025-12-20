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
        // ✅ PERBAIKAN 2: Select kolom yang benar ('produk_id')
       // Ubah 'product_id' menjadi 'produk_id'
$produk = DB::table('produk')->select('produk_id', 'umkm_id', 'harga')->get();
            
       if ($produkData->isEmpty()) { 
        echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
        return;
    }

        // 2. AMBIL/BUAT DATA PELANGGAN
        if (!Schema::hasTable('pelanggan')) {
            // ... (Kode bagian pelanggan ini sudah aman, biarkan saja jika menggunakan tabel users/pelanggan)
             $pelangganIds = DB::table('users')->pluck('id')->toArray(); // Asumsi tabel pelanggan adalah 'users'
             if(empty($pelangganIds)) {
                 echo "Warning: Menggunakan data dummy pelanggan manual karena tabel users kosong.\n";
                 $pelangganIds = range(1, 10); // Dummy ID
             }
        } else {
             // Jika tabel pelanggan bernama 'pelanggan'
             $pelangganIds = DB::table('pelanggan')->pluck('id')->toArray();
        }

        // Fallback jika tidak ada pelanggan
        if (empty($pelangganIds)) {
             $pelangganIds = [1]; 
        }

        echo "Membuat data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];

        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // Pilih produk acak dari $produkData (Variabel sudah benar sekarang)
            $produk = $faker->randomElement($produkData);
            $pelangganId = $faker->randomElement($pelangganIds);
            
            $hargaProduk = $produk->harga;
            $jumlah = $faker->numberBetween(1, 10);
            $totalHarga = $hargaProduk * $jumlah;
            
            $status = $faker->randomElement($statusPesanan);
            
            $createdAt = ($status === 'completed') 
                ? $faker->dateTimeBetween('-3 months', 'now')
                : now();

            $pesananId = DB::table('pesanan')->insertGetId([
                // ✅ PERBAIKAN 3: Gunakan 'produk_id' (sesuai database), bukan 'product_id'
                'produk_id' => $produk->produk_id, 
                
                'pelanggan_id' => $pelangganId,
                'umkm_id' => $produk->umkm_id,
                'jumlah' => $jumlah,
                'total_harga' => $totalHarga,
                'status' => $status,
                'metode_pembayaran' => $faker->randomElement($metodePembayaran),
                'bukti_pembayaran' => $status === 'completed' ? 'bukti_' . $faker->uuid() . '.jpg' : null,
                'catatan' => $faker->optional(0.3)->sentence(),
                'no_resi' => $status === 'completed' ? $faker->numerify('RESI##########') : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
            
            $pesananIds[] = $pesananId;
            
            // Update stok jika pesanan completed
            if ($status === 'completed') {
                DB::table('produk')
                    // ✅ PERBAIKAN 4: Pastikan where menggunakan 'produk_id'
                    ->where('produk_id', $produk->produk_id) 
                    // Pastikan nama kolom stok di tabel produk benar (biasanya 'stok' atau 'stock')
                    ->decrement('stok', $jumlah); 
            }
        }

        echo "Seeder pesanan berhasil dijalankan!\n";
    }
}