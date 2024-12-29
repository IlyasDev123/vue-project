<?php

namespace Database\Seeders;

use App\Models\ManagementStyle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManagementStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManagementStyle::upsert([
            [
                'name' => 'Hands On',
            ],
            [
                'name' => 'Fun',
            ],
            [
                'name' => 'Hands Off',
            ],
            [
                'name' => 'Feedback Focused',
            ],
            [
                'name' => 'Supportive',
            ],

        ], ['id', 'name'],['name']);
    }
}
