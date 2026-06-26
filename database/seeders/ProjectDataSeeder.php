<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\Task;
use App\Models\File;
use App\Models\Comment;
use App\Models\Evaluation;
use App\Models\Notification;
use App\Models\Message;
use App\Models\AiReport;

class ProjectDataSeeder extends Seeder
{
    public function run(): void
    {
        // نوقف التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // تنظيف الجداول القديمة
        Team::query()->delete();
        DB::table('team_members')->delete();
        Project::query()->delete();
        Milestone::query()->delete();
        Task::query()->delete();
        File::query()->delete();
        Comment::query()->delete();
        Evaluation::query()->delete();
        Notification::query()->delete();
        Message::query()->delete();
        AiReport::query()->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- بذر الفرق (Teams) ---
        // المشرف هو د. أحمد السالم (ID = 9)
        // منشئ الفريق (created_by) هو رئيس الفريق (طالب)

        // 1. فريق Alpha (هندسة البرمجيات: ID = 1)
        $teamAlpha = Team::create([
            'id' => 1,
            'name' => 'Alpha',
            'department_id' => 1, // هندسة البرمجيات
            'invite_code' => 'ALPHA123',
            'max_members' => 4,
            'supervisor_id' => 9,
            'created_by' => 5, // محمد أحمد
            'created_at' => now()->subDays(50),
        ]);

        // 2. فريق Beta (هندسة البرمجيات: ID = 1)
        $teamBeta = Team::create([
            'id' => 2,
            'name' => 'Beta',
            'department_id' => 1,
            'invite_code' => 'BETA456',
            'max_members' => 4,
            'supervisor_id' => 9,
            'created_by' => 1, // أحمد محمد
            'created_at' => now()->subDays(30),
        ]);

        // 3. فريق Gamma (برمجة الإنترنت: ID = 7)
        $teamGamma = Team::create([
            'id' => 3,
            'name' => 'Gamma',
            'department_id' => 7,
            'invite_code' => 'GAMMA789',
            'max_members' => 3,
            'supervisor_id' => 9,
            'created_by' => 7, // يوسف محمد
            'created_at' => now()->subDays(20),
        ]);

        // 4. فريق Delta (ذكاء اصطناعي: ID = 4) - طلب إشراف جديد
        $teamDelta = Team::create([
            'id' => 4,
            'name' => 'Delta',
            'department_id' => 4,
            'invite_code' => 'DELTA777',
            'max_members' => 4,
            'supervisor_id' => null, // لم يتم تعيين مشرف بعد
            'created_by' => 6, // رنا كريم
            'created_at' => now()->subDays(5),
        ]);

        // 5. فريق Zeta (أمن سيبراني: ID = 5) - طلب إشراف جديد
        $teamZeta = Team::create([
            'id' => 5,
            'name' => 'Zeta',
            'department_id' => 5,
            'invite_code' => 'ZETA999',
            'max_members' => 3,
            'supervisor_id' => null, // لم يتم تعيين مشرف بعد
            'created_by' => 8, // نور الدين أحمد
            'created_at' => now()->subDays(3),
        ]);

        // --- بذر أعضاء الفرق (Team Members) ---
        DB::table('team_members')->insert([
            // فريق Alpha
            ['team_id' => 1, 'user_id' => 5, 'is_leader' => true, 'joined_at' => now()->subDays(50)], // محمد أحمد
            ['team_id' => 1, 'user_id' => 2, 'is_leader' => false, 'joined_at' => now()->subDays(49)], // سارة علي
            ['team_id' => 1, 'user_id' => 3, 'is_leader' => false, 'joined_at' => now()->subDays(48)], // عمر خالد
            ['team_id' => 1, 'user_id' => 4, 'is_leader' => false, 'joined_at' => now()->subDays(47)], // ليلى يوسف

            // فريق Beta
            ['team_id' => 2, 'user_id' => 1, 'is_leader' => true, 'joined_at' => now()->subDays(30)], // أحمد محمد
            ['team_id' => 2, 'user_id' => 6, 'is_leader' => false, 'joined_at' => now()->subDays(29)], // رنا كريم

            // فريق Gamma
            ['team_id' => 3, 'user_id' => 7, 'is_leader' => true, 'joined_at' => now()->subDays(20)], // يوسف محمد
            ['team_id' => 3, 'user_id' => 8, 'is_leader' => false, 'joined_at' => now()->subDays(19)], // نور الدين أحمد

            // فريق Delta
            ['team_id' => 4, 'user_id' => 6, 'is_leader' => true, 'joined_at' => now()->subDays(5)], // رنا كريم

            // فريق Zeta
            ['team_id' => 5, 'user_id' => 8, 'is_leader' => true, 'joined_at' => now()->subDays(3)], // نور الدين أحمد
        ]);

        // --- بذر المشاريع (Projects) ---
        // 1. مشروع فريق Alpha
        $projectAlpha = Project::create([
            'id' => 1,
            'title' => 'GradSmart — نظام إدارة التخرج',
            'description' => 'منصة ويب متكاملة لإدارة مشاريع التخرج بالجامعة بمساعدة الذكاء الاصطناعي لتتبع تقدم الطلاب وحساب مستوى الخطورة.',
            'status' => 'ACTIVE',
            'team_id' => 1,
            'supervisor_id' => 9,
            'expected_end_date' => now()->addDays(4), // 23 يونيو تقريباً
            'progress' => 62.00,
            'created_at' => now()->subDays(50),
        ]);

        // 2. مشروع فريق Beta
        $projectBeta = Project::create([
            'id' => 2,
            'title' => 'SmartLibrary — نظام مكتبة ذكي',
            'description' => 'مشروع يهدف لتسهيل استعارة الكتب وتصنيفها آلياً باستخدام تقنيات التعرف على الصور والباركود.',
            'status' => 'ACTIVE',
            'team_id' => 2,
            'supervisor_id' => 9,
            'expected_end_date' => now()->subDays(18), // 1 يونيو
            'progress' => 22.00,
            'created_at' => now()->subDays(30),
        ]);

        // 3. مشروع فريق Gamma
        $projectGamma = Project::create([
            'id' => 3,
            'title' => 'E-Commerce Platform',
            'description' => 'منصة تجارة إلكترونية متطورة تدعم الدفع الإلكتروني المحلي وتوفر لوحة إحصائيات للبائعين.',
            'status' => 'ACTIVE',
            'team_id' => 3,
            'supervisor_id' => 9,
            'expected_end_date' => now()->subDays(4), // 15 يونيو
            'progress' => 45.00,
            'created_at' => now()->subDays(20),
        ]);

        // 4. مشروع فريق Delta - طلب إشراف
        $projectDelta = Project::create([
            'id' => 4,
            'title' => 'تطبيق صحة ذكي',
            'description' => 'تطبيق يعتمد على الذكاء الاصطناعي لتشخيص الأعراض الصحية الأولية وتقديم توصيات طبية.',
            'status' => 'ACTIVE',
            'team_id' => 4,
            'supervisor_id' => null,
            'expected_end_date' => now()->addMonths(6),
            'progress' => 0.00,
            'created_at' => now()->subDays(5),
        ]);

        // 5. مشروع فريق Zeta - طلب إشراف
        $projectZeta = Project::create([
            'id' => 5,
            'title' => 'نظام كشف الثغرات التلقائي',
            'description' => 'أداة لأتمتة فحص المواقع والشبكات للكشف عن الثغرات الأمنية الشائعة وتقديم تقرير حماية.',
            'status' => 'ACTIVE',
            'team_id' => 5,
            'supervisor_id' => null,
            'expected_end_date' => now()->addMonths(5),
            'progress' => 0.00,
            'created_at' => now()->subDays(3),
        ]);

        // --- بذر المراحل (Milestones) ---
        Milestone::create([
            'project_id' => 1,
            'name' => 'تحليل المتطلبات وتصميم الواجهات',
            'weight' => 20.00,
            'completion' => 100.00,
            'due_date' => now()->subDays(30),
            'is_completed' => true,
        ]);
        Milestone::create([
            'project_id' => 1,
            'name' => 'بناء قاعدة البيانات وهيكلة النظام',
            'weight' => 30.00,
            'completion' => 100.00,
            'due_date' => now()->subDays(15),
            'is_completed' => true,
        ]);
        Milestone::create([
            'project_id' => 1,
            'name' => 'برمجة واجهة المشرف والطالب',
            'weight' => 30.00,
            'completion' => 40.00,
            'due_date' => now()->addDays(5),
            'is_completed' => false,
        ]);

        // --- بذر المهام (Tasks) ---
        // مهام Alpha
        Task::create([
            'id' => 1,
            'title' => 'تصميم قاعدة البيانات ERD',
            'description' => 'رسم المخطط العلائقي لقاعدة البيانات وتحديد المفاتيح الأساسية والأجنبية.',
            'status' => 'DONE',
            'deadline' => now()->subDays(49),
            'project_id' => 1,
            'assigned_to' => 5, // محمد أحمد
            'created_by' => 5,
        ]);
        Task::create([
            'id' => 2,
            'title' => 'تطوير واجهة تسجيل الدخول',
            'description' => 'تصميم وبرمجة صفحة تسجيل الدخول واستعادة كلمة المرور وتوزيع الصلاحيات.',
            'status' => 'IN_PROGRESS',
            'deadline' => now()->addDays(1),
            'project_id' => 1,
            'assigned_to' => 2, // سارة علي
            'created_by' => 5,
        ]);
        Task::create([
            'id' => 3,
            'title' => 'كتابة API المصادقة',
            'description' => 'تطوير المسارات والكونترولر الخاص بالمصادقة والتحقق من الجلسات.',
            'status' => 'TODO', // متأخرة
            'deadline' => now()->subDays(32),
            'project_id' => 1,
            'assigned_to' => 3, // عمر خالد
            'created_by' => 5,
        ]);
        Task::create([
            'id' => 4,
            'title' => 'إعداد قاعدة البيانات MySQL',
            'description' => 'إنشاء قاعدة البيانات محلياً وربطها بالمشروع وجداول الهجرة.',
            'status' => 'DONE',
            'deadline' => now()->subDays(45),
            'project_id' => 1,
            'assigned_to' => 4, // ليلى يوسف
            'created_by' => 5,
        ]);
        Task::create([
            'id' => 5,
            'title' => 'Dashboard المشرف',
            'description' => 'تصميم لوحة التحكم الخاصة بالمشرف الأكاديمي لعرض الفرق والتقارير.',
            'status' => 'IN_PROGRESS',
            'deadline' => now()->addDays(2),
            'project_id' => 1,
            'assigned_to' => 5, // محمد أحمد
            'created_by' => 5,
        ]);

        // --- بذر الملفات (Files) ---
        File::create([
            'project_id' => 1,
            'filename' => 'تقرير_المرحلة_الثانية.pdf',
            'path' => 'uploads/projects/1/تقرير_المرحلة_الثانية.pdf',
            'size' => 2516582, // 2.4 MB
            'version' => 1,
            'uploaded_by' => 5,
        ]);
        File::create([
            'project_id' => 1,
            'filename' => 'GradSmart_ERD_Final.png',
            'path' => 'uploads/projects/1/GradSmart_ERD_Final.png',
            'size' => 3250585, // 3.1 MB
            'version' => 1,
            'uploaded_by' => 5,
        ]);
        File::create([
            'project_id' => 1,
            'filename' => 'gradsmart_backend_v1.zip',
            'path' => 'uploads/projects/1/gradsmart_backend_v1.zip',
            'size' => 47185920, // 45 MB
            'version' => 1,
            'uploaded_by' => 3,
        ]);

        // --- بذر التعليقات (Comments) ---
        Comment::create([
            'project_id' => 1,
            'task_id' => 1,
            'user_id' => 9, // المشرف
            'content' => 'مخطط ممتاز ومستوفٍ لكل الجداول المطلوبة في SRS. بالتوفيق.',
        ]);

        // --- بذر التقييمات (Evaluations) ---
        Evaluation::create([
            'team_id' => 1,
            'evaluator_id' => 9,
            'evaluation_type' => 'SUPERVISOR',
            'score_documentation' => 95.00,
            'score_implementation' => 90.00,
            'score_presentation' => 95.00,
            'total_score' => 93.33,
            'feedback' => 'التحليل والتوثيق للمرحلة الأولى كان استثنائياً ومنظماً جداً.',
            'created_at' => now()->subDays(20),
        ]);

        Evaluation::create([
            'team_id' => 1,
            'evaluator_id' => 9,
            'evaluation_type' => 'SUPERVISOR',
            'score_documentation' => 24.00, // من 30
            'score_implementation' => 15.00, // من 25
            'score_presentation' => 25.00, // من 25
            'total_score' => 82.00,
            'feedback' => 'أداء ممتاز في الواجهات، لكن هناك تأخر بسيط في برمجة الـ APIs.',
            'created_at' => now()->subDays(1),
        ]);

        // --- بذر الإشعارات (Notifications) ---
        Notification::create([
            'user_id' => 9,
            'message' => 'فريق Beta متأخر 5 أيام! مشروع SmartLibrary لم ينجز سوى 22%.',
            'type' => 'DANGER',
        ]);
        Notification::create([
            'user_id' => 9,
            'message' => 'فريق Gamma: تقدم أقل من المتوقع، احتمالية حدوث تأخير.',
            'type' => 'WARNING',
        ]);
        Notification::create([
            'user_id' => 9,
            'message' => 'لديك رسائل جديدة من فريق Alpha.',
            'type' => 'INFO',
        ]);

        // --- بذر الرسائل (Messages) ---
        // رسائل دردشة بين المشرف (9) والطلاب
        // محمد أحمد (5)
        Message::create([
            'sender_id' => 5,
            'receiver_id' => 9,
            'content' => 'أهلاً يا دكتور، لقد قمنا بتعديل الواجهات الأمامية بالكامل بناءً على ملاحظاتك الأخيرة، وأضفنا الوضع المظلم وتأثير الزجاج كما اقترحت.',
            'is_read' => false,
            'sent_at' => now()->subMinutes(15),
        ]);
        // سارة علي (2)
        Message::create([
            'sender_id' => 2,
            'receiver_id' => 9,
            'content' => 'الرجاء الاطلاع على التقرير_المرقّي_المرحلة_3.pdf المرفق وتزويدنا بملاحظاتك.',
            'is_read' => false,
            'sent_at' => now()->subMinutes(10),
        ]);
        // رد المشرف
        Message::create([
            'sender_id' => 9,
            'receiver_id' => 5,
            'content' => 'عمل رائع ومتميز يا شباب! الواجهات تبدو استثنائية وجذابة للغاية الآن. سأقوم بمراجعة تقرير المرحلة الثالثة وإرسال الملاحظات والتقييم لكم.',
            'is_read' => true,
            'sent_at' => now()->subMinutes(5),
        ]);

        // رسائل من فريق Beta (رئيس الفريق: أحمد محمد (1))
        Message::create([
            'sender_id' => 1,
            'receiver_id' => 9,
            'content' => 'عمر: هل يمكن تحديد موعد لمراجعة الـ ERD؟ لدينا بعض الصعوبات في هيكلة الجداول.',
            'is_read' => false,
            'sent_at' => now()->subDays(1),
        ]);

        // رسائل من فريق Gamma (رئيس الفريق: يوسف محمد (7))
        Message::create([
            'sender_id' => 9,
            'receiver_id' => 7,
            'content' => 'يرجى تسريع العمل لتجنب التأخير، فالموعد النهائي يقترب ونسبة الإنجاز لا تزال 45%.',
            'is_read' => true,
            'sent_at' => now()->subDays(3),
        ]);

        // --- بذر تقارير الذكاء الاصطناعي (AiReports) ---
        AiReport::create([
            'project_id' => 1,
            'risk_level' => 'LOW',
            'delay_probability' => 10.0,
            'completion_rate' => 62.0,
            'time_consumed_rate' => 65.0,
        ]);
        AiReport::create([
            'project_id' => 2,
            'risk_level' => 'HIGH',
            'delay_probability' => 85.0,
            'completion_rate' => 22.0,
            'time_consumed_rate' => 90.0,
        ]);
        AiReport::create([
            'project_id' => 3,
            'risk_level' => 'MEDIUM',
            'delay_probability' => 50.0,
            'completion_rate' => 45.0,
            'time_consumed_rate' => 60.0,
        ]);
    }
}
