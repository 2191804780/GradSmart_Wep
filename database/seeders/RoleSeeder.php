<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // نوقف التحقق من المفاتيح الأجنبية مؤقتاً لتتمكن من مسح الجدول بأمان
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // نضيف الأدوار الأربعة الأساسية في النظام كما هو محدد في وثيقة SRS
        DB::table('roles')->insert([
            ['role_name' => 'STUDENT',    'description' => 'طالب يعمل ضمن فريق مشروع تخرج'],
            ['role_name' => 'SUPERVISOR', 'description' => 'مشرف أكاديمي يتابع مشاريع الفرق'],
            ['role_name' => 'ADMIN',      'description' => 'مسؤول النظام ويدير جميع المستخدمين'],
            ['role_name' => 'EXAMINER',   'description' => 'ممتحن خارجي يقيّم مشاريع التخرج'],
        ]);
    }
}
