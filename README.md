# 🎓 GradSmart — نظام إدارة مشاريع التخرج

نظام متكامل لإدارة مشاريع التخرج يشمل ثلاثة أدوار:
- 👨‍🎓 **الطالب** — إدارة المهام، الفريق، الملفات، والتقدم
- 👨‍🏫 **المشرف** — الإشراف على المشاريع والفرق
- 🏛️ **الإدارة** — إدارة النظام والمستخدمين

## 🛠 التقنيات المستخدمة
- **Laravel** (PHP Framework)
- **MySQL** (XAMPP)
- **Blade Templates**
- **Vanilla CSS + Dark Mode**

## 🚀 تشغيل المشروع محلياً

```bash
git clone https://github.com/2191804780/GradSmart_Wep.git
cd GradSmart_Wep
composer install
cp .env.example .env
php artisan key:generate
php artisan serve --port=8001
```

## 📁 هيكل المشروع
```
resources/views/
├── layouts/          ← القوالب الرئيسية (Student, Supervisor, Admin)
├── student/          ← صفحات الطالب (10 صفحات)
├── supervisor/       ← صفحات المشرف (3 صفحات)
├── admin/            ← صفحات الإدارة (3 صفحات)
└── auth/             ← تسجيل الدخول والتسجيل
```
