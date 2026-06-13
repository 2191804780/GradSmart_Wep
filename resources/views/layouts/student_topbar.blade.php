<div class="topbar">
  <div class="page-title">
    @hasSection('page_title')
      @yield('page_title')
    @else
      <h1>مرحباً، محمد 👋</h1>
      <p>السبت، 9 مايو 2026 — إليك ملخص مشروعك اليوم</p>
    @endif
  </div>
  <div class="topbar-actions">
    @hasSection('topbar_actions')
      @yield('topbar_actions')
    @else
      <div class="search-box">🔍 ابحث...</div>
    @endif
    <button class="theme-toggle-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
    <div class="notif-btn">🔔 <div class="notif-dot"></div></div>
  </div>
</div>
