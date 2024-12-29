<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::upsert([
            [
                'name' => 'Marketing/Content',
            ],
            [
                'name' => 'Technology/Engineering',
            ],
            [
                'name' => 'Businsess/Finance',
            ],
            [
                'name' => 'Creative/Design',
            ],
        ], ['id', 'name'],['name']);
    }
}
