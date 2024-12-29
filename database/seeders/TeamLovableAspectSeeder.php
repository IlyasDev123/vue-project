<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamLovableAspect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamLovableAspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamLovableAspect::upsert([
            [
                'name' => 'Fun Projects',
            ],
            [
                'name' => 'Fast-Paced',
            ],
            [
                'name' => 'Competitive Pay/Benefits',
            ],
            [
                'name' => 'Flexible Scheduling',
            ],
            [
                'name' => 'Growth Opportunities',
            ],
            [
                'name' => 'Strong Leadership',
            ],
            [
                'name' => 'Team Culture',
            ],
            [
                'name' => 'Company Events',
            ], [
                'name' => 'Innovative Projects',
            ],
        ], ['id'], ['name']);
    }
}
