<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>

    <!-- Shared Styles -->
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body id="app" @class(['dark-mode' => $darkMode])>
    <x-flash-message />
    <x-support-model />

    <!-- Header -->
    <x-header :show-nav-btns="$showNavBtns" />

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <x-footer
        :platformName="$settings->platform_name"
        :expanded="$footerExpanded"
        :socialLinks="$socialLinks"
        :phone="$settings->phone"
        :email="$settings->email"
    />
    <script>
        window.APP_DARK_MODE = @json($darkMode);
    </script>
    <!--  Shared Scripts -->
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>