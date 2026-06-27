@extends('layouts.student')

@section('title', 'GradSmart — إدارة المهام')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/task_management.css') }}">
@endsection

@php
    $totalTasks = $tasks->count();
    $todoTasks = $tasks->where('status', 'TODO');
    $progressTasks = $tasks->where('status', 'IN_PROGRESS');
    $doneTasks = $tasks->where('status', 'DONE');

    $lateTasks = $tasks->filter(function ($task) {
        return $task->status !== 'DONE'
            && $task->deadline
            && \Carbon\Carbon::parse($task->deadline)->isPast();
    });
@endphp

@section('page_title')
<h1>✅ إدارة المهام</h1>
<p>{{ $totalTasks }} مهمة إجمالاً — {{ $doneTasks->count() }} منجزة، {{ $lateTasks->count() }} متأخرة تحتاج متابعة</p>
@endsection

@section('topbar_actions')
<button class="btn btn-outline" onclick="exportTasks()">📥 تصدير</button>
<button type="button" class="btn btn-primary" onclick="openModal()">＋ مهمة جديدة</button>
@endsection

@section('content')

@if ($errors->any())
    <div style="background:#fee2e2;color:#991b1b;border-radius:16px;padding:14px;margin-bottom:16px;font-weight:700">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div style="background:#dcfce7;color:#166534;border-radius:16px;padding:14px;margin-bottom:16px;font-weight:700">
        {{ session('success') }}
    </div>
@endif

<div class="mini-stats-row">
    <div class="mini-stat-card">
        <div class="ms-icon" style="background:#f1f5f9">📋</div>
        <div><div class="ms-num" style="color:var(--muted)">{{ $totalTasks }}</div><div class="ms-label">الكل</div></div>
    </div>

    <div class="mini-stat-card">
        <div class="ms-icon" style="background:#f0fdf4">✅</div>
        <div><div class="ms-num" style="color:var(--green)">{{ $doneTasks->count() }}</div><div class="ms-label">منجزة</div></div>
    </div>

    <div class="mini-stat-card">
        <div class="ms-icon" style="background:#eff6ff">🔄</div>
        <div><div class="ms-num" style="color:var(--blue)">{{ $progressTasks->count() }}</div><div class="ms-label">قيد التنفيذ</div></div>
    </div>

    <div class="mini-stat-card">
        <div class="ms-icon" style="background:#fff7ed">⚠️</div>
        <div><div class="ms-num" style="color:var(--orange)">{{ $lateTasks->count() }}</div><div class="ms-label">متأخرة</div></div>
    </div>

    <div class="mini-stat-card">
        <div class="ms-icon" style="background:#faf5ff">👥</div>
        <div><div class="ms-num" style="color:var(--purple)">{{ $team->members->count() }}</div><div class="ms-label">أعضاء الفريق</div></div>
    </div>
</div>

<div class="filter-bar">
    <div class="filter-tabs">
        <button class="ftab active">الكل ({{ $totalTasks }})</button>
        <button class="ftab">لم تبدأ ({{ $todoTasks->count() }})</button>
        <button class="ftab">قيد التنفيذ ({{ $progressTasks->count() }})</button>
        <button class="ftab">متأخرة ({{ $lateTasks->count() }})</button>
        <button class="ftab">منجزة ({{ $doneTasks->count() }})</button>
    </div>

    <div class="filter-right">
        <input class="search-input" placeholder="🔍 ابحث عن مهمة...">

        <select class="filter-select">
            <option>كل الأعضاء</option>
            @foreach($team->members as $member)
                <option>{{ $member->name }}</option>
            @endforeach
        </select>

        <select class="filter-select">
            <option>كل الحالات</option>
            <option>لم تبدأ</option>
            <option>قيد التنفيذ</option>
            <option>منجزة</option>
        </select>
    </div>
</div>

<div class="kanban">

    <div class="kanban-col">
        <div class="col-head todo">
            <span>⬜ لم تبدأ</span>
            <div class="col-count">{{ $todoTasks->count() }}</div>
        </div>

        @forelse($todoTasks as $task)
            @include('student.partials.task_card', ['task' => $task, 'type' => 'todo'])
        @empty
            <div style="padding:14px;color:var(--muted);font-size:.8rem">لا توجد مهام لم تبدأ.</div>
        @endforelse
    </div>

    <div class="kanban-col">
        <div class="col-head progress">
            <span>🔄 قيد التنفيذ</span>
            <div class="col-count">{{ $progressTasks->count() }}</div>
        </div>

        @forelse($progressTasks as $task)
            @include('student.partials.task_card', ['task' => $task, 'type' => 'progress'])
        @empty
            <div style="padding:14px;color:var(--muted);font-size:.8rem">لا توجد مهام قيد التنفيذ.</div>
        @endforelse
    </div>

    <div class="kanban-col">
        <div class="col-head" style="background:#fef2f2;color:var(--red)">
            <span>🔴 متأخرة</span>
            <div class="col-count" style="background:var(--red)">{{ $lateTasks->count() }}</div>
        </div>

        @forelse($lateTasks as $task)
            @include('student.partials.task_card', ['task' => $task, 'type' => 'late'])
        @empty
            <div style="padding:14px;color:var(--muted);font-size:.8rem">لا توجد مهام متأخرة.</div>
        @endforelse
    </div>

    <div class="kanban-col">
        <div class="col-head done">
            <span>✅ منجزة</span>
            <div class="col-count">{{ $doneTasks->count() }}</div>
        </div>

        @forelse($doneTasks as $task)
            @include('student.partials.task_card', ['task' => $task, 'type' => 'done'])
        @empty
            <div style="padding:14px;color:var(--muted);font-size:.8rem">لا توجد مهام منجزة.</div>
        @endforelse
    </div>

</div>

<div class="modal-overlay" id="modal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">＋ إضافة مهمة جديدة</div>
            <button class="modal-close" onclick="closeModal()" type="button">✕</button>
        </div>

        <form method="POST" action="{{ route('student.tasks.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">اسم المهمة *</label>
                <input name="title" class="form-input" required placeholder="مثال: تطوير صفحة Dashboard">
            </div>

            <div class="form-group">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-textarea" placeholder="وصف تفصيلي للمهمة..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">المسؤول</label>
                    <select name="assigned_to" class="form-select">
                        <option value="">بدون تحديد</option>
                        @foreach($team->members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">الموعد النهائي *</label>
                    <input name="deadline" class="form-input" type="date" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-select" required>
                    <option value="TODO">⬜ لم تبدأ</option>
                    <option value="IN_PROGRESS">🔄 قيد التنفيذ</option>
                    <option value="DONE">✅ منجزة</option>
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" style="flex:1" type="submit">✓ حفظ المهمة</button>
                <button class="btn btn-outline" type="button" onclick="closeModal()">إلغاء</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openModal() {
    document.getElementById('modal').classList.add('open');
}

function closeModal() {
    document.getElementById('modal').classList.remove('open');
}

document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

document.querySelectorAll('.ftab').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

const navTasks = document.getElementById('nav-tasks');
if (navTasks) navTasks.classList.add('active');
</script>
@endsection