@extends('layouts.app')

@section('title', 'إنشاء حساب - ' . $settings->platform_name)

@section('content')
    <!-- Signin Container -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-user-plus"></i> إنشاء حساب جديد</h2>
                <p>انضم إلى اسم المنصة التعليمية وابدأ رحلة التعلم</p>
            </div>
        
            <div class="form-container">
                <form action="{{ route('signup.process') }}" method="POST" onsubmit="return validateForm();">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> الاسم الكامل</label>
                        <input type="text" name="name" id="name" placeholder="أدخل اسمك الثلاثي" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <div class="error-box">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    
                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> رقم الهاتف</label>
                        <div class="input-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text" name="phone" id="phone" inputmode="numeric" pattern="01[0125][0-9]{8}" maxlength="11" title="رقم الهاتف خاطئ" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="01XXXXXXXXX" required>
                        </div>
                    </div>
                    @error('phone')
                        <div class="error-box">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="parent_phone"><i class="fas fa-phone"></i> رقم ولي الأمر</label>
                        <div class="input-icon">
                            <i class="fas fa-user-friends"></i>
                            <input type="text" name="parent_phone" id="parent_phone" inputmode="numeric" pattern="01[0125][0-9]{8}" maxlength="11" title="رقم الهاتف خاطئ" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="01XXXXXXXXX" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> كلمة السر</label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" id="password" placeholder="كلمة السر (6 أحرف على الأقل)" required>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="password-strength-bar"></div>
                        </div>
                    </div>
                    @error('password')
                        <div class="error-box">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="confirm_password"><i class="fas fa-lock"></i> تأكيد كلمة السر</label>
                        <div class="input-icon">
                            <i class="fas fa-check-circle"></i>
                            <input type="password" name="password_confirmation" id="confirm_password" placeholder="أعد إدخال كلمة السر" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="stage"><i class="fas fa-graduation-cap"></i> المرحلة الدراسية</label>
                        <select name="stage" id="stage" required>
                            <option value="" disabled selected>اختر المرحلة</option>
                            <option value="إعدادية">إعدادية</option>
                            <option value="ثانوية">ثانوية</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="class"><i class="fas fa-book"></i> الصف الدراسي</label>
                        <select name="class" id="class" required>
                            <option value="" disabled selected>اختر الصف</option>
                            <option value="الأول">الأول</option>
                            <option value="الثاني">الثاني</option>
                            <option value="الثالث">الثالث</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="educational_type"><i class="fas fa-school"></i> نوع الدراسة</label>
                        <select name="educational_type" id="educational_type" required>
                            <option value="" disabled selected>اختر نوع الدراسة</option>
                            <option value="أزهري">أزهر</option>
                            <option value="عام">عام</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="sectionDiv">
                        <label for="section"><i class="fas fa-chalkboard"></i> القسم</label>
                        <select name="section" id="section">
                            <option value="" disabled selected>اختر القسم</option>
                            <option value="علمي">علمي</option>
                            <option value="أدبي">أدبي</option>
                        </select>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_language" id="is_language" value="1">
                        <label for="is_language">هل تدرس لغات؟</label>
                    </div>

                    <div id="errorBox" class="error-box" style="display:none;">
                        <i class="fas fa-exclamation-circle"></i> <span id="errorText"></span>
                    </div>

                    <button type="submit" class="btn"><i class="fas fa-user-plus"></i> إنشاء حساب</button>
                </form>
                @if ($errors->any())
                    <div class="error-box">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                
                <div class="login-link">
                    <p>هل لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل الدخول الآن</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $showNavBtns = '';
    $footerExpanded = false;
@endphp

@pushOnce('styles')
    @vite( 'resources/css/pages/signup.css' )
@endpushOnce
@pushOnce('scripts')
    @vite( 'resources/js/pages/signup.js' )
@endpushOnce