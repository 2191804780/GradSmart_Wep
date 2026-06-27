<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Software Engineering',
                'code' => 'SE',
                'description' => 'Software Engineering Department',
            ],
            [
                'name' => 'Computer Networks',
                'code' => 'CN',
                'description' => 'Computer Networks Department',
            ],
            [
                'name' => 'Internet Technologies',
                'code' => 'IT',
                'description' => 'Internet Technologies Department',
            ],
            [
                'name' => 'Mobile Computing',
                'code' => 'MC',
                'description' => 'Mobile Computing Department',
            ],
            [
                'name' => 'Data Science',
                'code' => 'DS',
                'description' => 'Data Science Department',
            ],
            [
                'name' => 'Cyber Security',
                'code' => 'CY',
                'description' => 'Cyber Security Department',
            ],
            [
                'name' => 'Information Systems',
                'code' => 'IS',
                'description' => 'Information Systems Department',
            ],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['code' => $department['code']],
                $department
            );
        }
    }
}