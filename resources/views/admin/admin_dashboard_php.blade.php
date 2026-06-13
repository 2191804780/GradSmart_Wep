<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — لوحة المسؤول</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>

<?php 
  // استدعاء البار الجانبي المشترك للمسؤول
  include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/admin_sidebar.php'; 
?>
 
<!-- ── القسم الرئيسي (Main Section) ── -->
<div class="main">
 
  <?php 
    // استدعاء الشريط العلوي المشترك للمسؤول
    include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/admin_topbar.php'; 
  ?>

  <!-- شبكة الإحصائيات (Stats Grid) -->
  <div class="stats-grid">
    <div class="stat-card blue">
      <div class="stat-icon">🎓</div>
      <div class="stat-num">120</div>
      <div class="stat-label">إجمالي الطلاب</div>
    </div>
    <div class="stat-card purple">
      <div class="stat-icon">👨‍🏫</div>
      <div class="stat-num">24</div>
      <div class="stat-label">المشرفين النشطين</div>
    </div>
    <div class="stat-card green">
      <div class="stat-icon">💼</div>
      <div class="stat-num">32</div>
      <div class="stat-label">المشاريع المسجلة</div>
    </div>
    <div class="stat-card orange">
      <div class="stat-icon">⏳</div>
      <div class="stat-num">5</div>
      <div class="stat-label">طلبات قيد المراجعة</div>
    </div>
  </div>

  <!-- الشبكة الثنائية للبطاقات الرئيسية (Main Grid) -->
  <div class="grid-main">
    
    <!-- قسم الطلبات والموافقات -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">📨 طلبات اعتماد المشاريع والفرق الجديدة</div>
        <a class="card-action" href="#">عرض جميع الطلبات ←</a>
      </div>
      
      <div class="requests-list">
        
        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">نظام إدارة العيادات الطبية الذكي</div>
            <div class="req-meta">👤 فريق البواسل · 4 طلاب · المشرف المقترح: د. خالد العتيبي</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">تطبيق تتبع الباصات الجامعية بالوقت الفعلي</div>
            <div class="req-meta">👤 فريق المستقبل · 3 طلاب · المشرف المقترح: د. سارة العلي</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">منصة التبرع بالكتب الدراسية المستعملة</div>
            <div class="req-meta">👤 فريق العطاء · 4 طلاب · المشرف المقترح: د. أحمد السالم</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

      </div>
    </div>

    <!-- القسم الأيسر: الرسوم البيانية والأنشطة -->
    <div style="display: flex; flex-direction: column; gap: 16px;">
      
      <!-- إحصائيات الأقسام والكليات -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">🏛️ توزيع المشاريع حسب الأقسام</div>
        </div>
        <div class="chart-container">
          <div class="chart-bars">
            <div class="bar-wrap">
              <div class="bar" style="height: 85%;"></div>
              <div class="bar-label">علوم حاسب</div>
            </div>
            <div class="bar-wrap">
              <div class="bar purple" style="height: 60%;"></div>
              <div class="bar-label">هندسة برمجيات</div>
            </div>
            <div class="bar-wrap">
              <div class="bar green" style="height: 45%;"></div>
              <div class="bar-label">تقنية معلومات</div>
            </div>
            <div class="bar-wrap">
              <div class="bar orange" style="height: 30%;"></div>
              <div class="bar-label">نظم معلومات</div>
            </div>
          </div>
        </div>
      </div>

      <!-- سجل الأنشطة الأمنية والبرمجية للنظام -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">📜 سجل الأنشطة والأمان للنظام</div>
          <a class="card-action" href="#">السجلات الكاملة ←</a>
        </div>
        <div class="activity-list">
          <div class="activity-item">
            <div class="act-icon" style="background: #eff6ff;">👥</div>
            <div class="act-text">
              <div class="act-main">تم تسجيل حساب مشرف جديد: د. محمد الخالدي</div>
              <div class="act-time">منذ 20 دقيقة</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background: #f0fdf4;">✅</div>
            <div class="act-text">
              <div class="act-main">تم اعتماد مشروع "نظام إدارة التخرج GradSmart"</div>
              <div class="act-time">منذ ساعتين</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background: #fff7ed;">⚠️</div>
            <div class="act-text">
              <div class="act-main">تنبيه أمني: محاولة دخول فاشلة لحساب المشرف د. أحمد السالم</div>
              <div class="act-time">منذ 4 ساعات</div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<script>
// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح وتزامنه (Dark/Light Theme)
const themeToggle = document.getElementById('themeToggle');

// التحقق من الإعدادات المحفوظة مسبقاً لدى المستخدم في الـ localStorage
if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add('dark-theme');
  themeToggle.textContent = '☀️';
} else {
  themeToggle.textContent = '🌙';
}

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  const isDark = document.body.classList.contains('dark-theme');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
  themeToggle.textContent = isDark ? '☀️' : '🌙';
});

// تفعيل كلاس active للبند الحالي في السايدبار تلقائياً
document.getElementById('nav-dashboard').classList.add('active');
</script>
</body>
</html>
