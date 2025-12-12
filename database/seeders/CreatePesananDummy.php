<?php
// File: database/seeders/CreatePesananDummy.php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatePesananDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        echo "Memulai seeder pesanan...\n";

        // 1. AMBIL DATA PRODUK - PERBAIKAN: gunakan 'product_id'
        $produkData = DB::table('produk')
            ->select('product_id', 'umkm_id', 'range as harga')
            ->get();
            
        if ($produkData->isEmpty()) {
            echo "ERROR: Data produk tidak ditemukan! Jalankan seeder produk terlebih dahulu.\n";
            return;
        }

        // 2. AMBIL/BUAT DATA PELANGGAN
        if (!Schema::hasTable('pelanggan')) {
            echo "Membuat data pelanggan dummy...\n";
            
            $pelangganIds = [];
            $pelangganFaker = Factory::create();
            
            foreach (range(1, 50) as $index) {
                $pelangganId = DB::table('pelanggan')->insertGetId([
                    'first_name' => $pelangganFaker->firstName,
                    'last_name' => $pelangganFaker->lastName,
                    'birthday' => $pelangganFaker->date('Y-m-d', '2005-12-31'),
                    'gender' => $pelangganFaker->randomElement(['Male', 'Female', 'Other']),
                    'email' => $pelangganFaker->unique()->safeEmail,
                    'phone' => $pelangganFaker->phoneNumber,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $pelangganIds[] = $pelangganId;
            }
        } else {
            $pelangganIds = DB::table('pelanggan')->pluck('id')->toArray();
        }

        if (empty($pelangganIds)) {
            echo "ERROR: Tidak ada data pelanggan!\n";
            return;
        }

        echo "Membuat data pesanan...\n";

        $statusPesanan = ['pending', 'processing', 'completed', 'cancelled'];
        $metodePembayaran = ['Transfer Bank', 'Cash on Delivery', 'E-Wallet'];

        $pesananIds = [];

        foreach (range(1, 50) as $index) {
            // Pilih produk acak
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
                'product_id' => $produk->product_id, // PERBAIKAN: 'product_id' bukan 'produk_id'
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
                    ->where('product_id', $produk->product_id)
                    ->decrement('stock', $jumlah);
            }
        }

        echo "Seeder pesanan berhasil dijalankan!\n";
        echo "- " . count($pesananIds) . " data pesanan dibuat\n";
        echo "- Terkait " . count($produkData) . " produk dan " . count($pelangganIds) . " pelanggan\n";
    }
}