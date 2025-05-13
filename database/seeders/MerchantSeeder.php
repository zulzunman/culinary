<?php

namespace Database\Seeders;

use App\Models\MerchantProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil user mulai dari ID 25 ke atas
        $users = User::where('id', '>=', 25)->take(76)->get();

        foreach ($users as $user) {
            // Generate nomor telepon Indonesia maksimal 15 karakter
            $rawPhone = '08' . $faker->numerify(str_repeat('#', rand(9, 13))); // total 11–15 digit

            MerchantProfile::create([
                'nik' => $faker->unique()->nik(),
                'name' => $user->username,
                'phone' => substr($rawPhone, 0, 15),
                'user_id' => $user->id,
            ]);
        }
    }
}
