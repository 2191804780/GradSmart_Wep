@extends('layouts.student')

@section('title', 'GradSmart — مشاريع المشرف')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sup_projects.css') }}">
@endsection

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div><h1 style="font-size:1.4rem;font-weight:900">📂 مشاريع فرقي</h1><p style="font-size:.82rem;color:var(--muted);margin-top:2px">8 فرق تحت إشرافي — عرض تفصيلي كامل</p></div>
    <div style="display:flex;gap:10px">
      <button class="btn btn-outline">📊 تقرير شامل</button>
      <button class="btn btn-green">📝 تقييم جماعي</button>
    </div>
  </div>
 
  <!-- Stats -->
  <div class="stats-row">
    <div class="sc" style="animation-delay:.05s">
      <div class="sc-icon" style="background:#f0fdf4">👥</div>
      <div><div class="sc-num" style="color:var(--green)">8</div><div class="sc-label">إجمالي الفرق</div></div>
    </div>
    <div class="sc" style="animation-delay:.10s">
      <div class="sc-icon" style="background:#eff6ff">✅</div>
      <div><div class="sc-num" style="color:var(--blue)">5</div><div class="sc-label">على المسار</div></div>
    </div>
    <div class="sc" style="animation-delay:.15s">
      <div class="sc-icon" style="background:#fff7ed">⚠️</div>
      <div><div class="sc-num" style="color:var(--orange)">1</div><div class="sc-label">تحتاج متابعة</div></div>
    </div>
    <div class="sc" style="animation-delay:.20s">
      <div class="sc-icon" style="background:#fef2f2">🔴</div>
      <div><div class="sc-num" style="color:var(--red)">2</div><div class="sc-label">في خطر عالي</div></div>
    </div>
  </div>
 
  <!-- Filter -->
  <div class="filter-bar">
    <div class="search-box"><span>🔍</span><input placeholder="ابحث باسم الفريق أو المشروع..."></div>
    <select class="filter-select">
      <option>كل الحالات</option>
      <option>على المسار</option>
      <option>متأخر</option>
      <option>خطر عالي</option>
    </select>
    <div class="filter-tabs">
      <button class="ftab active">الكل (8)</button>
      <button class="ftab">في خطر</button>
      <button class="ftab">متأخرة</button>
    </div>
  </div>
 
  <!-- Cards Grid -->
  <div class="projects-grid">
 
    <!-- Card 1: On track -->
    <div class="proj-card green" style="animation-delay:.05s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#eff6ff">🌐</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">GradSmart System</div>
      <div class="pc-team">👥 فريق Alpha · 4 أعضاء · 📅 23 يونيو 2026</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--blue);font-weight:700">62%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:62%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--blue)">م</div>
          <div class="pc-av" style="background:var(--pink)">س</div>
          <div class="pc-av" style="background:var(--green)">ع</div>
          <div class="pc-av" style="background:var(--yellow)">ل</div>
        </div>
        <div class="pc-date">آخر نشاط: اليوم</div>
        <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn pa-primary">🔍 تفاصيل المشروع</button>
        <button class="pa-btn pa-outline">📝 تقييم</button>
      </div>
    </div>
 
    <!-- Card 2: Danger -->
    <div class="proj-card danger" style="animation-delay:.10s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#fef2f2">📚</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">SmartLibrary</div>
      <div class="pc-team">👥 فريق Beta · 4 أعضاء · ⚠ تأخر 5 أيام</div>
      <div class="danger-alert">🚨 هذا المشروع يحتاج تدخلاً عاجلاً — إنجاز 22% فقط!</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--red);font-weight:700">22%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:22%;background:linear-gradient(90deg,var(--red),var(--orange))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--red)">ر</div>
          <div class="pc-av" style="background:var(--orange)">ه</div>
        </div>
        <div class="pc-date" style="color:var(--red)">⚠ 1 يونيو — قريب!</div>
        <div class="pc-risk" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca;animation:pulse 2s infinite">🔴 عالي</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn" style="background:linear-gradient(135deg,var(--red),#dc2626);color:white">🚨 تدخل عاجل</button>
        <button class="pa-btn pa-outline">💬 راسل الفريق</button>
      </div>
    </div>
 
    <!-- Card 3: Warning -->
    <div class="proj-card orange" style="animation-delay:.15s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#fff7ed">🛒</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">E-Commerce Platform</div>
      <div class="pc-team">👥 فريق Gamma · 3 أعضاء · 📅 15 يونيو 2026</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--orange);font-weight:700">45%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:45%;background:linear-gradient(90deg,var(--orange),var(--yellow))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--orange)">خ</div>
          <div class="pc-av" style="background:var(--yellow)">ن</div>
        </div>
        <div class="pc-date">آخر نشاط: أمس</div>
        <div class="pc-risk" style="background:#fffbeb;color:var(--amber,#f59e0b);border:1px solid #fde68a">🟡 متوسط</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn pa-primary">🔍 تفاصيل المشروع</button>
        <button class="pa-btn pa-outline">📝 تقييم</button>
      </div>
    </div>
 
    <!-- Card 4: Excellent -->
    <div class="proj-card green" style="animation-delay:.20s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#f0fdf4">🏥</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">Hospital Management System</div>
      <div class="pc-team">👥 فريق Delta · 4 أعضاء · 📅 30 يونيو 2026</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--green);font-weight:700">78%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:78%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--green)">أ</div>
          <div class="pc-av" style="background:var(--teal)">ف</div>
        </div>
        <div class="pc-date">آخر نشاط: اليوم</div>
        <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 ممتاز</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn pa-primary">🔍 تفاصيل المشروع</button>
        <button class="pa-btn pa-outline">📝 تقييم</button>
      </div>
    </div>
 
    <!-- Card 5 -->
    <div class="proj-card green" style="animation-delay:.25s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#faf5ff">📦</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">Smart Inventory App</div>
      <div class="pc-team">👥 فريق Zeta · 3 أعضاء · 📅 20 يونيو 2026</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--purple);font-weight:700">55%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:55%;background:linear-gradient(90deg,var(--purple),var(--pink))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--purple)">ي</div>
          <div class="pc-av" style="background:var(--pink)">ل</div>
        </div>
        <div class="pc-date">آخر نشاط: منذ 2 أيام</div>
        <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn pa-primary">🔍 تفاصيل المشروع</button>
        <button class="pa-btn pa-outline">📝 تقييم</button>
      </div>
    </div>
 
    <!-- Card 6: Danger -->
    <div class="proj-card danger" style="animation-delay:.30s">
      <div class="pc-top">
        <div class="pc-icon" style="background:#fef2f2">📚</div>
        <div class="pc-menu">⋮</div>
      </div>
      <div class="pc-name">E-Learning Platform</div>
      <div class="pc-team">👥 فريق Eta · 3 أعضاء · ⚠ تأخر 3 أيام</div>
      <div class="danger-alert">🚨 مستوى خطر عالي — يحتاج اجتماع عاجل!</div>
      <div class="pc-progress">
        <div class="pcp-top"><span style="color:var(--muted)">نسبة الإنجاز</span><span style="color:var(--red);font-weight:700">18%</span></div>
        <div class="pcp-track"><div class="pcp-fill" style="width:18%;background:linear-gradient(90deg,var(--red),var(--orange))"></div></div>
      </div>
      <div class="pc-footer">
        <div class="pc-avatars">
          <div class="pc-av" style="background:var(--teal)">ن</div>
          <div class="pc-av" style="background:var(--blue)">ك</div>
        </div>
        <div class="pc-date" style="color:var(--red)">⚠ 10 يونيو — خطر</div>
        <div class="pc-risk" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca;animation:pulse 2s infinite">🔴 عالي</div>
      </div>
      <div class="pc-actions">
        <button class="pa-btn" style="background:linear-gradient(135deg,var(--red),#dc2626);color:white">🚨 تدخل عاجل</button>
        <button class="pa-btn pa-outline">💬 راسل الفريق</button>
      </div>
    </div>
 
  </div>
 
  <!-- Pagination -->
  <div style="background:var(--white);border-radius:12px;padding:14px 18px;border:1px solid var(--border);margin-top:16px;display:flex;align-items:center;justify-content:space-between">
    <div style="font-size:.75rem;color:var(--muted)">عرض 1-6 من 8 مشاريع</div>
    <div style="display:flex;gap:5px">
      <div style="width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.78rem">‹</div>
      <div style="width:32px;height:32px;border-radius:8px;border:1px solid var(--green);background:var(--green);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.78rem;color:white;font-weight:700">1</div>
      <div style="width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.78rem">2</div>
      <div style="width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.78rem">›</div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.ftab').forEach(btn => {
  btn.addEventListener('click', function() {
    this.closest('.filter-tabs').querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
  });
});
</script>
@endsection