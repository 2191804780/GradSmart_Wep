@extends('layouts.student')

@section('title', 'GradSmart — ملف المشرف')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sup_profile.css') }}">
@endsection

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div><h1 style="font-size:1.4rem;font-weight:900">👨‍🏫 ملفي الشخصي</h1><p style="font-size:.82rem;color:var(--muted);margin-top:2px">تعديل معلوماتك وإدارة تفضيلاتك</p></div>
    <button class="btn btn-green">💾 حفظ التغييرات</button>
  </div>
 
  <div class="layout">
 
    <!-- Left: Profile card + teams -->
    <div>
      <!-- Profile hero -->
      <div class="profile-hero">
        <div class="ph-avatar-wrap">
          <div class="ph-avatar">أح</div>
          <button class="ph-edit-av">✏️</button>
        </div>
        <div class="ph-name">د. أحمد السالم</div>
        <div class="ph-title">أستاذ مشارك — قسم علوم الحاسوب</div>
        <div class="ph-badges">
          <div class="ph-badge">👨‍🏫 مشرف</div>
          <div class="ph-badge">🟢 متاح</div>
          <div class="ph-badge">⭐ 4.8 تقييم</div>
        </div>
        <div class="ph-stats">
          <div class="ph-stat"><div class="ph-stat-num">8</div><div class="ph-stat-label">فرق حالية</div></div>
          <div class="ph-stat"><div class="ph-stat-num">82%</div><div class="ph-stat-label">متوسط الأداء</div></div>
          <div class="ph-stat"><div class="ph-stat-num">6</div><div class="ph-stat-label">سنوات خبرة</div></div>
        </div>
      </div>
 
      <!-- Assigned teams -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header"><div class="card-title">👥 فرقي الحالية</div><span style="font-size:.75rem;color:var(--green);cursor:pointer;font-weight:600">عرض الكل ←</span></div>
        <div class="at-item">
          <div class="at-icon" style="background:#eff6ff">🌐</div>
          <div style="flex:1"><div style="font-size:.78rem;font-weight:700;margin-bottom:2px">فريق Alpha</div><div style="font-size:.62rem;color:var(--muted)">GradSmart System</div></div>
          <div><div class="at-pct" style="color:var(--blue)">62%</div><div class="at-bar"><div class="at-bar-fill" style="width:62%;background:var(--blue)"></div></div></div>
        </div>
        <div class="at-item" style="border-color:#fecaca;background:#fffafa">
          <div class="at-icon" style="background:#fef2f2">📚</div>
          <div style="flex:1"><div style="font-size:.78rem;font-weight:700;margin-bottom:2px">فريق Beta</div><div style="font-size:.62rem;color:var(--red)">SmartLibrary ⚠ خطر</div></div>
          <div><div class="at-pct" style="color:var(--red)">22%</div><div class="at-bar"><div class="at-bar-fill" style="width:22%;background:var(--red)"></div></div></div>
        </div>
        <div class="at-item">
          <div class="at-icon" style="background:#fff7ed">🛒</div>
          <div style="flex:1"><div style="font-size:.78rem;font-weight:700;margin-bottom:2px">فريق Gamma</div><div style="font-size:.62rem;color:var(--muted)">E-Commerce Platform</div></div>
          <div><div class="at-pct" style="color:var(--orange)">45%</div><div class="at-bar"><div class="at-bar-fill" style="width:45%;background:var(--orange)"></div></div></div>
        </div>
        <div class="at-item">
          <div class="at-icon" style="background:#f0fdf4">🏥</div>
          <div style="flex:1"><div style="font-size:.78rem;font-weight:700;margin-bottom:2px">فريق Delta</div><div style="font-size:.62rem;color:var(--muted)">Hospital Management</div></div>
          <div><div class="at-pct" style="color:var(--green)">78%</div><div class="at-bar"><div class="at-bar-fill" style="width:78%;background:var(--green)"></div></div></div>
        </div>
      </div>
    </div>
 
    <!-- Right: Edit forms -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- Personal Info -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header"><div class="card-title">📝 المعلومات الشخصية</div></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">الاسم الأول</label><input class="form-input" value="أحمد"></div>
          <div class="form-group"><label class="form-label">اسم العائلة</label><input class="form-input" value="السالم"></div>
        </div>
        <div class="form-group"><label class="form-label">البريد الجامعي</label><input class="form-input" value="a.salem@university.edu"></div>
        <div class="form-group"><label class="form-label">رقم الهاتف</label><input class="form-input" value="+218 91 234 0001"></div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">الرتبة العلمية</label>
            <select class="form-select"><option>أستاذ مشارك</option><option>أستاذ مساعد</option><option>أستاذ</option></select>
          </div>
          <div class="form-group">
            <label class="form-label">سنوات الخبرة</label>
            <input class="form-input" type="number" value="6">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">نبذة مهنية</label>
          <textarea class="form-input" style="resize:none;min-height:70px">متخصص في هندسة البرمجيات وتطوير الأنظمة. خبرة واسعة في الإشراف على مشاريع التخرج البرمجية.</textarea>
        </div>
      </div>
 
      <!-- Expertise -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header"><div class="card-title">💡 مجالات التخصص</div></div>
        <div class="exp-tags">
          <div class="exp-tag selected">💻 هندسة البرمجيات <button class="exp-tag-remove">×</button></div>
          <div class="exp-tag selected">🗄️ قواعد البيانات <button class="exp-tag-remove">×</button></div>
          <div class="exp-tag selected">🌐 تطوير الويب <button class="exp-tag-remove">×</button></div>
          <div class="exp-tag" onclick="this.classList.toggle('selected')">🤖 الذكاء الاصطناعي</div>
          <div class="exp-tag" onclick="this.classList.toggle('selected')">🔒 الأمن السيبراني</div>
          <div class="exp-tag" onclick="this.classList.toggle('selected')">📱 تطوير الموبايل</div>
        </div>
        <div style="display:flex;gap:8px;margin-top:12px">
          <input class="form-input" placeholder="أضف تخصصاً جديداً..." style="flex:1">
          <button class="btn btn-green" style="flex-shrink:0;padding:10px 14px">＋</button>
        </div>
      </div>
 
      <!-- Availability -->
      <div class="card" style="animation-delay:.40s">
        <div class="card-header"><div class="card-title">📅 التوفر والجداول</div></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">أقصى عدد فرق</label><input class="form-input" type="number" value="10"></div>
          <div class="form-group"><label class="form-label">ساعات المكتب</label><input class="form-input" value="الأحد — الأربعاء 10-12"></div>
        </div>
        <div class="form-group">
          <label class="form-label">الحالة الحالية</label>
          <select class="form-select">
            <option>🟢 متاح لقبول فرق جديدة</option>
            <option>🟡 متاح بشكل محدود</option>
            <option>🔴 مشغول — لا قبول جديد</option>
          </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:6px">
          <button class="btn btn-outline" style="flex:1;justify-content:center">إلغاء</button>
          <button class="btn btn-green" style="flex:2;justify-content:center">💾 حفظ التغييرات</button>
        </div>
      </div>
 
    </div>
  </div>
@endsection
