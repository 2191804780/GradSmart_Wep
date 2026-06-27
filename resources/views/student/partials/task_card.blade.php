@php
    $isLate = $task->status !== 'DONE'
        && $task->deadline
        && \Carbon\Carbon::parse($task->deadline)->isPast();

    $cardClass = $type;

    $statusText = match($task->status) {
        'TODO' => 'لم تبدأ',
        'IN_PROGRESS' => 'قيد التنفيذ',
        'DONE' => 'منجزة',
        default => $task->status,
    };

    $progress = match($task->status) {
        'TODO' => 0,
        'IN_PROGRESS' => 50,
        'DONE' => 100,
        default => 0,
    };

    $titleStyle = $task->status === 'DONE'
        ? 'text-decoration:line-through;color:var(--muted)'
        : '';

    $cardStyle = $task->status === 'DONE'
        ? 'opacity:.85'
        : '';

    $topStyle = $isLate
        ? 'margin-top:20px'
        : '';

    $fillColor = $task->status === 'DONE'
        ? 'var(--green)'
        : ($isLate ? 'var(--red)' : 'var(--blue)');
@endphp

<div class="task-card {{ $cardClass }}" style="{{ $cardStyle }}">
    @if($isLate)
        <div class="late-badge">متأخرة!</div>
    @endif

    <div class="tc-top" style="{{ $topStyle }}">
        <span class="tc-priority {{ $isLate ? 'pri-high' : 'pri-medium' }}">
            {{ $isLate ? 'عالية' : 'متوسطة' }}
        </span>
        <span class="tc-menu">⋮</span>
    </div>

    <div class="tc-title" style="{{ $titleStyle }}">
        {{ $task->title }}
    </div>

    <div class="tc-desc">
        {{ $task->description ?? 'لا يوجد وصف لهذه المهمة.' }}
    </div>

    <span class="tc-cat" style="background:#eff6ff;color:var(--blue)">
        {{ $statusText }}
    </span>

    <div class="tc-progress">
        <div class="tcp-top">
            <span>التقدم</span>
            <span>{{ $progress }}%</span>
        </div>

        <div class="tcp-track">
            <div class="tcp-fill" style="width:{{ $progress }}%;background:{{ $fillColor }}"></div>
        </div>
    </div>

    <div class="tc-footer">
        <div class="tc-assignees">
            <div class="assignee-avatar" style="background:var(--blue)">
                {{ $task->assignee ? mb_substr($task->assignee->name, 0, 1) : '؟' }}
            </div>
        </div>

        <div class="tc-date {{ $isLate ? 'late-date' : '' }}">
            📅 {{ $task->deadline }}
        </div>

        <div class="tc-comments">
            👤 {{ $task->assignee->name ?? 'غير محدد' }}
        </div>
    </div>
</div>