<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم {{ $settings->platform_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/dashboard.css'
    ])
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <h1>نظام {{ $settings->platform_name }} التعليمي</h1>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    @php
                        $firstName = explode(' ', $user->name)[0];
                    @endphp
                    <div>مرحباً، {{ $firstName }}</div>
                    <div style="font-size: 12px; opacity: 0.8;">
                        آخر دخول: {{ $user->last_login_at ? $user->last_login_at->format('d-m-Y H:i') : 'اليوم (ستفعل قريباً)' }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="welcome-banner animate__animated animate__fadeIn">
            <div class="welcome-text">
                <h2>مرحباً بك في لوحة التحكم</h2>
                @if ($user->role === 'super_admin')
                    <p>يمكنك من هنا إدارة جميع جوانب النظام التعليمي ومتابعة أداء الطلاب</p>
                @elseif ($user->role === 'admin')
                    <p>يمكنك من هنا إدارة المحتوى، المستخدمين، والتقارير (بدون صلاحيات النظام العام)</p>
                @elseif ($user->role === 'content_manager')
                    <p>يمكنك من هنا إدارة المحتوى التعليمي مثل الدروس والاختبارات</p>
                @elseif ($user->role === 'support')
                    <p>يمكنك من هنا تقديم الدعم الفني والمساعدة للمستخدمين</p>
                @endif
            </div>
            <div class="date-display">
                <div class="day" id="current-day">الثلاثاء</div>
                <div class="date" id="current-date">6 يناير 2009</div>
            </div>
        </div>
        
        <div class="stats-section animate__animated animate__fadeInUp animate__delay-1s">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $studentCount }}</h3>
                    <p>طالب مسجل</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $subjectCount }}</h3>
                    <p>مادة دراسية</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $lessonCount }}</h3>
                    <p>درس مضافة</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $adminCount }}</h3>
                    <p>مشرفين وإداريين</p>
                </div>
            </div>
        </div>

        <div class="dashboard-cards">
            @can('manage-admins')
                <div class="card animate__animated animate__fadeInRight" onclick="window.location.href='{{ route('admin.admins') }}'">
                    <i class="fas fa-user-shield"></i>
                    <h2>إدارة الحسابات الإدارية</h2>
                    <p>إنشاء وإدارة حسابات المشرفين والإداريين في النظام التعليمي</p>
                    <a href="{{ route('admin.admins') }}" class="btn btn-admin">إنشاء حساب إداري</a>
                </div>
            @endcan

            @can('manage-students')
                <div class="card animate__animated animate__fadeInLeft" onclick="window.location.href='{{ route('admin.students.index') }}'">
                    <i class="fas fa-user-graduate"></i>
                    <h2>إدارة الطلاب</h2>
                    <p>إدارة حسابات الطلاب، تتبع تقدمهم، وتعديل بياناتهم الشخصية</p>
                    <a href="{{ route('admin.students.index') }}" class="btn">عرض قائمة الطلاب</a>
                </div>
            @endcan

            @can('manage-content')
                <div class="card animate__animated animate__fadeInLeft" onclick="window.location.href='{{ route('admin.subjects') }}'">
                    <i class="fas fa-book-open"></i>
                    <h2>إدارة المواد الدراسية</h2>
                    <p>إضافة، تعديل أو حذف المواد الدراسية مع تفاصيلها وربطها بالمناهج التعليمية</p>
                    <a href="{{ route('admin.subjects') }}" class="btn">الدخول إلى الإدارة</a>
                </div>
            @endcan

            @can('view-reports')
                <div class="card animate__animated animate__fadeInLeft">
                    <i class="fas fa-chart-line"></i>
                    <h2>التقارير والإحصائيات</h2>
                    <p>عرض تقارير مفصلة عن أداء الطلاب وإحصائيات استخدام النظام</p>
                    <button class="btn btn-disabled">قريباً</button>
                </div>
                <div class="card animate__animated animate__fadeInRight">
                    <i class="fas fa-question-circle"></i>
                    <h2>الدعم والمساعدة</h2>
                    <p>الوصول إلى دليل المستخدم، الأسئلة الشائعة، والدعم الفني</p>
                    <a href="#" class="btn">إنشاء محتوى جديد</a>
                </div>
            @endcan
        </div>
    </div>
    
    <a href="{{ route('admin.dashboard') }}" class="back-btn animate__animated animate__fadeInUp">
        <i class="fas fa-home" style="color: white; font-size: 24px;"></i>
    </a>
    
    <div class="footer">
        <p>© 2023 نظام {{ $settings->platform_name }} التعليمي. جميع الحقوق محفوظة.</p>
    </div>
    <script>
        window.statsUrl = "{{ route('admin.stats') }}";
    </script>
    @vite([
        'resources/js/dashboard.js'
    ])
</body>
</html>