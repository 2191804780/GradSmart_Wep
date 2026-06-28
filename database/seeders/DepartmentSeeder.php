<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'قسم هندسة البرمجيات', 'code' => 'SE', 'description' => 'قسم هندسة البرمجيات'],
            ['name' => 'قسم الشبكات', 'code' => 'NET', 'description' => 'قسم الشبكات'],
            ['name' => 'قسم نظم التشغيل', 'code' => 'OS', 'description' => 'قسم نظم التشغيل'],
            ['name' => 'قسم الذكاء الاصطناعي', 'code' => 'AI', 'description' => 'قسم الذكاء الاصطناعي'],
            ['name' => 'قسم الأمن السيبراني', 'code' => 'CYB', 'description' => 'قسم الأمن السيبراني'],
            ['name' => 'قسم الحوسبة المتنقلة', 'code' => 'MC', 'description' => 'قسم الحوسبة المتنقلة'],
            ['name' => 'قسم برمجة الإنترنت', 'code' => 'WEB', 'description' => 'قسم برمجة الإنترنت'],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['code' => $department['code']],
                [
                    'name' => $department['name'],
                    'description' => $department['description'],
                ]
            );
        }
    }
}