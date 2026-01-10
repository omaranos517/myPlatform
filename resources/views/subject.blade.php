<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($subject['name']) }} - اسم المنصة التعليمية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/subject.css',
        'resources/css/shared.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/loading-screen.css',
        'resources/css/backToTopBtn.css',
        'resources/css/backBtn.css',
    ])
</head>
<body>
    <!-- Header -->
    <x-header show-nav-btns="" />
    <!-- Back Button -->
    @include('partials.backBtn')
    <div class="lessons-container">
        @forelse($courses as $course)
            <div class="lesson-card">
                <div class="lesson-header">
                    <h3 class="lesson-title">{{ $course->title }}</h3>
                </div>
                <div class="lesson-content">
                    <p>{{ $course->description ?? 'لا يوجد وصف للكورس حتى الآن' }}</p>
                    <a href="{{ route('courses.show', $course->id) }}" class="video-link">
                        <i class="fas fa-arrow-circle-right"></i> استعراض الكورس
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>لا توجد كورسات متاحة حالياً</h3>
                <p>سيتم إضافة الكورسات قريباً بإذن الله</p>
            </div>
        @endforelse
    </div>
    <!-- Footer -->
    <x-footer 
        :platformName="$settings->platform_name"
        :socialLinks="$socialLinks"
        :phone="$settings->phone"
        :email="$settings->email"
        :footerLinks=null
    />
    <!-- back to top button -->
    @include('partials.backToTopBtn')

    @vite([
        'resources/js/loading-screen.js',
        'resources/js/header.js',
        'resources/js/footer.js',
        'resources/js/backToTopBtn.js',
        'resources/js/backBtn.js',
    ])
    <script>
        // تشغيل تأثيرات الظهور عند التحميل
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.dispatchEvent(new Event('scroll'));
            }, 100);
        });
    </script>
</body>
</html>