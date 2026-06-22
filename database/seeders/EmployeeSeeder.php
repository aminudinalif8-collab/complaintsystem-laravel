<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Manager
        $manager = Employee::create([
            'employeeName' => 'Admin Manager',
            'employeeEmail' => 'manager@test.com',
            'employeePassword' => bcrypt('password123'),
            'employeePhone' => '0123456789',
            'role' => 'manager',
            'departmentID' => 1,
            'supervisorID' => null,
        ]);

        // Supervisor
        $supervisor = Employee::create([
            'employeeName' => 'Supervisor One',
            'employeeEmail' => 'supervisor@test.com',
            'employeePassword' => bcrypt('password123'),
            'employeePhone' => '0111111111',
            'role' => 'supervisor',
            'departmentID' => 1,
            'supervisorID' => $manager->employeeID, // 👈 BETUL
        ]);

        // Supervisor HR
        // $supervisorHR = Employee::create([
        //     'employeeName' => 'Supervisor HR',
        //     'employeeEmail' => 'supervisor_hr@test.com',
        //     'employeePassword' => bcrypt('password123'),
        //     'employeePhone' => '0112222222',
        //     'role' => 'supervisor',
        //     'departmentID' => 2, // 🔥 HR
        //     'supervisorID' => $manager->employeeID,
        // ]);

        // Clerk
        $clerk = Employee::create([
            'employeeName' => 'Clerk One',
            'employeeEmail' => 'clerk@test.com',
            'employeePassword' => bcrypt('password123'),
            'employeePhone' => '0111111111',
            'role' => 'clerk',
            'departmentID' => null,
            'supervisorID' => $supervisor->employeeID,
        ]);

        // Employee
        Employee::create([
            'employeeName' => 'Employee One',
            'employeeEmail' => 'employee@test.com',
            'employeePassword' => bcrypt('password123'),
            'employeePhone' => '0100000000',
            'role' => 'employee',
            'departmentID' => 1,
            'supervisorID' => $supervisor->employeeID, // 👈 BETUL
        ]);
    }
}