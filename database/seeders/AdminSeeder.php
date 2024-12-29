<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'first_name' => 'Admin',
                'last_name' => "admin",
                'phone_no' => 123456789,
                'email' => "admin@admin.com",
                'email_verified_at' => now(),
                'type' => 4,
                'avatar' => 'kattie.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'KATIE',
                'last_name' => "CLARK",
                'phone_no' => 123456789,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'type' => 3,
                'avatar' => 'kattie.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],

            [
                'first_name' => 'Claud',
                'last_name' => "ALEXANDER",
                'phone_no' => 123456789,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'type' => 3,
                'avatar' => 'claud.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],

            [
                'first_name' => 'Daniel',
                'last_name' => "Filimon",
                'phone_no' => 123456789,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'type' => 3,
                'avatar' => 'Daniel.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'Tania',
                'last_name' => "Ursan",
                'phone_no' => 123456789,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'type' => 3,
                'avatar' => 'tania.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'Ryan',
                'last_name' => "Lawrence",
                'phone_no' => 123456789,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'type' => 3,
                'avatar' => 'rayan.png',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],

        ];

        User::insert($data);
    }
}
