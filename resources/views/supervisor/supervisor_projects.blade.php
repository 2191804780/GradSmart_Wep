@extends('layouts.supervisor')

@section('title', 'مشاريعي')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/supervisor_projects.css') }}">
@endsection

@section('no_topbar', true)

@section('content')
  <!-- Page Tabs -->
  <div class="page-tabs">
    <button class="ptab active" onclick="switchPage('proj-details',this)">🔍 تفاصيل المشروع</button>
    <button class="ptab" onclick="switchPage('evaluation',this)">📝 التقييم</button>
    <button class="ptab" onclick="switchPage('ai-report',this)">🤖 تقرير AI</button>
  </div>
 
  <!-- ══ PROJECT DETAILS ══ -->
  <div class="page-content active" id="proj-details">
    <div class="topbar">
      <div class="page-title"><h1>🔍 تفاصيل مشروع الفريق</h1><p>فريق Alpha — GradSmart System</p></div>
      <div class="topbar-actions">
        <button class="btn btn-outline">💬 مراسلة الفريق</button>
        <button class="btn btn-primary">📝 إضافة تقييم</button>
      </div>
    </div>
 
    <!-- Team Bar -->
    <div class="team-bar">
      <div class="tb-icon">🌐</div>
      <div>
        <div class="tb-name">GradSmart — نظام إدارة التخرج</div>
        <div class="tb-meta">👥 فريق Alpha · 4 أعضاء · بدأ 1 أبريل 2026</div>
      </div>
      <div class="tb-right">
        <div class="tb-stat"><div class="tb-stat-num">62%</div><div class="tb-stat-label">إنجاز</div></div>
        <div class="tb-stat"><div class="tb-stat-num">7/12</div><div class="tb-stat-label">مهام</div></div>
        <div class="tb-stat"><div class="tb-stat-num">45</div><div class="tb-stat-label">يوم</div></div>
      </div>
      <div class="tb-risk">🟢 خطر منخفض</div>
    </div>
 
    <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px">
      <!-- Tasks -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header">
          <div class="card-title">✅ مهام الفريق — يراها المشرف كاملة</div>
          <div style="display:flex;gap:6px">
            <select style="padding:5px 10px;border:1px solid var(--border);border-radius:7px;font-family:'Cairo',sans-serif;font-size:.72rem;outline:none;background:var(--bg)">
              <option>كل المهام</option><option>المتأخرة</option><option>المنجزة</option>
            </select>
          </div>
        </div>
        <div class="sup-tasks">
          <div class="sup-task-item has-comment">
            <div class="sti-status" style="background:var(--green)"></div>
            <div class="sti-info">
              <div class="sti-name">تصميم قاعدة البيانات ERD</div>
              <div class="sti-meta">👤 محمد أحمد · تم 1 مايو · <span style="color:var(--green)">لديك تعليق</span></div>
            </div>
            <div class="sti-progress">
              <div class="stp-track"><div class="stp-fill" style="width:100%;background:var(--green)"></div></div>
              <div class="stp-label">100%</div>
            </div>
            <span class="sti-badge" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">✓ منجزة</span>
            <button class="sti-comment-btn">💬 تعليق</button>
          </div>
 
          <div class="sup-task-item needs-review">
            <div class="sti-status" style="background:var(--blue)"></div>
            <div class="sti-info">
              <div class="sti-name">تطوير واجهة تسجيل الدخول</div>
              <div class="sti-meta">👤 سارة علي · الموعد 12 مايو</div>
            </div>
            <div class="sti-progress">
              <div class="stp-track"><div class="stp-fill" style="width:65%;background:var(--blue)"></div></div>
              <div class="stp-label">65%</div>
            </div>
            <span class="sti-badge" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">🔄 جارية</span>
            <button class="sti-comment-btn">💬 تعليق</button>
          </div>
 
          <div class="sup-task-item late">
            <div class="sti-status" style="background:var(--red)"></div>
            <div class="sti-info">
              <div class="sti-name">كتابة API المصادقة</div>
              <div class="sti-meta">👤 عمر خالد · <span style="color:var(--red);font-weight:700">⚠ تأخر يوم</span></div>
            </div>
            <div class="sti-progress">
              <div class="stp-track"><div class="stp-fill" style="width:30%;background:var(--red)"></div></div>
              <div class="stp-label">30%</div>
            </div>
            <span class="sti-badge" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">⚠ متأخرة</span>
            <button class="sti-comment-btn" style="border-color:var(--red);color:var(--red)">⚠ تنبيه</button>
          </div>
 
          <div class="sup-task-item">
            <div class="sti-status" style="background:var(--green)"></div>
            <div class="sti-info">
              <div class="sti-name">إعداد قاعدة البيانات MySQL</div>
              <div class="sti-meta">👤 ليلى يوسف · تم 5 مايو</div>
            </div>
            <div class="sti-progress">
              <div class="stp-track"><div class="stp-fill" style="width:100%;background:var(--green)"></div></div>
              <div class="stp-label">100%</div>
            </div>
            <span class="sti-badge" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">✓ منجزة</span>
            <button class="sti-comment-btn">💬 تعليق</button>
          </div>
 
          <div class="sup-task-item">
            <div class="sti-status" style="background:var(--purple)"></div>
            <div class="sti-info">
              <div class="sti-name">Dashboard المشرف</div>
              <div class="sti-meta">👤 محمد أحمد · الموعد 18 مايو</div>
            </div>
            <div class="sti-progress">
              <div class="stp-track"><div class="stp-fill" style="width:40%;background:var(--purple)"></div></div>
              <div class="stp-label">40%</div>
            </div>
            <span class="sti-badge" style="background:#faf5ff;color:var(--purple);border:1px solid #ddd6fe">🔄 جارية</span>
            <button class="sti-comment-btn">💬 تعليق</button>
          </div>
        </div>
      </div>
 
      <!-- Right: Files + Activity + Members -->
      <div style="display:flex;flex-direction:column;gap:14px">
        <!-- Uploaded Files -->
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">📁 الملفات المرفوعة</div><a class="card-action">الكل ←</a></div>
          <div style="display:flex;flex-direction:column;gap:8px">
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:9px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
              <span style="font-size:1.1rem">📄</span>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700">تقرير_المرحلة_الثانية.pdf</div><div style="font-size:.62rem;color:var(--muted)">محمد · 9 مايو · 2.4 MB</div></div>
              <button style="padding:4px 10px;border:1px solid var(--border);background:var(--white);border-radius:7px;font-size:.68rem;cursor:pointer">⬇ تحميل</button>
            </div>
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:9px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
              <span style="font-size:1.1rem">🎨</span>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700">GradSmart_ERD_Final.png</div><div style="font-size:.62rem;color:var(--muted)">محمد · 1 مايو · 3.1 MB</div></div>
              <button style="padding:4px 10px;border:1px solid var(--border);background:var(--white);border-radius:7px;font-size:.68rem;cursor:pointer">⬇ تحميل</button>
            </div>
            <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:9px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
              <span style="font-size:1.1rem">💻</span>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700">gradsmart_backend_v1.zip</div><div style="font-size:.62rem;color:var(--muted)">عمر · 7 مايو · 45 MB</div></div>
              <button style="padding:4px 10px;border:1px solid var(--border);background:var(--white);border-radius:7px;font-size:.68rem;cursor:pointer">⬇ تحميل</button>
            </div>
          </div>
        </div>
 
        <!-- Members performance -->
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">👥 أداء الأعضاء</div></div>
          <div style="display:flex;flex-direction:column;gap:10px">
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:white;flex-shrink:0">م أ</div>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700;margin-bottom:3px">محمد أحمد</div><div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:75%;height:100%;background:linear-gradient(90deg,var(--blue),var(--purple));border-radius:10px"></div></div></div>
              <div style="font-size:.75rem;font-weight:700;color:var(--blue)">75%</div>
            </div>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--pink),var(--orange));display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:white;flex-shrink:0">سا</div>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700;margin-bottom:3px">سارة علي</div><div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:60%;height:100%;background:linear-gradient(90deg,var(--pink),var(--orange));border-radius:10px"></div></div></div>
              <div style="font-size:.75rem;font-weight:700;color:var(--pink)">60%</div>
            </div>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--green),var(--teal));display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:white;flex-shrink:0">عم</div>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700;margin-bottom:3px">عمر خالد</div><div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:40%;height:100%;background:linear-gradient(90deg,var(--orange),var(--yellow));border-radius:10px"></div></div></div>
              <div style="font-size:.75rem;font-weight:700;color:var(--orange)">40%</div>
            </div>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--yellow),var(--orange));display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:white;flex-shrink:0">لي</div>
              <div style="flex:1"><div style="font-size:.75rem;font-weight:700;margin-bottom:3px">ليلى يوسف</div><div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden"><div style="width:85%;height:100%;background:linear-gradient(90deg,var(--green),var(--teal));border-radius:10px"></div></div></div>
              <div style="font-size:.75rem;font-weight:700;color:var(--green)">85%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ EVALUATION ══ -->
  <div class="page-content" id="evaluation">
    <div class="topbar">
      <div class="page-title"><h1>📝 تقييم الفريق</h1><p>فريق Alpha — تقييم المرحلة الثانية</p></div>
      <div class="topbar-actions">
        <button class="btn btn-outline">📋 التقييمات السابقة</button>
        <button class="btn btn-primary">📤 إرسال التقييم</button>
      </div>
    </div>
 
    <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px">
      <!-- Eval Form -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header">
          <div class="card-title">⭐ نموذج التقييم التفصيلي</div>
          <div style="font-size:.75rem;color:var(--muted)">المرحلة الثانية — مايو 2026</div>
        </div>
        <div style="margin-bottom:14px">
          <label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:7px">اختر الفريق</label>
          <select style="width:100%;padding:10px 14px;border:2px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.85rem;outline:none;background:#f8fafc">
            <option>فريق Alpha — GradSmart</option>
            <option>فريق Beta — SmartLibrary</option>
            <option>فريق Gamma — E-Commerce</option>
          </select>
        </div>
        <div class="eval-form">
          <div class="eval-criteria">
            <div class="ec-top"><span class="ec-title">🏗️ جودة الكود والبنية التقنية</span><span class="ec-weight">30%</span></div>
            <div class="star-row">
              <span class="star filled" onclick="setStars(this,1)">★</span>
              <span class="star filled" onclick="setStars(this,2)">★</span>
              <span class="star filled" onclick="setStars(this,3)">★</span>
              <span class="star filled" onclick="setStars(this,4)">★</span>
              <span class="star" onclick="setStars(this,5)">★</span>
            </div>
            <div class="ec-desc">4/5 — الكود منظم وقابل للصيانة مع توثيق جيد</div>
          </div>
          <div class="eval-criteria">
            <div class="ec-top"><span class="ec-title">📅 الالتزام بالجدول الزمني</span><span class="ec-weight">25%</span></div>
            <div class="star-row">
              <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star">★</span><span class="star">★</span>
            </div>
            <div class="ec-desc">3/5 — يوجد تأخر في مهمة الـ API</div>
          </div>
          <div class="eval-criteria">
            <div class="ec-top"><span class="ec-title">🎨 جودة الواجهة وتجربة المستخدم</span><span class="ec-weight">25%</span></div>
            <div class="star-row">
              <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span>
            </div>
            <div class="ec-desc">5/5 — تصميم احترافي وتجربة مستخدم ممتازة</div>
          </div>
          <div class="eval-criteria">
            <div class="ec-top"><span class="ec-title">🤝 التواصل والتعاون داخل الفريق</span><span class="ec-weight">20%</span></div>
            <div class="star-row">
              <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star">★</span>
            </div>
            <div class="ec-desc">4/5 — تواصل جيد ومستمر مع المشرف</div>
          </div>
        </div>
        <div style="margin-top:16px">
          <label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:7px">📝 ملاحظات المشرف</label>
          <textarea style="width:100%;padding:12px;border:2px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.82rem;resize:none;height:90px;outline:none;direction:rtl;background:#f8fafc" placeholder="اكتب ملاحظاتك التفصيلية للفريق...">أداء ممتاز في الجزء الخلفي. أرجو التركيز على واجهة المستخدم وتحسين تجربة الطالب. المهمة المتأخرة تحتاج معالجة فورية.</textarea>
        </div>
        <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:14px">📤 إرسال التقييم للفريق</button>
      </div>
 
      <!-- Grade + Previous -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">📊 الدرجة الكلية</div></div>
          <div class="grade-display">
            <div class="gd-num">82</div>
            <div class="gd-label">من 100 درجة</div>
            <div class="gd-grade">تقدير: جيد جداً ✨</div>
          </div>
          <div style="margin-top:14px;display:flex;flex-direction:column;gap:6px">
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--muted)">جودة الكود (30%)</span><span style="font-weight:700;color:var(--blue)">24/30</span></div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--muted)">الالتزام الزمني (25%)</span><span style="font-weight:700;color:var(--orange)">15/25</span></div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--muted)">جودة الواجهة (25%)</span><span style="font-weight:700;color:var(--green)">25/25</span></div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0"><span style="color:var(--muted)">التواصل (20%)</span><span style="font-weight:700;color:var(--blue)">18/20</span></div>
          </div>
        </div>
 
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">📜 التقييمات السابقة</div></div>
          <div class="prev-evals">
            <div class="pe-item">
              <div>
                <div class="pe-phase">المرحلة الأولى — التحليل</div>
                <div class="pe-date">30 أبريل 2026</div>
              </div>
              <div class="pe-stars">★★★★★</div>
              <div class="pe-grade" style="color:var(--green)">95</div>
            </div>
            <div class="pe-item" style="background:linear-gradient(135deg,#eff6ff,#f5f3ff)">
              <div>
                <div class="pe-phase">المرحلة الثانية — البناء</div>
                <div class="pe-date">جارية...</div>
              </div>
              <div class="pe-stars" style="color:var(--yellow)">★★★★☆</div>
              <div class="pe-grade" style="color:var(--blue)">82</div>
            </div>
            <div class="pe-item" style="opacity:.5">
              <div>
                <div class="pe-phase">المرحلة الثالثة — AI</div>
                <div class="pe-date">لم تبدأ</div>
              </div>
              <div class="pe-stars" style="color:var(--border)">☆☆☆☆☆</div>
              <div class="pe-grade" style="color:var(--muted)">—</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ AI REPORT ══ -->
  <div class="page-content" id="ai-report">
    <div class="topbar">
      <div class="page-title"><h1>🤖 تقرير الذكاء الاصطناعي</h1><p>فريق Alpha — تحليل تلقائي لحظي</p></div>
      <div class="topbar-actions">
        <button class="btn btn-outline">📥 تصدير التقرير</button>
        <button class="btn btn-primary">🔄 تحديث التحليل</button>
      </div>
    </div>
 
    <!-- Risk Card -->
    <div class="ai-risk-card">
      <div class="arc-header">
        <div class="arc-icon">🧠</div>
        <div>
          <div class="arc-title">نتيجة التحليل الذكي — فريق Alpha</div>
          <div class="arc-sub">آخر تحديث: اليوم 3:00 م — تحليل تلقائي كل 6 ساعات</div>
        </div>
      </div>
      <div style="margin-bottom:16px">
        <div style="font-size:.78rem;font-weight:700;margin-bottom:8px">مستوى خطر المشروع</div>
        <div class="risk-levels">
          <div class="rl-item active-low">🟢 منخفض</div>
          <div class="rl-item inactive">🟡 متوسط</div>
          <div class="rl-item inactive">🔴 عالي</div>
        </div>
      </div>
      <div style="font-size:.8rem;font-weight:600;color:var(--green)">✅ المشروع على المسار الصحيح مع بعض نقاط تحتاج انتباهاً</div>
    </div>
 
    <!-- AI Factors -->
    <div class="ai-factors-grid">
      <div class="aif-card">
        <div class="aif-icon">📈</div>
        <div class="aif-label">معدل الإنجاز</div>
        <div class="aif-value" style="color:var(--blue)">62%</div>
        <div class="aif-bar"><div class="aif-fill" style="width:62%;background:var(--blue)"></div></div>
      </div>
      <div class="aif-card">
        <div class="aif-icon">⏰</div>
        <div class="aif-label">الالتزام الزمني</div>
        <div class="aif-value" style="color:var(--orange)">74%</div>
        <div class="aif-bar"><div class="aif-fill" style="width:74%;background:var(--orange)"></div></div>
      </div>
      <div class="aif-card">
        <div class="aif-icon">👥</div>
        <div class="aif-label">نشاط الفريق</div>
        <div class="aif-value" style="color:var(--green)">88%</div>
        <div class="aif-bar"><div class="aif-fill" style="width:88%;background:var(--green)"></div></div>
      </div>
      <div class="aif-card">
        <div class="aif-icon">📁</div>
        <div class="aif-label">التوثيق</div>
        <div class="aif-value" style="color:var(--purple)">70%</div>
        <div class="aif-bar"><div class="aif-fill" style="width:70%;background:var(--purple)"></div></div>
      </div>
      <div class="aif-card">
        <div class="aif-icon">💬</div>
        <div class="aif-label">التواصل</div>
        <div class="aif-value" style="color:var(--green)">92%</div>
        <div class="aif-bar"><div class="aif-fill" style="width:92%;background:var(--green)"></div></div>
      </div>
      <div class="aif-card">
        <div class="aif-icon">⚠️</div>
        <div class="aif-label">المهام المتأخرة</div>
        <div class="aif-value" style="color:var(--red)">3</div>
        <div class="aif-bar"><div class="aif-fill" style="width:25%;background:var(--red)"></div></div>
      </div>
    </div>
 
    <!-- Recommendations -->
    <div class="card" style="animation-delay:.3s">
      <div class="card-header"><div class="card-title">💡 توصيات الذكاء الاصطناعي للمشرف</div></div>
      <div class="ai-recommendations">
        <div class="air-item good"><div class="air-icon">✅</div><div class="air-text"><strong>الفريق نشط ومتواصل بشكل ممتاز.</strong> معدل التواصل 92% يدل على بيئة عمل صحية. واصل التشجيع والمتابعة الأسبوعية.</div></div>
        <div class="air-item warn"><div class="air-icon">⚠️</div><div class="air-text"><strong>مهمة API المصادقة تأخرت يوماً.</strong> يُنصح بعقد اجتماع عاجل مع عمر خالد لمعرفة العائق وتقديم الدعم اللازم خلال 48 ساعة.</div></div>
        <div class="air-item info"><div class="air-icon">📊</div><div class="air-text"><strong>نسبة الإنجاز 62% مقارنة بالمتوقع 65%.</strong> الفارق بسيط ويمكن تعويضه. يُقترح إضافة ساعة عمل إضافية يومياً للفريق هذا الأسبوع.</div></div>
        <div class="air-item good"><div class="air-icon">🤖</div><div class="air-text"><strong>احتمالية إنجاز المشروع في الوقت المحدد: 78%.</strong> مع معالجة التأخيرات الحالية يمكن رفعها إلى 90%+. المشروع في وضع جيد.</div></div>
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

document.addEventListener("DOMContentLoaded", () => {
    // Set active link
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    document.getElementById('nav-projects')?.classList.add('active');
});
</script>
@endsection
 