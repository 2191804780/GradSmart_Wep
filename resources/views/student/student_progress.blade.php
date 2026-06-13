@extends('layouts.student')

@section('title', 'GradSmart — تقدم المشروع')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_progress.css') }}">
@endsection

@section('page_title')
<h1>📊 تقدم المشروع</h1>
<p>GradSmart — متابعة الإنجاز والمراحل الزمنية</p>
@endsection

@section('topbar_actions')
<button class="btn btn-outline">📥 تصدير PDF</button>
<button class="btn btn-primary">🔄 تحديث</button>
@endsection

@section('content')
  <!-- Stats -->
  <div class="stats-row">
    <div class="sc"><div class="sc-icon">📊</div><div class="sc-num" style="color:var(--blue)">62%</div><div class="sc-label">نسبة الإنجاز الكلية</div></div>
    <div class="sc"><div class="sc-icon">✅</div><div class="sc-num" style="color:var(--green)">7</div><div class="sc-label">مهام منجزة</div></div>
    <div class="sc"><div class="sc-icon">⏳</div><div class="sc-num" style="color:var(--orange)">3</div><div class="sc-label">مهام متأخرة</div></div>
    <div class="sc"><div class="sc-icon">📅</div><div class="sc-num" style="color:var(--purple)">45</div><div class="sc-label">يوم متبقي</div></div>
    <div class="sc"><div class="sc-icon">🤖</div><div class="sc-num" style="color:var(--green)">منخفض</div><div class="sc-label">مستوى الخطر</div></div>
  </div>
 
  <!-- Overall Progress Bar -->
  <div class="overall-card">
    <div class="oc-left">
      <div class="oc-title">مشروع التخرج</div>
      <div class="oc-project">GradSmart — نظام إدارة مشاريع التخرج الذكي</div>
      <div class="oc-meta">👨‍🏫 د. أحمد السالم &nbsp;·&nbsp; 👥 4 أعضاء &nbsp;·&nbsp; 📅 بدأ 1 أبريل 2026</div>
      <div class="oc-bar-wrap">
        <div class="oc-bar-top"><span>نسبة الإنجاز الكلية</span><span style="font-weight:900">62%</span></div>
        <div class="oc-bar-track"><div class="oc-bar-fill" style="width:62%"></div></div>
      </div>
      <div class="oc-bar-note">المتوقع في هذا التاريخ: 65% — أنتم قريبون جداً! 💪</div>
    </div>
    <div class="oc-right">
      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:62%"><div class="oc-circle-inner"><div class="oc-circle-num">7</div><div class="oc-circle-sub">منجزة</div></div></div>
        <div class="oc-circle-label">مهام</div>
      </div>
      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:25%"><div class="oc-circle-inner"><div class="oc-circle-num">3</div><div class="oc-circle-sub">متأخرة</div></div></div>
        <div class="oc-circle-label">تأخير</div>
      </div>
      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:45%"><div class="oc-circle-inner"><div class="oc-circle-num">45</div><div class="oc-circle-sub">يوم</div></div></div>
        <div class="oc-circle-label">متبقي</div>
      </div>
    </div>
  </div>
 
  <!-- Gantt Chart -->
  <div class="card gantt-card">
    <div class="card-header">
      <div class="card-title">📅 المخطط الزمني — Gantt Chart</div>
      <div style="display:flex;gap:8px;align-items:center">
        <div style="display:flex;gap:6px;font-size:.65rem;align-items:center">
          <span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:var(--green)"></span>منجزة
          <span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:var(--blue)"></span>جارية
          <span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:var(--red)"></span>متأخرة
          <span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:var(--border)"></span>قادمة
        </div>
        <a class="card-action">تكبير ←</a>
      </div>
    </div>
    <div class="gantt-controls">
      <button class="gc-btn">أبريل</button>
      <button class="gc-btn active">مايو</button>
      <button class="gc-btn">يونيو</button>
      <div class="gc-spacer"></div>
      <button class="gc-btn">أسبوع</button>
      <button class="gc-btn active">شهر</button>
    </div>
 
    <!-- Simple Visual Gantt -->
    <div style="overflow-x:auto">
      <div style="min-width:700px">
        <!-- Header days -->
        <div style="display:flex;margin-right:200px;margin-bottom:4px">
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">أسبوع 1 (1-7 مايو)</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">أسبوع 2 (8-14 مايو)</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">أسبوع 3 (15-21 مايو)</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;padding:4px">أسبوع 4 (22-31 مايو)</div>
        </div>
 
        <!-- Gantt Rows -->
        <div style="display:flex;flex-direction:column;gap:6px">
 
          <!-- Row 1: Done -->
          <div style="display:flex;align-items:center;gap:0">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:var(--bg);border-radius:8px 0 0 8px;border:1px solid var(--border);border-left:none">
              <div style="font-size:.75rem;font-weight:700">تصميم ERD</div>
              <div style="font-size:.62rem;color:var(--muted)">م أ · 1-7 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#f8fafc;border:1px solid var(--border);border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:0;width:25%;height:24px;background:var(--green);border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700">✓ مكتملة</div>
            </div>
          </div>
 
          <!-- Row 2: Done -->
          <div style="display:flex;align-items:center">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:var(--bg);border-radius:8px 0 0 8px;border:1px solid var(--border);border-left:none">
              <div style="font-size:.75rem;font-weight:700">تصميم Figma</div>
              <div style="font-size:.62rem;color:var(--muted)">سا · 1-8 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#f8fafc;border:1px solid var(--border);border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:0;width:30%;height:24px;background:var(--green);border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700">✓ مكتملة</div>
            </div>
          </div>
 
          <!-- Row 3: Late -->
          <div style="display:flex;align-items:center">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:#fef9f9;border-radius:8px 0 0 8px;border:1px solid #fecaca;border-left:none">
              <div style="font-size:.75rem;font-weight:700;color:var(--red)">API المصادقة ⚠</div>
              <div style="font-size:.62rem;color:var(--muted)">عم · 5-8 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#fef9f9;border:1px solid #fecaca;border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:12%;width:15%;height:24px;background:var(--red);border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700;animation:pulse 2s infinite">⚠ متأخرة</div>
            </div>
          </div>
 
          <!-- Row 4: In Progress -->
          <div style="display:flex;align-items:center">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:var(--bg);border-radius:8px 0 0 8px;border:1px solid var(--border);border-left:none">
              <div style="font-size:.75rem;font-weight:700">واجهة Login</div>
              <div style="font-size:.62rem;color:var(--muted)">سا + لي · 6-12 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#f8fafc;border:1px solid var(--border);border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:10%;width:20%;height:24px;background:linear-gradient(90deg,var(--blue),var(--purple));border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700">🔄 65%</div>
            </div>
          </div>
 
          <!-- Row 5: In Progress -->
          <div style="display:flex;align-items:center">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:var(--bg);border-radius:8px 0 0 8px;border:1px solid var(--border);border-left:none">
              <div style="font-size:.75rem;font-weight:700">Dashboard المشرف</div>
              <div style="font-size:.62rem;color:var(--muted)">م أ · 8-18 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#f8fafc;border:1px solid var(--border);border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:25%;width:30%;height:24px;background:linear-gradient(90deg,var(--purple),var(--pink));border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700">🔄 40%</div>
            </div>
          </div>
 
          <!-- Row 6: Upcoming -->
          <div style="display:flex;align-items:center">
            <div style="width:200px;flex-shrink:0;padding:8px 12px;background:var(--bg);border-radius:8px 0 0 8px;border:1px solid var(--border);border-left:none">
              <div style="font-size:.75rem;font-weight:700">ربط Frontend/Backend</div>
              <div style="font-size:.62rem;color:var(--muted)">لي · 20-26 مايو</div>
            </div>
            <div style="flex:1;height:40px;background:#f8fafc;border:1px solid var(--border);border-right:none;position:relative;border-radius:0 8px 8px 0">
              <div style="position:absolute;top:8px;right:57%;width:26%;height:24px;background:var(--border);border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:var(--muted);font-weight:700">⬜ لم تبدأ</div>
            </div>
          </div>
 
          <!-- Today marker visual -->
          <div style="display:flex;align-items:center;margin-top:4px">
            <div style="width:200px;flex-shrink:0"></div>
            <div style="flex:1;display:flex">
              <div style="width:32%;border-top:2px dashed var(--red);position:relative">
                <span style="position:absolute;top:-10px;right:0;font-size:.62rem;color:var(--red);font-weight:700;white-space:nowrap">← اليوم (9 مايو)</span>
              </div>
            </div>
          </div>
 
        </div>
      </div>
    </div>
  </div>
 
  <!-- Member Progress -->
  <div style="margin-bottom:8px;font-size:.85rem;font-weight:800">👤 إنجاز كل عضو</div>
  <div class="member-progress-grid">
    <div class="mp-card">
      <div class="mp-top">
        <div class="mp-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">م أ</div>
        <div><div class="mp-name">محمد أحمد</div><div class="mp-role">Full Stack</div></div>
      </div>
      <div class="mp-stats">
        <div><div class="mp-stat-num" style="color:var(--blue)">3/4</div><div class="mp-stat-label">مهام</div></div>
        <div><div class="mp-stat-num" style="color:var(--blue)">75%</div><div class="mp-stat-label">إنجاز</div></div>
      </div>
      <div class="mp-bar-track"><div class="mp-bar-fill" style="width:75%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div></div>
    </div>
    <div class="mp-card">
      <div class="mp-top">
        <div class="mp-avatar" style="background:linear-gradient(135deg,var(--pink),var(--orange))">سا</div>
        <div><div class="mp-name">سارة علي</div><div class="mp-role">UI/UX</div></div>
      </div>
      <div class="mp-stats">
        <div><div class="mp-stat-num" style="color:var(--pink)">2/3</div><div class="mp-stat-label">مهام</div></div>
        <div><div class="mp-stat-num" style="color:var(--pink)">60%</div><div class="mp-stat-label">إنجاز</div></div>
      </div>
      <div class="mp-bar-track"><div class="mp-bar-fill" style="width:60%;background:linear-gradient(90deg,var(--pink),var(--orange))"></div></div>
    </div>
    <div class="mp-card">
      <div class="mp-top">
        <div class="mp-avatar" style="background:linear-gradient(135deg,var(--green),var(--teal))">عم</div>
        <div><div class="mp-name">عمر خالد</div><div class="mp-role">Backend</div></div>
      </div>
      <div class="mp-stats">
        <div><div class="mp-stat-num" style="color:var(--green)">1/3</div><div class="mp-stat-label">مهام</div></div>
        <div><div class="mp-stat-num" style="color:var(--orange)">40%</div><div class="mp-stat-label">إنجاز</div></div>
      </div>
      <div class="mp-bar-track"><div class="mp-bar-fill" style="width:40%;background:linear-gradient(90deg,var(--orange),var(--yellow))"></div></div>
    </div>
    <div class="mp-card">
      <div class="mp-top">
        <div class="mp-avatar" style="background:linear-gradient(135deg,var(--yellow),var(--orange))">لي</div>
        <div><div class="mp-name">ليلى يوسف</div><div class="mp-role">Database</div></div>
      </div>
      <div class="mp-stats">
        <div><div class="mp-stat-num" style="color:var(--yellow)">2/2</div><div class="mp-stat-label">مهام</div></div>
        <div><div class="mp-stat-num" style="color:var(--green)">85%</div><div class="mp-stat-label">إنجاز</div></div>
      </div>
      <div class="mp-bar-track"><div class="mp-bar-fill" style="width:85%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
    </div>
  </div>
 
  <!-- Bottom Grid -->
  <div class="bottom-grid">
    <!-- Milestones -->
    <div class="card" style="animation-delay:.4s">
      <div class="card-header"><div class="card-title">🏁 المراحل والمعالم</div><a class="card-action">تعديل ←</a></div>
      <div class="milestones">
        <div class="milestone-item">
          <div class="ms-indicator"><div class="ms-dot done"></div><div class="ms-line done"></div></div>
          <div class="ms-content">
            <div class="ms-title">المرحلة 1 — التحليل والتصميم</div>
            <div class="ms-desc">تحليل المتطلبات، تصميم ERD، وثيقة المتطلبات، نماذج الواجهات</div>
            <div class="ms-footer"><div class="ms-date" style="color:var(--green)">✓ 30 أبريل</div><span class="ms-badge mb-done">مكتملة</span></div>
          </div>
        </div>
        <div class="milestone-item">
          <div class="ms-indicator"><div class="ms-dot active"></div><div class="ms-line pending"></div></div>
          <div class="ms-content">
            <div class="ms-title">المرحلة 2 — البناء الأساسي</div>
            <div class="ms-desc">قاعدة البيانات، نظام المصادقة، واجهات الطالب والمشرف</div>
            <div class="ms-footer"><div class="ms-date" style="color:var(--blue)">📅 30 مايو</div><span class="ms-badge mb-active">جارية — 62%</span></div>
          </div>
        </div>
        <div class="milestone-item">
          <div class="ms-indicator"><div class="ms-dot late"></div><div class="ms-line pending"></div></div>
          <div class="ms-content">
            <div class="ms-title">المرحلة 3 — وحدة الذكاء الاصطناعي</div>
            <div class="ms-desc">خوارزمية التنبؤ، اقتراح المشرف، التقارير الذكية</div>
            <div class="ms-footer"><div class="ms-date" style="color:var(--orange)">📅 15 يونيو</div><span class="ms-badge mb-late">متأخرة</span></div>
          </div>
        </div>
        <div class="milestone-item">
          <div class="ms-indicator"><div class="ms-dot pending"></div><div class="ms-line pending"></div></div>
          <div class="ms-content">
            <div class="ms-title">المرحلة 4 — الاختبار والإطلاق</div>
            <div class="ms-desc">اختبار شامل، تصحيح الأخطاء، التوثيق، العرض النهائي</div>
            <div class="ms-footer"><div class="ms-date" style="color:var(--muted)">📅 23 يونيو</div><span class="ms-badge mb-pending">لم تبدأ</span></div>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Phase progress -->
    <div class="card" style="animation-delay:.45s">
      <div class="card-header"><div class="card-title">📈 إنجاز المراحل</div></div>
      <div class="phases">
        <div class="phase-item">
          <div class="ph-top"><span class="ph-name">🎨 Frontend</span><span class="ph-pct" style="color:var(--blue)">55%</span></div>
          <div class="ph-track"><div class="ph-fill" style="width:55%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div></div>
          <div class="ph-meta">6 من 11 مهمة · سارة + ليلى</div>
        </div>
        <div class="phase-item">
          <div class="ph-top"><span class="ph-name">⚙️ Backend PHP</span><span class="ph-pct" style="color:var(--orange)">40%</span></div>
          <div class="ph-track"><div class="ph-fill" style="width:40%;background:linear-gradient(90deg,var(--orange),var(--yellow))"></div></div>
          <div class="ph-meta">4 من 10 مهمة · عمر + محمد</div>
        </div>
        <div class="phase-item">
          <div class="ph-top"><span class="ph-name">🗄️ قاعدة البيانات</span><span class="ph-pct" style="color:var(--green)">85%</span></div>
          <div class="ph-track"><div class="ph-fill" style="width:85%;background:linear-gradient(90deg,var(--green),var(--teal))"></div></div>
          <div class="ph-meta">5 من 6 مهام · ليلى</div>
        </div>
        <div class="phase-item">
          <div class="ph-top"><span class="ph-name">🤖 الذكاء الاصطناعي</span><span class="ph-pct" style="color:var(--muted)">0%</span></div>
          <div class="ph-track"><div class="ph-fill" style="width:0%;background:var(--muted)"></div></div>
          <div class="ph-meta">0 من 4 مهام · محمد</div>
        </div>
        <div class="phase-item">
          <div class="ph-top"><span class="ph-name">🧪 الاختبار</span><span class="ph-pct" style="color:var(--muted)">0%</span></div>
          <div class="ph-track"><div class="ph-fill" style="width:0%;background:var(--muted)"></div></div>
          <div class="ph-meta">لم تبدأ بعد</div>
        </div>
      </div>
    </div>
  </div>
  <style>@keyframes pulse{0%,100%{opacity:1}50%{opacity:.6}}</style>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    const navProgress = document.getElementById('nav-progress');
    if (navProgress) navProgress.classList.add('active');
    const navProject = document.getElementById('nav-project');
    if (navProject) navProject.classList.add('active');
</script>
@endsection