<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <title>@yield('title')</title>

    <!-- Shared Styles -->
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body>
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
    <!--  Shared Scripts -->
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>