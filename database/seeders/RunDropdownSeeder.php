<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\HobbySeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\SalarySeeder;
use Database\Seeders\IndustrySeeder;
use Database\Seeders\ExperienceSeeder;
use Database\Seeders\ProfessionSeeder;
use Database\Seeders\CoworkerReviewSeeder;
use Database\Seeders\ManagementStyleSeeder;
use Database\Seeders\TeamLovableAspectSeeder;
use Database\Seeders\PreferWorkLocationSeeder;
use Database\Seeders\EmployerSelectionPreferenceSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RunDropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CoworkerReviewSeeder::class,
            EmployerSelectionPreferenceSeeder::class,
            ExperienceSeeder::class,
            HobbySeeder::class,
            IndustrySeeder::class,
            ManagementStyleSeeder::class,
            PreferWorkLocationSeeder::class,
            ProfessionSeeder::class,
            SalarySeeder::class,
            TeamLovableAspectSeeder::class,
            StateSeeder::class,
        ]);
    }
}