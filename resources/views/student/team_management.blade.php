@extends('layouts.student')

@section('title', 'GradSmart — إدارة الفريق')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/team_management.css') }}">
@endsection

@section('page_title')
<h1>👥 إدارة الفريق</h1>
<p>فريق Alpha — 4 أعضاء نشطون</p>
@endsection

@section('topbar_actions')
<button class="btn btn-outline">📋 تقرير الفريق</button>
<button class="btn btn-primary" onclick="document.getElementById('modal').classList.add('open')">＋ دعوة عضو</button>
@endsection

@section('content')
  <!-- Team Header -->
  <div class="team-header-card">
    <div class="team-logo">🚀</div>
    <div class="team-info">
      <div class="team-name">فريق Alpha</div>
      <div class="team-sub">مشروع GradSmart — نظام إدارة مشاريع التخرج</div>
      <div class="team-badges">
        <div class="t-badge">👨‍🏫 د. أحمد السالم</div>
        <div class="t-badge">📅 تأسس أبريل 2026</div>
        <div class="t-badge">🖥️ Web Application</div>
        <div class="t-badge" style="background:rgba(62,207,142,.3);border-color:rgba(62,207,142,.5)">🟢 نشط</div>
      </div>
    </div>
    <div class="team-progress-wrap">
      <div class="team-progress-circle">
        <div class="tpc-inner">
          <div class="tpc-num">62%</div>
          <div class="tpc-label">إنجاز</div>
        </div>
      </div>
      <div class="team-progress-label">تقدم المشروع الكلي</div>
    </div>
  </div>
 
  <!-- Stats -->
  <div class="stats-row">
    <div class="stat-card">
      <div class="s-icon" style="background:#eff6ff">👥</div>
      <div><div class="s-num" style="color:var(--blue)">4</div><div class="s-label">أعضاء الفريق</div></div>
    </div>
    <div class="stat-card">
      <div class="s-icon" style="background:#f0fdf4">✅</div>
      <div><div class="s-num" style="color:var(--green)">7</div><div class="s-label">مهام منجزة</div></div>
    </div>
    <div class="stat-card">
      <div class="s-icon" style="background:#fff7ed">⏳</div>
      <div><div class="s-num" style="color:var(--orange)">5</div><div class="s-label">مهام جارية</div></div>
    </div>
    <div class="stat-card">
      <div class="s-icon" style="background:#faf5ff">📅</div>
      <div><div class="s-num" style="color:var(--purple)">45</div><div class="s-label">يوم متبقي</div></div>
    </div>
  </div>
 
  <!-- Main Grid -->
  <div class="grid-2">
 
    <!-- Members List -->
    <div class="card" style="animation-delay:.3s">
      <div class="card-header">
        <div class="card-title">👤 أعضاء الفريق</div>
        <a class="card-action" href="#">إدارة الأدوار ←</a>
      </div>
      <div class="members-list">
 
        <!-- Leader -->
        <div class="member-item leader">
          <div class="m-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
            م أ
            <div class="leader-crown">👑</div>
          </div>
          <div class="m-info">
            <div class="m-name">محمد أحمد علي</div>
            <div class="m-role">قائد الفريق · Full Stack Developer</div>
          </div>
          <div class="m-tasks">
            <div class="m-task-count" style="color:var(--blue)">4 مهام</div>
            <div class="m-progress-mini">
              <div class="m-progress-fill" style="width:75%;background:var(--blue)"></div>
            </div>
          </div>
          <div class="m-actions">
            <div class="m-btn" title="رسالة">💬</div>
          </div>
        </div>
 
        <!-- Member 2 -->
        <div class="member-item">
          <div class="m-avatar" style="background:linear-gradient(135deg,var(--pink),var(--orange))">سا</div>
          <div class="m-info">
            <div class="m-name">سارة علي محمد</div>
            <div class="m-role">UI/UX Designer · Frontend</div>
          </div>
          <div class="m-tasks">
            <div class="m-task-count" style="color:var(--pink)">3 مهام</div>
            <div class="m-progress-mini">
              <div class="m-progress-fill" style="width:60%;background:var(--pink)"></div>
            </div>
          </div>
          <div class="m-actions">
            <div class="m-btn">💬</div>
            <div class="m-btn">⋮</div>
          </div>
        </div>
 
        <!-- Member 3 -->
        <div class="member-item">
          <div class="m-avatar" style="background:linear-gradient(135deg,var(--green),#06b6d4)">عم</div>
          <div class="m-info">
            <div class="m-name">عمر خالد إبراهيم</div>
            <div class="m-role">Backend Developer · PHP</div>
          </div>
          <div class="m-tasks">
            <div class="m-task-count" style="color:var(--green)">3 مهام</div>
            <div class="m-progress-mini">
              <div class="m-progress-fill" style="width:40%;background:var(--green)"></div>
            </div>
          </div>
          <div class="m-actions">
            <div class="m-btn">💬</div>
            <div class="m-btn">⋮</div>
          </div>
        </div>
 
        <!-- Member 4 -->
        <div class="member-item">
          <div class="m-avatar" style="background:linear-gradient(135deg,var(--yellow),var(--orange))">لي</div>
          <div class="m-info">
            <div class="m-name">ليلى يوسف حسن</div>
            <div class="m-role">Database Admin · MySQL</div>
          </div>
          <div class="m-tasks">
            <div class="m-task-count" style="color:var(--yellow)">2 مهام</div>
            <div class="m-progress-mini">
              <div class="m-progress-fill" style="width:85%;background:var(--yellow)"></div>
            </div>
          </div>
          <div class="m-actions">
            <div class="m-btn">💬</div>
            <div class="m-btn">⋮</div>
          </div>
        </div>
 
        <!-- Invite -->
        <div class="invite-box" onclick="document.getElementById('modal').classList.add('open')">
          <div class="invite-icon">➕</div>
          <div class="invite-title">دعوة عضو جديد</div>
          <div class="invite-sub">أرسل دعوة بالبريد الجامعي</div>
        </div>
 
      </div>
    </div>
 
    <!-- Right column -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- Project Info -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header">
          <div class="card-title">📋 المشروع</div>
          <a class="card-action" href="#">عرض ←</a>
        </div>
        <div class="project-card">
          <div class="proj-header">
            <div class="proj-icon">🌐</div>
            <div>
              <div class="proj-name">GradSmart System</div>
              <div class="proj-type">نظام ويب · Web Application</div>
            </div>
          </div>
          <div class="proj-progress-bar">
            <div class="ppb-top">
              <span style="color:var(--muted);font-size:.72rem">نسبة الإنجاز</span>
              <span style="font-weight:700;color:var(--blue)">62%</span>
            </div>
            <div class="ppb-track"><div class="ppb-fill" style="width:62%"></div></div>
          </div>
          <div class="proj-tags">
            <span class="p-tag" style="background:#eff6ff;color:var(--blue)">PHP</span>
            <span class="p-tag" style="background:#f0fdf4;color:var(--green)">MySQL</span>
            <span class="p-tag" style="background:#fff7ed;color:var(--orange)">JavaScript</span>
            <span class="p-tag" style="background:#faf5ff;color:var(--purple)">HTML/CSS</span>
          </div>
        </div>
      </div>
 
      <!-- Team Skills -->
      <div class="card" style="animation-delay:.40s">
        <div class="card-header">
          <div class="card-title">💡 مهارات الفريق</div>
        </div>
        <div class="skills-grid">
          <div class="skill-item">
            <div class="skill-icon">🖥️</div>
            <div class="skill-name">Frontend</div>
            <div class="skill-level" style="background:#eff6ff;color:var(--blue)">جيد جداً</div>
          </div>
          <div class="skill-item">
            <div class="skill-icon">⚙️</div>
            <div class="skill-name">Backend PHP</div>
            <div class="skill-level" style="background:#f0fdf4;color:var(--green)">جيد</div>
          </div>
          <div class="skill-item">
            <div class="skill-icon">🗄️</div>
            <div class="skill-name">MySQL</div>
            <div class="skill-level" style="background:#f0fdf4;color:var(--green)">ممتاز</div>
          </div>
          <div class="skill-item">
            <div class="skill-icon">🎨</div>
            <div class="skill-name">UI/UX</div>
            <div class="skill-level" style="background:#faf5ff;color:var(--purple)">ممتاز</div>
          </div>
          <div class="skill-item">
            <div class="skill-icon">🤖</div>
            <div class="skill-name">AI/ML</div>
            <div class="skill-level" style="background:#fff7ed;color:var(--orange)">متوسط</div>
          </div>
          <div class="skill-item">
            <div class="skill-icon">🧪</div>
            <div class="skill-name">Testing</div>
            <div class="skill-level" style="background:#f1f5f9;color:var(--muted)">أساسي</div>
          </div>
        </div>
      </div>
 
      <!-- Recent Activity -->
      <div class="card" style="animation-delay:.45s">
        <div class="card-header">
          <div class="card-title">📜 نشاط الفريق</div>
          <a class="card-action" href="#">الكل ←</a>
        </div>
        <div class="timeline">
          <div class="tl-item">
            <div class="tl-dot" style="background:var(--green)"></div>
            <div class="tl-content">
              <div class="tl-text">سارة أنجزت مهمة "تصميم واجهة Login"</div>
              <div class="tl-time">منذ ساعتين</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot" style="background:var(--blue)"></div>
            <div class="tl-content">
              <div class="tl-text">محمد رفع تقرير الأسبوع الثالث</div>
              <div class="tl-time">منذ 4 ساعات</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot" style="background:var(--orange)"></div>
            <div class="tl-content">
              <div class="tl-text">تنبيه: مهمة عمر تأخرت يوماً</div>
              <div class="tl-time">أمس 9:00 ص</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot" style="background:var(--purple)"></div>
            <div class="tl-content">
              <div class="tl-text">ليلى أكملت ربط الجداول في MySQL</div>
              <div class="tl-time">أمس 2:30 م</div>
            </div>
          </div>
        </div>
      </div>
 
    </div>
  </div>

  <!-- Modal: Invite -->
  <div class="modal-overlay" id="modal">
    <div class="modal">
      <div class="modal-header">
        <div class="modal-title">➕ دعوة عضو جديد</div>
        <button class="modal-close" onclick="document.getElementById('modal').classList.remove('open')">✕</button>
      </div>
      <div class="form-group">
        <label class="form-label">البريد الجامعي للعضو *</label>
        <input class="form-input" placeholder="example@university.edu">
      </div>
      <div class="form-group">
        <label class="form-label">الدور في الفريق</label>
        <select class="form-select">
          <option>🖥️ Frontend Developer</option>
          <option>⚙️ Backend Developer</option>
          <option>🗄️ Database Admin</option>
          <option>🎨 UI/UX Designer</option>
          <option>🧪 Tester</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">رسالة الدعوة (اختياري)</label>
        <input class="form-input" placeholder="مرحباً، ندعوك للانضمام لفريق Alpha...">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" style="flex:1" onclick="document.getElementById('modal').classList.remove('open')">📨 إرسال الدعوة</button>
        <button class="btn btn-outline" onclick="document.getElementById('modal').classList.remove('open')">إلغاء</button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    const navTeam = document.getElementById('nav-team');
    if (navTeam) navTeam.classList.add('active');
</script>
@endsection