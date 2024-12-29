<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployerSelectionPreference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployerSelectionPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployerSelectionPreference::upsert([
            [
                'name' => 'Company culture',
            ],
            [
                'name' => 'Work-Life Balance',
            ],
            [
                'name' => 'Growth Opportunities',
            ],
            [
                'name' => 'Pay/Benefits',
            ],
            [
                'name' => 'Exciting Projects',
            ],
            [
                'name' => 'Stability',
            ],
        ], ['id'], ['name']);
    }
}
