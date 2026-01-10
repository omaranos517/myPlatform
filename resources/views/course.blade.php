<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - اسم المنصة التعليمية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/course.css',
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
    <div class="course-container">
        <h2 class="course-title">{{ $course->title }}</h2>
        <p class="course-description">{{ $course->description ?? 'لا يوجد وصف للكورس' }}</p>

        <h3>الدروس المرتبطة بهذا الكورس</h3>
        
        @if($course->lessons->count() > 0)
        <button class="toggle-all-btn" id="toggleAllBtn">
            <i class="fas fa-expand-alt"></i>
            فتح/إغلاق كل الدروس
        </button>
        @endif
        
        <div class="lessons-container">
            @forelse($course->lessons as $index => $lesson)
                <div class="lesson-wrapper">
                    <button class="lesson-toggle" onclick="toggleLesson({{ $index }})">
                        <span>{{ $index + 1 }}. {{ $lesson->title }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <div class="lesson-content" id="lessonContent{{ $index }}">
                        <p>{{ $lesson->description ?? 'لا يوجد وصف للدرس' }}</p>
                        
                        @if($lesson->explanation_url || $lesson->solution_url)
                        <div class="lesson-links">
                            @if($lesson->explanation_url)
                                <a href="{{ $lesson->explanation_url }}" class="video-link" target="_blank">
                                    <i class="fas fa-play-circle"></i> مشاهدة الشرح
                                </a>
                            @endif
                            
                            @if($lesson->solution_url)
                                <a href="{{ $lesson->solution_url }}" class="solution-link" target="_blank">
                                    <i class="fas fa-file-alt"></i> مشاهدة الحل
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h4>لا توجد دروس لهذا الكورس حتى الآن</h4>
                    <p>سيتم إضافة الدروس قريباً بإذن الله</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer Section -->
    <x-footer 
        :platformName="$settings->platform_name"
        :socialLinks="$socialLinks"
        :phone="$settings->phone"
        :email="$settings->email"
    />
    <!-- Back To Top -->
    @include('partials.backToTopBtn')

    @vite([
        'resources/js/loading-screen.js',
        'resources/js/header.js',
        'resources/js/footer.js',
        'resources/js/backToTopBtn.js',
        'resources/js/backBtn.js',
    ])
</body>
</html>