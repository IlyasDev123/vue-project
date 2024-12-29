<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Refer;
use App\Models\Position;
use App\Utlities\Constants;
use Illuminate\Database\Seeder;
use App\Models\CompanyUserMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TalentMatcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $talent = User::where('type', 1)->pluck('id');
        $poitions = Position::pluck('id');
        $employer = User::where('type', 2)->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            Refer::create([
                'talent_id' => 58,
                'company_id' => $employer[$i],
                'position_id' => $poitions[$i],
                'status' => Constants::REFER_STATUS['talent'],
            ]);

            CompanyUserMatch::create([
                'talent_id' => 58,
                'position_id' => $poitions[$i],
                'company_id' => $employer[$i],
                'status' => Constants::REFER_TO_TALENT,
            ]);
        }
    }
}