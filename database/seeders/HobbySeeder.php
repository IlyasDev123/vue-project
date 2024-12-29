<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobby::updateOrCreate(['id' => 1],  [
            'name' => 'Cooking',
        ]);
        Hobby::updateOrCreate(['id' => 2],  [
            'name' => 'Make Music',
        ]);
        Hobby::updateOrCreate(['id' => 3],  [
            'name' => 'Home Improvements',
        ]);
        Hobby::updateOrCreate(['id' => 4],  [
            'name' => 'Spending time with friend and family',
        ]);
        Hobby::updateOrCreate(['id' => 5],  [
            'name' => 'Playing Video Games',
        ]);
        Hobby::updateOrCreate(['id' => 6],  [
            'name' => 'Workout/Sports',
        ]);
        Hobby::updateOrCreate(['id' => 7],  [
            'name' => 'Watching Movies',
        ]);

        // Hobby::upsert([
        //     [
        //         'name' => 'Watching Movies',
        //     ]
        //     ]);
    }
}
