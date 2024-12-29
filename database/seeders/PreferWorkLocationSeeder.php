<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreferWorkLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PreferWorkLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreferWorkLocation::upsert([
            [
                'name' => 'Hybrid',
            ],
            [
                'name' => 'In-Office',
            ],
            [
                'name' => 'Remote',
            ],
        ], ['id', 'name'], ['name']);
    }
}
