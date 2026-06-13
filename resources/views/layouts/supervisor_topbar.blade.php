<div class="topbar">
  <div class="page-title">
    @hasSection('page_title')
      @yield('page_title')
    @else
      <h1>مرحباً، د. أحمد 👋</h1>
      <p>لديك 8 فرق تحت إشرافك — 2 تحتاج متابعة عاجلة</p>
    @endif
  </div>
  <div class="topbar-actions">
    @hasSection('topbar_actions')
      @yield('topbar_actions')
    @else
      <button class="btn btn-outline">📊 تقرير شامل</button>
      <button class="btn btn-primary">📝 تقييم جديد</button>
    @endif
    <button class="theme-toggle-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
  </div>
</div>
