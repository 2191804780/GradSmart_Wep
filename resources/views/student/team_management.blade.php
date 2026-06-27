@extends('layouts.student')

@section('title', 'GradSmart — إدارة الفريق')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/team_management.css') }}">
@endsection

@php
    $membersCount = $team->members->count();
    $projectTitle = $project->title ?? 'لا يوجد مشروع بعد';
    $projectKeywords = $project->keywords ?? '';
    $projectStatus = $project->status ?? 'غير محدد';
    $supervisorName = optional($project?->supervisor ?? $team->supervisor)->name ?? 'لم يتم اختيار مشرف';
@endphp

@section('page_title')
<h1>👥 إدارة الفريق</h1>
<p>فريق {{ $team->name }} — أعضاء نشطون {{ $membersCount }} </p>
@endsection

@section('topbar_actions')
<button class="btn btn-outline" type="button" onclick="openReport()">📋 تقرير الفريق</button>
<button class="btn btn-primary" type="button" onclick="openModal()">＋ دعوة عضو</button>
@endsection

@section('content')

@if ($errors->any())
  <div class="card" style="background:#fee2e2;color:#991b1b;margin-bottom:16px">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
      <style>
.role-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.role-card {
  border: 1.5px solid var(--border);
  background: #fff;
  border-radius: 14px;
  padding: 12px 10px;
  cursor: pointer;
  font-size: .78rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  gap: 7px;
  transition: .2s;
}

.role-card:hover {
  border-color: var(--blue);
  background: #eff6ff;
}

.role-card.active {
  background: linear-gradient(135deg, var(--blue), var(--purple));
  color: #fff;
  border-color: transparent;
  box-shadow: 0 10px 22px rgba(79,142,247,.22);
}

.role-card.active::after {
  content: "✓";
  margin-right: auto;
  font-weight: 900;
}

@media(max-width:700px){
  .role-grid {
    grid-template-columns: 1fr 1fr;
  }
}
</style>
    @endforeach
  </div>
@endif

@if (session('success'))
  <div class="card" style="background:#dcfce7;color:#166534;margin-bottom:16px">
    {{ session('success') }}
  </div>
@endif

<div class="team-header-card">
  <div class="team-logo">🚀</div>

  <div class="team-info">
    <div class="team-name">فريق {{ $team->name }}</div>
    <div class="team-sub">مشروع {{ $projectTitle }}</div>

    <div class="team-badges">
      <div class="t-badge">👨‍🏫 {{ $supervisorName }}</div>
      <div class="t-badge">🏫 {{ $team->department->name ?? 'غير محدد' }}</div>
      <div class="t-badge">👥 {{ $membersCount }} / {{ $team->max_members }} أعضاء</div>
      <div class="t-badge" style="background:rgba(62,207,142,.3);border-color:rgba(62,207,142,.5)">🟢 نشط</div>
    </div>
  </div>

  <div class="team-progress-wrap">
    <div class="team-progress-circle">
      <div class="tpc-inner">
        <div class="tpc-num">{{ $projectProgress }}%</div>
        <div class="tpc-label">إنجاز</div>
      </div>
    </div>
    <div class="team-progress-label">تقدم المشروع الكلي</div>
  </div>
</div>

<div class="stats-row">
  <div class="stat-card">
    <div class="s-icon" style="background:#eff6ff">👥</div>
    <div><div class="s-num" style="color:var(--blue)">{{ $membersCount }}</div><div class="s-label">أعضاء الفريق</div></div>
  </div>

  <div class="stat-card">
    <div class="s-icon" style="background:#f0fdf4">✅</div>
    <div><div class="s-num" style="color:var(--green)">{{ $doneTasks }}</div><div class="s-label">مهام منجزة</div></div>
  </div>

  <div class="stat-card">
    <div class="s-icon" style="background:#fff7ed">⏳</div>
    <div><div class="s-num" style="color:var(--orange)">{{ $progressTasks }}</div><div class="s-label">مهام جارية</div></div>
  </div>

  <div class="stat-card">
    <div class="s-icon" style="background:#faf5ff">📅</div>
    <div><div class="s-num" style="color:var(--purple)">{{ $daysLeft }}</div><div class="s-label">يوم متبقي</div></div>
  </div>
</div>

<div class="grid-2">

  <div class="card" id="roles-section">
    <div class="card-header">
      <div class="card-title">👤 أعضاء الفريق</div>
      <a class="card-action" href="#roles-section">إدارة الأدوار ←</a>
    </div>

    <div class="members-list">
      @foreach($team->members as $member)
        @php
          $stats = $memberStats[$member->id] ?? ['total'=>0,'done'=>0,'progress'=>0];
        @endphp

        <div class="member-item {{ $member->pivot->is_leader ? 'leader' : '' }}">
          <div class="m-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
            {{ mb_substr($member->name,0,1) }}
            @if($member->pivot->is_leader)
              <div class="leader-crown">👑</div>
            @endif
          </div>

          <div class="m-info">
            <div class="m-name">{{ $member->name }}</div>
            <div class="m-role">
              {{ $member->pivot->is_leader ? 'قائد الفريق' : ($member->pivot->member_role ?? 'عضو الفريق') }}
              · {{ $member->email }}
            </div>
          </div>

          <div class="m-tasks">
            <div class="m-task-count" style="color:var(--blue)">{{ $stats['total'] }} مهام</div>
            <div class="m-progress-mini">
              <div class="m-progress-fill" style="width: {{ $stats['progress'] }}%;background:var(--blue)"></div>
            </div>
          </div>

          <div class="m-actions">
            <div class="m-btn" title="رسالة">💬</div>

            @if($currentUserIsLeader && ! $member->pivot->is_leader)
              <form method="POST" action="{{ route('student.teams.makeLeader', $member->id) }}" style="display:inline">
                @csrf
                <button class="m-btn" type="submit" title="تعيين قائد" style="border:0;cursor:pointer">👑</button>
              </form>

              <form method="POST" action="{{ route('student.teams.removeMember', $member->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="m-btn" type="submit" title="حذف العضو" style="border:0;cursor:pointer"
                  onclick="return confirm('هل تريد حذف هذا العضو من الفريق؟')">🗑️</button>
              </form>
            @endif
          </div>
        </div>
      @endforeach

      <div class="invite-box" onclick="openModal()">
        <div class="invite-icon">➕</div>
        <div class="invite-title">دعوة عضو جديد</div>
        <div class="invite-sub">أرسل دعوة بالبريد الجامعي</div>
      </div>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:16px">

    <div class="card">
      <div class="card-header">
        <div class="card-title">📋 المشروع</div>
        <a class="card-action" href="{{ route('student.project.index') }}">عرض ←</a>
      </div>

      <div class="project-card">
        <div class="proj-header">
          <div class="proj-icon">🌐</div>
          <div>
            <div class="proj-name">{{ $projectTitle }}</div>
            <div class="proj-type">{{ $projectStatus }} · Web Application</div>
          </div>
        </div>

        <div class="proj-progress-bar">
          <div class="ppb-top">
            <span style="color:var(--muted);font-size:.72rem">نسبة الإنجاز</span>
            <span style="font-weight:700;color:var(--blue)">{{ $projectProgress }}%</span>
          </div>
          <div class="ppb-track">
            <div class="ppb-fill" style="width: {{ $projectProgress }}%;"></div>
          </div>
        </div>

        <div class="proj-tags">
          @if($projectKeywords)
            @foreach(explode(',', $projectKeywords) as $keyword)
              <span class="p-tag" style="background:#eff6ff;color:var(--blue)">{{ trim($keyword) }}</span>
            @endforeach
          @else
            <span class="p-tag" style="background:#f1f5f9;color:var(--muted)">لا توجد كلمات مفتاحية</span>
          @endif
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">📌 لوحة مهام الفريق</div>
        <a class="card-action" href="{{ route('student.tasks.index') }}">كل المهام ←</a>
      </div>

      <div class="timeline">
        @forelse($tasks->take(5) as $task)
          <div class="tl-item">
            <div class="tl-dot" style="background:{{ $task->status === 'DONE' ? 'var(--green)' : 'var(--orange)' }}"></div>
            <div class="tl-content">
              <div class="tl-text">{{ $task->title }}</div>
              <div class="tl-time">
                {{ $task->assignee->name ?? 'غير محدد' }} · {{ $task->status }}
              </div>
            </div>
          </div>
        @empty
          <div class="last-note">لا توجد مهام بعد.</div>
        @endforelse
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">📜 نشاط الفريق</div>
        <a class="card-action" href="#" onclick="openActivity();return false;">الكل ←</a>
      </div>

      <div class="timeline">
        @foreach($activities->take(4) as $activity)
          <div class="tl-item">
            <div class="tl-dot" style="background:{{ $activity['color'] }}"></div>
            <div class="tl-content">
              <div class="tl-text">{{ $activity['text'] }}</div>
              <div class="tl-time">{{ $activity['time'] }}</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</div>

<div class="modal-overlay" id="modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">➕ دعوة عضو جديد</div>
      <button type="button" class="modal-close" onclick="closeModal()">✕</button>
    </div>

    <form method="POST" action="{{ route('student.teams.invite') }}">
      @csrf

      <div class="form-group">
        <label class="form-label">البريد الجامعي للطالب *</label>
        <input name="email" class="form-input" required placeholder="example@university.edu">
      </div>

        <div class="form-group">
            <label class="form-label">اختر دور الطالب</label>

          <input type="hidden" name="member_role" id="memberRoleInput" value="MEMBER">
          <select name="member_role" class="form-select" required>
              <option value=""> دور الطالب</option>
              <option value="Frontend">🖥️ Frontend Developer</option>
              <option value="Backend">⚙️ Backend Developer</option>
              <option value="Full Stack">💻 Full Stack Developer</option>
             <option value="Database">🗄️ Database Developer</option>
             <option value="UI/UX">🎨 UI / UX Designer</option>
             <option value="Tester">🧪 Software Tester</option>
             <option value="AI/ML">🤖 AI / ML</option>
             <option value="Documentation">📄 Documentation</option>
             <option value="Other"> لا دور محدد </option>
          </select>
       </div>

        <div class="form-group">
          <label class="form-label">ملاحظة الدعوة</label>

           <textarea
                 name="note"
              class="form-textarea"
                 rows="5"
               placeholder="اكتب ملاحظة للعضو (اختياري)..."
              style="
            width:100%;
            min-height:120px;
            resize:vertical;
            padding:14px;
            border:1px solid #dcdfe6;
            border-radius:12px;
            font-size:14px;
            font-family:inherit;
            line-height:1.7;
            background:#fff;
            box-sizing:border-box;
        "></textarea>

            <small style="color:#888;margin-top:6px;display:block">
            يمكنك كتابة رسالة ترحيب أو توضيح المهمة المطلوبة.
           </small>
         </div>
      

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" style="flex:1">📨 إرسال الدعوة</button>
        <button type="button" class="btn btn-outline" onclick="closeModal()">إلغاء</button>
      </div>
    </form>
  </div>
</div>

<div class="modal-overlay" id="activityModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">📜 كل نشاط الفريق</div>
      <button type="button" class="modal-close" onclick="closeActivity()">✕</button>
    </div>

    <div class="timeline">
      @foreach($activities as $activity)
        <div class="tl-item">
          <div class="tl-dot" style="background:{{ $activity['color'] }}"></div>
          <div class="tl-content">
            <div class="tl-text">{{ $activity['text'] }}</div>
            <div class="tl-time">{{ $activity['time'] }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<div id="reportBox" style="display:none">
  <h2>تقرير الفريق</h2>
  <p>اسم الفريق: {{ $team->name }}</p>
  <p>القسم: {{ $team->department->name ?? 'غير محدد' }}</p>
  <p>المشروع: {{ $projectTitle }}</p>
  <p>المشرف: {{ $supervisorName }}</p>
  <p>عدد الأعضاء: {{ $membersCount }}</p>
  <p>إجمالي المهام: {{ $totalTasks }}</p>
  <p>المهام المنجزة: {{ $doneTasks }}</p>
  <p>نسبة الإنجاز: {{ $projectProgress }}%</p>

  <h3>الأعضاء</h3>
  <ul>
    @foreach($team->members as $member)
      <li>{{ $member->name }} — {{ $member->pivot->is_leader ? 'قائد الفريق' : ($member->pivot->member_role ?? 'عضو الفريق') }}</li>
    @endforeach
  </ul>
</div>

@endsection

@section('scripts')
<script>
const navTeam = document.getElementById('nav-team');
if (navTeam) navTeam.classList.add('active');

function openModal(){ document.getElementById('modal').classList.add('open'); }
function closeModal(){ document.getElementById('modal').classList.remove('open'); }

function openActivity(){ document.getElementById('activityModal').classList.add('open'); }
function closeActivity(){ document.getElementById('activityModal').classList.remove('open'); }

function openReport() {
  const report = document.getElementById('reportBox').innerHTML;
  const win = window.open('', '', 'width=900,height=700');
  win.document.write(`
    <html dir="rtl" lang="ar">
      <head>
        <title>تقرير الفريق</title>
        <style>
          body{font-family:Tahoma,Arial;padding:30px;line-height:1.9}
          h2{color:#4f46e5}
          p,li{font-size:15px}
        </style>
      </head>
      <body>${report}</body>
    </html>
  `);
  win.document.close();
  win.print();
}

document.querySelectorAll('.modal-overlay').forEach(modal => {
  modal.addEventListener('click', function(e) {
    if (e.target === modal) modal.classList.remove('open');
  });
});

const themeBtn = document.getElementById('themeToggle');
if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add('dark-theme');
  if (themeBtn) themeBtn.textContent = '☀️';
}
if (themeBtn) {
  themeBtn.addEventListener('click', function(){
    document.body.classList.toggle('dark-theme');
    const isDark = document.body.classList.contains('dark-theme');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    themeBtn.textContent = isDark ? '☀️' : '🌙';
  });
}

</script>
@endsection