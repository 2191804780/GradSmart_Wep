<div class="topbar">
  <div class="page-title">
    @hasSection('page_title')
      @yield('page_title')
    @else
      <h1>مرحباً، المسؤول 👋</h1>
      <p>الأربعاء، 27 مايو 2026 — إليك ملخص حالة النظام اليوم</p>
    @endif
  </div>
  <div class="topbar-actions">
    @hasSection('topbar_actions')
      @yield('topbar_actions')
    @else
      <div class="search-box">🔍 ابحث عن مستخدم أو مشروع...</div>
      <button class="btn btn-primary">➕ إضافة مستخدم</button>
    @endif
    <button class="theme-toggle-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
  </div>
</div>
