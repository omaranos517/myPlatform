<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب إداري - (اسم المنصة)</title>
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
        
        .admin-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
        }
        
        .admin-header {
            background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
            padding: 25px;
            text-align: center;
            color: white;
        }
        
        .admin-header h2 {
            font-size: 28px;
            margin: 0;
        }
        
        .admin-header p {
            margin-top: 10px;
            opacity: 0.9;
        }
        
        .admin-form-container {
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
        
        input, select {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .password-strength {
            height: 5px;
            background: #eee;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 3px;
        }
        
        .weak {
            background: var(--danger);
            width: 33%;
        }
        
        .medium {
            background: var(--warning);
            width: 66%;
        }
        
        .strong {
            background: var(--success);
            width: 100%;
        }
        
        .error-box {
            background: #ffebee;
            color: var(--danger);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
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
            display: none;
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
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-link a:hover {
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
        
        .role-description {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 14px;
            display: none;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                max-width: 100%;
            }
            
            .admin-form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h2><i class="fas fa-user-shield"></i> إنشاء حساب إداري</h2>
            <p>أنشئ حساباً جديداً لأعضاء الفريق الإداري</p>
        </div>
        <div class="admin-form-container">
            <form action="{{ route('admin.signup.process') }}" method="POST" onsubmit="return validateAdminForm();">
                @csrf
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> الاسم الكامل</label>
                    <input type="text" name="name" id="name" placeholder="أدخل الاسم الكامل" required>
                </div>
                
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                    <div class="input-icon">
                        <i class="fas fa-at"></i>
                        <input type="email" name="email" id="email" placeholder="example@domain.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> رقم الهاتف</label>
                    <div class="input-icon">
                        <i class="fas fa-mobile-alt"></i>
                        <input type="text" name="phone" id="phone" inputmode="numeric" pattern="01[0125][0-9]{8}" maxlength="11" title="رقم الهاتف خاطئ" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="01XXXXXXXXX" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role"><i class="fas fa-user-tag"></i> الصلاحية</label>
                    <select name="role" id="role" required onchange="showRoleDescription()">
                        <option value="" disabled selected>اختر صلاحية المستخدم</option>
                        <option value="super_admin">مدير عام</option>
                        <option value="admin">مدير</option>
                        <option value="content_manager">مدير محتوى</option>
                        <option value="support">دعم فني</option>
                    </select>
                    <div id="roleDescription" class="role-description"></div>
                </div>
                
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> كلمة المرور</label>
                    <div class="input-icon">
                        <i class="fas fa-key"></i>
                        <input type="password" name="password" id="password" placeholder="كلمة المرور (6 أحرف على الأقل)" required>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="password-strength-bar"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password"><i class="fas fa-lock"></i> تأكيد كلمة المرور</label>
                    <div class="input-icon">
                        <i class="fas fa-check-circle"></i>
                        <input type="password" name="password_confirmation" id="confirm_password" placeholder="أعد إدخال كلمة المرور" required>
                    </div>
                </div>

                <div id="errorBox" class="error-box" style="display:none;">
                    <i class="fas fa-exclamation-circle"></i> <span id="errorText"></span>
                </div>
                
                @if (!empty($errors))
                    <div class="error-box">
                        <i class="fas fa-exclamation-circle"></i> 
                        @foreach ($errors as $error)
                            <p>{{ $error }}</p>
                        @endforeach;
                    </div>
                @endif;
                
                @if (isset($success))
                    <div class="success-box">
                        <i class="fas fa-check-circle"></i> {{ $success }}
                    </div>
                @endif

                <button type="submit"><i class="fas fa-user-plus"></i> إنشاء حساب إداري</button>
            </form>
            
            <div class="login-link">
                <p>العودة إلى <a href="administrators_login.php">صفحة تسجيل الدخول</a></p>
            </div>
        </div>
    </div>

    <script>
        // المراجع
        const nameEl = document.getElementById("name");
        const emailEl = document.getElementById("email");
        const passwordEl = document.getElementById("password");
        const confirmEl = document.getElementById("confirm_password");
        const phoneEl = document.getElementById("phone");
        const roleEl = document.getElementById("role");
        const errorBox = document.getElementById("errorBox");
        const errorText = document.getElementById("errorText");
        const passwordStrengthBar = document.getElementById("password-strength-bar");
        const roleDescription = document.getElementById("roleDescription");

        // إضافة مستمعي الأحداث للحقول
        nameEl.addEventListener('input', clearError);
        emailEl.addEventListener('input', clearError);
        phoneEl.addEventListener('input', clearError);
        passwordEl.addEventListener('input', function() {
            clearError();
            checkPasswordStrength(this.value);
        });
        confirmEl.addEventListener('input', clearError);
        roleEl.addEventListener('change', clearError);

        // إظهار وصف الصلاحية
        function showRoleDescription() {
            const role = roleEl.value;
            let description = "";
            
            switch(role) {
                case "super_admin":
                    description = "صلاحيات كاملة على النظام: إدارة المستخدمين، الصلاحيات، المحتوى، والإعدادات العامة.";
                    break;
                case "admin":
                    description = "صلاحيات إدارية: إدارة المحتوى، المستخدمين، والتقارير (بدون صلاحيات النظام العام).";
                    break;
                case "content_manager":
                    description = "إدارة المحتوى فقط: إضافة وتعديل الدروس، المواد، والاختبارات.";
                    break;
                case "support":
                    description = "صلاحيات الدعم الفني: الرد على استفسارات المستخدمين وحل المشكلات.";
                    break;
                default:
                    description = "";
            }
            
            roleDescription.textContent = description;
            roleDescription.style.display = description ? "block" : "none";
        }

        // التحقق من قوة كلمة السر
        function checkPasswordStrength(password) {
            passwordStrengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                return;
            }
            
            let strength = 0;
            
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            if (password.length >= 8) strength++;
            
            if (strength <= 2) {
                passwordStrengthBar.classList.add('weak');
            } else if (strength <= 4) {
                passwordStrengthBar.classList.add('medium');
            } else {
                passwordStrengthBar.classList.add('strong');
            }
        }

        // إظهار الخطأ
        function showError(message) {
            errorText.textContent = message;
            errorBox.style.display = "block";
        }

        // مسح الخطأ
        function clearError() {
            errorBox.style.display = "none";
            errorText.textContent = "";
        }

        // التحقق قبل الإرسال
        function validateAdminForm() {
            const phonePattern = /^01[0125][0-9]{8}$/;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nameEl.value.trim() === passwordEl.value) {
                showError("يجب أن تكون كلمة المرور مختلفة عن الاسم");
                return false;
            }

            if (passwordEl.value.length < 6) {
                showError("كلمة المرور يجب أن تكون 6 أحرف أو أكثر");
                return false;
            }

            if (!emailPattern.test(emailEl.value)) {
                showError("صيغة البريد الإلكتروني غير صحيحة");
                return false;
            }

            if (!phonePattern.test(phoneEl.value)) {
                showError("برجاء إدخال رقم هاتف صحيح");
                return false;
            }

            if (passwordEl.value !== confirmEl.value) {
                showError("كلمتا المرور غير متطابقتين");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>