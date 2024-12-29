<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Post::create([
                "title" => fake()->text(),
                "description" => fake()->text(),
                "permission_status" => 1,
                'user_id' => 1
            ]);
        }
    }
}