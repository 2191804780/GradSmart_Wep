@extends('layouts.admin')

@section('title', 'GradSmart — إدارة النظام')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin_management.css') }}">
<style>
@keyframes pulseBadge{0%,100%{opacity:1}50%{opacity:.5}}
</style>
@endsection

@section('topbar_actions')
<button class="btn btn-outline" onclick="openModal('export-modal')">📥 تصدير Excel</button>
      <button class="btn btn-primary" onclick="openModal('add-modal')">➕ إضافة جديد</button>
@endsection

@section('content')
<!-- Tabs -->
  <div class="page-tabs">
    <button class="ptab active" onclick="switchPage('users-page',this)">👤 المستخدمون (128)</button>
    <button class="ptab" onclick="switchPage('projects-page',this)">📦 المشاريع (32)</button>
    <button class="ptab" onclick="switchPage('supervisors-page',this)">👨‍🏫 المشرفون (14)</button>
  </div>
 
  <!-- ══ USERS PAGE ══ -->
  <div class="page-content active" id="users-page">
 
    <!-- Mini Stats -->
    <div class="mini-stats">
      <div class="ms-card" style="animation-delay:.05s">
        <div class="ms-icon" style="background:#eff6ff">👨‍🎓</div>
        <div><div class="ms-num" style="color:var(--blue)">108</div><div class="ms-label">طلاب مسجلون</div></div>
      </div>
      <div class="ms-card" style="animation-delay:.10s">
        <div class="ms-icon" style="background:#f0fdf4">👨‍🏫</div>
        <div><div class="ms-num" style="color:var(--green)">14</div><div class="ms-label">مشرفون</div></div>
      </div>
      <div class="ms-card" style="animation-delay:.15s">
        <div class="ms-icon" style="background:#fffbeb">🆕</div>
        <div><div class="ms-num" style="color:var(--amber)">6</div><div class="ms-label">جدد هذا الأسبوع</div></div>
      </div>
      <div class="ms-card" style="animation-delay:.20s">
        <div class="ms-icon" style="background:#fef2f2">🚫</div>
        <div><div class="ms-num" style="color:var(--red)">2</div><div class="ms-label">حسابات موقوفة</div></div>
      </div>
    </div>
 
    <!-- Filter -->
    <div class="filter-bar">
      <div class="search-box">
        <span>🔍</span>
        <input placeholder="ابحث بالاسم أو البريد أو رقم القيد...">
      </div>
      <select class="filter-select">
        <option>كل الأدوار</option>
        <option>طالب</option>
        <option>مشرف</option>
        <option>إدارة</option>
      </select>
      <select class="filter-select">
        <option>كل الحالات</option>
        <option>نشط</option>
        <option>غير نشط</option>
        <option>موقوف</option>
      </select>
      <div class="filter-tabs">
        <button class="ftab active">الكل</button>
        <button class="ftab">جدد</button>
        <button class="ftab">موقوف</button>
      </div>
    </div>
 
    <!-- Bulk action (shown when rows selected) -->
    <div class="bulk-bar" id="bulk-bar" style="display:none">
      <span>☑️ تم تحديد</span><span class="bulk-count">3 مستخدمين</span>
      <div class="bulk-actions">
        <button class="bulk-btn" style="background:#eff6ff;color:var(--blue)">📧 مراسلة</button>
        <button class="bulk-btn" style="background:#fffbeb;color:var(--amber)">✏️ تعديل الدور</button>
        <button class="bulk-btn" style="background:#fef2f2;color:var(--red)">🚫 إيقاف</button>
      </div>
    </div>
 
    <!-- Table -->
    <div class="card" style="animation-delay:.25s;padding:0;overflow:hidden">
      <table class="data-table">
        <thead>
          <tr>
            <th style="width:40px"><input type="checkbox" onchange="document.getElementById('bulk-bar').style.display=this.checked?'flex':'none'"></th>
            <th>المستخدم</th>
            <th>رقم القيد/الكود</th>
            <th>الدور</th>
            <th>الفريق/المشروع</th>
            <th>تاريخ الانضمام</th>
            <th>الحالة</th>
            <th style="text-align:center">إجراءات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,var(--blue),var(--purple))">م أ</div><div><div class="td-name">محمد أحمد علي</div><div class="td-email">m.ahmed@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">CS2021-004</td>
            <td><span class="badge badge-student">👨‍🎓 طالب</span></td>
            <td style="font-size:.75rem">فريق Alpha</td>
            <td style="font-size:.72rem;color:var(--muted)">1 أبريل 2026</td>
            <td><span class="badge badge-active">🟢 نشط</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div><div class="ab ab-ban">🚫</div></div></td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,var(--pink),var(--orange))">سا</div><div><div class="td-name">سارة علي محمد</div><div class="td-email">s.ali@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">CS2021-012</td>
            <td><span class="badge badge-student">👨‍🎓 طالب</span></td>
            <td style="font-size:.75rem">فريق Alpha</td>
            <td style="font-size:.72rem;color:var(--muted)">1 أبريل 2026</td>
            <td><span class="badge badge-active">🟢 نشط</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div><div class="ab ab-ban">🚫</div></div></td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,var(--green),var(--teal))">أح</div><div><div class="td-name">د. أحمد السالم</div><div class="td-email">a.salem@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">SUP-2019-001</td>
            <td><span class="badge badge-sup">👨‍🏫 مشرف</span></td>
            <td style="font-size:.75rem">8 فرق</td>
            <td style="font-size:.72rem;color:var(--muted)">10 مارس 2026</td>
            <td><span class="badge badge-active">🟢 نشط</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div><div class="ab ab-ban">🚫</div></div></td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,#94a3b8,#64748b)">ر م</div><div><div class="td-name">رامي منصور</div><div class="td-email">r.mansour@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">CS2020-088</td>
            <td><span class="badge badge-student">👨‍🎓 طالب</span></td>
            <td style="font-size:.75rem;color:var(--muted)">غير مسند</td>
            <td style="font-size:.72rem;color:var(--muted)">8 مايو 2026</td>
            <td><span class="badge badge-inactive">⚪ غير نشط</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div><div class="ab ab-ban">🚫</div></div></td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,var(--yellow),var(--orange))">ه ع</div><div><div class="td-name">هشام عبد الله</div><div class="td-email">h.abdallah@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">CS2021-033</td>
            <td><span class="badge badge-student">👨‍🎓 طالب</span></td>
            <td style="font-size:.75rem">فريق Beta</td>
            <td style="font-size:.72rem;color:var(--muted)">1 أبريل 2026</td>
            <td><span class="badge badge-banned">🔴 موقوف</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div><div class="ab" style="color:var(--green);border-color:var(--green)">✅</div></div></td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><div class="td-user"><div class="td-av" style="background:linear-gradient(135deg,var(--amber),var(--orange))">عم</div><div><div class="td-name">عمر الجميل</div><div class="td-email">o.jamil@university.edu</div></div></div></td>
            <td style="color:var(--muted);font-size:.75rem">ADM-001</td>
            <td><span class="badge badge-admin">🏛️ إدارة</span></td>
            <td style="font-size:.75rem">مدير القسم</td>
            <td style="font-size:.72rem;color:var(--muted)">1 يناير 2025</td>
            <td><span class="badge badge-active">🟢 نشط</span></td>
            <td><div class="action-btns"><div class="ab ab-view">👁</div><div class="ab ab-edit">✏️</div></div></td>
          </tr>
        </tbody>
      </table>
      <div style="padding:16px 22px">
        <div class="pagination">
          <div class="pag-info">عرض 1-6 من 128 مستخدم</div>
          <div class="pag-btns">
            <div class="pag-btn">‹</div>
            <div class="pag-btn active">1</div>
            <div class="pag-btn">2</div>
            <div class="pag-btn">3</div>
            <div class="pag-btn">...</div>
            <div class="pag-btn">22</div>
            <div class="pag-btn">›</div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ PROJECTS PAGE ══ -->
  <div class="page-content" id="projects-page">
 
    <div class="mini-stats">
      <div class="ms-card" style="animation-delay:.05s"><div class="ms-icon" style="background:#f0fdf4">🟢</div><div><div class="ms-num" style="color:var(--green)">20</div><div class="ms-label">على المسار</div></div></div>
      <div class="ms-card" style="animation-delay:.10s"><div class="ms-icon" style="background:#fff7ed">🟡</div><div><div class="ms-num" style="color:var(--orange)">9</div><div class="ms-label">تحتاج متابعة</div></div></div>
      <div class="ms-card" style="animation-delay:.15s"><div class="ms-icon" style="background:#fef2f2">🔴</div><div><div class="ms-num" style="color:var(--red)">3</div><div class="ms-label">في خطر</div></div></div>
      <div class="ms-card" style="animation-delay:.20s"><div class="ms-icon" style="background:#f1f5f9">✅</div><div><div class="ms-num" style="color:var(--muted)">0</div><div class="ms-label">مكتملة</div></div></div>
    </div>
 
    <div class="filter-bar">
      <div class="search-box"><span>🔍</span><input placeholder="ابحث باسم المشروع أو الفريق..."></div>
      <select class="filter-select"><option>كل المشرفين</option><option>د. أحمد</option><option>د. سلمى</option><option>د. كريم</option></select>
      <select class="filter-select"><option>كل الحالات</option><option>نشط</option><option>متأخر</option><option>خطر</option></select>
      <div class="filter-tabs">
        <button class="ftab active">الكل</button>
        <button class="ftab">في خطر</button>
        <button class="ftab">متأخرة</button>
      </div>
    </div>
 
    <div class="projects-grid">
      <div class="proj-card on-track" style="animation-delay:.05s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#eff6ff">🌐</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">GradSmart System</div>
        <div class="pc-team">👥 فريق Alpha · 4 أعضاء · د. أحمد</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--blue);font-weight:700">62%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:62%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--blue)">م</div><div class="pc-av" style="background:var(--pink)">س</div><div class="pc-av" style="background:var(--green)">ع</div></div>
          <div class="pc-date">📅 23 يونيو</div>
          <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</div>
        </div>
      </div>
 
      <div class="proj-card danger" style="animation-delay:.10s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#fef2f2">📚</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">SmartLibrary</div>
        <div class="pc-team">👥 فريق Beta · 4 أعضاء · د. أحمد</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--red);font-weight:700">22%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:22%;background:linear-gradient(90deg,var(--red),var(--orange))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--red)">ر</div><div class="pc-av" style="background:var(--orange)">ه</div></div>
          <div class="pc-date" style="color:var(--red)">⚠ 1 يونيو</div>
          <div class="pc-risk" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca;animation:pulseBadge 2s infinite">🔴 عالي</div>
        </div>
      </div>
 
      <div class="proj-card at-risk" style="animation-delay:.15s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#fff7ed">🛒</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">E-Commerce Platform</div>
        <div class="pc-team">👥 فريق Gamma · 3 أعضاء · د. سلمى</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--orange);font-weight:700">45%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:45%;background:linear-gradient(90deg,var(--orange),var(--yellow))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--orange)">خ</div><div class="pc-av" style="background:var(--yellow)">ن</div></div>
          <div class="pc-date">📅 15 يونيو</div>
          <div class="pc-risk" style="background:#fff7ed;color:var(--orange);border:1px solid #fed7aa">🟡 متوسط</div>
        </div>
      </div>
 
      <div class="proj-card on-track" style="animation-delay:.20s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#f0fdf4">🏥</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">Hospital Management System</div>
        <div class="pc-team">👥 فريق Delta · 4 أعضاء · د. كريم</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--green);font-weight:700">78%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:78%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--green)">أ</div><div class="pc-av" style="background:var(--teal)">ف</div></div>
          <div class="pc-date">📅 30 يونيو</div>
          <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</div>
        </div>
      </div>
 
      <div class="proj-card on-track" style="animation-delay:.25s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#faf5ff">📦</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">Smart Inventory App</div>
        <div class="pc-team">👥 فريق Zeta · 3 أعضاء · د. سلمى</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--purple);font-weight:700">55%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:55%;background:linear-gradient(90deg,var(--purple),var(--pink))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--purple)">ي</div><div class="pc-av" style="background:var(--pink)">ل</div></div>
          <div class="pc-date">📅 20 يونيو</div>
          <div class="pc-risk" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</div>
        </div>
      </div>
 
      <div class="proj-card danger" style="animation-delay:.30s">
        <div class="pc-top">
          <div class="pc-icon" style="background:#fef2f2">📚</div>
          <div class="pc-menu">⋮</div>
        </div>
        <div class="pc-name">E-Learning Platform</div>
        <div class="pc-team">👥 فريق Eta · 3 أعضاء · د. منى</div>
        <div class="pc-progress">
          <div class="pcp-top"><span style="color:var(--muted)">الإنجاز</span><span style="color:var(--red);font-weight:700">18%</span></div>
          <div class="pcp-track"><div class="pcp-fill" style="width:18%;background:linear-gradient(90deg,var(--red),var(--orange))"></div></div>
        </div>
        <div class="pc-footer">
          <div class="pc-avatars"><div class="pc-av" style="background:var(--teal)">ن</div><div class="pc-av" style="background:var(--blue)">ك</div></div>
          <div class="pc-date" style="color:var(--red)">⚠ 10 يونيو</div>
          <div class="pc-risk" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">🔴 عالي</div>
        </div>
      </div>
    </div>
 
    <!-- Pagination -->
    <div style="background:var(--white);border-radius:12px;padding:14px 18px;border:1px solid var(--border);margin-top:16px">
      <div class="pagination">
        <div class="pag-info">عرض 1-6 من 32 مشروع</div>
        <div class="pag-btns">
          <div class="pag-btn">‹</div>
          <div class="pag-btn active">1</div>
          <div class="pag-btn">2</div>
          <div class="pag-btn">3</div>
          <div class="pag-btn">4</div>
          <div class="pag-btn">›</div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ SUPERVISORS PAGE ══ -->
  <div class="page-content" id="supervisors-page">
 
    <div class="mini-stats">
      <div class="ms-card" style="animation-delay:.05s"><div class="ms-icon" style="background:#fffbeb">👨‍🏫</div><div><div class="ms-num" style="color:var(--amber)">14</div><div class="ms-label">مشرف إجمالاً</div></div></div>
      <div class="ms-card" style="animation-delay:.10s"><div class="ms-icon" style="background:#f0fdf4">✅</div><div><div class="ms-num" style="color:var(--green)">11</div><div class="ms-label">نشطون</div></div></div>
      <div class="ms-card" style="animation-delay:.15s"><div class="ms-icon" style="background:#eff6ff">📊</div><div><div class="ms-num" style="color:var(--blue)">2.3</div><div class="ms-label">متوسط الفرق/مشرف</div></div></div>
      <div class="ms-card" style="animation-delay:.20s"><div class="ms-icon" style="background:#fff7ed">⚠️</div><div><div class="ms-num" style="color:var(--orange)">2</div><div class="ms-label">عبء عمل زائد</div></div></div>
    </div>
 
    <div class="filter-bar">
      <div class="search-box"><span>🔍</span><input placeholder="ابحث باسم المشرف أو التخصص..."></div>
      <select class="filter-select"><option>كل التخصصات</option><option>هندسة البرمجيات</option><option>الذكاء الاصطناعي</option><option>قواعد البيانات</option></select>
      <div class="filter-tabs">
        <button class="ftab active">الكل</button>
        <button class="ftab">متاح</button>
        <button class="ftab">مشغول</button>
      </div>
    </div>
 
    <div class="sup-cards-grid">
      <div class="sup-card" style="animation-delay:.05s;border-top:3px solid var(--green)">
        <div class="sup-card-top">
          <div class="sup-av-big" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
            أح
            <div class="sup-online"></div>
          </div>
          <div>
            <div class="sup-card-name">د. أحمد السالم</div>
            <div class="sup-card-title">أستاذ مشارك</div>
            <div class="sup-card-spec">💻 هندسة البرمجيات</div>
          </div>
        </div>
        <div class="sup-stats-row">
          <div class="ss-box"><div class="ss-num" style="color:var(--blue)">8</div><div class="ss-label">فرق</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--green)">82%</div><div class="ss-label">أداء</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">6</div><div class="ss-label">سنوات</div></div>
        </div>
        <div class="sup-load-bar">
          <div class="slb-top"><span style="font-size:.72rem;color:var(--muted)">عبء العمل</span><span style="font-size:.72rem;font-weight:700;color:var(--orange)">80% — مشغول</span></div>
          <div class="slb-track"><div class="slb-fill" style="width:80%;background:linear-gradient(90deg,var(--orange),var(--yellow))"></div></div>
        </div>
        <div class="sup-actions">
          <button class="sup-btn sup-btn-primary">📋 إسناد فريق</button>
          <button class="sup-btn sup-btn-outline">👁 تفاصيل</button>
        </div>
      </div>
 
      <div class="sup-card" style="animation-delay:.10s;border-top:3px solid var(--green)">
        <div class="sup-card-top">
          <div class="sup-av-big" style="background:linear-gradient(135deg,var(--green),var(--teal))">
            كر
            <div class="sup-online"></div>
          </div>
          <div>
            <div class="sup-card-name">د. كريم العمري</div>
            <div class="sup-card-title">أستاذ مساعد</div>
            <div class="sup-card-spec">🗄️ قواعد البيانات</div>
          </div>
        </div>
        <div class="sup-stats-row">
          <div class="ss-box"><div class="ss-num" style="color:var(--green)">6</div><div class="ss-label">فرق</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--green)">75%</div><div class="ss-label">أداء</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">4</div><div class="ss-label">سنوات</div></div>
        </div>
        <div class="sup-load-bar">
          <div class="slb-top"><span style="font-size:.72rem;color:var(--muted)">عبء العمل</span><span style="font-size:.72rem;font-weight:700;color:var(--green)">60% — جيد</span></div>
          <div class="slb-track"><div class="slb-fill" style="width:60%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
        </div>
        <div class="sup-actions">
          <button class="sup-btn sup-btn-primary">📋 إسناد فريق</button>
          <button class="sup-btn sup-btn-outline">👁 تفاصيل</button>
        </div>
      </div>
 
      <div class="sup-card" style="animation-delay:.15s;border-top:3px solid var(--orange)">
        <div class="sup-card-top">
          <div class="sup-av-big" style="background:linear-gradient(135deg,var(--pink),var(--purple))">سل</div>
          <div>
            <div class="sup-card-name">د. سلمى نور</div>
            <div class="sup-card-title">أستاذ مشارك</div>
            <div class="sup-card-spec">🤖 الذكاء الاصطناعي</div>
          </div>
        </div>
        <div class="sup-stats-row">
          <div class="ss-box"><div class="ss-num" style="color:var(--pink)">5</div><div class="ss-label">فرق</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--purple)">61%</div><div class="ss-label">أداء</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">3</div><div class="ss-label">سنوات</div></div>
        </div>
        <div class="sup-load-bar">
          <div class="slb-top"><span style="font-size:.72rem;color:var(--muted)">عبء العمل</span><span style="font-size:.72rem;font-weight:700;color:var(--blue)">50% — مناسب</span></div>
          <div class="slb-track"><div class="slb-fill" style="width:50%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div></div>
        </div>
        <div class="sup-actions">
          <button class="sup-btn sup-btn-primary">📋 إسناد فريق</button>
          <button class="sup-btn sup-btn-outline">👁 تفاصيل</button>
        </div>
      </div>
 
      <div class="sup-card" style="animation-delay:.20s;border-top:3px solid var(--red)">
        <div class="sup-card-top">
          <div class="sup-av-big" style="background:linear-gradient(135deg,var(--amber),var(--orange))">من</div>
          <div>
            <div class="sup-card-name">د. منى الشريف</div>
            <div class="sup-card-title">أستاذ مساعد</div>
            <div class="sup-card-spec">🌐 الشبكات</div>
          </div>
        </div>
        <div class="sup-stats-row">
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">4</div><div class="ss-label">فرق</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--red)">45%</div><div class="ss-label">أداء</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">2</div><div class="ss-label">سنوات</div></div>
        </div>
        <div class="sup-load-bar">
          <div class="slb-top"><span style="font-size:.72rem;color:var(--muted)">عبء العمل</span><span style="font-size:.72rem;font-weight:700;color:var(--red)">95% — مثقل!</span></div>
          <div class="slb-track"><div class="slb-fill" style="width:95%;background:linear-gradient(90deg,var(--red),var(--orange))"></div></div>
        </div>
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:9px;padding:8px 10px;font-size:.7rem;color:var(--red);font-weight:600;margin-bottom:10px">⚠️ عبء العمل زائد — يُنصح بنقل فريق</div>
        <div class="sup-actions">
          <button class="sup-btn" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca;">📤 نقل فريق</button>
          <button class="sup-btn sup-btn-outline">👁 تفاصيل</button>
        </div>
      </div>
 
      <div class="sup-card" style="animation-delay:.25s;border-top:3px solid var(--teal)">
        <div class="sup-card-top">
          <div class="sup-av-big" style="background:linear-gradient(135deg,var(--teal),var(--blue))">
            نا
            <div class="sup-online"></div>
          </div>
          <div>
            <div class="sup-card-name">د. ناصر الحربي</div>
            <div class="sup-card-title">أستاذ مساعد</div>
            <div class="sup-card-spec">🔒 الأمن السيبراني</div>
          </div>
        </div>
        <div class="sup-stats-row">
          <div class="ss-box"><div class="ss-num" style="color:var(--teal)">3</div><div class="ss-label">فرق</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--orange)">38%</div><div class="ss-label">أداء</div></div>
          <div class="ss-box"><div class="ss-num" style="color:var(--amber)">1</div><div class="ss-label">سنة</div></div>
        </div>
        <div class="sup-load-bar">
          <div class="slb-top"><span style="font-size:.72rem;color:var(--muted)">عبء العمل</span><span style="font-size:.72rem;font-weight:700;color:var(--green)">30% — متاح</span></div>
          <div class="slb-track"><div class="slb-fill" style="width:30%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
        </div>
        <div class="sup-actions">
          <button class="sup-btn sup-btn-primary">📋 إسناد فريق</button>
          <button class="sup-btn sup-btn-outline">👁 تفاصيل</button>
        </div>
      </div>
 
      <!-- Add Supervisor card -->
      <div style="background:linear-gradient(135deg,#fffbeb,#fff7ed);border:2px dashed #fde68a;border-radius:16px;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:30px;cursor:pointer;transition:all .2s;animation:fadeUp .4s .30s ease both" onmouseover="this.style.background='white'" onmouseout="this.style.background='linear-gradient(135deg,#fffbeb,#fff7ed)'" onclick="openModal('add-modal')">
        <div style="font-size:2.5rem;margin-bottom:12px">➕</div>
        <div style="font-size:.88rem;font-weight:800;margin-bottom:6px">إضافة مشرف جديد</div>
        <div style="font-size:.72rem;color:var(--muted)">أضف مشرفاً جديداً للنظام</div>
      </div>
    </div>
  </div>
</div>
 
<!-- Modal: Add User -->
<div class="modal-overlay" id="add-modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">➕ إضافة مستخدم جديد</div>
      <button class="modal-close" onclick="closeModal('add-modal')">✕</button>
    </div>
    <div class="form-group">
      <label class="form-label">نوع الحساب *</label>
      <select class="form-select">
        <option>👨‍🎓 طالب</option>
        <option>👨‍🏫 مشرف</option>
        <option>🏛️ إدارة</option>
      </select>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">الاسم الأول *</label><input class="form-input" placeholder="محمد"></div>
      <div class="form-group"><label class="form-label">اسم العائلة *</label><input class="form-input" placeholder="أحمد"></div>
    </div>
    <div class="form-group"><label class="form-label">البريد الجامعي *</label><input class="form-input" placeholder="m.ahmed@university.edu"></div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">رقم القيد / الكود</label><input class="form-input" placeholder="CS2021-XXX"></div>
      <div class="form-group"><label class="form-label">كلمة المرور المؤقتة</label><input class="form-input" type="password" placeholder="••••••••"></div>
    </div>
    <div class="form-group"><label class="form-label">التخصص / القسم</label><input class="form-input" placeholder="هندسة البرمجيات"></div>
    <div class="modal-footer">
      <button class="btn btn-primary" style="flex:1" onclick="closeModal('add-modal')">✅ إنشاء الحساب</button>
      <button class="btn btn-outline" onclick="closeModal('add-modal')">إلغاء</button>
    </div>
@endsection

@section('scripts')
<script>
function switchPage(id,btn){
  document.querySelectorAll('.page-content').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(b=>b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
}
function openModal(id){document.getElementById(id).classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
document.querySelectorAll('.modal-overlay').forEach(m=>m.addEventListener('click',function(e){if(e.target===this)this.classList.remove('open')}));
document.querySelectorAll('.ftab').forEach(btn=>btn.addEventListener('click',function(){this.closest('.filter-bar').querySelectorAll('.ftab').forEach(b=>b.classList.remove('active'));this.classList.add('active')}));
</script>
@endsection