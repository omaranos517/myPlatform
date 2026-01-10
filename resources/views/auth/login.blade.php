<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - {{ $settings->platform_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/shared.css',
        'resources/css/login.css',
        'resources/css/header.css',
    ])
</head>
<body>
    <!-- Header -->
    <x-header show-nav-btns="" />
    <!-- Login Form -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-user-lock"></i>تسجيل الدخول</h2>
                <p>سجل الدخول لتكمل رحلتك معنا</p>
            </div>
            
            <div class="login-form">
                <form action="{{ route('login.process') }}" method="POST">
                    <div class="form-group">
                        @csrf
                        <label for="phone"><i class="fas fa-phone"></i> رقم الهاتف</label>
                        <div class="input-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                inputmode="numeric"
                                pattern="01[0125][0-9]{8}"
                                maxlength="11"
                                required
                                placeholder="أدخل رقم هاتفك"
                                title="أدخل رقم الهاتف"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            />
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> كلمة المرور</label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="أدخل كلمة المرور" 
                                required
                            >
                            <span class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="error-box">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <button type="submit" class="btn">
                        <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                    </button>
                </form>
                <div class="login-footer">
                    <p>ليس لديك حساب؟ <a href="{{ route('signup.showForm') }}">أنشئ حسابًا الآن</a></p>
                    <p style="margin-top: 10px;">
                        <a href="#">نسيت كلمة المرور؟ (قادمة لاحقا)</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @vite([
        'resources/js/login.js',
        'resources/js/header.js',
    ])
</body>
</html>