<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $input = array(
                'type' => 2,
                'first_name' => fake()->name(),
                'last_name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('123456789'),
                'phone_no' => '12345678',
                'is_agree_with_terms_condition' => true,
                'recruiter_id' => rand(1, 4),
            );
            $user = User::create($input);
            $userMeta = $user->companyMeta()->create([
                'company_name' => fake()->name(),
                'description' => fake()->text(),
                'current_role' => 'Developer',
                'prefer_work_location_id' => rand(1, 3),
                'team_loveable_aspect_id' => rand(1, 4),
                'state_id' => rand(1, 50),
            ]);
            $position = $user->positions()->create([
                'profession_id' => rand(1, 4),
                'experience_id' => rand(1, 4),
                'salary_id' => rand(1, 4),
                'state_id' => rand(1, 50),
                'is_specfic_state' => 1,

            ]);
            $userMeta->managementStyles()->attach(['management_style_id' => rand(1, 3)]);
        }
    }
}
