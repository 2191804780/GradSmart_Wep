@extends('layouts.admin')

@section('title', 'GradSmart — الأقسام والكليات')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
<style>
@keyframes pulseBadge{0%,100%{opacity:1}50%{opacity:.6}}
</style>
@endsection

@section('topbar_actions')
<button class="btn btn-outline">📥 تصدير</button><button class="btn btn-amber">⚡ تحديث</button>
@endsection

@section('content')
<div class="page-tabs">
    <button class="ptab active" onclick="switchPage('ai-dash',this)">🤖 لوحة AI</button>
    <button class="ptab" onclick="switchPage('reports',this)">📊 تقارير الأداء</button>
    <button class="ptab" onclick="switchPage('archive',this)">🗄️ الأرشيف</button>
    <button class="ptab" onclick="switchPage('create-proj',this)">🆕 إنشاء مشروع</button>
    <button class="ptab" onclick="switchPage('activity',this)">📜 سجل الأنشطة</button>
    <button class="ptab" onclick="switchPage('help',this)">❓ المساعدة</button>
  </div>
 
  <!-- ══ AI DASHBOARD ══ -->
  <div class="page-content active" id="ai-dash">
    <div class="ai-hero">
      <div class="ai-hero-content">
        <div class="ai-brain-icon">🧠</div>
        <div class="ai-hero-text">
          <h2>GradSmart AI Engine</h2>
          <p>تحليل ذكي لجميع مشاريع القسم — يعمل تلقائياً كل 6 ساعات</p>
          <div class="ai-update-badge">🟢 آخر تحليل: اليوم 3:00 م · 32 مشروع محلّل</div>
        </div>
      </div>
      <div class="ai-hero-stats" style="margin-top:18px">
        <div class="ai-hs"><div class="ai-hs-num" style="color:#86efac">20</div><div class="ai-hs-label">منخفضة الخطر</div></div>
        <div class="ai-hs"><div class="ai-hs-num" style="color:#fcd34d">9</div><div class="ai-hs-label">متوسطة الخطر</div></div>
        <div class="ai-hs"><div class="ai-hs-num" style="color:#fca5a5">3</div><div class="ai-hs-label">عالية الخطر</div></div>
        <div class="ai-hs"><div class="ai-hs-num">58%</div><div class="ai-hs-label">متوسط الإنجاز</div></div>
        <div class="ai-hs"><div class="ai-hs-num" style="color:#67e8f9">78%</div><div class="ai-hs-label">احتمال النجاح</div></div>
      </div>
    </div>
 
    <!-- Risk Cards -->
    <div class="risk-grid">
      <div class="risk-card low" style="animation-delay:.05s">
        <div class="rc-icon">🟢</div>
        <div class="rc-num">20</div>
        <div class="rc-label">مشاريع منخفضة الخطر</div>
        <div class="rc-sub">على المسار — لا تحتاج تدخلاً</div>
      </div>
      <div class="risk-card med" style="animation-delay:.10s">
        <div class="rc-icon">🟡</div>
        <div class="rc-num">9</div>
        <div class="rc-label">مشاريع متوسطة الخطر</div>
        <div class="rc-sub">تحتاج متابعة دورية من المشرف</div>
      </div>
      <div class="risk-card high" style="animation-delay:.15s">
        <div class="rc-icon">🔴</div>
        <div class="rc-num">3</div>
        <div class="rc-label">مشاريع عالية الخطر</div>
        <div class="rc-sub">تحتاج تدخلاً فورياً من الإدارة!</div>
      </div>
    </div>
 
    <div class="ai-projects-grid">
      <!-- Danger Projects -->
      <div class="card" style="animation-delay:.2s">
        <div class="card-header">
          <div class="card-title">🚨 مشاريع عالية الخطر — تدخل عاجل</div>
          <a class="card-action">عرض الكل ←</a>
        </div>
        <div class="ai-proj-list">
          <div class="ai-proj-item ai-danger">
            <div class="api-rank" style="background:var(--red)">#1</div>
            <div style="flex:1">
              <div class="api-name">SmartLibrary — فريق Beta</div>
              <div class="api-team">مشرف: د. أحمد · تأخر 5 أيام</div>
            </div>
            <div class="api-score"><div class="api-score-num" style="color:var(--red)">22%</div><div class="api-score-label">إنجاز</div></div>
            <span style="font-size:.6rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#fef2f2;color:var(--red);border:1px solid #fecaca">خطر عالٍ</span>
          </div>
          <div class="ai-proj-item ai-danger">
            <div class="api-rank" style="background:var(--red)">#2</div>
            <div style="flex:1">
              <div class="api-name">E-Learning Platform — فريق Eta</div>
              <div class="api-team">مشرف: د. منى · تأخر 3 أيام</div>
            </div>
            <div class="api-score"><div class="api-score-num" style="color:var(--red)">18%</div><div class="api-score-label">إنجاز</div></div>
            <span style="font-size:.6rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#fef2f2;color:var(--red);border:1px solid #fecaca">خطر عالٍ</span>
          </div>
          <div class="ai-proj-item" style="border-color:#fde68a;background:#fffdf5">
            <div class="api-rank" style="background:var(--amber)">#3</div>
            <div style="flex:1">
              <div class="api-name">E-Commerce Platform — Gamma</div>
              <div class="api-team">مشرف: د. سلمى · إنجاز أقل من المتوقع</div>
            </div>
            <div class="api-score"><div class="api-score-num" style="color:var(--amber)">45%</div><div class="api-score-label">إنجاز</div></div>
            <span style="font-size:.6rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#fffbeb;color:var(--amber);border:1px solid #fde68a">متوسط</span>
          </div>
        </div>
      </div>
 
      <!-- AI Suggestions -->
      <div class="card" style="animation-delay:.25s">
        <div class="card-header">
          <div class="card-title">💡 توصيات AI للإدارة</div>
          <a class="card-action">تفاصيل ←</a>
        </div>
        <div class="suggestions-list">
          <div class="suggestion-item">
            <div class="si-top">
              <div class="si-icon" style="background:#fef2f2">🚨</div>
              <div class="si-title">نقل فريق من د. منى</div>
              <div class="si-conf" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">عاجل</div>
            </div>
            <div class="si-desc">د. منى الشريف عبء عملها 95% — يُنصح بنقل فريق Eta لمشرف آخر متاح</div>
            <button class="si-action">تنفيذ التوصية ←</button>
          </div>
          <div class="suggestion-item">
            <div class="si-top">
              <div class="si-icon" style="background:#fffbeb">👨‍🏫</div>
              <div class="si-title">اقتراح مشرف لفريق جديد</div>
              <div class="si-conf">93% دقة</div>
            </div>
            <div class="si-desc">الفريق الجديد Theta يناسب تخصصه د. ناصر الحربي (أمن سيبراني، متاح 70%)</div>
            <button class="si-action">عرض الاقتراح ←</button>
          </div>
          <div class="suggestion-item">
            <div class="si-top">
              <div class="si-icon" style="background:#f0fdf4">📈</div>
              <div class="si-title">تسريع مشاريع المرحلة الثانية</div>
              <div class="si-conf">متوسط الخطر</div>
            </div>
            <div class="si-desc">9 مشاريع في خطر متوسط — يُقترح عقد اجتماع جماعي مع المشرفين هذا الأسبوع</div>
            <button class="si-action">جدولة اجتماع ←</button>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ PERFORMANCE REPORTS ══ -->
  <div class="page-content" id="reports">
    <div style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap">
      <button class="btn btn-outline">📅 هذا الفصل</button>
      <button class="btn btn-outline">📅 هذا الشهر</button>
      <button class="btn btn-outline">📅 هذا الأسبوع</button>
      <div style="flex:1"></div>
      <button class="btn btn-amber">📥 تصدير PDF</button>
      <button class="btn btn-primary">📊 تقرير مخصص</button>
    </div>
 
    <div class="reports-grid">
      <!-- Bar Chart: Team Progress -->
      <div class="report-card" style="animation-delay:.05s">
        <div class="card-header"><div class="card-title">📊 إنجاز الفرق مقارنةً</div></div>
        <div class="bar-chart">
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:62%;background:linear-gradient(180deg,var(--blue),#3b82f6);position:relative">
              <span class="bc-bar-val" style="color:var(--blue)">62%</span>
            </div>
            <div class="bc-label">Alpha</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:22%;background:linear-gradient(180deg,var(--red),#dc2626);position:relative">
              <span class="bc-bar-val" style="color:var(--red)">22%</span>
            </div>
            <div class="bc-label">Beta</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:45%;background:linear-gradient(180deg,var(--orange),#ea580c);position:relative">
              <span class="bc-bar-val" style="color:var(--orange)">45%</span>
            </div>
            <div class="bc-label">Gamma</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:78%;background:linear-gradient(180deg,var(--green),#16a34a);position:relative">
              <span class="bc-bar-val" style="color:var(--green)">78%</span>
            </div>
            <div class="bc-label">Delta</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:55%;background:linear-gradient(180deg,var(--purple),#7c3aed);position:relative">
              <span class="bc-bar-val" style="color:var(--purple)">55%</span>
            </div>
            <div class="bc-label">Zeta</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:18%;background:linear-gradient(180deg,#ef4444,#dc2626);position:relative">
              <span class="bc-bar-val" style="color:var(--red)">18%</span>
            </div>
            <div class="bc-label">Eta</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:70%;background:linear-gradient(180deg,var(--teal),#0891b2);position:relative">
              <span class="bc-bar-val" style="color:var(--teal)">70%</span>
            </div>
            <div class="bc-label">Theta</div>
          </div>
          <div class="bc-bar-wrap">
            <div class="bc-bar" style="height:85%;background:linear-gradient(180deg,var(--green),#16a34a);position:relative">
              <span class="bc-bar-val" style="color:var(--green)">85%</span>
            </div>
            <div class="bc-label">Sigma</div>
          </div>
        </div>
        <div style="display:flex;justify-content:center;margin-top:10px;gap:16px;font-size:.68rem;color:var(--muted)">
          <span>المتوسط العام: <strong style="color:var(--blue)">58%</strong></span>
          <span>الأعلى: <strong style="color:var(--green)">Sigma 85%</strong></span>
          <span>الأدنى: <strong style="color:var(--red)">Eta 18%</strong></span>
        </div>
      </div>
 
      <!-- Supervisor Performance -->
      <div class="report-card" style="animation-delay:.10s">
        <div class="card-header"><div class="card-title">👨‍🏫 أداء المشرفين</div></div>
        <div style="display:flex;flex-direction:column;gap:10px">
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px"><span style="font-weight:700">د. أحمد السالم</span><span style="font-weight:700;color:var(--green)">82%</span></div>
            <div style="height:8px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:82%;height:100%;background:linear-gradient(90deg,var(--green),var(--teal));border-radius:10px"></div></div>
            <div style="font-size:.62rem;color:var(--muted);margin-top:3px">8 فرق · هندسة البرمجيات</div>
          </div>
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px"><span style="font-weight:700">د. كريم العمري</span><span style="font-weight:700;color:var(--blue)">75%</span></div>
            <div style="height:8px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:75%;height:100%;background:linear-gradient(90deg,var(--blue),var(--purple));border-radius:10px"></div></div>
            <div style="font-size:.62rem;color:var(--muted);margin-top:3px">6 فرق · قواعد البيانات</div>
          </div>
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px"><span style="font-weight:700">د. سلمى نور</span><span style="font-weight:700;color:var(--purple)">61%</span></div>
            <div style="height:8px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:61%;height:100%;background:linear-gradient(90deg,var(--purple),var(--pink));border-radius:10px"></div></div>
            <div style="font-size:.62rem;color:var(--muted);margin-top:3px">5 فرق · الذكاء الاصطناعي</div>
          </div>
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px"><span style="font-weight:700">د. منى الشريف</span><span style="font-weight:700;color:var(--red)">45%</span></div>
            <div style="height:8px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:45%;height:100%;background:linear-gradient(90deg,var(--red),var(--orange));border-radius:10px"></div></div>
            <div style="font-size:.62rem;color:var(--muted);margin-top:3px">4 فرق · الشبكات ⚠ مثقلة</div>
          </div>
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px"><span style="font-weight:700">د. ناصر الحربي</span><span style="font-weight:700;color:var(--orange)">38%</span></div>
            <div style="height:8px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:38%;height:100%;background:linear-gradient(90deg,var(--orange),var(--yellow));border-radius:10px"></div></div>
            <div style="font-size:.62rem;color:var(--muted);margin-top:3px">3 فرق · الأمن السيبراني</div>
          </div>
        </div>
      </div>
 
      <!-- Summary Table -->
      <div class="report-card full-width" style="animation-delay:.15s;padding:0;overflow:hidden">
        <div style="padding:18px 22px 12px"><div class="card-title">📋 تقرير الأداء الكلي التفصيلي</div></div>
        <table class="comp-table">
          <thead><tr>
            <th>الفريق</th><th>المشروع</th><th>المشرف</th>
            <th>الإنجاز</th><th>المهام</th><th>التأخيرات</th>
            <th>آخر نشاط</th><th>مستوى الخطر</th>
          </tr></thead>
          <tbody>
            <tr>
              <td style="font-weight:700">Alpha</td>
              <td>GradSmart System</td>
              <td>د. أحمد</td>
              <td><div class="perf-bar-cell"><div class="pbc-track"><div class="pbc-fill" style="width:62%;background:var(--blue)"></div></div><span style="font-size:.72rem;font-weight:700;color:var(--blue)">62%</span></div></td>
              <td style="font-size:.75rem">7/12</td>
              <td style="font-size:.75rem;color:var(--orange)">3 مهام</td>
              <td style="font-size:.68rem;color:var(--muted)">اليوم</td>
              <td><span style="font-size:.62rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</span></td>
            </tr>
            <tr>
              <td style="font-weight:700;color:var(--red)">Beta</td>
              <td>SmartLibrary</td>
              <td>د. أحمد</td>
              <td><div class="perf-bar-cell"><div class="pbc-track"><div class="pbc-fill" style="width:22%;background:var(--red)"></div></div><span style="font-size:.72rem;font-weight:700;color:var(--red)">22%</span></div></td>
              <td style="font-size:.75rem">2/9</td>
              <td style="font-size:.75rem;color:var(--red)">5 أيام</td>
              <td style="font-size:.68rem;color:var(--muted)">أمس</td>
              <td><span style="font-size:.62rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#fef2f2;color:var(--red);border:1px solid #fecaca;animation:pulseBadge 2s infinite">🔴 عالي</span></td>
            </tr>
            <tr>
              <td style="font-weight:700">Gamma</td>
              <td>E-Commerce</td>
              <td>د. سلمى</td>
              <td><div class="perf-bar-cell"><div class="pbc-track"><div class="pbc-fill" style="width:45%;background:var(--orange)"></div></div><span style="font-size:.72rem;font-weight:700;color:var(--orange)">45%</span></div></td>
              <td style="font-size:.75rem">4/9</td>
              <td style="font-size:.75rem;color:var(--orange)">2 أيام</td>
              <td style="font-size:.68rem;color:var(--muted)">منذ يومين</td>
              <td><span style="font-size:.62rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#fffbeb;color:var(--amber);border:1px solid #fde68a">🟡 متوسط</span></td>
            </tr>
            <tr>
              <td style="font-weight:700">Delta</td>
              <td>Hospital Mgmt</td>
              <td>د. كريم</td>
              <td><div class="perf-bar-cell"><div class="pbc-track"><div class="pbc-fill" style="width:78%;background:var(--green)"></div></div><span style="font-size:.72rem;font-weight:700;color:var(--green)">78%</span></div></td>
              <td style="font-size:.75rem">7/9</td>
              <td style="font-size:.75rem;color:var(--green)">لا تأخير</td>
              <td style="font-size:.68rem;color:var(--muted)">اليوم</td>
              <td><span style="font-size:.62rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">🟢 منخفض</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
 
  <!-- ══ ARCHIVE ══ -->
  <div class="page-content" id="archive">
    <div class="archive-header">
      <div class="archive-icon">🗄️</div>
      <div>
        <div style="font-size:1rem;font-weight:900;margin-bottom:3px">أرشيف المشاريع المكتملة</div>
        <div style="font-size:.78rem;color:var(--muted)">مشاريع الفصول الدراسية السابقة — محفوظة للرجوع إليها</div>
      </div>
      <div class="archive-stats-mini">
        <div class="asm-item"><div class="asm-num">47</div><div class="asm-label">مشروع مؤرشف</div></div>
        <div class="asm-item"><div class="asm-num">3</div><div class="asm-label">فصول</div></div>
        <div class="asm-item"><div class="asm-num">186</div><div class="asm-label">طالب</div></div>
      </div>
      <button class="btn btn-outline">🔍 بحث متقدم</button>
    </div>
 
    <div style="display:flex;gap:8px;margin-bottom:18px">
      <button class="btn btn-outline" style="background:var(--blue);color:white;border-color:var(--blue)">📅 2025-2026</button>
      <button class="btn btn-outline">📅 2024-2025</button>
      <button class="btn btn-outline">📅 2023-2024</button>
    </div>
 
    <div class="archive-grid">
      <div class="arch-card" style="animation-delay:.05s">
        <div class="arch-card-top">
          <div class="arch-icon">🌐</div>
          <div><div class="arch-name">Student Portal v2.0</div><div class="arch-team">فريق Alpha · الفصل الخريفي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--green);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 مارس 2026</span>
          <span class="arch-grade" style="color:var(--green)">ممتاز — 95/100</span>
        </div>
      </div>
      <div class="arch-card" style="animation-delay:.10s">
        <div class="arch-card-top">
          <div class="arch-icon">🏥</div>
          <div><div class="arch-name">ClinicTrack System</div><div class="arch-team">فريق Beta · الفصل الخريفي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--blue);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 فبراير 2026</span>
          <span class="arch-grade" style="color:var(--blue)">جيد جداً — 87/100</span>
        </div>
      </div>
      <div class="arch-card" style="animation-delay:.15s">
        <div class="arch-card-top">
          <div class="arch-icon">📱</div>
          <div><div class="arch-name">Campus Events App</div><div class="arch-team">فريق Gamma · الفصل الخريفي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--purple);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 فبراير 2026</span>
          <span class="arch-grade" style="color:var(--purple)">جيد — 78/100</span>
        </div>
      </div>
      <div class="arch-card" style="animation-delay:.20s">
        <div class="arch-card-top">
          <div class="arch-icon">🤖</div>
          <div><div class="arch-name">AI Exam Helper</div><div class="arch-team">فريق Delta · الفصل الصيفي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--orange);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 سبتمبر 2025</span>
          <span class="arch-grade" style="color:var(--orange)">جيد — 82/100</span>
        </div>
      </div>
      <div class="arch-card" style="animation-delay:.25s">
        <div class="arch-card-top">
          <div class="arch-icon">📊</div>
          <div><div class="arch-name">Budget Manager Pro</div><div class="arch-team">فريق Zeta · الفصل الصيفي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--green);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 أغسطس 2025</span>
          <span class="arch-grade" style="color:var(--green)">ممتاز — 93/100</span>
        </div>
      </div>
      <div class="arch-card" style="animation-delay:.30s">
        <div class="arch-card-top">
          <div class="arch-icon">🔒</div>
          <div><div class="arch-name">SecureAuth Library</div><div class="arch-team">فريق Eta · الفصل الربيعي 2025</div></div>
        </div>
        <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:8px"><div style="width:100%;height:100%;background:var(--teal);border-radius:10px"></div></div>
        <div class="arch-meta">
          <span>📅 يونيو 2025</span>
          <span class="arch-grade" style="color:var(--teal)">جيد جداً — 88/100</span>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ CREATE PROJECT ══ -->
  <div class="page-content" id="create-proj">
    <!-- Stepper -->
    <div class="stepper">
      <div class="step done"><div class="step-circle">✓</div><div class="step-label">بيانات الفريق</div></div>
      <div class="step-line done"></div>
      <div class="step active"><div class="step-circle">2</div><div class="step-label">تفاصيل المشروع</div></div>
      <div class="step-line pending"></div>
      <div class="step pending"><div class="step-circle">3</div><div class="step-label">اختيار المشرف</div></div>
      <div class="step-line pending"></div>
      <div class="step pending"><div class="step-circle">4</div><div class="step-label">المراجعة</div></div>
    </div>
 
    <div class="create-proj-layout">
      <!-- Form -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header"><div class="card-title">📋 تفاصيل المشروع</div><div style="font-size:.72rem;color:var(--muted)">الخطوة 2 من 4</div></div>
 
        <div class="form-group">
          <label class="form-label">عنوان المشروع <span class="req">*</span></label>
          <input class="form-input" placeholder="مثال: GradSmart — نظام إدارة مشاريع التخرج الذكي" id="proj-title-input" oninput="updateCount(this,'title-count',100)">
          <div class="char-count"><span id="title-count">0</span>/100 حرف</div>
        </div>
 
        <div class="form-group">
          <label class="form-label">وصف المشروع <span class="req">*</span></label>
          <textarea class="form-textarea" placeholder="اشرح فكرة المشروع وأهدافه وما يحله من مشكلة..." oninput="updateCount(this,'desc-count',500)"></textarea>
          <div class="char-count"><span id="desc-count">0</span>/500 حرف</div>
        </div>
 
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">نوع المشروع <span class="req">*</span></label>
            <select class="form-select">
              <option>اختر النوع...</option>
              <option>🌐 Web Application</option>
              <option>📱 Mobile App</option>
              <option>🤖 AI/ML System</option>
              <option>🗄️ Database System</option>
              <option>🔒 Security System</option>
              <option>📊 Data Analytics</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">لغة البرمجة الرئيسية</label>
            <select class="form-select">
              <option>اختر اللغة...</option>
              <option>PHP</option>
              <option>Python</option>
              <option>JavaScript</option>
              <option>Java</option>
              <option>C#</option>
            </select>
          </div>
        </div>
 
        <div class="form-group">
          <label class="form-label">التقنيات المستخدمة</label>
          <div class="tech-tags-wrap">
            <div class="tech-tag" onclick="this.classList.toggle('selected')">🌐 HTML/CSS</div>
            <div class="tech-tag selected" onclick="this.classList.toggle('selected')">⚡ JavaScript</div>
            <div class="tech-tag selected" onclick="this.classList.toggle('selected')">🐘 PHP</div>
            <div class="tech-tag selected" onclick="this.classList.toggle('selected')">🗄️ MySQL</div>
            <div class="tech-tag" onclick="this.classList.toggle('selected')">🐍 Python</div>
            <div class="tech-tag" onclick="this.classList.toggle('selected')">⚛️ React</div>
            <div class="tech-tag" onclick="this.classList.toggle('selected')">🤖 AI/ML</div>
            <div class="tech-tag" onclick="this.classList.toggle('selected')">🐙 GitHub</div>
            <div class="tech-tag" onclick="this.classList.toggle('selected')">🐋 Docker</div>
          </div>
        </div>
 
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">تاريخ البداية</label>
            <input class="form-input" type="date" value="2026-04-01">
          </div>
          <div class="form-group">
            <label class="form-label">تاريخ التسليم المتوقع</label>
            <input class="form-input" type="date" value="2026-06-23">
          </div>
        </div>
 
        <div style="display:flex;gap:10px;margin-top:8px">
          <button class="btn btn-outline" style="flex:1">← السابق</button>
          <button class="btn btn-primary" style="flex:2;justify-content:center">التالي: اختيار المشرف ←</button>
        </div>
      </div>
 
      <!-- Supervisor suggestions -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">🤖 اقتراحات AI للمشرف</div></div>
          <div style="font-size:.75rem;color:var(--muted);margin-bottom:12px">بناءً على تخصص مشروعك — اضغط لاختيار</div>
          <div class="sup-suggestion selected" onclick="selectSup(this)">
            <div class="ss-av" style="background:linear-gradient(135deg,var(--blue),var(--purple))">أح</div>
            <div><div class="ss-name">د. أحمد السالم</div><div class="ss-spec">هندسة البرمجيات · 8 فرق</div></div>
            <div class="ss-match">95% تطابق</div>
            <div class="ss-radio"></div>
          </div>
          <div class="sup-suggestion" onclick="selectSup(this)">
            <div class="ss-av" style="background:linear-gradient(135deg,var(--green),var(--teal))">كر</div>
            <div><div class="ss-name">د. كريم العمري</div><div class="ss-spec">قواعد البيانات · 6 فرق</div></div>
            <div class="ss-match">80% تطابق</div>
            <div class="ss-radio"></div>
          </div>
          <div class="sup-suggestion" onclick="selectSup(this)">
            <div class="ss-av" style="background:linear-gradient(135deg,var(--pink),var(--purple))">سل</div>
            <div><div class="ss-name">د. سلمى نور</div><div class="ss-spec">الذكاء الاصطناعي · 5 فرق</div></div>
            <div class="ss-match">70% تطابق</div>
            <div class="ss-radio"></div>
          </div>
        </div>
 
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">👥 أعضاء فريقك</div></div>
          <div style="display:flex;flex-direction:column;gap:8px">
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-radius:10px;border:1px solid #ddd6fe">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:white">م أ</div>
              <div style="flex:1"><div style="font-size:.78rem;font-weight:700">محمد أحمد</div><div style="font-size:.62rem;color:var(--muted)">قائد الفريق</div></div>
              <span style="font-size:.6rem;font-weight:700;background:#eff6ff;color:var(--blue);padding:2px 7px;border-radius:10px">أنت</span>
            </div>
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--pink),var(--orange));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:white">سا</div>
              <div style="flex:1"><div style="font-size:.78rem;font-weight:700">سارة علي</div><div style="font-size:.62rem;color:var(--muted)">UI/UX Designer</div></div>
            </div>
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--green),var(--teal));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:white">عم</div>
              <div style="flex:1"><div style="font-size:.78rem;font-weight:700">عمر خالد</div><div style="font-size:.62rem;color:var(--muted)">Backend Developer</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ ACTIVITY LOG ══ -->
  <div class="page-content" id="activity">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
      <div class="page-title"><h1>📜 سجل الأنشطة</h1><p>توثيق كامل لجميع الإجراءات على مشروع GradSmart</p></div>
      <button class="btn btn-outline">📥 تصدير السجل</button>
    </div>
 
    <div class="activity-header">
      <button class="act-filter-btn active">🔍 الكل</button>
      <button class="act-filter-btn">✅ المهام</button>
      <button class="act-filter-btn">📁 الملفات</button>
      <button class="act-filter-btn">💬 التعليقات</button>
      <button class="act-filter-btn">👤 المستخدمون</button>
      <button class="act-filter-btn">🤖 AI</button>
      <div style="flex:1"></div>
      <input style="padding:8px 14px;border:1.5px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.78rem;outline:none;width:200px" placeholder="🔍 ابحث في السجل...">
    </div>
 
    <div class="activity-timeline">
 
      <div class="act-day-group">
        <div class="act-day-label">اليوم — 9 مايو 2026</div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#fef2f2">🚨</div>
            <div class="act-line"></div>
          </div>
          <div class="act-body">
            <div class="act-title">تنبيه: مهمة API المصادقة تأخرت</div>
            <div class="act-desc">المهمة المسندة لعمر خالد تجاوزت الموعد النهائي (8 مايو) بيوم كامل. تم إرسال تنبيه تلقائي للطالب والمشرف.</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--orange)">🤖</div>نظام AI</div>
              <div class="act-time">3:00 م</div>
              <span class="act-tag" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">⚠ تحذير</span>
            </div>
          </div>
        </div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#eff6ff">📁</div>
            <div class="act-line"></div>
          </div>
          <div class="act-body">
            <div class="act-title">رفع ملف: تقرير_المرحلة_الثانية.pdf</div>
            <div class="act-desc">تم رفع ملف PDF بحجم 2.4 MB في مجلد التقارير المرحلية للمشروع.</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--blue)">م أ</div>محمد أحمد</div>
              <div class="act-time">11:30 ص</div>
              <span class="act-tag" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">📁 ملف</span>
            </div>
          </div>
        </div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#f0fdf4">💬</div>
            <div class="act-line"></div>
          </div>
          <div class="act-body">
            <div class="act-title">ملاحظة جديدة من المشرف</div>
            <div class="act-desc">د. أحمد السالم أضاف ملاحظة على مهمة "تطوير واجهة تسجيل الدخول": "الواجهة جيدة — أضيفي validation للحقول"</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--green)">أح</div>د. أحمد</div>
              <div class="act-time">9:15 ص</div>
              <span class="act-tag" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">💬 تعليق</span>
            </div>
          </div>
        </div>
      </div>
 
      <div class="act-day-group">
        <div class="act-day-label">أمس — 8 مايو 2026</div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#f0fdf4">✅</div>
            <div class="act-line"></div>
          </div>
          <div class="act-body">
            <div class="act-title">إنجاز مهمة: تصميم واجهة Login</div>
            <div class="act-desc">تم تحديث حالة المهمة من "قيد التنفيذ" إلى "منجزة" ورفع ملف الكود على GitHub.</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--pink)">سا</div>سارة علي</div>
              <div class="act-time">4:30 م</div>
              <span class="act-tag" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">✅ إنجاز</span>
            </div>
          </div>
        </div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#faf5ff">➕</div>
            <div class="act-line"></div>
          </div>
          <div class="act-body">
            <div class="act-title">إضافة مهمة جديدة: ربط Frontend بـ Backend</div>
            <div class="act-desc">تم إضافة مهمة "ربط الـ Frontend بالـ Backend" وإسنادها لليلى يوسف بموعد نهائي 20 مايو.</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--purple)">م أ</div>محمد أحمد</div>
              <div class="act-time">2:00 م</div>
              <span class="act-tag" style="background:#faf5ff;color:var(--purple);border:1px solid #ddd6fe">➕ مهمة</span>
            </div>
          </div>
        </div>
 
        <div class="act-item">
          <div class="act-icon-wrap">
            <div class="act-dot" style="background:#fff7ed">🤖</div>
          </div>
          <div class="act-body">
            <div class="act-title">تقرير AI: مستوى الخطر منخفض</div>
            <div class="act-desc">تحليل تلقائي: إنجاز 62% مقابل المتوقع 65%. احتمال الإنجاز في الوقت 78%. لا يوجد خطر فوري.</div>
            <div class="act-footer">
              <div class="act-user"><div class="act-user-av" style="background:var(--orange)">🤖</div>نظام AI</div>
              <div class="act-time">9:00 ص</div>
              <span class="act-tag" style="background:#fff7ed;color:var(--orange);border:1px solid #fed7aa">🤖 AI</span>
            </div>
          </div>
        </div>
      </div>
 
    </div>
  </div>
 
  <!-- ══ HELP / FAQ ══ -->
  <div class="page-content" id="help">
    <div class="help-hero">
      <div style="position:relative;z-index:1">
        <div class="hh-icon">❓</div>
        <div class="hh-title">مركز المساعدة</div>
        <div class="hh-sub">ابحث عن إجابتك أو تصفح الأسئلة الشائعة</div>
        <div class="hh-search">
          <input placeholder="ابحث عن سؤالك هنا..." style="background:transparent">
          <button class="hh-search-btn">بحث</button>
        </div>
      </div>
    </div>
 
    <!-- Quick Links -->
    <div class="quick-links">
      <div class="ql-card" style="animation-delay:.05s">
        <div class="ql-icon">🚀</div>
        <div class="ql-title">البدء السريع</div>
        <div class="ql-desc">كيف تبدأ استخدام GradSmart</div>
      </div>
      <div class="ql-card" style="animation-delay:.10s">
        <div class="ql-icon">👥</div>
        <div class="ql-title">إدارة الفريق</div>
        <div class="ql-desc">إنشاء فريق ودعوة الأعضاء</div>
      </div>
      <div class="ql-card" style="animation-delay:.15s">
        <div class="ql-icon">✅</div>
        <div class="ql-title">إدارة المهام</div>
        <div class="ql-desc">إنشاء وتتبع المهام بكفاءة</div>
      </div>
      <div class="ql-card" style="animation-delay:.20s">
        <div class="ql-icon">🤖</div>
        <div class="ql-title">الذكاء الاصطناعي</div>
        <div class="ql-desc">فهم تقارير AI وتوصياته</div>
      </div>
      <div class="ql-card" style="animation-delay:.25s">
        <div class="ql-icon">💬</div>
        <div class="ql-title">التواصل</div>
        <div class="ql-desc">كيف تتواصل مع مشرفك</div>
      </div>
      <div class="ql-card" style="animation-delay:.30s">
        <div class="ql-icon">📁</div>
        <div class="ql-title">رفع الملفات</div>
        <div class="ql-desc">رفع وإدارة ملفات المشروع</div>
      </div>
    </div>
 
    <div class="help-grid">
      <!-- Nav -->
      <div>
        <div class="help-nav">
          <div class="hn-item active" onclick="setHelpCat(this)"><span class="hn-icon">🏠</span>عام<span class="hn-count">8 أسئلة</span></div>
          <div class="hn-item" onclick="setHelpCat(this)"><span class="hn-icon">👨‍🎓</span>للطلاب<span class="hn-count">12 أسئلة</span></div>
          <div class="hn-item" onclick="setHelpCat(this)"><span class="hn-icon">👨‍🏫</span>للمشرفين<span class="hn-count">7 أسئلة</span></div>
          <div class="hn-item" onclick="setHelpCat(this)"><span class="hn-icon">🏛️</span>للإدارة<span class="hn-count">5 أسئلة</span></div>
          <div class="hn-item" onclick="setHelpCat(this)"><span class="hn-icon">🤖</span>الذكاء الاصطناعي<span class="hn-count">6 أسئلة</span></div>
          <div class="hn-item" onclick="setHelpCat(this)"><span class="hn-icon">🔒</span>الأمان<span class="hn-count">4 أسئلة</span></div>
          <div style="margin-top:16px;padding:16px;background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-radius:12px;border:1px solid #ddd6fe;text-align:center">
            <div style="font-size:1.2rem;margin-bottom:8px">💬</div>
            <div style="font-size:.82rem;font-weight:700;margin-bottom:4px">تحتاج مساعدة؟</div>
            <div style="font-size:.7rem;color:var(--muted);margin-bottom:10px">تواصل مع الدعم التقني</div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;padding:8px">📧 راسلنا</button>
          </div>
        </div>
      </div>
 
      <!-- FAQ -->
      <div>
        <div class="faq-list">
 
          <div class="faq-item open">
            <div class="faq-q" onclick="toggleFaq(this.parentElement)">
              <div class="faq-q-icon" style="background:#eff6ff">🚀</div>
              <div class="faq-q-text">كيف أبدأ استخدام GradSmart لأول مرة؟</div>
              <div class="faq-arrow">▼</div>
            </div>
            <div class="faq-a">
              ابدأ بإنشاء حساب من صفحة Register، اختر نوع حسابك (طالب)، ثم اكمل بياناتك. بعد تسجيل الدخول انتقل إلى "فريقي" لإنشاء فريق وإضافة أعضاء، ثم اذهب لـ "مشروعي" لإنشاء مشروع التخرج وإسناد مشرف مناسب.
              <div class="faq-helpful">هل كانت هذه الإجابة مفيدة؟ <button class="helpful-btn">👍 نعم</button><button class="helpful-btn">👎 لا</button></div>
            </div>
          </div>
 
          <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this.parentElement)">
              <div class="faq-q-icon" style="background:#f0fdf4">✅</div>
              <div class="faq-q-text">كيف أغيّر حالة مهمة من "قيد التنفيذ" إلى "منجزة"؟</div>
              <div class="faq-arrow">▼</div>
            </div>
            <div class="faq-a">
              اذهب إلى صفحة "المهام"، ابحث عن المهمة المطلوبة، اضغط عليها لفتح التفاصيل، ثم غيّر الحالة من القائمة المنسدلة أو اضغط على المربع في بداية المهمة. التغيير يُحفظ تلقائياً ويصل إشعار للمشرف.
              <div class="faq-helpful">هل كانت هذه الإجابة مفيدة؟ <button class="helpful-btn">👍 نعم</button><button class="helpful-btn">👎 لا</button></div>
            </div>
          </div>
 
          <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this.parentElement)">
              <div class="faq-q-icon" style="background:#fff7ed">🤖</div>
              <div class="faq-q-text">ماذا يعني مستوى خطر المشروع في تقرير AI؟</div>
              <div class="faq-arrow">▼</div>
            </div>
            <div class="faq-a">
              يحلل الذكاء الاصطناعي عدة عوامل: نسبة الإنجاز مقارنة بالوقت المتبقي، عدد المهام المتأخرة، معدل نشاط الفريق. ثم يصنف المشروع: 🟢 منخفض (أمان تام)، 🟡 متوسط (تحتاج انتباهاً)، 🔴 عالي (تدخل عاجل مطلوب).
              <div class="faq-helpful">هل كانت هذه الإجابة مفيدة؟ <button class="helpful-btn">👍 نعم</button><button class="helpful-btn">👎 لا</button></div>
            </div>
          </div>
 
          <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this.parentElement)">
              <div class="faq-q-icon" style="background:#faf5ff">💬</div>
              <div class="faq-q-text">كيف أتواصل مع مشرفي داخل النظام؟</div>
              <div class="faq-arrow">▼</div>
            </div>
            <div class="faq-a">
              اذهب لقسم "المحادثة" من القائمة الجانبية. ستجد محادثة مباشرة مع مشرفك. يمكنك إرسال رسائل نصية، إرفاق ملفات، والرد على ملاحظاته. المشرف سيتلقى إشعاراً فورياً.
              <div class="faq-helpful">هل كانت هذه الإجابة مفيدة؟ <button class="helpful-btn">👍 نعم</button><button class="helpful-btn">👎 لا</button></div>
            </div>
          </div>
 
          <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this.parentElement)">
              <div class="faq-q-icon" style="background:#f0fdf4">📁</div>
              <div class="faq-q-text">ما أنواع الملفات المسموح برفعها؟</div>
              <div class="faq-arrow">▼</div>
            </div>
            <div class="faq-a">
              يدعم النظام: PDF، Word (.docx)، Excel (.xlsx)، PowerPoint (.pptx)، صور (PNG، JPG)، ملفات مضغوطة (ZIP، RAR)، وملفات الفيديو (MP4). الحد الأقصى 50 MB للملف الواحد، و1 GB إجمالاً للمشروع.
              <div class="faq-helpful">هل كانت هذه الإجابة مفيدة؟ <button class="helpful-btn">👍 نعم</button><button class="helpful-btn">👎 لا</button></div>
            </div>
          </div>
 
        </div>
      </div>
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
function toggleFaq(item){
  item.classList.toggle('open');
}
function setHelpCat(el){
  el.closest('.help-nav').querySelectorAll('.hn-item').forEach(i=>i.classList.remove('active'));
  el.classList.add('active');
}
function selectSup(el){
  el.closest('.card').querySelectorAll('.sup-suggestion').forEach(s=>s.classList.remove('selected'));
  el.classList.add('selected');
}
function updateCount(el,countId,max){
  const count=el.value.length;
  document.getElementById(countId).textContent=count;
  el.style.borderColor=count>max?'var(--red)':'';
}
document.querySelectorAll('.act-filter-btn').forEach(btn=>btn.addEventListener('click',function(){
  this.closest('.activity-header').querySelectorAll('.act-filter-btn').forEach(b=>b.classList.remove('active'));
  this.classList.add('active');
}));
</script>
@endsection