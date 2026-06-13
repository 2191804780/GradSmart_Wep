@extends('layouts.student')

@section('title', 'GradSmart — إدارة المهام')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/task_management.css') }}">
@endsection

@section('page_title')
<h1>✅ إدارة المهام</h1>
<p>12 مهمة إجمالاً — 7 منجزة، 3 متأخرة تحتاج متابعة</p>
@endsection

@section('topbar_actions')
<button class="btn btn-outline">📥 تصدير</button>
<button class="btn btn-primary" onclick="openModal()">＋ مهمة جديدة</button>
@endsection

@section('content')
  <!-- Mini Stats -->
  <div class="mini-stats-row">
    <div class="mini-stat-card">
      <div class="ms-icon" style="background:#f1f5f9">📋</div>
      <div><div class="ms-num" style="color:var(--muted)">12</div><div class="ms-label">الكل</div></div>
    </div>
    <div class="mini-stat-card">
      <div class="ms-icon" style="background:#f0fdf4">✅</div>
      <div><div class="ms-num" style="color:var(--green)">7</div><div class="ms-label">منجزة</div></div>
    </div>
    <div class="mini-stat-card">
      <div class="ms-icon" style="background:#eff6ff">🔄</div>
      <div><div class="ms-num" style="color:var(--blue)">2</div><div class="ms-label">قيد التنفيذ</div></div>
    </div>
    <div class="mini-stat-card">
      <div class="ms-icon" style="background:#fff7ed">⚠️</div>
      <div><div class="ms-num" style="color:var(--orange)">3</div><div class="ms-label">متأخرة</div></div>
    </div>
    <div class="mini-stat-card">
      <div class="ms-icon" style="background:#faf5ff">👁️</div>
      <div><div class="ms-num" style="color:var(--purple)">0</div><div class="ms-label">قيد المراجعة</div></div>
    </div>
  </div>
 
  <!-- Filter Bar -->
  <div class="filter-bar">
    <div class="filter-tabs">
      <button class="ftab active">الكل (12)</button>
      <button class="ftab">لم تبدأ (3)</button>
      <button class="ftab">قيد التنفيذ (2)</button>
      <button class="ftab">متأخرة (3)</button>
      <button class="ftab">منجزة (7)</button>
    </div>
    <div class="filter-right">
      <input class="search-input" placeholder="🔍 ابحث عن مهمة...">
      <select class="filter-select">
        <option>كل الأعضاء</option>
        <option>محمد</option>
        <option>سارة</option>
        <option>عمر</option>
        <option>ليلى</option>
      </select>
      <select class="filter-select">
        <option>كل الأولويات</option>
        <option>عالية</option>
        <option>متوسطة</option>
        <option>منخفضة</option>
      </select>
      <div class="view-toggle">
        <div class="vtoggle active">⊞</div>
        <div class="vtoggle">☰</div>
      </div>
    </div>
  </div>
 
  <!-- ══ KANBAN BOARD ══ -->
  <div class="kanban">
 
    <!-- Column 1: Todo -->
    <div class="kanban-col">
      <div class="col-head todo">
        <span>⬜ لم تبدأ</span>
        <div class="col-count">3</div>
      </div>
 
      <div class="task-card todo" style="animation-delay:.05s">
        <div class="tc-top">
          <span class="tc-priority pri-medium">متوسطة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">ربط الـ Frontend بالـ Backend</div>
        <div class="tc-desc">دمج واجهة المستخدم مع الـ API عبر Axios وإدارة الحالة.</div>
        <span class="tc-cat" style="background:#eff6ff;color:var(--blue)">🖥️ Frontend</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>0%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:0%;background:var(--blue)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--blue)">لي</div>
          </div>
          <div class="tc-date">📅 20 مايو</div>
          <div class="tc-comments">💬 0</div>
        </div>
      </div>
 
      <div class="task-card todo" style="animation-delay:.10s">
        <div class="tc-top">
          <span class="tc-priority pri-low">منخفضة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">اختبار وحدة الذكاء الاصطناعي</div>
        <div class="tc-desc">اختبار خوارزمية التنبؤ بمخاطر المشروع وضبط دقتها.</div>
        <span class="tc-cat" style="background:#fff7ed;color:var(--orange)">🤖 AI</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>0%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:0%;background:var(--orange)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--purple)">م أ</div>
          </div>
          <div class="tc-date">📅 1 يونيو</div>
          <div class="tc-comments">💬 1</div>
        </div>
      </div>
 
      <div class="task-card todo" style="animation-delay:.15s">
        <div class="tc-top">
          <span class="tc-priority pri-low">منخفضة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">كتابة التوثيق التقني للمشروع</div>
        <div class="tc-desc">توثيق كل الـ APIs والمكونات في ملف README شامل.</div>
        <span class="tc-cat" style="background:#f0fdf4;color:var(--green)">📝 توثيق</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>0%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:0%;background:var(--green)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--green)">عم</div>
          </div>
          <div class="tc-date">📅 10 يونيو</div>
          <div class="tc-comments">💬 0</div>
        </div>
      </div>
 
      <button class="add-task-btn" onclick="openModal()">＋ إضافة مهمة</button>
    </div>
 
    <!-- Column 2: In Progress -->
    <div class="kanban-col">
      <div class="col-head progress">
        <span>🔄 قيد التنفيذ</span>
        <div class="col-count">2</div>
      </div>
 
      <div class="task-card progress" style="animation-delay:.20s">
        <div class="tc-top">
          <span class="tc-priority pri-high">عالية</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">تطوير واجهة تسجيل الدخول</div>
        <div class="tc-desc">بناء صفحة Login و Register مع التحقق من الصحة والتوجيه.</div>
        <span class="tc-cat" style="background:#eff6ff;color:var(--blue)">🖥️ Frontend</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>65%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:65%;background:var(--blue)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--pink)">سا</div>
            <div class="assignee-avatar" style="background:var(--blue)">لي</div>
          </div>
          <div class="tc-date">📅 12 مايو</div>
          <div class="tc-comments">💬 3</div>
        </div>
      </div>
 
      <div class="task-card progress" style="animation-delay:.25s">
        <div class="tc-top">
          <span class="tc-priority pri-medium">متوسطة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">تطوير لوحة تحكم المشرف</div>
        <div class="tc-desc">بناء صفحة Dashboard المشرف مع إحصائيات الفرق والمشاريع.</div>
        <span class="tc-cat" style="background:#eff6ff;color:var(--blue)">🖥️ Frontend</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>40%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:40%;background:var(--purple)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--purple)">م أ</div>
          </div>
          <div class="tc-date">📅 18 مايو</div>
          <div class="tc-comments">💬 2</div>
        </div>
      </div>
 
      <button class="add-task-btn" onclick="openModal()">＋ إضافة مهمة</button>
    </div>
 
    <!-- Column 3: Late -->
    <div class="kanban-col">
      <div class="col-head" style="background:#fef2f2;color:var(--red)">
        <span>🔴 متأخرة</span>
        <div class="col-count" style="background:var(--red)">3</div>
      </div>
 
      <div class="task-card late" style="animation-delay:.30s">
        <div class="late-badge">متأخرة!</div>
        <div class="tc-top" style="margin-top:20px">
          <span class="tc-priority pri-high">عالية</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">كتابة API المصادقة</div>
        <div class="tc-desc">بناء endpoints التسجيل والدخول والـ JWT Authentication.</div>
        <span class="tc-cat" style="background:#fef2f2;color:var(--red)">⚙️ Backend</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>30%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:30%;background:var(--red)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--green)">عم</div>
          </div>
          <div class="tc-date late-date">⚠ تأخر 1 يوم</div>
          <div class="tc-comments">💬 5</div>
        </div>
      </div>
 
      <div class="task-card late" style="animation-delay:.35s">
        <div class="late-badge">متأخرة!</div>
        <div class="tc-top" style="margin-top:20px">
          <span class="tc-priority pri-high">عالية</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">إعداد قاعدة البيانات وتنفيذ الـ Migrations</div>
        <div class="tc-desc">إنشاء كل الجداول وتحديد العلاقات وتنفيذ seed data.</div>
        <span class="tc-cat" style="background:#fef2f2;color:var(--red)">🗄️ Database</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>50%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:50%;background:var(--red)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--purple)">م أ</div>
            <div class="assignee-avatar" style="background:var(--green)">عم</div>
          </div>
          <div class="tc-date late-date">⚠ تأخر 2 يوم</div>
          <div class="tc-comments">💬 7</div>
        </div>
      </div>
 
      <div class="task-card late" style="animation-delay:.38s">
        <div class="late-badge">متأخرة!</div>
        <div class="tc-top" style="margin-top:20px">
          <span class="tc-priority pri-medium">متوسطة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title">تقرير المرحلة الأولى</div>
        <div class="tc-desc">كتابة تقرير مرحلة التصميم وإرساله للمشرف.</div>
        <span class="tc-cat" style="background:#fef2f2;color:var(--red)">📝 تقارير</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>80%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:80%;background:var(--orange)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--pink)">سا</div>
          </div>
          <div class="tc-date late-date">⚠ تأخر 3 أيام</div>
          <div class="tc-comments">💬 2</div>
        </div>
      </div>
    </div>
 
    <!-- Column 4: Done -->
    <div class="kanban-col">
      <div class="col-head done">
        <span>✅ منجزة</span>
        <div class="col-count">4</div>
      </div>
 
      <div class="task-card done" style="animation-delay:.40s;opacity:0.85">
        <div class="tc-top">
          <span class="tc-priority pri-high">عالية</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title" style="text-decoration:line-through;color:var(--muted)">تصميم قاعدة البيانات ERD</div>
        <span class="tc-cat" style="background:#f0fdf4;color:var(--green)">✅ مكتملة</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>100%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:100%;background:var(--green)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--purple)">م أ</div>
          </div>
          <div class="tc-date" style="color:var(--green)">✓ 1 مايو</div>
          <div class="tc-comments">💬 4</div>
        </div>
      </div>
 
      <div class="task-card done" style="animation-delay:.44s;opacity:0.85">
        <div class="tc-top">
          <span class="tc-priority pri-high">عالية</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title" style="text-decoration:line-through;color:var(--muted)">تصميم واجهات Figma</div>
        <span class="tc-cat" style="background:#f0fdf4;color:var(--green)">✅ مكتملة</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>100%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:100%;background:var(--green)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--pink)">سا</div>
            <div class="assignee-avatar" style="background:var(--blue)">لي</div>
          </div>
          <div class="tc-date" style="color:var(--green)">✓ 25 أبريل</div>
          <div class="tc-comments">💬 6</div>
        </div>
      </div>
 
      <div class="task-card done" style="animation-delay:.48s;opacity:0.85">
        <div class="tc-top">
          <span class="tc-priority pri-medium">متوسطة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title" style="text-decoration:line-through;color:var(--muted)">إعداد بيئة التطوير</div>
        <span class="tc-cat" style="background:#f0fdf4;color:var(--green)">✅ مكتملة</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>100%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:100%;background:var(--green)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--green)">عم</div>
          </div>
          <div class="tc-date" style="color:var(--green)">✓ 20 أبريل</div>
          <div class="tc-comments">💬 2</div>
        </div>
      </div>
 
      <div class="task-card done" style="animation-delay:.52s;opacity:0.85">
        <div class="tc-top">
          <span class="tc-priority pri-medium">متوسطة</span>
          <span class="tc-menu">⋮</span>
        </div>
        <div class="tc-title" style="text-decoration:line-through;color:var(--muted)">كتابة وثيقة المتطلبات</div>
        <span class="tc-cat" style="background:#f0fdf4;color:var(--green)">✅ مكتملة</span>
        <div class="tc-progress">
          <div class="tcp-top"><span>التقدم</span><span>100%</span></div>
          <div class="tcp-track"><div class="tcp-fill" style="width:100%;background:var(--green)"></div></div>
        </div>
        <div class="tc-footer">
          <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--purple)">م أ</div>
            <div class="assignee-avatar" style="background:var(--pink)">سا</div>
          </div>
          <div class="tc-date" style="color:var(--green)">✓ 15 أبريل</div>
          <div class="tc-comments">💬 8</div>
        </div>
      </div>
 
    </div>
  </div>
 
  <!-- ══ MODAL: Add Task ══ -->
  <div class="modal-overlay" id="modal">
    <div class="modal">
      <div class="modal-header">
        <div class="modal-title">＋ إضافة مهمة جديدة</div>
        <button class="modal-close" onclick="closeModal()">✕</button>
      </div>
 
      <div class="form-group">
        <label class="form-label">اسم المهمة *</label>
        <input class="form-input" placeholder="مثال: تطوير صفحة Dashboard">
      </div>
      <div class="form-group">
        <label class="form-label">الوصف</label>
        <textarea class="form-textarea" placeholder="وصف تفصيلي للمهمة..."></textarea>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">المسؤول</label>
          <select class="form-select">
            <option>محمد أحمد</option>
            <option>سارة علي</option>
            <option>عمر خالد</option>
            <option>ليلى يوسف</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">الموعد النهائي</label>
          <input class="form-input" type="date">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">الفئة</label>
          <select class="form-select">
            <option>🖥️ Frontend</option>
            <option>⚙️ Backend</option>
            <option>🗄️ Database</option>
            <option>🤖 AI</option>
            <option>📝 توثيق</option>
            <option>🧪 اختبار</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">الحالة</label>
          <select class="form-select">
            <option>⬜ لم تبدأ</option>
            <option>🔄 قيد التنفيذ</option>
            <option>✅ منجزة</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">الأولوية</label>
        <div class="radio-group">
          <div class="radio-opt sel-high" onclick="selectPri(this,'high')">🔴 عالية</div>
          <div class="radio-opt" onclick="selectPri(this,'medium')">🟡 متوسطة</div>
          <div class="radio-opt" onclick="selectPri(this,'low')">🟢 منخفضة</div>
        </div>
      </div>
 
      <div class="modal-footer">
        <button class="btn btn-primary" style="flex:1" onclick="closeModal()">✓ حفظ المهمة</button>
        <button class="btn btn-outline" onclick="closeModal()">إلغاء</button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  function openModal()  { document.getElementById('modal').classList.add('open'); }
  function closeModal() { document.getElementById('modal').classList.remove('open'); }
   
  document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
   
  function selectPri(el, type) {
    document.querySelectorAll('.radio-opt').forEach(o => {
      o.className = 'radio-opt';
    });
    el.classList.add('sel-' + type);
  }
   
  // Filter tabs
  document.querySelectorAll('.ftab').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
   
  // View toggle
  document.querySelectorAll('.vtoggle').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.vtoggle').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
  const navTasks = document.getElementById('nav-tasks');
  if (navTasks) navTasks.classList.add('active');
</script>
@endsection