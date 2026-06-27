<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // الترتيب مهم جداً! نبدأ بالجداول المستقلة أولاً (التي لا تعتمد على جداول أخرى)
        // ثم ننتقل للجداول التي تعتمد على الجداول السابقة

        // 1. أولاً: بذر الأدوار (لأن جدول users يحتاج role_id)
        $this->call(RoleSeeder::class);

        // 2. ثانياً: بذر الأقسام الأكاديمية (لأن جدول teams يحتاج department_id)
        $this->call(DepartmentSeeder::class);

        // 3. ثالثاً: بذر المستخدمين التجريبيين (بعد إنشاء الأدوار)
        $this->call(UserSeeder::class);

        // 4. رابعاً: بذر بيانات المشاريع والفرق والمهام للمشرف والطلاب
        $this->call(ProjectDataSeeder::class);
    }
}
