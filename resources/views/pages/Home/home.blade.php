@extends('layouts.app')

@section('title', 'المنصة التعليمية الأولي - ' . $settings->platform_name)

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-content" id="hero-content">
            @auth
                <h1 class="animate__animated animate__fadeInDown">مرحبًا بك، {{$firstName}}! 🌟</h1>
                <p class="animate__animated animate__fadeInUp">سعداء بانضمامك إلى عائلة {{ $settings->platform_name }} للمرحلتين الإعدادية والثانوية.<br>أكبر منصة تعليمية متكاملة</p>
                <div class="hero-buttons animate__animated animate__fadeInUp">
                    <a href="#subjects" class="hero-btn primary">
                        <i class="fas fa-book"></i> ابدأ التعلم الآن
                    </a>
                    <a href="#stats" class="hero-btn secondary">
                        <i class="fas fa-chart-line"></i> إحصائيات المنصة
                    </a>
                </div>
            @endauth
            @guest
                <h1 class="animate__animated animate__fadeInDown">أهلاً بك في عائلة {{ $settings->platform_name }}</h1>
                <p class="animate__animated animate__fadeInUp">أكبر منصة تعليمية متكاملة في مصر للمرحلتين الإعدادية والثانوية<br>عام - أزهر - لغات</p>
                <div class="hero-buttons animate__animated animate__fadeInUp">
                    <a href="{{ route('signup.showForm') }}" class="hero-btn primary">
                        <i class="fas fa-user-plus"></i> انضم إلينا الآن
                    </a>
                    <a href="#features" class="hero-btn secondary">
                        <i class="fas fa-info-circle"></i> لماذا نختار {{ $settings->platform_name }}؟
                    </a>
                </div>
            @endguest
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section" id="stats">
        <h2 class="section-title">إحصائيات المنصة</h2>
        <div class="stats-grid">
            <x-stat-card icon="users" :value="$totalStudents" label="طالب وطالبة" />
            <x-stat-card icon="graduation-cap" :value="$successRate" label="نسبة نجاح الطلاب" />
            <x-stat-card icon="chalkboard-teacher" :value="$totalTeachers" label="مدرس متخصص" />
            <x-stat-card icon="smile" :value="$ParentalSatisfaction . '%'" label="رضا أولياء الأمور" />
        </div>
    </section>
    @auth
        <!-- Subjects Section -->
        <section class="subjects-section" id="subjects">
            <div class="subjects-container">
                @if ($subjects->count() > 0)
                    <h2 class="section-title">المواد الدراسية</h2>
                    <div class="subjects-grid">
                        @foreach ($subjects as $index => $subject)
                            <x-subject-card :subject="$subject" :index="$index" />
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-book-open-reader"></i>
                        <h3>لا توجد مواد دراسية حتى الآن</h3>
                        <p>سيتم إضافة المواد الدراسية قريباً حسب صفك وقسمك</p>
                    </div>
                @endif
            </div>
        </section>
    @endauth
    @guest
        <!-- Motivation Section -->
        <section class="motivation-section" id="features">
            <h2>ليه لازم تشترك معانا؟</h2>
            <div class="features">
                <div class="feature animate-on-scroll">
                    <i class="fas fa-clock"></i>
                    <h3>توفير الوقت</h3>
                    <p>دروس مباشرة وتسجيلات متاحة في أي وقت</p>
                </div>
                
                <div class="feature animate-on-scroll">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>توفير المال</h3>
                    <p>أسعار مناسبة تنافس الدروس الخصوصية</p>
                </div>
                
                <div class="feature animate-on-scroll">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>أفضل المدرسين</h3>
                    <p>مدرسين متخصصين بخبرة طويلة</p>
                </div>
                
                <div class="feature">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>نتائج مضمونة</h3>
                    <p>ضمان تحسن مستواك الدراسي</p>
                </div>
            </div>
        </section>
        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <h2 class="section-title">آراء طلابنا</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card animate-on-scroll">
                    <div class="testimonial-text">
                        "المنصة غيرت طريقة دراستي بالكامل، المدرسين بيشرحوا بطريقة رائعة والمواد منظمة جداً. النتيجة كانت تحسن ملحوظ في درجاتي!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">م</div>
                        <div class="author-info">
                            <h4>محمد أحمد</h4>
                            <p>طالب الصف الثاني الثانوي</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card animate-on-scroll">
                    <div class="testimonial-text">
                        "أفضل قرار اتخذته هو الاشتراك في اسم المنصة، وفرت عليّ مصاريف الدروس الخصوصية والنتيجة كانت ممتازة!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">س</div>
                        <div class="author-info">
                            <h4>سارة محمود</h4>
                            <p>طالبة الصف الأول الثانوي</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card animate-on-scroll">
                    <div class="testimonial-text">
                        "التسجيلات بتكون موجودة دايماً فبقدر أذاكر في أي وقت يناسبني، والمدرسين بيردوا على أسئلتي بسرعة كبيرة."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">ي</div>
                        <div class="author-info">
                            <h4>ياسمين علي</h4>
                            <p>طالبة الصف الثالث الإعدادي</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
    
    <!-- Back to Top Button -->
    @include('components.backToTopBtn')
@endsection

@php
    $showNavBtns = 'main';
    $footerExpanded = true;
@endphp

@pushOnce('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/components/backToTopBtn.css',
    ])
@endpushOnce
@pushOnce('scripts')
    @vite([
        'resources/js/pages/home.js',
        'resources/js/components/backToTopBtn.js',
    ])
@endpushOnce