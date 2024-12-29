<?php

namespace Database\Seeders;

use App\Models\CoworkerReview;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoworkerReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoworkerReview::upsert([
            [
                'name' => 'Leader',
            ],
            [
                'name' => 'Trusting',
            ],
            [
                'name' => 'Knowledgable',
            ],
            [
                'name' => 'Dependable',
            ],
            [
                'name' => 'Easy-Going',
            ],
            [
                'name' => 'Ambitious',
            ],
            [
                'name' => 'Energetic',
            ],
            [
                'name' => 'Insightful',
            ],
            [
                'name' => 'Helpful',
            ],
        ], ['name']);
    }
}
