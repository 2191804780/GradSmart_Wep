@extends('layouts.student')

@section('title', 'GradSmart — تفاصيل المهمة')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/task_detail.css') }}">
@endsection

@section('content')
<!-- Breadcrumb -->
  <div style="display:flex;align-items:center;gap:8px;font-size:.78rem;color:var(--muted);margin-bottom:16px">
    <span style="cursor:pointer;color:var(--blue)"></span>تفاصيل المهام</span><span>›</span>
    <span style="color:var(--text);font-weight:600">تطوير واجهة تسجيل الدخول</span>
  </div>
 
  <!-- Task Hero -->
  <div class="task-hero">
    <div class="th-content">
      <div class="th-top">
        <div>
          <div class="th-badges">
            <span class="th-badge">🔄 قيد التنفيذ</span>
            <span class="th-badge">🔴 أولوية عالية</span>
            <span class="th-badge">🖥️ Frontend</span>
          </div>
        </div>
        <div class="progress-donut">
          <div class="pd-inner"><div class="pd-num">65%</div><div class="pd-label">إنجاز</div></div>
        </div>
      </div>
      <div class="th-title">تطوير واجهة تسجيل الدخول</div>
      <div class="th-desc">بناء صفحتَي Login و Register مع التحقق من صحة البيانات، نظام JWT للمصادقة، وتوجيه المستخدم تلقائياً حسب دوره.</div>
      <div class="th-meta-row">
        <div class="th-meta-item">👤 <span>سارة علي + ليلى يوسف</span></div>
        <div class="th-meta-item">📅 <span>الموعد: 12 مايو 2026</span></div>
        <div class="th-meta-item">📁 <span>مشروع GradSmart</span></div>
        <div class="th-meta-item">⏱️ <span>أُضيفت: 1 مايو 2026</span></div>
      </div>
    </div>
  </div>
 
  <!-- Status Actions -->
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="font-size:.82rem;font-weight:700">تغيير الحالة:</div>
    <div class="status-actions">
      <button class="sa-btn" style="border-color:var(--border);color:var(--muted)">⬜ لم تبدأ</button>
      <button class="sa-btn" style="border-color:var(--blue);color:var(--blue);background:#eff6ff">🔄 قيد التنفيذ</button>
      <button class="sa-btn" style="border-color:var(--purple);color:var(--purple)">👁 قيد المراجعة</button>
      <button class="sa-btn" style="border-color:var(--green);color:var(--green)">✅ منجزة</button>
    </div>
  </div>
 
  <div class="task-detail-layout">
    <!-- Left -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- Subtasks -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header">
          <div class="card-title">☑️ المهام الفرعية</div>
          <span style="font-size:.75rem;color:var(--green);font-weight:700">3/5 منجزة</span>
        </div>
        <div style="height:7px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:16px">
          <div style="width:60%;height:100%;background:linear-gradient(90deg,var(--green),var(--teal));border-radius:10px"></div>
        </div>
        <div class="subtasks-list">
          <div class="subtask-item done">
            <div class="st-check checked" onclick="toggleCheck(this)">✓</div>
            <div style="flex:1"><div class="st-text done-text">تصميم شكل الصفحة في Figma</div><div class="st-assign">👤 سارة · انتهت 3 مايو</div></div>
          </div>
          <div class="subtask-item done">
            <div class="st-check checked" onclick="toggleCheck(this)">✓</div>
            <div style="flex:1"><div class="st-text done-text">كتابة HTML/CSS للصفحة</div><div class="st-assign">👤 سارة + ليلى · انتهت 6 مايو</div></div>
          </div>
          <div class="subtask-item done">
            <div class="st-check checked" onclick="toggleCheck(this)">✓</div>
            <div style="flex:1"><div class="st-text done-text">إضافة Validation للحقول</div><div class="st-assign">👤 ليلى · انتهت 7 مايو</div></div>
          </div>
          <div class="subtask-item">
            <div class="st-check" onclick="toggleCheck(this)"></div>
            <div style="flex:1"><div class="st-text">ربط النموذج بـ API الخلفي</div><div class="st-assign">👤 سارة · الموعد 10 مايو</div></div>
            <span style="font-size:.62rem;font-weight:700;padding:2px 7px;border-radius:20px;background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">جارية</span>
          </div>
          <div class="subtask-item">
            <div class="st-check" onclick="toggleCheck(this)"></div>
            <div style="flex:1"><div class="st-text">اختبار الصفحة والـ Edge Cases</div><div class="st-assign">👤 ليلى · الموعد 12 مايو</div></div>
            <span style="font-size:.62rem;font-weight:700;padding:2px 7px;border-radius:20px;background:#f1f5f9;color:var(--muted);border:1px solid var(--border)">لم تبدأ</span>
          </div>
          <div class="add-subtask">＋ إضافة مهمة فرعية</div>
        </div>
      </div>
 
      <!-- Files -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header"><div class="card-title">📎 الملفات المرفقة</div><span style="font-size:.75rem;color:var(--muted)">2 ملفات</span></div>
        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:12px">
          <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--bg);border-radius:10px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
            <span style="font-size:1.1rem">🎨</span>
            <div style="flex:1"><div style="font-size:.75rem;font-weight:700">Login_Design_Final.fig</div><div style="font-size:.62rem;color:var(--muted)">سارة · 5 مايو · 8.2 MB</div></div>
            <div style="display:flex;gap:4px">
              <div style="width:26px;height:26px;border-radius:7px;border:1px solid var(--border);background:white;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.7rem">👁</div>
              <div style="width:26px;height:26px;border-radius:7px;border:1px solid var(--border);background:white;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.7rem">⬇</div>
            </div>
          </div>
          <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--bg);border-radius:10px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
            <span style="font-size:1.1rem">💻</span>
            <div style="flex:1"><div style="font-size:.75rem;font-weight:700">login.html + style.css</div><div style="font-size:.62rem;color:var(--muted)">ليلى · 7 مايو · 24 KB</div></div>
            <div style="display:flex;gap:4px">
              <div style="width:26px;height:26px;border-radius:7px;border:1px solid var(--border);background:white;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.7rem">👁</div>
              <div style="width:26px;height:26px;border-radius:7px;border:1px solid var(--border);background:white;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.7rem">⬇</div>
            </div>
          </div>
        </div>
        <div class="file-upload-mini">
          <div style="font-size:1.5rem;margin-bottom:6px">☁️</div>
          <div style="font-size:.75rem;font-weight:700;margin-bottom:2px">رفع ملف جديد</div>
          <div style="font-size:.65rem;color:var(--muted)">PDF, Word, ZIP, صور — حتى 50 MB</div>
        </div>
      </div>
    </div>
 
    <!-- Right -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- Comments -->
      <div class="card" style="animation-delay:.40s">
        <div class="card-header"><div class="card-title">💬 التعليقات</div><span style="font-size:.7rem;color:var(--muted)">3 تعليقات</span></div>
        <div class="comments-list">
          <div class="comment-item">
            <div class="cm-avatar" style="background:linear-gradient(135deg,var(--green),var(--teal))">أح</div>
            <div class="cm-bubble">
              <div class="cm-header">
                <div class="cm-name">د. أحمد السالم</div>
                <span class="cm-role-badge" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">👨‍🏫 مشرف</span>
                <div class="cm-time">أمس 6:30 م</div>
              </div>
              <div class="cm-text supervisor">الواجهة جيدة جداً! أضيفي Validation رسائل خطأ واضحة باللغة العربية.</div>
            </div>
          </div>
          <div class="comment-item">
            <div class="cm-avatar" style="background:linear-gradient(135deg,var(--pink),var(--orange))">سا</div>
            <div class="cm-bubble">
              <div class="cm-header">
                <div class="cm-name">سارة علي</div>
                <span class="cm-role-badge" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">👩‍🎓 طالبة</span>
                <div class="cm-time">اليوم 9:00 ص</div>
              </div>
              <div class="cm-text">تم دكتور! أضفنا رسائل الخطأ بالعربي 👍</div>
            </div>
          </div>
          <div class="comment-item">
            <div class="cm-avatar" style="background:linear-gradient(135deg,var(--yellow),var(--orange))">لي</div>
            <div class="cm-bubble">
              <div class="cm-header">
                <div class="cm-name">ليلى يوسف</div>
                <span class="cm-role-badge" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">👩‍🎓 طالبة</span>
                <div class="cm-time">اليوم 10:15 ص</div>
              </div>
              <div class="cm-text">أنا أعمل على ربط الـ API الآن 💪</div>
            </div>
          </div>
        </div>
        <div class="comment-input-row">
          <textarea class="comment-input" placeholder="اكتب تعليقاً..." rows="1"></textarea>
          <button class="btn btn-primary" style="padding:10px 14px;flex-shrink:0">➤</button>
        </div>
      </div>
 
      <!-- Task Info -->
      <div class="card" style="animation-delay:.45s">
        <div class="card-header"><div class="card-title">ℹ️ معلومات المهمة</div></div>
        <div style="display:flex;flex-direction:column;gap:8px">
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">الحالة</span><span style="font-weight:700;color:var(--blue)">🔄 قيد التنفيذ</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">الأولوية</span><span style="font-weight:700;color:var(--red)">🔴 عالية</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">الموعد النهائي</span><span style="font-weight:700;color:var(--orange)">12 مايو 2026</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">الفئة</span><span style="font-weight:700">🖥️ Frontend</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">المسؤولون</span><span style="font-weight:700">سارة، ليلى</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 10px;background:var(--bg);border-radius:8px;font-size:.75rem"><span style="color:var(--muted)">تاريخ الإضافة</span><span style="font-weight:700;color:var(--muted)">1 مايو 2026</span></div>
        </div>
        <div style="display:flex;gap:8px;margin-top:14px">
          <button class="btn btn-outline" style="flex:1;justify-content:center;font-size:.75rem">✏️ تعديل</button>
          <button class="btn btn-danger" style="flex:1;justify-content:center;font-size:.75rem">🗑️ حذف</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
function toggleCheck(el){
  el.classList.toggle('checked');
  el.textContent = el.classList.contains('checked') ? '✓' : '';
  const item = el.closest('.subtask-item');
  item.classList.toggle('done');
  item.querySelector('.st-text').classList.toggle('done-text');
}
</script>
@endsection