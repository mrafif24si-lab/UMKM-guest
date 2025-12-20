<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateDetailPesananDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        echo "Memulai seeder detail pesanan...\n";

        // 1. AMBIL DATA PESANAN
        $pesanan = DB::table('pesanan')
            ->select('pesanan_id') 
            ->limit(50)
            ->get();

        if ($pesanan->isEmpty()) {
            echo "ERROR: Data pesanan tidak ditemukan! Jalankan seeder pesanan dulu.\n";
            return;
        }

        // 2. AMBIL DATA PRODUK
        $semuaProduk = DB::table('produk')->select('produk_id', 'harga')->get();
        
        if ($semuaProduk->isEmpty()) {
            echo "ERROR: Data produk tidak ditemukan!\n";
            return;
        }

        echo "Membuat data detail pesanan...\n";

        $detailPesananData = [];

        foreach ($pesanan as $order) {
            $jumlahItem = $faker->numberBetween(1, 3);
            
            for ($i = 0; $i < $jumlahItem; $i++) {
                $produk = $faker->randomElement($semuaProduk);
                
                $qty = $faker->numberBetween(1, 5);
                $hargaSatuan = $produk->harga;
                $subtotal = $hargaSatuan * $qty;
                $createdAt = $faker->dateTimeBetween('-3 months', 'now');
                
                $detailPesananData[] = [
                    'pesanan_id' => $order->pesanan_id,
                    'produk_id' => $produk->produk_id,
                    'qty' => $qty, 
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }
        }

        // Insert Batch
        foreach (array_chunk($detailPesananData, 50) as $chunk) {
            DB::table('detail_pesanan')->insert($chunk);
        }

        echo "\n✅ Seeder detail pesanan berhasil dijalankan! (" . count($detailPesananData) . " baris)\n";
        
        // Panggil fungsi update harga
        $this->updateTotalHargaPesanan();
    }
    
    private function updateTotalHargaPesanan(): void
    {
        echo "Memperbarui total harga di tabel pesanan...\n";
        
        $pesananIds = DB::table('detail_pesanan')
                        ->pluck('pesanan_id')
                        ->unique();
        
        foreach ($pesananIds as $id) {
            $sumTotal = DB::table('detail_pesanan')
                        ->where('pesanan_id', $id)
                        ->sum('subtotal');
            
            // ✅ PERBAIKAN: Menggunakan kolom 'total' sesuai gambar tabel Anda
            DB::table('pesanan')
                ->where('pesanan_id', $id)
                ->update(['total' => $sumTotal]);
        }
        
        echo "✅ Kolom 'total' pada tabel pesanan telah diperbarui!\n";
    }
}