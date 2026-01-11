@extends('layouts.app')

@section('title', 'تسجيل الدخول - ' . $settings->platform_name)

@section('content')
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
    <!-- Footer -->
    <x-footer :platformName="$settings->platform_name" />
@endsection

@pushOnce('styles')
    @vite('resources/css/pages/login.css')
@endpushOnce
@pushOnce('scripts')
    @vite('resources/js/pages/login.js')
@endpushOnce
