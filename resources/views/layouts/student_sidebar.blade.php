@php

$notificationCount = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();

$messageCount = \App\Models\Message::where('receiver_id', auth()->id())
                ->where('is_read', false)
                ->count();

@endphp


<!-- ══ البار الجانبي للطالب (Student Sidebar) ══ -->
<div class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-box">🎓</div>
    <div class="logo-text">Grad<span>Smart</span></div>
  </div>
 
  <div class="sidebar-nav">
    <span class="nav-label">القائمة الرئيسية</span>
    <a class="nav-item" {{ request()->is('student/dashboard') ? 'active' : '' }} href="/student/dashboard" id="nav-dashboard">
      <span class="nav-icon">🏠</span> لوحة التحكم
    </a>
    <a class="nav-item" {{ request()->is('student/project') ? 'active' : '' }} href="/student/project" id="nav-project">
      <span class="nav-icon">📋</span> مشروعي
    </a>
    <a class="nav-item" {{ request()->is('student/task-management') ? 'active' : '' }} href="/student/task-management" id="nav-tasks">
      <span class="nav-icon">✅</span> المهام
      <span class="nav-badge"></span>
    </a>
    <a class="nav-item" {{ request()->is('student/team-management') ? 'active' : '' }} href="/student/team-management" id="nav-team">
      <span class="nav-icon">👥</span> فريقي
    </a>
    <a class="nav-item" {{ request()->is('student/file-upload') ? 'active' : '' }} href="/student/file-upload" id="nav-files">
      <span class="nav-icon">📁</span> الملفات
    </a>
    <a class="nav-item" {{ request()->is('student/progress') ? 'active' : '' }} href="/student/progress" id="nav-progress">
      <span class="nav-icon">📊</span> التقدم
    </a>
 
    <span class="nav-label">التواصل</span>
    <a class="nav-item" {{ request()->is('student/chat') ? 'active' : '' }} href="/student/chat" id="nav-chat">
      <span class="nav-icon">💬</span> المحادثة
      @if ($messageCount > 0)
      <span class="nav-badge">{{ $messageCount }}</span>
      @endif
    </a>
    <a class="nav-item" {{ request()->is('student/notifications') ? 'active' : '' }} href="/student/notifications" id="nav-notifications">
      <span class="nav-icon">🔔</span> الإشعارات
      @if ($notificationCount > 0)
      <span class="nav-badge">{{ $notificationCount }}</span>
      @endif
    </a>
 
    <span class="nav-label">الحساب</span>
    <a class="nav-item" {{ request()->is('student/profile') ? 'active' : '' }} href="/student/profile" id="nav-profile">
      <span class="nav-icon">👤</span> ملفي الشخصي
    </a>
    <a class="nav-item" {{ request()->is('student/settings') ? 'active' : '' }} href="/student/settings" id="nav-settings">
      <span class="nav-icon">⚙️</span> الإعدادات
    </a>
{{-- تسجيل الخروج --}}
<form method="POST" action="{{ route('logout') }}" id="logout-form">

    @csrf

    <button type="submit" class="nav-item logout-btn" style="width: 100%; border: none;
        background: transparent; font-family: inherit;  cursor: pointer; text-align: right;">

        <span class="nav-icon">🚪</span>

        تسجيل الخروج

    </button>

</form>
  </div>
 
  <div class="sidebar-user">
    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 2) }}</div>
    <div>
      <div class="user-name">{{ auth()->user()->name }}</div>
      <div class="user-role">👨‍🎓 طالب</div>
    </div>
  </div>
 
</div>
