<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $input =  array(
                'type' => 1,
                'first_name' => fake()->name(),
                'last_name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('123456789'),
                'phone_no' => '12345678',
                'is_agree_with_terms_condition' => true,
                'recruiter_id' => rand(1, 4),
            );
            $user = User::create($input);
            $user->talentMeta()->create([
                'current_role' => 'Developer',
                'prefer_work_location_id' => rand(1, 2),
                'employer_selection_preference_id' => rand(1, 4),
                'coworker_review_id' => rand(1, 4),
                'hobby_id' => rand(1, 4),
                'state_id' => rand(1, 50),
            ]);
            $user->skills()->create([
                'profession_id' => rand(1, 4),
                'experience_id' => 1,
                // 'salary_id' => rand(1, 4),
            ]);
        }
    }
}
