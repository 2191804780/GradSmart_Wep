<div class="topbar">

    <div class="page-title">

        @hasSection('page_title')
            @yield('page_title')
        @else

            <h1>
                مرحباً {{ auth()->user()->name }} 👋
            </h1>

            <p>
                {{ now()->translatedFormat('l، d F Y') }}
                —
                إليك ملخص مشروعك
            </p>

        @endif

    </div>

    <div class="topbar-actions">

        @hasSection('topbar_actions')
            @yield('topbar_actions')
        @else

            {{-- زر الوضع الليلي --}}
            <button
                class="theme-toggle-btn"
                id="themeToggle"
                aria-label="تبديل المظهر">
                🌙
            </button>

            {{-- زر الإشعارات --}}
            @php
                $notificationCount = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();
            @endphp

            <a href="/student/notifications" class="notification-btn">

                🔔

                @if($notificationCount > 0)
                    <span class="notif-dot"></span>
                @endif

            </a>

        @endif

    </div>

</div>