<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['departmentName' => 'IT Support'],
            ['departmentName' => 'Human Resources'],
            ['departmentName' => 'Finance / Billing'],
            ['departmentName' => 'Facility Management'],
            ['departmentName' => 'Technical'],
            ['departmentName' => 'Marketing'],
            ['departmentName' => 'Operations'],
        ]);
    }
}
