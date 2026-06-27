<div class="topbar">
  <div class="page-title">
    @hasSection('page_title')
      @yield('page_title')
    @else
      <h1>مرحباً {{ substr(auth()->user()->name, 0, 9) }}👋</h1>
     
     @php
     \Carbon\Carbon::setLocale('ar');
     
     @endphp 
      <p>{{ now()->format('l، j F Y') }} — إليك ملخص مشروعك </p>
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
