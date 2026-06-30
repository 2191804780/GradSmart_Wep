@extends('layouts.student')

@section('title', 'GradSmart — الملف الشخصي')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/profile.css') }}">
@endsection

@section('page_title')
<h1>👤 الملف الشخصي</h1>
<p>GradSmart — بيانات حسابك وفريقك ومشروعك</p>
@endsection

@section('content')

@if(session('success'))
    <div class="profile-alert success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="profile-alert error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="profile-wrapper">

    <div class="profile-hero">

        <div class="profile-user">

            <div class="profile-avatar">
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile">
                @else
                    <span>{{ mb_substr($user->name, 0, 1) }}</span>
                @endif
            </div>

            <div>
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>

                <div class="profile-badges">
                    <span>🎓 طالب</span>
                    <span>{{ $user->is_active ? '🟢 نشط' : '🔴 غير نشط' }}</span>
                </div>
            </div>

        </div>

        <a href="{{ route('student.settings') }}" class="profile-edit-btn">
            ⚙️ تعديل البيانات
        </a>

    </div>

    <div class="profile-stats">

        <div class="profile-stat-card">
            <div class="stat-icon">👥</div>
            <strong>{{ $team?->members?->count() ?? 0 }}</strong>
            <span>أعضاء الفريق</span>
        </div>

        <div class="profile-stat-card">
            <div class="stat-icon">📋</div>
            <strong>{{ $project ? 'نعم' : 'لا' }}</strong>
            <span>مشروع مرتبط</span>
        </div>

        <div class="profile-stat-card">
            <div class="stat-icon">📊</div>
            <strong>{{ $project->progress ?? 0 }}%</strong>
            <span>تقدم المشروع</span>
        </div>

        <div class="profile-stat-card">
            <div class="stat-icon">🏫</div>
            <strong>{{ $team?->department?->name ?? 'غير محدد' }}</strong>
            <span>القسم</span>
        </div>

    </div>

    <div class="profile-grid">

        <div class="profile-card">
            <div class="card-title">📌 بيانات الحساب</div>

            <div class="info-row">
                <span>الاسم الكامل</span>
                <strong>{{ $user->name }}</strong>
            </div>

            <div class="info-row">
                <span>البريد الإلكتروني</span>
                <strong>{{ $user->email }}</strong>
            </div>

            <div class="info-row">
                <span>الرقم القيد</span>
                <strong>{{ $user->student_id ?? 'غير مسجل' }}</strong>
            </div>

            <div class="info-row">
                <span>حالة الحساب</span>
                <strong>{{ $user->is_active ? 'نشط' : 'غير نشط' }}</strong>
            </div>
        </div>

        <div class="profile-card">
            <div class="card-title">👥 بيانات الفريق</div>

            <div class="info-row">
                <span>اسم الفريق</span>
                <strong>{{ $team->name ?? 'لا يوجد فريق' }}</strong>
            </div>

            <div class="info-row">
                <span>القسم</span>
                <strong>{{ $team?->department?->name ?? 'غير محدد' }}</strong>
            </div>

            <div class="info-row">
                <span>عدد الأعضاء</span>
                <strong>{{ $team?->members?->count() ?? 0 }}</strong>
            </div>

            <div class="info-row">
                <span>كود الدعوة</span>
                <strong>{{ $team->invite_code ?? 'غير متاح' }}</strong>
            </div>
        </div>

        <div class="profile-card wide">
            <div class="card-title">📋 بيانات المشروع</div>

            <div class="info-row">
                <span>عنوان المشروع</span>
                <strong>{{ $project->title ?? 'لا يوجد مشروع بعد' }}</strong>
            </div>

            <div class="info-row">
                <span>حالة المشروع</span>
                <strong>{{ $project->status ?? 'غير محدد' }}</strong>
            </div>

            <div class="info-row">
                <span>نسبة التقدم</span>
                <strong>{{ $project->progress ?? 0 }}%</strong>
            </div>

            <div class="profile-progress">
                <div style="width: {{ $project->progress ?? 0 }}%"></div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
const navProfile = document.getElementById('nav-profile');
if (navProfile) navProfile.classList.add('active');
</script>
@endsection