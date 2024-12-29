<?php

namespace Database\Seeders;

use App\Utlities\Constants;
use Illuminate\Database\Seeder;
use App\Models\CompanyUserMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyMatcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // for ($i = 0; $i < 10; $i++) {
        CompanyUserMatch::create([
            'position_id' => 6,
            'company_id' => 6,
            'talent_id' => 77,
            'status' => Constants::TALENT_SEND_REQUEST_TO_COMPANY
        ]);
        // }
    }
}