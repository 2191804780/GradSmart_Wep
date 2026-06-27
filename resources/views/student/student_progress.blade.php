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
<button class="btn btn-primary" onclick="location.reload()">🔄 تحديث</button>
@endsection

@section('content')

@if($state === 'no_team')

  <div class="card" style="text-align:center;padding:50px 25px">
    <div style="font-size:60px;margin-bottom:15px">👥</div>
    <h2>لا يمكن عرض التقدم بعد</h2>
    <p style="color:var(--muted);line-height:1.9;max-width:650px;margin:auto">
      يجب أن تكوني ضمن فريق أولاً حتى يتمكن النظام من حساب تقدم المشروع والمهام والمراحل.
    </p>

    <div style="display:flex;justify-content:center;gap:12px;margin-top:24px;flex-wrap:wrap">
      <a href="{{ route('student.teams.create') }}" class="msg-btn" style="text-decoration:none;max-width:220px">
        🚀 إنشاء فريق
      </a>

      <a href="{{ route('student.teams.create') }}#my-invitations" class="msg-btn" style="text-decoration:none;max-width:220px;background:#fff;color:var(--blue);border:1px solid var(--blue)">
        📨 عرض الدعوات
      </a>
    </div>
  </div>

  <div class="stats-row" style="margin-top:20px">
    <div class="sc"><div class="sc-icon">👥</div><div class="sc-num" style="color:var(--blue)">1</div><div class="sc-label">إنشاء فريق</div></div>
    <div class="sc"><div class="sc-icon">📋</div><div class="sc-num" style="color:var(--green)">2</div><div class="sc-label">إنشاء مشروع</div></div>
    <div class="sc"><div class="sc-icon">✅</div><div class="sc-num" style="color:var(--orange)">3</div><div class="sc-label">إضافة المهام</div></div>
    <div class="sc"><div class="sc-icon">📊</div><div class="sc-num" style="color:var(--purple)">4</div><div class="sc-label">متابعة التقدم</div></div>
    <div class="sc"><div class="sc-icon">🤖</div><div class="sc-num" style="color:var(--green)">AI</div><div class="sc-label">تحليل الخطر</div></div>
  </div>

@elseif($state === 'no_project')

  <div class="card" style="text-align:center;padding:50px 25px">
    <div style="font-size:60px;margin-bottom:15px">📋</div>
    <h2>الفريق جاهز، لكن لا يوجد مشروع بعد</h2>
    <p style="color:var(--muted);line-height:1.9;max-width:650px;margin:auto">
      لا يمكن حساب نسبة التقدم قبل إنشاء مشروع وربط المهام به.
    </p>

    <div style="display:flex;justify-content:center;gap:12px;margin-top:24px;flex-wrap:wrap">
      <a href="{{ route('student.project.index') }}" class="msg-btn" style="text-decoration:none;max-width:220px">
        📋 إنشاء مشروع
      </a>

      <a href="{{ route('student.teams.management') }}" class="msg-btn" style="text-decoration:none;max-width:220px;background:#fff;color:var(--blue);border:1px solid var(--blue)">
        👥 إدارة الفريق
      </a>
    </div>
  </div>

  <div class="stats-row" style="margin-top:20px">
    <div class="sc"><div class="sc-icon">👥</div><div class="sc-num" style="color:var(--blue)">{{ $team->members->count() }}</div><div class="sc-label">أعضاء الفريق</div></div>
    <div class="sc"><div class="sc-icon">🏫</div><div class="sc-num" style="color:var(--green)">✓</div><div class="sc-label">{{ $team->department->name ?? 'القسم غير محدد' }}</div></div>
    <div class="sc"><div class="sc-icon">📋</div><div class="sc-num" style="color:var(--orange)">0</div><div class="sc-label">المشروع</div></div>
    <div class="sc"><div class="sc-icon">✅</div><div class="sc-num" style="color:var(--purple)">0</div><div class="sc-label">المهام</div></div>
    <div class="sc"><div class="sc-icon">📊</div><div class="sc-num" style="color:var(--green)">0%</div><div class="sc-label">التقدم</div></div>
  </div>

@else

  <!-- Stats -->
  <div class="stats-row">
    <div class="sc">
      <div class="sc-icon">📊</div>
      <div class="sc-num" style="color:var(--blue)">{{ $progressPercent }}%</div>
      <div class="sc-label">نسبة الإنجاز الكلية</div>
    </div>

    <div class="sc">
      <div class="sc-icon">✅</div>
      <div class="sc-num" style="color:var(--green)">{{ $doneTasks }}</div>
      <div class="sc-label">مهام منجزة</div>
    </div>

    <div class="sc">
      <div class="sc-icon">⏳</div>
      <div class="sc-num" style="color:var(--orange)">{{ $lateTasks }}</div>
      <div class="sc-label">مهام متأخرة</div>
    </div>

    <div class="sc">
      <div class="sc-icon">📅</div>
      <div class="sc-num" style="color:var(--purple)">{{ $daysLeft }}</div>
      <div class="sc-label">يوم متبقي</div>
    </div>

    <div class="sc">
      <div class="sc-icon">🤖</div>
      <div class="sc-num" style="color:{{ $riskColor }}">{{ $riskLevel }}</div>
      <div class="sc-label">مستوى الخطر</div>
    </div>
  </div>

  <!-- Overall Progress Bar -->
  <div class="overall-card">
    <div class="oc-left">
      <div class="oc-title">مشروع التخرج</div>

      <div class="oc-project">
        {{ $project->title ?? $project->name ?? 'مشروع التخرج' }}
      </div>

      <div class="oc-meta">
        👨‍🏫 {{ $supervisorName }}
        &nbsp;·&nbsp;
        👥 {{ $teamSize }} أعضاء
        &nbsp;·&nbsp;
        📅 بدأ {{ $startDate }}
      </div>

      <div class="oc-bar-wrap">
        <div class="oc-bar-top">
          <span>نسبة الإنجاز الكلية</span>
          <span style="font-weight:900">{{ $progressPercent }}%</span>
        </div>

        <div class="oc-bar-track">
          <div class="oc-bar-fill" style="width:{{ $progressPercent }}%"></div>
        </div>
      </div>

      <div class="oc-bar-note">
        المتوقع في هذا التاريخ: {{ $expectedProgress }}%
        —
        @if($progressPercent >= $expectedProgress)
          أنتم على المسار الصحيح! 💪
        @else
          تحتاجون بعض التنظيم للحاق بالخطة ⚠️
        @endif
      </div>
    </div>

    <div class="oc-right">
      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:{{ $progressPercent }}%">
          <div class="oc-circle-inner">
            <div class="oc-circle-num">{{ $doneTasks }}</div>
            <div class="oc-circle-sub">منجزة</div>
          </div>
        </div>
        <div class="oc-circle-label">مهام</div>
      </div>

      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:{{ $totalTasks > 0 ? round(($lateTasks / $totalTasks) * 100) : 0 }}%">
          <div class="oc-circle-inner">
            <div class="oc-circle-num">{{ $lateTasks }}</div>
            <div class="oc-circle-sub">متأخرة</div>
          </div>
        </div>
        <div class="oc-circle-label">تأخير</div>
      </div>

      <div class="oc-circle">
        <div class="oc-circle-ring" style="--pct:{{ min(100, $daysLeft) }}%">
          <div class="oc-circle-inner">
            <div class="oc-circle-num">{{ $daysLeft }}</div>
            <div class="oc-circle-sub">يوم</div>
          </div>
        </div>
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
      </div>
    </div>

    <div class="gantt-controls">
      <button class="gc-btn active">المهام الحالية</button>
      <div class="gc-spacer"></div>
      <button class="gc-btn active">شهر</button>
    </div>

    <div style="overflow-x:auto">
      <div style="min-width:700px">

        <div style="display:flex;margin-right:200px;margin-bottom:4px">
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">لم تبدأ</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">قيد التنفيذ</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;border-right:1px solid var(--border);padding:4px">متأخرة</div>
          <div style="flex:1;text-align:center;font-size:.65rem;color:var(--muted);font-weight:700;padding:4px">منجزة</div>
        </div>

        <div style="display:flex;flex-direction:column;gap:6px">

          @forelse($tasks->take(8) as $task)
            @php
              $isLate = $task->deadline && $task->status !== 'DONE' && \Carbon\Carbon::parse($task->deadline)->isPast();

              $barColor = match($task->status) {
                  'DONE' => 'var(--green)',
                  'IN_PROGRESS' => 'linear-gradient(90deg,var(--blue),var(--purple))',
                  default => $isLate ? 'var(--red)' : 'var(--border)',
              };

              $barText = match($task->status) {
                  'DONE' => '✓ مكتملة',
                  'IN_PROGRESS' => '🔄 قيد التنفيذ',
                  default => $isLate ? '⚠ متأخرة' : '⬜ لم تبدأ',
              };

              $barRight = match($task->status) {
                  'TODO' => '0%',
                  'IN_PROGRESS' => '25%',
                  'DONE' => '75%',
                  default => '0%',
              };

              if($isLate) {
                  $barRight = '50%';
              }

              $barWidth = match($task->status) {
                  'TODO' => '22%',
                  'IN_PROGRESS' => '28%',
                  'DONE' => '25%',
                  default => '22%',
              };

              $rowBg = $isLate ? '#fef9f9' : 'var(--bg)';
              $rowBorder = $isLate ? '#fecaca' : 'var(--border)';
            @endphp

            <div style="display:flex;align-items:center">
              <div style="width:200px;flex-shrink:0;padding:8px 12px;background:{{ $rowBg }};border-radius:8px 0 0 8px;border:1px solid {{ $rowBorder }};border-left:none">
                <div style="font-size:.75rem;font-weight:700;color:{{ $isLate ? 'var(--red)' : 'var(--text)' }}">
                  {{ $task->title }}
                </div>
                <div style="font-size:.62rem;color:var(--muted)">
                  {{ $task->assignee->name ?? 'غير محدد' }}
                  ·
                  {{ $task->deadline ?? 'بدون موعد' }}
                </div>
              </div>

              <div style="flex:1;height:40px;background:#f8fafc;border:1px solid {{ $rowBorder }};border-right:none;position:relative;border-radius:0 8px 8px 0">
                <div style="position:absolute;top:8px;right:{{ $barRight }};width:{{ $barWidth }};height:24px;background:{{ $barColor }};border-radius:6px;display:flex;align-items:center;padding:0 8px;font-size:.62rem;color:white;font-weight:700">
                  {{ $barText }}
                </div>
              </div>
            </div>
          @empty
            <div style="padding:30px;text-align:center;color:var(--muted)">
              لا توجد مهام بعد لعرضها في المخطط الزمني.
            </div>
          @endforelse

          <div style="display:flex;align-items:center;margin-top:4px">
            <div style="width:200px;flex-shrink:0"></div>
            <div style="flex:1;display:flex">
              <div style="width:50%;border-top:2px dashed var(--red);position:relative">
                <span style="position:absolute;top:-10px;right:0;font-size:.62rem;color:var(--red);font-weight:700;white-space:nowrap">
                  ← اليوم
                </span>
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
    @forelse($memberProgress as $item)
      @php
        $member = $item['member'];
        $initials = collect(explode(' ', trim($member->name)))
          ->filter()
          ->take(2)
          ->map(fn($part) => mb_substr($part, 0, 1))
          ->implode('');

        $percentColor = $item['percent'] >= 70
          ? 'var(--green)'
          : ($item['percent'] >= 40 ? 'var(--orange)' : 'var(--blue)');
      @endphp

      <div class="mp-card">
        <div class="mp-top">
          <div class="mp-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
            {{ $initials ?: 'ع' }}
          </div>

          <div>
            <div class="mp-name">{{ $member->name }}</div>
            <div class="mp-role">
              {{ $member->pivot->is_leader ? 'قائد الفريق' : ($member->pivot->member_role ?? 'عضو فريق') }}
            </div>
          </div>
        </div>

        <div class="mp-stats">
          <div>
            <div class="mp-stat-num" style="color:var(--blue)">
              {{ $item['done'] }}/{{ $item['total'] }}
            </div>
            <div class="mp-stat-label">مهام</div>
          </div>

          <div>
            <div class="mp-stat-num" style="color:{{ $percentColor }}">
              {{ $item['percent'] }}%
            </div>
            <div class="mp-stat-label">إنجاز</div>
          </div>
        </div>

        <div class="mp-bar-track">
          <div class="mp-bar-fill" style="width:{{ $item['percent'] }}%;background:linear-gradient(90deg,var(--blue),var(--purple))"></div>
        </div>
      </div>
    @empty
      <div class="card" style="grid-column:1/-1;text-align:center;color:var(--muted)">
        لا يوجد أعضاء في الفريق بعد.
      </div>
    @endforelse
  </div>
    <!-- Bottom Grid -->
  <div class="bottom-grid">

    <!-- Milestones -->
    <div class="card" style="animation-delay:.4s">
      <div class="card-header">
        <div class="card-title">🏁 المراحل والمعالم</div>
        <a class="card-action" href="{{ route('student.tasks.index') }}">المهام ←</a>
      </div>

      <div class="milestones">

        <div class="milestone-item">
          <div class="ms-indicator">
            <div class="ms-dot {{ $progressPercent > 0 ? 'done' : 'active' }}"></div>
            <div class="ms-line {{ $progressPercent > 25 ? 'done' : 'pending' }}"></div>
          </div>

          <div class="ms-content">
            <div class="ms-title">المرحلة 1 — بدء المشروع</div>
            <div class="ms-desc">إنشاء الفريق، إنشاء المشروع، وتجهيز بيئة العمل.</div>
            <div class="ms-footer">
              <div class="ms-date" style="color:var(--green)">✓ {{ $startDate }}</div>
              <span class="ms-badge {{ $progressPercent > 0 ? 'mb-done' : 'mb-active' }}">
                {{ $progressPercent > 0 ? 'بدأت' : 'جارية' }}
              </span>
            </div>
          </div>
        </div>

        <div class="milestone-item">
          <div class="ms-indicator">
            <div class="ms-dot {{ $progressPercent >= 50 ? 'done' : 'active' }}"></div>
            <div class="ms-line {{ $progressPercent >= 75 ? 'done' : 'pending' }}"></div>
          </div>

          <div class="ms-content">
            <div class="ms-title">المرحلة 2 — تنفيذ المهام</div>
            <div class="ms-desc">تنفيذ المهام المسندة لأعضاء الفريق ومتابعة التقدم.</div>
            <div class="ms-footer">
              <div class="ms-date" style="color:var(--blue)">📊 {{ $progressPercent }}%</div>
              <span class="ms-badge {{ $progressPercent >= 50 ? 'mb-done' : 'mb-active' }}">
                {{ $progressPercent >= 50 ? 'متقدمة' : 'جارية' }}
              </span>
            </div>
          </div>
        </div>

        <div class="milestone-item">
          <div class="ms-indicator">
            <div class="ms-dot {{ $lateTasks > 0 ? 'late' : ($progressPercent >= 75 ? 'done' : 'pending') }}"></div>
            <div class="ms-line pending"></div>
          </div>

          <div class="ms-content">
            <div class="ms-title">المرحلة 3 — المتابعة والمراجعة</div>
            <div class="ms-desc">مراجعة المهام المتأخرة وتحسين سير العمل قبل التسليم.</div>
            <div class="ms-footer">
              <div class="ms-date" style="color:{{ $lateTasks > 0 ? 'var(--orange)' : 'var(--muted)' }}">
                ⚠ {{ $lateTasks }} مهام متأخرة
              </div>
              <span class="ms-badge {{ $lateTasks > 0 ? 'mb-late' : 'mb-pending' }}">
                {{ $lateTasks > 0 ? 'تحتاج متابعة' : 'مستقرة' }}
              </span>
            </div>
          </div>
        </div>

        <div class="milestone-item">
          <div class="ms-indicator">
            <div class="ms-dot {{ $progressPercent == 100 ? 'done' : 'pending' }}"></div>
            <div class="ms-line pending"></div>
          </div>

          <div class="ms-content">
            <div class="ms-title">المرحلة 4 — التسليم النهائي</div>
            <div class="ms-desc">إنهاء جميع المهام وتجهيز ملفات المشروع والعرض النهائي.</div>
            <div class="ms-footer">
              <div class="ms-date" style="color:var(--muted)">
                📅 {{ $projectEndDate ? \Carbon\Carbon::parse($projectEndDate)->format('Y-m-d') : 'غير محدد' }}
              </div>
              <span class="ms-badge {{ $progressPercent == 100 ? 'mb-done' : 'mb-pending' }}">
                {{ $progressPercent == 100 ? 'مكتملة' : 'لم تكتمل بعد' }}
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Phase progress -->
    <div class="card" style="animation-delay:.45s">
      <div class="card-header">
        <div class="card-title">📈 إنجاز المراحل</div>
      </div>

      <div class="phases">
        @foreach($phaseProgress as $phase)
          <div class="phase-item">
            <div class="ph-top">
              <span class="ph-name">{{ $phase['name'] }}</span>
              <span class="ph-pct" style="color:{{ $phase['color'] }}">{{ $phase['percent'] }}%</span>
            </div>

            <div class="ph-track">
              <div class="ph-fill" style="width:{{ $phase['percent'] }}%;background:{{ $phase['color'] }}"></div>
            </div>

            <div class="ph-meta">
              {{ $phase['done'] }} من {{ $phase['total'] }} مهمة
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>

@endif

<style>
@keyframes pulse {
  0%,100% { opacity:1 }
  50% { opacity:.6 }
}
</style>

@endsection

@section('scripts')
<script>
    const navProgress = document.getElementById('nav-progress');
    if (navProgress) navProgress.classList.add('active');
</script>
@endsection
