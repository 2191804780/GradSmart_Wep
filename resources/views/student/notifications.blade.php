@extends('layouts.student')

@section('title', 'GradSmart — الإشعارات')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/notifications.css') }}">
@endsection

@section('content')

<div class="notifications-wrapper">

    <div class="notifications-hero">
        <div>
            <span class="page-badge">🔔 مركز الإشعارات</span>
            <h1>الإشعارات</h1>
            <p>تابع آخر التنبيهات الخاصة بالفريق، المشروع، المهام، والملفات.</p>
        </div>

        <div class="hero-count">
            <strong>{{ $notifications->where('is_read', false)->count() }}</strong>
            <span>غير مقروءة</span>
        </div>
    </div>

    <div class="notifications-card">

        @forelse($notifications as $notification)

            <div class="notification-row {{ $notification->is_read ? 'read' : 'unread' }}">
                <div class="notification-icon">
                    @switch($notification->type)
                        @case('task') ✅ @break
                        @case('file') 📁 @break
                        @case('message') 💬 @break
                        @case('team') 👥 @break
                        @case('project') 📋 @break
                        @default 🔔
                    @endswitch
                </div>

                <div class="notification-info">
                    <h3>{{ $notification->message }}</h3>
                    <p>
                        {{ $notification->created_at ? \Carbon\Carbon::parse($notification->created_at)->diffForHumans() : 'غير محدد' }}
                    </p>
                </div>

                @if(! $notification->is_read)
                    <span class="new-label">جديد</span>
                @endif
            </div>

        @empty

            <div class="empty-notifications">
                <div class="empty-icon">🔕</div>
                <h2>لا توجد إشعارات بعد</h2>
                <p>عندما يحدث أي تحديث في مشروعك ستظهر الإشعارات هنا.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection