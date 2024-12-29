<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Experience::updateOrCreate(['id' => 1],  [
            'start_range' => 0.6,
        ]);
        Experience::updateOrCreate(['id' => 2],  [
            'start_range' => 1,
        ]);
         Experience::updateOrCreate(['id' => 3],  [
            'start_range' => 2,
        ]);
         Experience::updateOrCreate(['id' => 4],  [
            'start_range' => 3,
        ]);
         Experience::updateOrCreate(['id' => 5],  [
            'start_range' => 5,
        ]);
        Experience::updateOrCreate(['id' => 6],  [
            'start_range' => 10,
        ]);
    }
}
