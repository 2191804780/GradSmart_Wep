<!-- ══ البار الجانبي للطالب (Student Sidebar) ══ -->
<div class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-box">🎓</div>
    <div class="logo-text">Grad<span>Smart</span></div>
  </div>
 
  <div class="sidebar-nav">
    <span class="nav-label">القائمة الرئيسية</span>
    <a class="nav-item" href="/student/dashboard" id="nav-dashboard">
      <span class="nav-icon">🏠</span> لوحة التحكم
    </a>
    <a class="nav-item" href="/student/project" id="nav-project">
      <span class="nav-icon">📋</span> مشروعي
    </a>
    <a class="nav-item" href="/student/task-management" id="nav-tasks">
      <span class="nav-icon">✅</span> المهام
      <span class="nav-badge"></span>
    </a>
    <a class="nav-item" href="/student/team-management" id="nav-team">
      <span class="nav-icon">👥</span> فريقي
    </a>
    <a class="nav-item" href="/student/file-upload" id="nav-files">
      <span class="nav-icon">📁</span> الملفات
    </a>
    <a class="nav-item" href="/student/progress" id="nav-progress">
      <span class="nav-icon">📊</span> التقدم
    </a>
 
    <span class="nav-label">التواصل</span>
    <a class="nav-item" href="/student/chat" id="nav-chat">
      <span class="nav-icon">💬</span> المحادثة
      <span class="nav-badge"></span>
    </a>
    <a class="nav-item" href="#" id="nav-notifications">
      <span class="nav-icon">🔔</span> الإشعارات
    </a>
 
    <span class="nav-label">الحساب</span>
    <a class="nav-item" href="#" id="nav-profile">
      <span class="nav-icon">👤</span> ملفي الشخصي
    </a>
    <a class="nav-item" href="#" id="nav-settings">
      <span class="nav-icon">⚙️</span> الإعدادات
    </a>

    <a class="nav-item" href="/logout" id="nav-logout">
      <span class="nav-icon">🚪</span> تسجيل الخروج
    </a>
  </div>
 
  <div class="sidebar-user">
    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 2) }}</div>
    <div>
      <div class="user-name">{{ auth()->user()->name }}</div>
      <div class="user-role">👨‍🎓 طالب</div>
    </div>
  </div>
 
</div>
