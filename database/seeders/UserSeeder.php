<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // نمسح المستخدمين التجريبيين السابقين أولاً
        User::query()->delete();

        // --- مستخدم تجريبي بدور الطالب (role_id = 1) ---
        $students = [
            ['STU-001', 'أحمد محمد', 'student@gradsmart.com'],
            ['STU-002', 'سارة علي', 'student2@gradsmart.com'],
            ['STU-003', 'عمر خالد', 'student3@gradsmart.com'],
            ['STU-004', 'ليلى يوسف', 'student4@gradsmart.com'],
            ['STU-005', 'محمد أحمد', 'student5@gradsmart.com'],
            ['STU-006', 'رنا كريم', 'student6@gradsmart.com'],
            ['STU-007', 'يوسف محمد', 'student7@gradsmart.com'],
            ['STU-008', 'نور الدين أحمد', 'student8@gradsmart.com'],
        ];

        foreach ($students as $s) {
            User::create([
                'student_id'    => $s[0],
                'name'          => $s[1],
                'email'         => $s[2],
                'password'      => Hash::make('12345678'),
                'role_id'       => 1, // STUDENT
                'is_active'     => true,
                'created_at'    => now(),
            ]);
        }

        // --- مستخدم تجريبي بدور المشرف (role_id = 2) ---
        User::create([
            'student_id'    => null,
            'name'          => 'د. أحمد السالم',
            'email'         => 'supervisor@gradsmart.com',
            'password'      => Hash::make('12345678'),
            'role_id'       => 2, // SUPERVISOR
            'is_active'     => true,
            'created_at'    => now(),
        ]);

        // --- مستخدم تجريبي بدور الأدمن (role_id = 3) ---
        User::create([
            'student_id'    => null,
            'name'          => 'مسؤول النظام',
            'email'         => 'admin@gradsmart.com',
            'password'      => Hash::make('12345678'),
            'role_id'       => 3, // ADMIN
            'is_active'     => true,
            'created_at'    => now(),
        ]);
    }
}
