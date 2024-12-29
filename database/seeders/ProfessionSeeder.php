<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::upsert([
            [
                'name' => 'Social-Media',
                'industry_id' => 1
            ],
            [
                'name' => 'Email/Communications',
                'industry_id' => 1

            ],
            [
                'name' => 'Digital Marketing',
                'industry_id' => 1
            ],
            [
                'name' => 'Field/Event Marketing',
                'industry_id' => 1
            ],
            [
                'name' => 'Product Owner',
                'industry_id' => 1
            ],
            [
                'name' => 'Digital Marketing',
                'industry_id' => 1
            ],
            [
                'name' => 'Product Marketing',
                'industry_id' => 1
            ],
        ], ['id', 'name'], ['name']);
    }
}