@extends('layouts.student')

@section('title', 'GradSmart — سجل الأنشطة')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/activities.css') }}?v={{ time() }}">
@endsection

@section('page_title')
<h1>📜 سجل الأنشطة</h1>
<p>كل العمليات والتحديثات الخاصة بحسابك ومشروعك</p>
@endsection

@section('content')

<div class="activities-page">

    <div class="activities-hero">
        <div>
            <span class="hero-badge">Activity Log</span>
            <h2>سجل الأنشطة</h2>
            <p>
                هنا يمكنك متابعة آخر العمليات التي تمت داخل النظام مثل إنشاء مشروع،
                إضافة مهمة، رفع ملف، أو تحديث حالة العمل.
            </p>
        </div>

        <div class="hero-count">
            <strong>{{ $activities->count() }}</strong>
            <span>نشاط</span>
        </div>
    </div>

    <div class="activities-toolbar">
        <div class="activity-search">
            <span>🔍</span>
            <input type="text" id="activitySearch" placeholder="ابحث في الأنشطة...">
        </div>

        <a href="{{ route('student.dashboard') }}" class="back-btn">
            ← العودة للوحة التحكم
        </a>
    </div>

    <div class="activities-card" id="activitiesList">

        @forelse($activities as $activity)

            @php
                $type = $activity->entity_type ?? 'general';

                $icon = match($type) {
                    'project' => '📋',
                    'task' => '✅',
                    'file' => '📁',
                    'team' => '👥',
                    'message' => '💬',
                    'supervisor' => '👨‍🏫',
                    default => '✨',
                };

                $colorClass = match($type) {
                    'project' => 'blue',
                    'task' => 'green',
                    'file' => 'purple',
                    'team' => 'orange',
                    'message' => 'teal',
                    'supervisor' => 'pink',
                    default => 'gray',
                };
            @endphp

            <div class="activity-row"
                 data-text="{{ strtolower($activity->action . ' ' . $activity->entity_type) }}">

                <div class="activity-icon {{ $colorClass }}">
                    {{ $icon }}
                </div>

                <div class="activity-content">
                    <h3>{{ $activity->action }}</h3>

                    <p>
                        النوع:
                        <strong>{{ $activity->entity_type ?? 'عام' }}</strong>
                    </p>

                    <span>
                        🕒
                        {{ $activity->timestamp ? \Carbon\Carbon::parse($activity->timestamp)->diffForHumans() : 'غير محدد' }}
                    </span>
                </div>

            </div>

        @empty

            <div class="empty-activities">
                <div>📭</div>
                <h3>لا توجد أنشطة بعد</h3>
                <p>
                    عندما يتم إنشاء مشروع أو مهمة أو رفع ملف، ستظهر الأنشطة هنا.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection

@section('scripts')
<script>
const navDashboard = document.getElementById('nav-dashboard');
if (navDashboard) navDashboard.classList.add('active');

const activitySearch = document.getElementById('activitySearch');
const activityRows = document.querySelectorAll('.activity-row');

if (activitySearch) {
    activitySearch.addEventListener('keyup', function () {
        const value = this.value.toLowerCase();

        activityRows.forEach(row => {
            row.style.display = row.dataset.text.includes(value) ? '' : 'none';
        });
    });
}
</script>
@endsection