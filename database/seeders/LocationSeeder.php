<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Batasan area kawasan Lengkong Culinary
        // Batasan koordinat sepanjang Jalan Lengkong Kecil
        $minLat = -6.9270; // Selatan
        $maxLat = -6.9215; // Utara
        $baseLng = 107.6110; // Longitude utama di tengah jalan

        $locations = [];
        for ($i = 1; $i <= 153; $i++) {
            $locations[] = [
                'id' => $i,
                'code' => sprintf('LC%03d', $i), // Format seperti LC001, LC002, dst.
                'detail' => $faker->address, // Generate random address
                'latitude' => $faker->randomFloat(7, $minLat, $maxLat), // Acak di sepanjang jalan
                'longitude' => $faker->randomFloat(7, $baseLng, $baseLng + 0.0008), // Geser ke kanan jalan
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('locations')->insert($locations);
    }
}
