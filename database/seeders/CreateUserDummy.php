<?php

namespace Database\Seeders;


use Faker\Factory;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan 'id_ID' untuk data Indonesia
        $faker = Factory::create('id_ID');

        // Kita buat 50 data user dummy
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => $faker->optional(0.7)->dateTimeThisYear(), // 70% verified, 30% null
                'password' => Hash::make('password123'), // Default password untuk semua user dummy
                'remember_token' => $faker->optional(0.3)->asciify('**********'), // 30% memiliki remember token
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tambahkan satu admin user untuk testing
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
