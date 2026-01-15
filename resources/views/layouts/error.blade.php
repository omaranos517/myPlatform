<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('error-code') | {{ $settings->platform_name }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/errors.css',
        'resources/css/shared.css',
    ])
</head>
<body>
<main class="main-content">
    <section class="error-section">
        <div class="error-icon">
            <i class="@yield('error-icon')"></i>
        </div>
        <h1 class="error-code">@yield('error-code')</h1>
        <h2 class="error-title">@yield('error-title')</h2>
        <p class="error-description">@yield('error-description')</p>

        <div class="action-buttons">
            <a href="{{ route('home') }}" class="action-btn primary">
                <i class="fas fa-home"></i> العودة للصفحة الرئيسية
            </a>
            <button id="back-btn" class="action-btn secondary">
                <i class="fas fa-arrow-right"></i> العودة للصفحة السابقة
            </button>
        </div>
    </section>
</main>

@vite([
    'resources/js/errors.js',
    'resources/js/backBtn.js',
])
</body>
</html>
