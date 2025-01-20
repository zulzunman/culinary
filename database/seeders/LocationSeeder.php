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
        $faker = Faker ::create();

        $locations = [];
        for ($i = 1; $i <= 150; $i++) {
            $locations[] = [
                'id' => $i,
                'code' => sprintf('LC%03d', $i), // Format seperti LCU001, LCU002, dst.
                'detail' => $faker->address, // Generate random address
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('locations')->insert($locations);
    }
}
