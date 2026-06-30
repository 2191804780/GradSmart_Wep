@extends('layouts.student')

@section('title', 'GradSmart — لوحة الطالب')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_dashboard.css') }}">
@endsection

@section('content')

@if ($errors->any())
    <div class="card" style="background:#fee2e2;color:#991b1b;margin-bottom:16px">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="card" style="background:#dcfce7;color:#166534;margin-bottom:16px">
        {{ session('success') }}
    </div>
@endif


{{-- الحالة الأولى: الطالب لا يملك فريق --}}
@if(!$team)

    <div class="card" style="text-align:center;padding:40px 25px;margin-bottom:20px">
        <div style="font-size:54px;margin-bottom:14px">🎓</div>

        <h2 style="font-size:1.7rem;margin-bottom:10px">
            مرحباً {{ $user->name }} 👋
        </h2>

        <p style="color:var(--muted);line-height:1.9;max-width:650px;margin:auto">
            أنت الآن داخل نظام GradSmart. للبدء في إدارة مشروع التخرج،
            يمكنك إنشاء فريق جديد أو قبول دعوة من أحد الفرق الموجودة.
        </p>

        <div style="display:flex;justify-content:center;gap:12px;margin-top:24px;flex-wrap:wrap">
            <a href="{{ route('student.teams.create') }}" class="msg-btn" style="text-decoration:none;max-width:220px">
                🚀 إنشاء فريق
            </a>

            <a href="#my-invitations" class="msg-btn" style="text-decoration:none;max-width:220px;background:#fff;color:var(--blue);border:1px solid var(--blue)">
                📨 عرض الدعوات
            </a>
        </div>
    </div>

    <div class="stats-grid">

        <div class="stat-card blue">
            <div class="stat-icon">👥</div>
            <div class="stat-num">1</div>
            <div class="stat-label">الخطوة الأولى</div>
            <div class="stat-change up">إنشاء فريق أو قبول دعوة</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">📋</div>
            <div class="stat-num">2</div>
            <div class="stat-label">الخطوة الثانية</div>
            <div class="stat-change up">إنشاء مشروع التخرج</div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon">✅</div>
            <div class="stat-num">3</div>
            <div class="stat-label">الخطوة الثالثة</div>
            <div class="stat-change warn">إدارة المهام والملفات</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon">📊</div>
            <div class="stat-num">4</div>
            <div class="stat-label">الخطوة الرابعة</div>
            <div class="stat-change up">متابعة التقدم</div>
        </div>

    </div>

    <div class="card" id="my-invitations" style="margin-top:20px">
        <div class="card-header">
            <div class="card-title">📨 دعوات الانضمام</div>
        </div>

        @forelse($myInvitations as $invitation)

            <div class="activity-item" style="align-items:flex-start">
                <div class="act-icon" style="background:#eff6ff">📩</div>

                <div class="act-text" style="flex:1">
                    <div class="act-main">
                        دعوة للانضمام إلى فريق:
                        <strong>{{ $invitation->team->name ?? 'فريق غير معروف' }}</strong>
                    </div>

                    <div class="act-time" style="line-height:1.8">
                        المرسل: {{ $invitation->sender->name ?? 'غير معروف' }} <br>
                        الدور المقترح: {{ $invitation->member_role }} <br>
                        الملاحظة: {{ $invitation->note ?? 'لا توجد ملاحظة' }}
                    </div>

                    <div style="display:flex;gap:10px;margin-top:12px;flex-wrap:wrap">

                        <form method="POST" action="{{ route('student.teams.acceptInvitation', $invitation->id) }}">
                            @csrf
                            <button class="msg-btn" type="submit" style="padding:10px 18px">
                                ✅ قبول
                            </button>
                        </form>

                        <form method="POST" action="{{ route('student.teams.rejectInvitation', $invitation->id) }}">
                            @csrf
                            <button class="msg-btn" type="submit" style="padding:10px 18px;background:#fff;color:#ef4444;border:1px solid #ef4444">
                                ❌ رفض
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        @empty

            <div class="last-note">
                لا توجد دعوات حالياً. يمكنك إنشاء فريق جديد من زر "إنشاء فريق".
            </div>

        @endforelse
    </div>


{{-- الحالة الثانية: يوجد فريق ولا يوجد مشروع --}}
@elseif($team && !$project)

    <div class="card" style="text-align:center;padding:36px 25px;margin-bottom:20px">
        <div style="font-size:50px;margin-bottom:12px">👥</div>

        <h2 style="font-size:1.6rem;margin-bottom:10px">
            فريقك جاهز: {{ $team->name }}
        </h2>

        <p style="color:var(--muted);line-height:1.9">
            تم إنشاء الفريق أو الانضمام إليه بنجاح. الخطوة التالية هي إنشاء مشروع التخرج.
        </p>

        <a href="{{ route('student.project.index') }}" class="msg-btn" style="text-decoration:none;max-width:240px;margin:22px auto 0">
            📋 إنشاء مشروع
        </a>
    </div>

    <div class="stats-grid">

        <div class="stat-card blue">
            <div class="stat-icon">👥</div>
            <div class="stat-num">{{ $team->members->count() }}</div>
            <div class="stat-label">أعضاء الفريق</div>
            <div class="stat-change up">الفريق نشط</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">🏫</div>
            <div class="stat-num">✓</div>
            <div class="stat-label">القسم</div>
            <div class="stat-change up">{{ $team->department->name ?? 'غير محدد' }}</div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon">📋</div>
            <div class="stat-num">0</div>
            <div class="stat-label">المشروع</div>
            <div class="stat-change warn">لم يتم إنشاؤه بعد</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon">✅</div>
            <div class="stat-num">0</div>
            <div class="stat-label">المهام</div>
            <div class="stat-change up">تظهر بعد إنشاء المشروع</div>
        </div>

    </div>

    <div class="card" style="margin-top:20px">
        <div class="card-header">
            <div class="card-title">👤 أعضاء الفريق</div>
            <a class="card-action" href="{{ route('student.teams.management') }}">إدارة الفريق ←</a>
        </div>

        <div class="activity-list">

            @foreach($team->members as $member)
                <div class="activity-item">
                    <div class="act-icon" style="background:#eff6ff">
                        {{ mb_substr($member->name, 0, 1) }}
                    </div>

                    <div class="act-text">
                        <div class="act-main">{{ $member->name }}</div>

                        <div class="act-time">
                            {{ $member->pivot->is_leader ? 'قائد الفريق' : ($member->pivot->member_role ?? 'عضو فريق') }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


{{-- الحالة الثالثة: يوجد فريق ومشروع --}}
@else

    <div class="stats-grid">

        <div class="stat-card blue">
            <div class="stat-icon">📋</div>
            <div class="stat-num">{{ $totalTasks }}</div>
            <div class="stat-label">إجمالي المهام</div>
            <div class="stat-change up">مرتبطة بالمشروع الحالي</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">✅</div>
            <div class="stat-num">{{ $doneTasks }}</div>
            <div class="stat-label">مهام منجزة</div>
            <div class="stat-change up">{{ $projectProgress }}% من الكلي</div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon">⏳</div>
            <div class="stat-num">{{ $lateTasks }}</div>
            <div class="stat-label">مهام متأخرة</div>
            <div class="stat-change warn">تحتاج متابعة</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon">📅</div>
            <div class="stat-num">{{ $daysLeft }}</div>
            <div class="stat-label">يوم متبقي</div>
            <div class="stat-change up">حتى موعد التسليم</div>
        </div>

    </div>


    <div class="progress-section">

        {{-- كرت تقدم المشروع --}}
        <div class="card">

            <div class="card-header">
                <div class="card-title">📊 تقدم المشروع</div>
                <a class="card-action" href="{{ route('student.project.index') }}">عرض التفاصيل ←</a>
            </div>

            <div class="project-info">
                <div class="project-emoji">🌐</div>

                <div>
                    <div class="project-name">{{ $project->title }}</div>

                    <div class="project-meta">
                        👨‍🏫 {{ $project->supervisor->name ?? 'لم يتم اختيار مشرف' }}
                        &nbsp;|&nbsp;
                        👥 {{ $team->members->count() }} أعضاء
                        &nbsp;|&nbsp;
                        🖥️ Web App
                    </div>
                </div>
            </div>

            <div class="big-progress">

                <div class="big-progress-top">
                    <span class="big-progress-label">نسبة الإنجاز الكلية</span>
                    <span class="big-progress-pct">{{ $projectProgress }}%</span>
                </div>

                <div class="progress-track">
                    <div class="progress-fill" style="width:{{ $projectProgress }}%"></div>
                </div>

            </div>

            <div class="mini-stats">

                <div class="mini-stat">
                    <div class="mini-stat-num" style="color:var(--green)">{{ $doneTasks }}</div>
                    <div class="mini-stat-label">منجزة ✅</div>
                </div>

                <div class="mini-stat">
                    <div class="mini-stat-num" style="color:var(--blue)">{{ $progressTasks }}</div>
                    <div class="mini-stat-label">قيد التنفيذ 🔄</div>
                </div>

                <div class="mini-stat">
                    <div class="mini-stat-num" style="color:var(--orange)">{{ $lateTasks }}</div>
                    <div class="mini-stat-label">متأخرة ⚠</div>
                </div>

                <div class="mini-stat">
                    <div class="mini-stat-num" style="color:var(--muted)">{{ $todoTasks }}</div>
                    <div class="mini-stat-label">لم تبدأ ⬜</div>
                </div>

            </div>
        </div>


        {{-- كرت التحليل الذكي --}}
        <div class="risk-card">

            <div class="card-header">
                <div class="card-title">🤖 التحليل الذكي للمشروع</div>
            </div>

            <div class="risk-meter">

                <div class="risk-circle">

                    <div class="risk-circle-inner">
                        <div class="risk-pct" style="color:{{ $riskColor }}">
                            {{ $riskLevel }}
                        </div>

                        <div class="risk-text">
                            مستوى الخطر
                        </div>
                    </div>

                </div>

                <div class="risk-label">
                    {{ $riskMessage }}
                </div>

            </div>

            <div class="risk-factors">

                <div class="risk-factor">
                    <span class="rf-label">معدل الإنجاز</span>

                    <div class="rf-bar-wrap">
                        <div class="rf-bar"
                             style="width: {{ $achievementRate }}%; background: var(--green);">
                        </div>
                    </div>

                    <small>{{ $achievementRate }}%</small>
                </div>

                <div class="risk-factor">
                    <span class="rf-label">الالتزام بالمواعيد</span>

                    <div class="rf-bar-wrap">
                        <div class="rf-bar"
                             style="width: {{ $deadlineCommitment }}%; background: {{ $lateTasks > 0 ? 'var(--yellow)' : 'var(--green)' }};">
                        </div>
                    </div>

                    <small>{{ $deadlineCommitment }}%</small>
                </div>

                <div class="risk-factor">
                    <span class="rf-label">نشاط الفريق</span>

                    <div class="rf-bar-wrap">
                        <div class="rf-bar"
                             style="width: {{ $teamActivity }}%; background: var(--green);">
                        </div>
                    </div>

                    <small>{{ $teamActivity }}%</small>
                </div>

            </div>

        </div>

    </div>


    <div class="bottom-row">

        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- أحدث المهام --}}
            <div class="card" style="animation-delay:0.35s">

                <div class="card-header">
                    <div class="card-title">✅ أحدث المهام</div>
                    <a class="card-action" href="{{ route('student.tasks.index') }}">كل المهام ←</a>
                </div>

                <div class="tasks-list">

                    @forelse($tasks->take(4) as $task)

                        <div class="task-item">

                            <div class="task-check {{ $task->status === 'DONE' ? 'done' : ($task->status === 'IN_PROGRESS' ? 'inprogress' : '') }}">
                                {{ $task->status === 'DONE' ? '✓' : '' }}
                            </div>

                            <div class="task-info">
                                <div class="task-name {{ $task->status === 'DONE' ? 'done' : '' }}">
                                    {{ $task->title }}
                                </div>

                                <div class="task-meta">
                                    <span>👤 {{ $task->assignee->name ?? 'غير محدد' }}</span>
                                    <span>📅 {{ $task->deadline ?? 'بدون موعد' }}</span>
                                </div>
                            </div>

                            @php
                                $tagClass = $task->status === 'DONE'
                                    ? 'tag-done'
                                    : ($task->status === 'IN_PROGRESS' ? 'tag-progress' : 'tag-todo');
                            @endphp

                            <span class="task-tag {{ $tagClass }}">
                                {{ $task->status === 'DONE' ? 'منجزة' : ($task->status === 'IN_PROGRESS' ? 'قيد التنفيذ' : 'لم تبدأ') }}
                            </span>

                        </div>

                    @empty

                        <div class="last-note">
                            لا توجد مهام بعد.
                        </div>

                    @endforelse

                </div>
            </div>


            {{-- سجل الأنشطة --}}
            <div class="card" style="animation-delay:0.4s">

                <div class="card-header">
                    <div class="card-title">📜 سجل الأنشطة</div>

                   
                    <a class="card-action" href="{{ route('student.activities.index') }}">
                        المزيد ←
                    </a>
                </div>

                <div class="activity-list">

                    @foreach($activities->take(4) as $activity)

                        <div class="activity-item">
                            <div class="act-icon" style="background:{{ $activity['bg'] }}">
                                {{ $activity['icon'] }}
                            </div>

                            <div class="act-text">
                                <div class="act-main">{{ $activity['text'] }}</div>
                                <div class="act-time">{{ $activity['time'] }}</div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>


        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- كرت المشرف --}}
            <div class="card" style="animation-delay:0.45s">

                <div class="card-header">
                    <div class="card-title">👨‍🏫 المشرف</div>
                </div>

                @if($project->supervisor)

                    <div class="supervisor-card">

                        <div class="sup-avatar">
                            {{ mb_substr($project->supervisor->name, 0, 2) }}
                        </div>

                        <div>
                            <div class="sup-name">
                                {{ $project->supervisor->name }}
                            </div>

                            <div class="sup-title">
                                مشرف مشروع التخرج
                            </div>
                        </div>

                        <div class="sup-status">
                            🟢 متاح
                        </div>

                    </div>

                    <div class="last-note">
                        لا توجد ملاحظات حديثة من المشرف.
                        <div class="note-from">📅 اليوم</div>
                    </div>

                    <a href="{{ route('student.chat.index', [
                                                   'type' => 'supervisor',
                                    'receiver_id' => $project->supervisor->id
                                      ]) }}"
                                      class="msg-btn"
                                      style="text-decoration:none">
                                    💬 إرسال رسالة
                     </a>

                @else

                    <div class="last-note">
                        لم يتم اختيار مشرف بعد. يمكنك اختيار مشرف مناسب من صفحة المشروع.
                    </div>

                    <a href="{{ route('student.project.index') }}"
                       class="msg-btn"
                       style="text-decoration:none">
                        👨‍🏫 اختيار مشرف
                    </a>

                @endif

            </div>


            {{-- المواعيد القادمة --}}
            <div class="card" style="animation-delay:0.5s">

                <div class="card-header">
                    <div class="card-title">📅 المواعيد القادمة</div>
                </div>

                <div class="deadline-items">

                    <div class="dl-item">

                        <div class="dl-dot" style="background:var(--purple)"></div>

                        <div class="dl-name">
                            موعد تسليم المشروع
                        </div>

                        <div class="dl-date">
                            {{ $project->expected_end_date ?? 'غير محدد' }}
                        </div>

                        <span class="dl-urgent" style="background:#faf5ff;color:var(--purple)">
                            {{ $daysLeft }} يوم
                        </span>

                    </div>

                    @foreach($tasks->where('status', '!=', 'DONE')->take(2) as $task)

                        <div class="dl-item">

                            <div class="dl-dot" style="background:var(--orange)"></div>

                            <div class="dl-name">
                                {{ $task->title }}
                            </div>

                            <div class="dl-date">
                                {{ $task->deadline ?? 'غير محدد' }}
                            </div>

                            <span class="dl-urgent" style="background:#fff7ed;color:var(--orange)">
                                مهمة
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endif

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('themeToggle');

        themeToggle.addEventListener('click', function () {
            document.body.classList.toggle('dark-theme');

            const isDark = document.body.classList.contains('dark-theme');

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            themeToggle.textContent = isDark ? '☀️' : '🌙';
        });
    }

     const navDashboard = document.getElementById('nav-dashboard');

    if (navDashboard) {
        navDashboard.classList.add('active');
    }

</script>
@endsection