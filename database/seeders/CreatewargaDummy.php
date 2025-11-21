<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatewargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Gunakan 'id_ID' untuk data Indonesia
        $faker = Factory::create('id_ID');

        // Kita buat 100 data warga dummy
        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->unique()->numerify('14############'), // 16 digit
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']), // Sesuai ENUM
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->randomElement([
                    'Wiraswasta',
                    'Pegawai Negeri',
                    'Pegawai Swasta', 
                    'Petani',
                    'Nelayan',
                    'Pedagang',
                    'Buruh',
                    'Pensiunan',
                    'Pelajar/Mahasiswa',
                    'Ibu Rumah Tangga',
                    'Tidak Bekerja'
                ]),
                'telp' => $faker->numerify('08##########'), // 12 digit
                'email' => $faker->optional(0.8)->safeEmail(), // 80% punya email, 20% null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}