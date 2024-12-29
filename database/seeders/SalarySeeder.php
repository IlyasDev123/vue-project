<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salary::updateOrCreate(['id' => 1],  [
            'start_range' => 5000,
        ]);
         Salary::updateOrCreate(['id' => 2],  [
            'start_range' => 10000,
        ]);
         Salary::updateOrCreate(['id' => 3],  [
            'start_range' => 15000,
        ]);
         Salary::updateOrCreate(['id' => 4],  [
            'start_range' => 20000,
        ]);

        Salary::updateOrCreate(['id' => 5],  [
            'start_range' => 25000,
        ]);
        Salary::updateOrCreate(['id' => 6],  [
            'start_range' => 50000,
        ]);
        Salary::updateOrCreate(['id' => 7],  [
            'start_range' => 100000,
        ]);
    }
}
