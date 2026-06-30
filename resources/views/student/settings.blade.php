@extends('layouts.student')

@section('title', 'الإعدادات')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/student/settings.css') }}" ?v= {{ time() }}>

@endsection
@section('content')

<div class="settings-page">

    <div class="page-header">
        <h2>⚙️ الإعدادات</h2>
        <p>يمكنك إدارة حسابك وتعديل بياناتك الشخصية.</p>
    </div>

    {{-- معلومات الحساب --}}
    <div class="settings-card">

        <h3>👤 معلومات الحساب</h3>

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">

                <label>الاسم</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$user->name) }}">
            </div>

            <div class="form-group">

                <label>البريد الإلكتروني</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email',$user->email) }}">
            </div>

            <button class="save-btn">
                💾 حفظ التعديلات
            </button>

        </form>

    </div>


    {{-- تغيير كلمة المرور --}}

    <div class="settings-card">

        <h3>🔒 تغيير كلمة المرور</h3>

        <form action="{{ route('student.password.update') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>كلمة المرور الحالية</label>

                <input
                    type="password"
                    name="current_password">

            </div>

            <div class="form-group">

                <label>كلمة المرور الجديدة</label>

                <input
                    type="password"
                    name="password">

            </div>

            <div class="form-group">

                <label>تأكيد كلمة المرور</label>

                <input
                    type="password"
                    name="password_confirmation">

            </div>

            <button class="save-btn">

                🔒 تغيير كلمة المرور

            </button>

        </form>

    </div>


    {{-- تسجيل الخروج --}}

    <div class="settings-card danger">

        <h3>🚪 تسجيل الخروج</h3>

        <p>
            سيتم إنهاء الجلسة الحالية.
        </p>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button class="logout-btn">

                تسجيل الخروج

            </button>

        </form>

    </div>

</div>

@endsection