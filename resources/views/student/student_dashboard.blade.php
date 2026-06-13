@extends('layouts.student')

@section('title', 'GradSmart — لوحة الطالب')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_dashboard.css') }}">
@endsection

@section('content')
  <!-- Stats -->
  <div class="stats-grid">
    <div class="stat-card blue">
      <div class="stat-icon">📋</div>
      <div class="stat-num">12</div>
      <div class="stat-label">إجمالي المهام</div>
      <div class="stat-change up">↑ تمت إضافة 2 هذا الأسبوع</div>
    </div>
    <div class="stat-card green">
      <div class="stat-icon">✅</div>
      <div class="stat-num">7</div>
      <div class="stat-label">مهام منجزة</div>
      <div class="stat-change up">↑ 58% من الكلي</div>
    </div>
    <div class="stat-card orange">
      <div class="stat-icon">⏳</div>
      <div class="stat-num">3</div>
      <div class="stat-label">مهام متأخرة</div>
      <div class="stat-change warn">⚠ تحتاج متابعة</div>
    </div>
    <div class="stat-card purple">
      <div class="stat-icon">📅</div>
      <div class="stat-num">45</div>
      <div class="stat-label">يوم متبقي</div>
      <div class="stat-change up">حتى موعد التسليم</div>
    </div>
  </div>
 
  <!-- Progress + Risk -->
  <div class="progress-section">
 
    <!-- Project Progress -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">📊 تقدم المشروع</div>
        <a class="card-action" href="#">عرض التفاصيل ←</a>
      </div>
 
      <div class="project-info">
        <div class="project-emoji">🌐</div>
        <div>
          <div class="project-name">GradSmart — نظام إدارة التخرج</div>
          <div class="project-meta">👨‍🏫 د. أحمد السالم &nbsp;|&nbsp; 👥 4 أعضاء &nbsp;|&nbsp; 🖥️ Web App</div>
        </div>
      </div>
 
      <div class="big-progress">
        <div class="big-progress-top">
          <span class="big-progress-label">نسبة الإنجاز الكلية</span>
          <span class="big-progress-pct">62%</span>
        </div>
        <div class="progress-track">
          <div class="progress-fill" style="width:62%"></div>
        </div>
      </div>
 
      <div class="mini-stats">
        <div class="mini-stat">
          <div class="mini-stat-num" style="color:var(--green)">7</div>
          <div class="mini-stat-label">منجزة ✅</div>
        </div>
        <div class="mini-stat">
          <div class="mini-stat-num" style="color:var(--blue)">2</div>
          <div class="mini-stat-label">قيد التنفيذ 🔄</div>
        </div>
        <div class="mini-stat">
          <div class="mini-stat-num" style="color:var(--orange)">3</div>
          <div class="mini-stat-label">متأخرة ⚠</div>
        </div>
        <div class="mini-stat">
          <div class="mini-stat-num" style="color:var(--muted)">0</div>
          <div class="mini-stat-label">لم تبدأ ⬜</div>
        </div>
      </div>
    </div>
 
    <!-- Risk + Supervisor -->
    <div style="display:flex;flex-direction:column;gap:16px;">
 
      <!-- Risk -->
      <div class="risk-card">
        <div class="card-header">
          <div class="card-title">🤖 تحليل الذكاء الاصطناعي</div>
        </div>
        <div class="risk-meter">
          <div class="risk-circle">
            <div class="risk-circle-inner">
              <div class="risk-pct">منخفض</div>
              <div class="risk-text">مستوى الخطر</div>
            </div>
          </div>
          <div class="risk-label">🟢 المشروع على المسار الصحيح</div>
        </div>
        <div class="risk-factors">
          <div class="risk-factor">
            <span class="rf-label">معدل الإنجاز</span>
            <div class="rf-bar-wrap"><div class="rf-bar" style="width:75%;background:var(--green)"></div></div>
          </div>
          <div class="risk-factor">
            <span class="rf-label">الالتزام بالمواعيد</span>
            <div class="rf-bar-wrap"><div class="rf-bar" style="width:60%;background:var(--yellow)"></div></div>
          </div>
          <div class="risk-factor">
            <span class="rf-label">نشاط الفريق</span>
            <div class="rf-bar-wrap"><div class="rf-bar" style="width:85%;background:var(--green)"></div></div>
          </div>
        </div>
      </div>
 
    </div>
  </div>
 
  <!-- Bottom Row -->
  <div class="bottom-row">
 
    <!-- Tasks + Activity -->
    <div style="display:flex;flex-direction:column;gap:16px;">
 
      <!-- Tasks -->
      <div class="card" style="animation-delay:0.35s">
        <div class="card-header">
          <div class="card-title">✅ أحدث المهام</div>
          <a class="card-action" href="#">كل المهام ←</a>
        </div>
        <div class="tasks-list">
          <div class="task-item">
            <div class="task-check done">✓</div>
            <div class="task-info">
              <div class="task-name done">تصميم قاعدة البيانات</div>
              <div class="task-meta"><span>👤 محمد</span><span>📅 تم 1 مايو</span></div>
            </div>
            <span class="task-tag tag-done">منجزة</span>
          </div>
          <div class="task-item">
            <div class="task-check inprogress"></div>
            <div class="task-info">
              <div class="task-name">تطوير واجهة تسجيل الدخول</div>
              <div class="task-meta"><span>👤 سارة</span><span>📅 12 مايو</span></div>
            </div>
            <span class="task-tag tag-progress">قيد التنفيذ</span>
          </div>
          <div class="task-item">
            <div class="task-check"></div>
            <div class="task-info">
              <div class="task-name">كتابة API المصادقة</div>
              <div class="task-meta"><span>👤 عمر</span><span>📅 8 مايو</span></div>
            </div>
            <span class="task-tag tag-late">متأخرة</span>
          </div>
          <div class="task-item">
            <div class="task-check"></div>
            <div class="task-info">
              <div class="task-name">ربط الـ Frontend بالـ Backend</div>
              <div class="task-meta"><span>👤 ليلى</span><span>📅 20 مايو</span></div>
            </div>
            <span class="task-tag tag-todo">لم تبدأ</span>
          </div>
        </div>
      </div>
 
      <!-- Activity -->
      <div class="card" style="animation-delay:0.4s">
        <div class="card-header">
          <div class="card-title">📜 سجل الأنشطة</div>
          <a class="card-action" href="#">المزيد ←</a>
        </div>
        <div class="activity-list">
          <div class="activity-item">
            <div class="act-icon" style="background:#eff6ff">📁</div>
            <div class="act-text">
              <div class="act-main">سارة رفعت تقرير المرحلة الثانية</div>
              <div class="act-time">منذ ساعتين</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:#f0fdf4">✅</div>
            <div class="act-text">
              <div class="act-main">عمر أنجز مهمة تصميم الـ ERD</div>
              <div class="act-time">منذ 5 ساعات</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:#faf5ff">💬</div>
            <div class="act-text">
              <div class="act-main">د. أحمد أضاف ملاحظة على المشروع</div>
              <div class="act-time">أمس 6:30 م</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:#fff7ed">⚠️</div>
            <div class="act-text">
              <div class="act-main">تنبيه: مهمة "API المصادقة" تأخرت</div>
              <div class="act-time">أمس 9:00 ص</div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Supervisor + Deadlines -->
    <div style="display:flex;flex-direction:column;gap:16px;">
 
      <!-- Supervisor -->
      <div class="card" style="animation-delay:0.45s">
        <div class="card-header">
          <div class="card-title">👨‍🏫 المشرف</div>
        </div>
        <div class="supervisor-card">
          <div class="sup-avatar">أح</div>
          <div>
            <div class="sup-name">د. أحمد السالم</div>
            <div class="sup-title">أستاذ هندسة البرمجيات</div>
          </div>
          <div class="sup-status">🟢 متاح</div>
        </div>
        <div class="last-note">
          "أداء ممتاز في الجزء الخلفي. أرجو التركيز على واجهة المستخدم وتحسين تجربة الطالب قبل الموعد النهائي."
          <div class="note-from">📅 أمس، 6:30 م</div>
        </div>
        <button class="msg-btn">💬 إرسال رسالة</button>
      </div>
 
      <!-- Upcoming Deadlines -->
      <div class="card" style="animation-delay:0.5s">
        <div class="card-header">
          <div class="card-title">📅 المواعيد القادمة</div>
        </div>
        <div class="deadline-items">
          <div class="dl-item">
            <div class="dl-dot" style="background:var(--orange)"></div>
            <div class="dl-name">تسليم التقرير المرحلي</div>
            <div class="dl-date">12 مايو</div>
            <span class="dl-urgent" style="background:#fff7ed;color:var(--orange)">3 أيام</span>
          </div>
          <div class="dl-item">
            <div class="dl-dot" style="background:var(--blue)"></div>
            <div class="dl-name">اجتماع المشرف الأسبوعي</div>
            <div class="dl-date">14 مايو</div>
            <span class="dl-urgent" style="background:#eff6ff;color:var(--blue)">5 أيام</span>
          </div>
          <div class="dl-item">
            <div class="dl-dot" style="background:var(--purple)"></div>
            <div class="dl-name">عرض المشروع النهائي</div>
            <div class="dl-date">23 يونيو</div>
            <span class="dl-urgent" style="background:#faf5ff;color:var(--purple)">45 يوم</span>
          </div>
        </div>
      </div>
 
    </div>
  </div>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    document.getElementById('nav-dashboard').classList.add('active');
</script>
@endsection