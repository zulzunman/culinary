<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     [
        //         'id' => 1,
        //         'username' => 'Super Admin',
        //         'email' => 'superadmin@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12345678'),
        //         'status' => 'APPROVE',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id' => 2,
        //         'username' => 'Admin',
        //         'email' => 'admin@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12345678'),
        //         'status' => 'APPROVE',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 76; $i++) {
            $name = $faker->unique()->firstName;
            User::create([
                'username' => $name,
                'email' => strtolower(str_replace(' ', '', $name)) . '@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
