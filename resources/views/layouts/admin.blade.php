<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GradSmart — بوابة المسؤول')</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-theme');
        }
    </script>
    
    @yield('styles')
</head>
<body>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
        }
    </script>

    @include('layouts.admin_sidebar')

    <!-- ══ MAIN ══ -->
    <div class="main">
        @include('layouts.admin_topbar')

        @yield('content')
    </div>

    <!-- Global Theme Toggle Script -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            const toggleIcon = themeToggle.querySelector('.toggle-icon') || themeToggle;
            
            if (localStorage.getItem('theme') === 'dark') {
                toggleIcon.textContent = '☀️';
            } else {
                toggleIcon.textContent = '🌙';
            }

            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-theme');
                const isDark = document.body.classList.contains('dark-theme');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                toggleIcon.textContent = isDark ? '☀️' : '🌙';
            });
        }
    </script>

    @yield('scripts')
</body>
</html>
