<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول المشرفين - {{ $settings->platform_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --gray: #7f8c8d;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4efe9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }
        
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
            padding: 25px;
            text-align: center;
            color: white;
        }
        
        .login-header h2 {
            font-size: 28px;
            margin: 0;
        }
        
        .login-header p {
            margin-top: 10px;
            opacity: 0.9;
        }
        
        .login-form-container {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-group label i {
            color: var(--primary);
        }
        
        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .error-box {
            background: #ffebee;
            color: var(--danger);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--danger);
        }
        
        .error-box i {
            margin-left: 5px;
        }
        
        .success-box {
            background: #e8f5e9;
            color: var(--success);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--success);
        }
        
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
        }
        
        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .input-icon input {
            padding-left: 45px;
        }
        
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .remember-me input {
            width: auto;
        }
        
        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-form-container {
                padding: 20px;
            }
            
            .login-options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-user-shield"></i> تسجيل دخول المشرفين</h2>
            <p>يجب أن يكون لديك صلاحية الدخول إلى هذه الصفحة</p>
        </div>
        
        <div class="login-form-container">
            <form id="adminLoginForm" method="POST" action="{{ route('admin.login.process') }}">
                @csrf
                <div class="form-group">
                    <label for="login_input"><i class="fas fa-user"></i> البريد الإلكتروني أو رقم الهاتف</label>
                    <div class="input-icon">
                        <i class="fas fa-at"></i>
                        <input type="text" name="login_input" id="login_input" placeholder="أدخل بريدك الإلكتروني أو رقم هاتفك" required value="{{ old('login_input') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> كلمة المرور</label>
                    <div class="input-icon">
                        <i class="fas fa-key"></i>
                        <input type="password" name="password" id="password" placeholder="أدخل كلمة المرور" required>
                    </div>
                </div>
                
                <div class="login-options">
                    
                    
                    <div class="forgot-password">
                        <a href="forgot_password.php">نسيت كلمة المرور؟</a>
                    </div>
                </div>

                @if ($errors->has('login_error'))
                    <div class="error-box">
                        <i class="fas fa-exclamation-circle"></i> {{ $errors->first('login_error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="success-box">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <button type="submit"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</button>
            </form>
            
            <div class="register-link">
                <p>ليس لديك حساب؟ <a href="{{ route('admin.signup') }}">إنشاء حساب إداري جديد</a></p>
            </div>
        </div>
    </div>

    <script>
        // المراجع
        const loginForm = document.getElementById("adminLoginForm");
        const loginInput = document.getElementById("login_input");
        const passwordEl = document.getElementById("password");
        const errorBoxes = document.querySelectorAll(".error-box");

        // إضافة مستمعي الأحداث للحقول
        loginInput.addEventListener('input', clearError);
        passwordEl.addEventListener('input', clearError);

        // مسح الخطأ
        function clearError() {
            errorBoxes.forEach(box => {
                box.style.display = "none";
            });
        }

        // التحقق قبل الإرسال
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            if (loginInput.value.trim() === '') {
                isValid = false;
            }
            
            if (passwordEl.value === '') {
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert("يرجى ملء جميع الحقول المطلوبة");
            }
        });
    </script>
</body>
</html>