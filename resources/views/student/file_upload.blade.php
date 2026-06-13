@extends('layouts.student')

@section('title', 'GradSmart — رفع الملفات')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/file_upload.css') }}">
@endsection

@section('topbar_actions')
<button class="btn btn-outline">🗂️ مجلد جديد</button><button class="btn btn-primary">⬆ رفع ملف</button>
@endsection

@section('content')
<!-- Page Tabs -->
  <div class="page-tabs">
    <button class="ptab active" onclick="switchPage('files',this)">📁 الملفات</button>
    <button class="ptab" onclick="switchPage('notifs',this)">🔔 الإشعارات <span style="background:var(--red);color:white;border-radius:20px;padding:1px 6px;font-size:.65rem;margin-right:4px">5</span></button>
    <button class="ptab" onclick="switchPage('profile',this)">👤 الملف الشخصي</button>
    <button class="ptab" onclick="switchPage('settings',this)">⚙️ الإعدادات</button>
  </div>
 
  <!-- ══ FILES ══ -->
  <div class="page-content active" id="files">
    <div class="topbar" style="margin-bottom:20px">
      <div class="page-title"><h1>📁 الملفات والتقارير</h1><p>12 ملف مرفوع — 245 MB من أصل 1 GB</p></div>
      <div class="topbar-actions"><button class="btn btn-outline">🗂️ مجلد جديد</button><button class="btn btn-primary">⬆ رفع ملف</button></div>
    </div>
 
    <!-- Upload Zone -->
    <div class="upload-zone">
      <div class="uz-icon">☁️</div>
      <div class="uz-title">اسحب الملفات هنا أو اضغط للرفع</div>
      <div class="uz-sub">الحد الأقصى 50 MB للملف الواحد</div>
      <div class="uz-types">
        <span class="uz-type">PDF</span><span class="uz-type">Word</span><span class="uz-type">Excel</span>
        <span class="uz-type">PNG/JPG</span><span class="uz-type">ZIP</span><span class="uz-type">MP4</span>
      </div>
    </div>
 
    <!-- Filter -->
    <div class="files-filter">
      <button class="ff-tab active">الكل (12)</button>
      <button class="ff-tab">📄 تقارير (5)</button>
      <button class="ff-tab">🎨 تصاميم (3)</button>
      <button class="ff-tab">💻 أكواد (2)</button>
      <button class="ff-tab">📊 عروض (2)</button>
      <div class="ff-spacer"></div>
      <input class="ff-search" placeholder="🔍 ابحث في الملفات...">
    </div>
 
    <!-- Files Grid -->
    <div class="files-grid">
      <div class="file-card" style="animation-delay:.05s">
        <div class="fc-top"><div class="fc-icon" style="background:#fef2f2">📄</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">تقرير_المرحلة_الثانية.pdf</div>
        <div class="fc-meta">📅 9 مايو 2026 · 👤 محمد · 2.4 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">PDF</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.10s">
        <div class="fc-top"><div class="fc-icon" style="background:#eff6ff">🎨</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">Figma_Design_GradSmart.fig</div>
        <div class="fc-meta">📅 8 مايو 2026 · 👤 سارة · 18.7 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">Figma</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.15s">
        <div class="fc-top"><div class="fc-icon" style="background:#f0fdf4">📊</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">GradSmart_ERD_Final.png</div>
        <div class="fc-meta">📅 1 مايو 2026 · 👤 محمد · 3.1 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">Image</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.20s">
        <div class="fc-top"><div class="fc-icon" style="background:#faf5ff">💻</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">gradsmart_backend_v1.zip</div>
        <div class="fc-meta">📅 7 مايو 2026 · 👤 عمر · 45.2 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#faf5ff;color:var(--purple);border:1px solid #ddd6fe">ZIP</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.25s">
        <div class="fc-top"><div class="fc-icon" style="background:#fff7ed">📝</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">وثيقة_المتطلبات_SRS.docx</div>
        <div class="fc-meta">📅 15 أبريل 2026 · 👤 محمد · 1.8 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fff7ed;color:var(--orange);border:1px solid #fed7aa">Word</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.30s">
        <div class="fc-top"><div class="fc-icon" style="background:#fef9f9">🎬</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">عرض_المشروع_PPT.pptx</div>
        <div class="fc-meta">📅 3 مايو 2026 · 👤 سارة · 12.5 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">PPT</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
    </div>
 
    <!-- Storage Usage -->
    <div class="card">
      <div class="card-header"><div class="card-title">💾 مساحة التخزين</div><span style="font-size:.75rem;color:var(--muted)">245 MB من 1 GB</span></div>
      <div style="height:10px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:12px">
        <div style="width:24%;height:100%;background:linear-gradient(90deg,var(--blue),var(--purple));border-radius:10px"></div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--red);display:inline-block"></span>PDF — 45 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--blue);display:inline-block"></span>Figma — 87 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--purple);display:inline-block"></span>ZIP — 68 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--orange);display:inline-block"></span>أخرى — 45 MB</div>
      </div>
    </div>
  </div>
 
  <!-- ══ NOTIFICATIONS ══ -->
  <div class="page-content" id="notifs">
    <div class="notif-header-row">
      <div class="notif-count"><div class="card-title">🔔 الإشعارات</div><span class="nc-badge">5 جديد</span></div>
      <a class="mark-all">تحديد الكل كمقروء ✓</a>
    </div>
 
    <div class="notif-section-title">اليوم</div>
    <div class="notif-list">
      <div class="notif-item unread" style="animation-delay:.05s">
        <div class="ni-unread-dot"></div>
        <div class="ni-icon" style="background:#fef2f2">🚨</div>
        <div class="ni-content">
          <div class="ni-title">مهمة متأخرة: API المصادقة</div>
          <div class="ni-desc">تأخرت مهمة "كتابة API المصادقة" المسندة إلى عمر خالد يوماً كاملاً. يُنصح بالمتابعة الفورية.</div>
          <div class="ni-footer"><span class="ni-time">منذ ساعة</span><span class="ni-tag" style="background:#fef2f2;color:var(--red)">تنبيه متأخر</span></div>
        </div>
      </div>
      <div class="notif-item success" style="animation-delay:.10s">
        <div class="ni-unread-dot" style="background:var(--green)"></div>
        <div class="ni-icon" style="background:#f0fdf4">💬</div>
        <div class="ni-content">
          <div class="ni-title">ملاحظة جديدة من د. أحمد السالم</div>
          <div class="ni-desc">"أداء ممتاز في الجزء الخلفي. أرجو التركيز على واجهة المستخدم وتحسين تجربة الطالب..."</div>
          <div class="ni-footer"><span class="ni-time">منذ 3 ساعات</span><span class="ni-tag" style="background:#f0fdf4;color:var(--green)">ملاحظة مشرف</span></div>
        </div>
      </div>
      <div class="notif-item ai" style="animation-delay:.15s">
        <div class="ni-unread-dot" style="background:var(--orange)"></div>
        <div class="ni-icon" style="background:#fff7ed">🤖</div>
        <div class="ni-content">
          <div class="ni-title">تقرير AI: المشروع على المسار الجيد</div>
          <div class="ni-desc">تحليل الذكاء الاصطناعي يُظهر مستوى خطر منخفض. معدل الإنجاز 62% مقارنة بالمتوقع 65%.</div>
          <div class="ni-footer"><span class="ni-time">منذ 5 ساعات</span><span class="ni-tag" style="background:#fff7ed;color:var(--orange)">AI تقرير</span></div>
        </div>
      </div>
    </div>
 
    <div class="notif-section-title">أمس</div>
    <div class="notif-list">
      <div class="notif-item" style="animation-delay:.20s">
        <div class="ni-icon" style="background:#f0fdf4">✅</div>
        <div class="ni-content">
          <div class="ni-title">سارة أنجزت مهمة "تصميم واجهة Login"</div>
          <div class="ni-desc">تم إنجاز المهمة وتحديث نسبة الإنجاز الكلية إلى 62%.</div>
          <div class="ni-footer"><span class="ni-time">أمس 4:30 م</span><span class="ni-tag" style="background:#f0fdf4;color:var(--green)">إنجاز مهمة</span></div>
        </div>
      </div>
      <div class="notif-item" style="animation-delay:.25s">
        <div class="ni-icon" style="background:#eff6ff">📁</div>
        <div class="ni-content">
          <div class="ni-title">محمد رفع ملفاً جديداً</div>
          <div class="ni-desc">تم رفع "gradsmart_backend_v1.zip" بحجم 45 MB في مجلد أكواد المشروع.</div>
          <div class="ni-footer"><span class="ni-time">أمس 2:00 م</span><span class="ni-tag" style="background:#eff6ff;color:var(--blue)">رفع ملف</span></div>
        </div>
      </div>
      <div class="notif-item unread" style="animation-delay:.30s">
        <div class="ni-unread-dot"></div>
        <div class="ni-icon" style="background:#faf5ff">👥</div>
        <div class="ni-content">
          <div class="ni-title">طلب انضمام لفريقك</div>
          <div class="ni-desc">الطالب "نور أحمد" طلب الانضمام لفريق Alpha كـ Backend Developer.</div>
          <div class="ni-footer">
            <span class="ni-time">أمس 11:00 ص</span>
            <button style="padding:4px 12px;background:var(--green);color:white;border:none;border-radius:7px;font-family:'Cairo',sans-serif;font-size:.7rem;font-weight:700;cursor:pointer;margin-left:6px">قبول</button>
            <button style="padding:4px 12px;background:var(--bg);color:var(--muted);border:1px solid var(--border);border-radius:7px;font-family:'Cairo',sans-serif;font-size:.7rem;font-weight:700;cursor:pointer">رفض</button>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ PROFILE ══ -->
  <div class="page-content" id="profile">
    <!-- Profile Header -->
    <div class="profile-header">
      <div class="ph-avatar-wrap">
        <div class="ph-avatar">م أ</div>
        <button class="ph-edit-btn">✏️</button>
      </div>
      <div class="ph-info">
        <div class="ph-name">محمد أحمد علي</div>
        <div class="ph-role">👨‍🎓 طالب — قسم علوم الحاسوب</div>
        <div class="ph-badges">
          <div class="ph-badge">🎓 الفصل السابع</div>
          <div class="ph-badge">🆔 CS2021-004</div>
          <div class="ph-badge">👑 قائد فريق Alpha</div>
        </div>
      </div>
      <div class="ph-stats">
        <div class="ph-stat"><div class="ph-stat-num">7</div><div class="ph-stat-label">مهام منجزة</div></div>
        <div class="ph-stat"><div class="ph-stat-num">62%</div><div class="ph-stat-label">إنجاز</div></div>
        <div class="ph-stat"><div class="ph-stat-num">12</div><div class="ph-stat-label">ملفات</div></div>
      </div>
    </div>
 
    <div class="profile-grid">
      <!-- Personal Info -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header"><div class="card-title">👤 المعلومات الشخصية</div><button class="btn btn-outline" style="padding:7px 14px;font-size:.75rem">✏️ تعديل</button></div>
        <div class="form-group"><label class="form-label">الاسم الكامل</label><input class="form-input" value="محمد أحمد علي"></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">رقم القيد</label><input class="form-input" value="CS2021-004" readonly style="background:#f1f5f9;color:var(--muted)"></div>
          <div class="form-group"><label class="form-label">الفصل الدراسي</label><select class="form-select"><option>الفصل السابع</option></select></div>
        </div>
        <div class="form-group"><label class="form-label">البريد الجامعي</label><input class="form-input" value="m.ahmed@university.edu"></div>
        <div class="form-group"><label class="form-label">رقم الهاتف</label><input class="form-input" value="+218 91 234 5678"></div>
        <div class="form-group"><label class="form-label">نبذة قصيرة</label>
          <textarea class="form-input" style="resize:none;height:70px" placeholder="اكتب نبذة عن نفسك...">طالب في الفصل السابع متخصص في Full Stack Development. أعمل على مشروع GradSmart كقائد للفريق.</textarea>
        </div>
        <button class="btn btn-primary" style="width:100%;justify-content:center">💾 حفظ التغييرات</button>
      </div>
 
      <!-- Skills + Academic -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">💡 المهارات التقنية</div></div>
          <div class="skill-tags">
            <div class="skill-tag">🖥️ HTML/CSS <button class="st-remove">×</button></div>
            <div class="skill-tag">⚡ JavaScript <button class="st-remove">×</button></div>
            <div class="skill-tag">🐘 PHP <button class="st-remove">×</button></div>
            <div class="skill-tag">🗄️ MySQL <button class="st-remove">×</button></div>
            <div class="skill-tag">🎨 Figma <button class="st-remove">×</button></div>
            <div class="skill-tag">🐙 Git/GitHub <button class="st-remove">×</button></div>
          </div>
          <div class="skill-add">
            <input class="skill-input" placeholder="أضف مهارة جديدة...">
            <button class="btn btn-primary" style="padding:8px 14px;font-size:.75rem">＋ إضافة</button>
          </div>
        </div>
 
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">🎓 المعلومات الأكاديمية</div></div>
          <div style="display:flex;flex-direction:column;gap:10px">
            <div style="display:flex;justify-content:space-between;padding:10px;background:var(--bg);border-radius:9px;font-size:.78rem">
              <span style="color:var(--muted)">القسم</span><span style="font-weight:700">علوم الحاسوب</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:10px;background:var(--bg);border-radius:9px;font-size:.78rem">
              <span style="color:var(--muted)">المشرف</span><span style="font-weight:700">د. أحمد السالم</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:10px;background:var(--bg);border-radius:9px;font-size:.78rem">
              <span style="color:var(--muted)">الفريق</span><span style="font-weight:700">Alpha — 4 أعضاء</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:10px;background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-radius:9px;font-size:.78rem;border:1px solid #ddd6fe">
              <span style="color:var(--muted)">المشروع</span><span style="font-weight:700;color:var(--blue)">GradSmart System</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ SETTINGS ══ -->
  <div class="page-content" id="settings">
    <div class="settings-grid">
      <!-- Settings Nav -->
      <div>
        <div class="settings-nav">
          <div class="sn-item active" onclick="switchSettings('notif-settings',this)"><span class="sn-icon">🔔</span> الإشعارات</div>
          <div class="sn-item" onclick="switchSettings('appear-settings',this)"><span class="sn-icon">🎨</span> المظهر</div>
          <div class="sn-item" onclick="switchSettings('security-settings',this)"><span class="sn-icon">🔒</span> الأمان</div>
          <div class="sn-item" onclick="switchSettings('lang-settings',this)"><span class="sn-icon">🌐</span> اللغة</div>
        </div>
      </div>
 
      <!-- Settings Content -->
      <div>
        <!-- Notifications Settings -->
        <div class="settings-section active card" id="notif-settings">
          <div class="sg-title">إعدادات الإشعارات</div>
          <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">📧</div><div><div class="toggle-title">إشعارات البريد الإلكتروني</div><div class="toggle-desc">استقبال الإشعارات على بريدك</div></div></div><div class="toggle-switch on" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">🔔</div><div><div class="toggle-title">إشعارات المهام</div><div class="toggle-desc">تنبيه عند إضافة مهمة أو تحديثها</div></div></div><div class="toggle-switch on" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">💬</div><div><div class="toggle-title">إشعارات الرسائل</div><div class="toggle-desc">تنبيه عند وصول رسالة جديدة</div></div></div><div class="toggle-switch on" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">🤖</div><div><div class="toggle-title">تنبيهات الذكاء الاصطناعي</div><div class="toggle-desc">تنبيه عند اكتشاف خطر في المشروع</div></div></div><div class="toggle-switch on" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">⏰</div><div><div class="toggle-title">تذكير المواعيد النهائية</div><div class="toggle-desc">تذكير قبل 24 ساعة من الموعد</div></div></div><div class="toggle-switch" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          <button class="btn btn-primary" style="margin-top:16px">💾 حفظ الإعدادات</button>
        </div>
 
        <!-- Appearance Settings -->
        <div class="settings-section card" id="appear-settings">
          <div class="sg-title">إعدادات المظهر</div>
          <div style="margin-bottom:20px">
            <div style="font-size:.82rem;font-weight:700;margin-bottom:10px">🌙 الوضع الليلي</div>
            <div class="toggle-item"><div class="toggle-left"><div class="toggle-icon">🌙</div><div><div class="toggle-title">الوضع الداكن</div><div class="toggle-desc">تفعيل الوضع الليلي لراحة العين</div></div></div><div class="toggle-switch" onclick="this.classList.toggle('on')"><div class="toggle-knob"></div></div></div>
          </div>
          <div>
            <div style="font-size:.82rem;font-weight:700;margin-bottom:10px">🎨 ألوان النظام</div>
            <div class="theme-options">
              <div class="theme-opt selected" style="background:linear-gradient(135deg,#4f8ef7,#9b6ef3)"></div>
              <div class="theme-opt" style="background:linear-gradient(135deg,#3ecf8e,#06b6d4)"></div>
              <div class="theme-opt" style="background:linear-gradient(135deg,#f97316,#fbbf24)"></div>
              <div class="theme-opt" style="background:linear-gradient(135deg,#f472b6,#9b6ef3)"></div>
              <div class="theme-opt" style="background:linear-gradient(135deg,#ef4444,#f97316)"></div>
            </div>
          </div>
          <button class="btn btn-primary" style="margin-top:20px">💾 حفظ</button>
        </div>
 
        <!-- Security Settings -->
        <div class="settings-section card" id="security-settings">
          <div class="sg-title">الأمان والخصوصية</div>
          <div class="security-item"><div class="sec-icon" style="background:#eff6ff">🔑</div><div><div class="sec-title">تغيير كلمة المرور</div><div class="sec-desc">آخر تغيير منذ 30 يوم</div></div><button class="sec-btn">تغيير</button></div>
          <div class="security-item"><div class="sec-icon" style="background:#f0fdf4">📱</div><div><div class="sec-title">التحقق الثنائي (2FA)</div><div class="sec-desc">حماية إضافية لحسابك</div></div><button class="sec-btn">تفعيل</button></div>
          <div class="security-item"><div class="sec-icon" style="background:#fef2f2">🚪</div><div><div class="sec-title">تسجيل الخروج من كل الأجهزة</div><div class="sec-desc">إنهاء جميع الجلسات النشطة</div></div><button class="sec-btn danger">خروج</button></div>
        </div>
 
        <!-- Language Settings -->
        <div class="settings-section card" id="lang-settings">
          <div class="sg-title">اللغة والمنطقة</div>
          <div class="form-group"><label class="form-label">لغة الواجهة</label><select class="form-select"><option>🇸🇦 العربية</option><option>🇬🇧 English</option><option>🇫🇷 Français</option></select></div>
          <div class="form-group"><label class="form-label">المنطقة الزمنية</label><select class="form-select"><option>Africa/Tripoli (UTC+2)</option><option>Asia/Riyadh (UTC+3)</option></select></div>
          <div class="form-group"><label class="form-label">تنسيق التاريخ</label><select class="form-select"><option>DD/MM/YYYY</option><option>MM/DD/YYYY</option><option>YYYY-MM-DD</option></select></div>
          <button class="btn btn-primary">💾 حفظ</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
function switchPage(id, btn) {
  document.querySelectorAll('.page-content').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(b => b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
  // Update sidebar active
  const map = {files:'📁',notifs:'🔔',profile:'👤',settings:'⚙️'};
  document.querySelectorAll('.nav-item').forEach(item => {
    item.classList.remove('active');
    if(id==='files' && item.textContent.includes('الملفات')) item.classList.add('active');
    if(id==='notifs' && item.textContent.includes('الإشعارات')) item.classList.add('active');
    if(id==='profile' && item.textContent.includes('ملفي')) item.classList.add('active');
    if(id==='settings' && item.textContent.includes('الإعدادات')) item.classList.add('active');
  });
}
function switchSettings(id, el) {
  document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.sn-item').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  el.classList.add('active');
}
</script>
@endsection