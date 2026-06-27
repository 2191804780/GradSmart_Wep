<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        
    

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['code' => $department['code']],
                $department
            );
        }
    }
}
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('departments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // نضيف الأقسام الأكاديمية الصحيحة الخاصة بالمشروع
        DB::table('departments')->insert([
            ['name' => 'هندسة البرمجيات',    'code' => 'SE',  'description' => 'قسم هندسة البرمجيات'],
            ['name' => 'شبكات',               'code' => 'NET', 'description' => 'قسم الشبكات'],
            ['name' => 'نظم تشغيل',           'code' => 'OS',  'description' => 'قسم نظم التشغيل'],
            ['name' => 'ذكاء اصطناعي',        'code' => 'AI',  'description' => 'قسم الذكاء الاصطناعي'],
            ['name' => 'أمن سيبراني',         'code' => 'CYB', 'description' => 'قسم الأمن السيبراني'],
            ['name' => 'الحوسبة المتنقلة',    'code' => 'MC',  'description' => 'قسم الحوسبة المتنقلة'],
            ['name' => 'برمجة الإنترنت',      'code' => 'WEB', 'description' => 'قسم برمجة الإنترنت'],
        ]);
    }
}
