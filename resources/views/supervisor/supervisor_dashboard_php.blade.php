<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — لوحة المشرف</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/supervisor_dashboard.css">
</head>
<body>

<?php 
  // استدعاء البار الجانبي للمشرف
  include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/supervisor_sidebar.php'; 
?>
 
<!-- Main -->
<div class="main">
 
  <?php 
    // استدعاء الشريط العلوي للمشرف
    include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/supervisor_topbar.php'; 
  ?>
 
  <!-- Stats -->
  <div class="stats-grid">
    <div class="stat-card green">
      <div class="stat-icon">👥</div>
      <div class="stat-num">8</div>
      <div class="stat-label">فرق تحت إشرافي</div>
    </div>
    <div class="stat-card blue">
      <div class="stat-icon">✅</div>
      <div class="stat-num">5</div>
      <div class="stat-label">مشاريع على المسار</div>
    </div>
    <div class="stat-card orange">
      <div class="stat-icon">⚠️</div>
      <div class="stat-num">2</div>
      <div class="stat-label">تحتاج تدخل عاجل</div>
    </div>
    <div class="stat-card red">
      <div class="stat-icon">🔔</div>
      <div class="stat-num">6</div>
      <div class="stat-label">طلبات جديدة</div>
    </div>
  </div>
 
  <!-- Main Grid -->
  <div class="grid-main">
 
    <!-- Projects List -->
    <div class="card" style="animation-delay:.3s">
      <div class="card-header">
        <div class="card-title">📂 مشاريع الفرق</div>
        <a class="card-action" href="#">عرض الكل ←</a>
      </div>
      <div class="projects-list">
 
        <div class="project-item danger">
          <div class="pi-top">
            <div class="pi-icon" style="background:#fef2f2">🚨</div>
            <div>
              <div class="pi-name">SmartLibrary — نظام مكتبة ذكي</div>
              <div class="pi-meta">👥 فريق Beta · 4 أعضاء</div>
            </div>
            <div class="pi-risk risk-high">🔴 خطر عالي</div>
          </div>
          <div class="pi-progress">
            <div class="pip-top">
              <span style="color:var(--muted)">الإنجاز</span>
              <span style="color:var(--red);font-weight:700">22%</span>
            </div>
            <div class="pip-track"><div class="pip-fill" style="width:22%;background:var(--red)"></div></div>
          </div>
          <div class="pi-footer">
            <div class="pi-avatars">
              <div class="pi-av" style="background:var(--red)">ر م</div>
              <div class="pi-av" style="background:var(--orange)">ه ع</div>
            </div>
            <span>⚠ تأخر 5 أيام</span>
            <span>📅 الموعد: 1 يونيو</span>
          </div>
        </div>
 
        <div class="project-item">
          <div class="pi-top">
            <div class="pi-icon" style="background:#eff6ff">🌐</div>
            <div>
              <div class="pi-name">GradSmart — إدارة التخرج</div>
              <div class="pi-meta">👥 فريق Alpha · 4 أعضاء</div>
            </div>
            <div class="pi-risk risk-low">🟢 منخفض</div>
          </div>
          <div class="pi-progress">
            <div class="pip-top">
              <span style="color:var(--muted)">الإنجاز</span>
              <span style="color:var(--blue);font-weight:700">62%</span>
            </div>
            <div class="pip-track"><div class="pip-fill" style="width:62%;background:var(--blue)"></div></div>
          </div>
          <div class="pi-footer">
            <div class="pi-avatars">
              <div class="pi-av" style="background:var(--blue)">م أ</div>
              <div class="pi-av" style="background:var(--pink)">سا</div>
              <div class="pi-av" style="background:var(--green)">عم</div>
            </div>
            <span>✅ على المسار</span>
            <span>📅 الموعد: 23 يونيو</span>
          </div>
        </div>
 
        <div class="project-item">
          <div class="pi-top">
            <div class="pi-icon" style="background:#fff7ed">🛒</div>
            <div>
              <div class="pi-name">E-Commerce Platform</div>
              <div class="pi-meta">👥 فريق Gamma · 3 أعضاء</div>
            </div>
            <div class="pi-risk risk-mid">🟡 متوسط</div>
          </div>
          <div class="pi-progress">
            <div class="pip-top">
              <span style="color:var(--muted)">الإنجاز</span>
              <span style="color:var(--orange);font-weight:700">45%</span>
            </div>
            <div class="pip-track"><div class="pip-fill" style="width:45%;background:var(--orange)"></div></div>
          </div>
          <div class="pi-footer">
            <div class="pi-avatars">
              <div class="pi-av" style="background:var(--orange)">خا</div>
              <div class="pi-av" style="background:var(--yellow)">ند</div>
            </div>
            <span>⚡ تأخر بسيط</span>
            <span>📅 الموعد: 15 يونيو</span>
          </div>
        </div>
 
        <div class="project-item">
          <div class="pi-top">
            <div class="pi-icon" style="background:#f0fdf4">🏥</div>
            <div>
              <div class="pi-name">Hospital Management System</div>
              <div class="pi-meta">👥 فريق Delta · 4 أعضاء</div>
            </div>
            <div class="pi-risk risk-low">🟢 منخفض</div>
          </div>
          <div class="pi-progress">
            <div class="pip-top">
              <span style="color:var(--muted)">الإنجاز</span>
              <span style="color:var(--green);font-weight:700">78%</span>
            </div>
            <div class="pip-track"><div class="pip-fill" style="width:78%;background:var(--green)"></div></div>
          </div>
          <div class="pi-footer">
            <div class="pi-avatars">
              <div class="pi-av" style="background:var(--green)">أم</div>
              <div class="pi-av" style="background:var(--teal)">فا</div>
            </div>
            <span>✅ ممتاز</span>
            <span>📅 الموعد: 30 يونيو</span>
          </div>
        </div>
 
      </div>
    </div>
 
    <!-- Right side -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- AI Report -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header">
          <div class="card-title">🤖 تقرير الذكاء الاصطناعي</div>
          <a class="card-action" href="#">تفاصيل ←</a>
        </div>
        <div class="ai-card">
          <div class="ai-header-row">
            <div class="ai-icon-box">🧠</div>
            <div>
              <div class="ai-title">تحليل المشاريع</div>
              <div class="ai-sub">آخر تحديث: منذ ساعة</div>
            </div>
          </div>
          <div class="ai-items">
            <div class="ai-item">
              <span class="ai-item-label">🔴 عالي الخطورة</span>
              <span class="ai-item-val" style="color:var(--red)">2 مشاريع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">🟡 متوسط الخطورة</span>
              <span class="ai-item-val" style="color:var(--orange)">1 مشروع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">🟢 منخفض الخطورة</span>
              <span class="ai-item-val" style="color:var(--green)">5 مشاريع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">📈 متوسط الإنجاز</span>
              <span class="ai-item-val" style="color:var(--blue)">58%</span>
            </div>
          </div>
        </div>
        <div style="margin-top:14px">
          <div style="font-size:.75rem;font-weight:700;margin-bottom:8px">إنجاز الفرق هذا الأسبوع</div>
          <div class="chart-bars">
            <div class="bar-wrap"><div class="bar" style="height:22%;background:var(--red)"></div><div class="bar-label">Beta</div></div>
            <div class="bar-wrap"><div class="bar" style="height:62%;background:var(--blue)"></div><div class="bar-label">Alpha</div></div>
            <div class="bar-wrap"><div class="bar" style="height:45%;background:var(--orange)"></div><div class="bar-label">Gamma</div></div>
            <div class="bar-wrap"><div class="bar" style="height:78%;background:var(--green)"></div><div class="bar-label">Delta</div></div>
            <div class="bar-wrap"><div class="bar" style="height:55%;background:var(--purple)"></div><div class="bar-label">Zeta</div></div>
          </div>
        </div>
      </div>
 
      <!-- Alerts -->
      <div class="card" style="animation-delay:.40s">
        <div class="card-header">
          <div class="card-title">🔔 تنبيهات عاجلة</div>
          <a class="card-action" href="#">الكل ←</a>
        </div>
        <div class="alerts-list">
          <div class="alert-item danger">
            <div class="al-icon">🚨</div>
            <div>
              <div class="al-title">فريق Beta متأخر 5 أيام!</div>
              <div class="al-desc">مشروع SmartLibrary لم يُنجز سوى 22% — تدخل عاجل مطلوب</div>
              <div class="al-time">منذ ساعة</div>
            </div>
          </div>
          <div class="alert-item warning">
            <div class="al-icon">⚠️</div>
            <div>
              <div class="al-title">فريق Gamma: إنجاز أقل من المتوقع</div>
              <div class="al-desc">توقع AI بأن المشروع قد يتأخر إذا لم يتسارع العمل</div>
              <div class="al-time">منذ 3 ساعات</div>
            </div>
          </div>
          <div class="alert-item info">
            <div class="al-icon">💬</div>
            <div>
              <div class="al-title">رسائل جديدة من 4 فرق</div>
              <div class="al-desc">فريق Alpha، Delta، Zeta، Eta أرسلوا استفسارات</div>
              <div class="al-time">اليوم</div>
            </div>
          </div>
        </div>
      </div>
 
    </div>
  </div>
 
  <!-- Bottom Grid -->
  <div class="grid-bottom">
 
    <!-- New Requests -->
    <div class="card" style="animation-delay:.45s">
      <div class="card-header">
        <div class="card-title">📨 طلبات إشراف جديدة</div>
        <span style="background:#fef2f2;color:var(--red);font-size:.65rem;font-weight:700;padding:3px 9px;border-radius:20px">6 جديد</span>
      </div>
      <div class="requests-list">
        <div class="request-item">
          <div class="req-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">ي م</div>
          <div>
            <div class="req-name">يوسف محمد</div>
            <div class="req-desc">مشروع: تطبيق صحة ذكي · AI</div>
          </div>
          <div class="req-actions">
            <button class="req-btn req-accept">✓ قبول</button>
            <button class="req-btn req-reject">✕</button>
          </div>
        </div>
        <div class="request-item">
          <div class="req-avatar" style="background:linear-gradient(135deg,var(--pink),var(--orange))">ن ا</div>
          <div>
            <div class="req-name">نور الدين أحمد</div>
            <div class="req-desc">مشروع: منصة تعليم إلكتروني</div>
          </div>
          <div class="req-actions">
            <button class="req-btn req-accept">✓ قبول</button>
            <button class="req-btn req-reject">✕</button>
          </div>
        </div>
        <div class="request-item">
          <div class="req-avatar" style="background:linear-gradient(135deg,var(--green),var(--teal))">ر ك</div>
          <div>
            <div class="req-name">رنا كريم</div>
            <div class="req-desc">مشروع: نظام حجز مستشفى</div>
          </div>
          <div class="req-actions">
            <button class="req-btn req-accept">✓ قبول</button>
            <button class="req-btn req-reject">✕</button>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Quick Eval -->
    <div class="card" style="animation-delay:.50s">
      <div class="card-header">
        <div class="card-title">📝 تقييم سريع</div>
        <a class="card-action" href="#">كل التقييمات ←</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:10px">
        <select style="width:100%;padding:10px;border:1.5px solid var(--border);border-radius:9px;font-family:'Cairo',sans-serif;font-size:.82rem;outline:none;background:#f8fafc">
          <option>اختر الفريق...</option>
          <option>فريق Alpha</option>
          <option>فريق Beta</option>
          <option>فريق Gamma</option>
        </select>
        <div style="display:flex;gap:8px">
          <div style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s" onmouseover="this.style.borderColor='var(--green)'" onmouseout="this.style.borderColor='var(--border)'">🟢 ممتاز</div>
          <div style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s" onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--border)'">🔵 جيد</div>
          <div style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s" onmouseover="this.style.borderColor='var(--orange)'" onmouseout="this.style.borderColor='var(--border)'">🟡 يحتاج تحسين</div>
        </div>
        <textarea style="width:100%;padding:10px;border:1.5px solid var(--border);border-radius:9px;font-family:'Cairo',sans-serif;font-size:.78rem;resize:none;height:80px;outline:none;direction:rtl;background:#f8fafc" placeholder="اكتب ملاحظاتك للفريق..."></textarea>
        <button class="btn btn-primary" style="width:100%;justify-content:center">📤 إرسال التقييم</button>
      </div>
    </div>
 
    <!-- Schedule -->
    <div class="card" style="animation-delay:.55s">
      <div class="card-header">
        <div class="card-title">📅 جدول الاجتماعات</div>
        <a class="card-action" href="#">إضافة ←</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:10px">
        <div style="padding:12px;background:linear-gradient(135deg,#f0fdf4,#ecfdf5);border:1px solid #bbf7d0;border-radius:11px">
          <div style="font-size:.8rem;font-weight:800;margin-bottom:3px">🟢 اليوم — 2:00 م</div>
          <div style="font-size:.75rem;font-weight:600">فريق Alpha — مراجعة أسبوعية</div>
          <div style="font-size:.68rem;color:var(--muted);margin-top:3px">Zoom · 30 دقيقة</div>
        </div>
        <div style="padding:12px;background:#f8fafc;border:1px solid var(--border);border-radius:11px">
          <div style="font-size:.8rem;font-weight:800;margin-bottom:3px">🔵 غداً — 10:00 ص</div>
          <div style="font-size:.75rem;font-weight:600">فريق Beta — جلسة إنقاذ عاجلة</div>
          <div style="font-size:.68rem;color:var(--muted);margin-top:3px">حضوري · ساعة</div>
        </div>
        <div style="padding:12px;background:#f8fafc;border:1px solid var(--border);border-radius:11px">
          <div style="font-size:.8rem;font-weight:800;margin-bottom:3px">🟡 الخميس — 4:00 م</div>
          <div style="font-size:.75rem;font-weight:600">فريق Delta — عرض التقدم</div>
          <div style="font-size:.68rem;color:var(--muted);margin-top:3px">Zoom · 45 دقيقة</div>
        </div>
      </div>
    </div>
 
  </div>
</div>
 
<script>
// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح وتزامنه (Dark/Light Theme)
const themeToggle = document.getElementById('themeToggle');

// التحقق من الإعدادات المحفوظة مسبقاً لدى المستخدم
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

// تفعيل صنف active للبند الحالي في السايدبار تلقائياً
document.getElementById('nav-dashboard').classList.add('active');
</script>
</body>
</html>
