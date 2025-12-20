<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUlasanProdukDummy extends Seeder
{
    public function run(): void
    {
        // Gunakan locale id_ID agar nama dan teks komentar berbahasa Indonesia
        $faker = Factory::create('id_ID');

        echo "Memulai seeder ulasan produk...\n";

        // 1. AMBIL ID PRODUK YANG ADA
        // Pastikan kolom di database Anda adalah 'produk_id'
        $produkIds = DB::table('produk')->pluck('produk_id')->toArray();

        if (empty($produkIds)) {
            echo "ERROR: Tabel 'produk' kosong. Jalankan seeder produk dulu.\n";
            return;
        }

        // 2. AMBIL ID WARGA
        // Cek apakah tabelnya 'warga' atau 'users'
        if (Schema::hasTable('warga')) {
            $tableNameWarga = 'warga';
            // ✅ PERBAIKAN DI SINI: Menggunakan 'warga_id' bukan 'id'
            $colName = 'warga_id'; 
        } else {
            $tableNameWarga = 'users';
            $colName = 'id';
        }

        echo "Mengambil data dari tabel: $tableNameWarga (kolom: $colName)...\n";

        $wargaIds = DB::table($tableNameWarga)->pluck($colName)->toArray();

        if (empty($wargaIds)) {
            echo "WARNING: Tabel '$tableNameWarga' kosong. Menggunakan ID dummy [1..10] untuk mencegah error.\n";
            $wargaIds = range(1, 10);
        }

        echo "Membuat 50 ulasan produk acak...\n";

        $ulasanData = [];
        
        // Contoh kalimat ulasan
        $ulasanPositif = [
            'Barangnya bagus banget, sesuai ekspektasi!',
            'Pengiriman cepat, packing rapi. Mantap!',
            'Kualitas produk oke punya, seller ramah.',
            'Suka banget sama produknya, bakal langganan nih.',
            'Harga terjangkau tapi kualitas bintang lima.'
        ];

        $ulasanNetral = [
            'Barang sampai dengan aman, lumayan lah.',
            'Pengiriman agak lama, tapi barang oke.',
            'Sesuai harga, nothing special.',
            'Cukup bagus, semoga awet.',
            'Warna agak beda dikit sama foto, tapi gapapa.'
        ];

        // Loop pembuatan data
        for ($i = 0; $i < 50; $i++) {
            $rating = $faker->randomElement([3, 4, 4, 5, 5, 5]); 
            
            if ($rating >= 4) {
                $komentar = $faker->randomElement($ulasanPositif) . ' ' . $faker->sentence();
            } else {
                $komentar = $faker->randomElement($ulasanNetral) . ' ' . $faker->sentence();
            }

            $createdAt = $faker->dateTimeBetween('-6 months', 'now');

            $ulasanData[] = [
                'produk_id' => $faker->randomElement($produkIds),
                'warga_id'  => $faker->randomElement($wargaIds),
                'rating'    => $rating,
                'komentar'  => $komentar,
                'created_at'=> $createdAt,
                'updated_at'=> $createdAt,
            ];
        }

        // Insert Batch
        foreach (array_chunk($ulasanData, 50) as $chunk) {
            DB::table('ulasan_produk')->insert($chunk);
        }

        echo "✅ Berhasil menambahkan " . count($ulasanData) . " ulasan produk!\n";
    }
}