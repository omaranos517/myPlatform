<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->platform_name }} - المنصة التعليمية الأولى</title>
    @vite([
        'resources/css/shared.css',
        'resources/css/home.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/backToTopBtn.css',
        'resources/css/loading-screen.css',
    ])
    <meta name="description" content="انضم إلى {{ $settings->platform_name }}، أكبر منصة تعليمية متكاملة في مصر للمرحلتين الإعدادية والثانوية. دروس مباشرة، تسجيلات، واختبارات تفاعلية مع أفضل المدرسين.">
    <meta name="keywords" content="{{ $settings->platform_name }}, منصة تعليمية, دروس أونلاين, المرحلة الإعدادية, المرحلة الثانوية, تعليم مصر, دروس خصوصية, مدرسين متخصصين">
    <meta name="author" content="The Platform Team">
    <meta property="og:title" content="{{ $settings->platform_name }} - المنصة التعليمية الأولى">
    <meta property="og:description" content="انضم إلى {{ $settings->platform_name }}، أكبر منصة تعليمية متكاملة في مصر للمرحلتين الإعدادية والثانوية. دروس مباشرة، تسجيلات، واختبارات تفاعلية مع أفضل المدرسين.">
    <meta property="og:image" content="https://www.alazhariplatform.com/GUI/light-mode-bg.png">
    <meta property="og:type" content="website">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <!-- Header -->
    <x-header show-nav-btns="main" />
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-content" id="hero-content">
            @auth
                @php
                    $firstName = explode(' ', trim(Auth::guard('student')->user()->name))[0];
                @endphp
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
                <p class="animate__animated animate__fadeInUp">أكبر منصة تعليمية متكاملة في مصر للمرحلتين الإعدادية والثانوية<br>أزهر - عام - لغات</p>
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
            <div class="stat-card animate-on-scroll">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{$totalStudents}}</div>
                <div class="stat-label">طالب وطالبة</div>
            </div>
            <div class="stat-card animate-on-scroll">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number">{{$successRate}}%</div>
                <div class="stat-label">نسبة النجاح</div>
            </div>
            <div class="stat-card animate-on-scroll">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-number">{{$totalTeachers}}</div>
                <div class="stat-label">مدرس متخصص</div>
            </div>
            <div class="stat-card animate-on-scroll">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-number">{{$ParentalSatisfaction}}%</div>
                <div class="stat-label">رضا أولياء الأمور</div>
            </div>
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
                            <div class="subject-card animate-on-scroll" style="transition-delay: {{$index * 0.1}}s">
                                <div class="subject-card-header">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="subject-card-body">
                                    <h3>{{$subject->name}}</h3>
                                    <p>استعد للتميز في هذه المادة مع أفضل المدرسين</p>
                                    <a href="{{ route('subjects.show', $subject) }}" class="subject-link">ابدأ التعلم الآن</a>
                                </div>
                            </div>
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
    <!-- Footer -->
    <x-footer 
        :platformName="$settings->platform_name"
        :socialLinks="$socialLinks"
        :phone="$settings->phone"
        :email="$settings->email"
    />
    <!-- Back to Top Button -->
    @include('partials.backToTopBtn')
    @vite([
        'resources/js/header.js',
        'resources/js/footer.js',
        'resources/js/loading-screen.js',
        'resources/js/home.js',
        'resources/js/backToTopBtn.js',
    ])
</body>
</html>
