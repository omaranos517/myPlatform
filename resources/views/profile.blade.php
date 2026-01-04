<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحساب - الأزهري</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/shared.css',
        'resources/css/profile.css',
        'resources/css/header.css',
        'resources/css/loading-screen.css',
        'resources/css/backBtn.css',
    ])
</head>
<body>
    <!-- Header -->
    @include('partials.header', ['showNavBtns' => 'account'])
    <!-- Back Button -->
    @include('partials.backBtn')
    <!-- Main Content -->
    <div class="main-container">
        <div class="welcome-banner">
            <h2><i class="fas fa-user-cog"></i> إدارة الحساب</h2>
            <p>مرحباً {{ $student['name'] }}، يمكنك هنا إدارة معلومات حسابك الشخصية</p>
        </div>
        
        <div class="account-container">
            <!-- معلومات الحساب -->
            <div class="account-card">
                <h3><i class="fas fa-user"></i> المعلومات الشخصية</h3>
                
                @if (session('profile_success'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> تم تحديث معلوماتك بنجاح
                    </div>
                @elseif (session('profile_error'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ session('profile_error') }}
                    </div>
                @endif
                
                <form method="POST" action="">
                    <input type="hidden" name="update_profile" value="1">
                    
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> الاسم الكامل</label>
                        <input type="text" id="name" name="name" value="{{ htmlspecialchars($student['name']) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> رقم الهاتف</label>
                        <div class="input-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text" id="phone" name="phone" inputmode="numeric" pattern="01[0125][0-9]{8}" 
                                   maxlength="11" value="{{ htmlspecialchars($student['phone']) }}" required
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="parent_phone"><i class="fas fa-user-friends"></i> رقم ولي الأمر</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="text" id="parent_phone" name="parent_phone" inputmode="numeric" 
                                   pattern="01[0125][0-9]{8}" maxlength="11" 
                                   value="{{ htmlspecialchars($student['parent_phone']) }}" required
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>
                    
                    <button type="submit">
                        <i class="fas fa-save"></i> حفظ التغييرات
                    </button>
                </form>
            </div>
            
            <!-- المعلومات الدراسية -->
            <div class="account-card">
                <div class="edit-toggle">
                    <h3><i class="fas fa-graduation-cap"></i> المعلومات الدراسية</h3>
                    <button class="edit-btn" onclick="toggleEditMode('academic-form', 'academic-info')">
                        <i class="fas fa-edit"></i> تعديل
                    </button>
                </div>
                
                @if (session('academic_success'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> {{ session('academic_success') }}
                    </div>
                @elseif (session('academic_error'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>  {{ session('academic_error') }}
                    </div>
                @endif
                
                <!-- نموذج التعديل (مخفي في البداية) -->
                <form method="POST" action="" id="academic-form" style="display: none;">
                    <input type="hidden" name="update_academic" value="1">
                    
                    <div class="form-group">
                        <label for="stage"><i class="fas fa-graduation-cap"></i> المرحلة الدراسية</label>
                        <select name="stage" id="stage" required onchange="toggleSection()">
                            <option value="" disabled>اختر المرحلة</option>
                            <option value="إعدادية" <?php echo $student['stage'] === 'إعدادية' ? 'selected' : ''; ?>>إعدادية</option>
                            <option value="ثانوية" <?php echo $student['stage'] === 'ثانوية' ? 'selected' : ''; ?>>ثانوية</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="class"><i class="fas fa-book"></i> الصف الدراسي</label>
                        <select name="class" id="class" required onchange="toggleSection()">
                            <option value="" disabled>اختر الصف</option>
                            <option value="الأول" <?php echo $student['class'] === 'الأول' ? 'selected' : ''; ?>>الأول</option>
                            <option value="الثاني" <?php echo $student['class'] === 'الثاني' ? 'selected' : ''; ?>>الثاني</option>
                            <option value="الثالث" <?php echo $student['class'] === 'الثالث' ? 'selected' : ''; ?>>الثالث</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="educational_type"><i class="fas fa-school"></i> نوع الدراسة</label>
                        <select name="educational_type" id="educational_type" required onchange="toggleSection()">
                            <option value="" disabled>اختر نوع الدراسة</option>
                            <option value="أزهري" <?php echo $student['educational_type'] === 'أزهري' ? 'selected' : ''; ?>>أزهر</option>
                            <option value="عام" <?php echo $student['educational_type'] === 'عام' ? 'selected' : ''; ?>>عام</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="section-field">
                        <label for="section"><i class="fas fa-chalkboard"></i> القسم</label>
                        <select name="section" id="section">
                            <option value="" disabled>اختر القسم</option>
                            <option value="علمي" <?php echo $student['section'] === 'علمي' ? 'selected' : ''; ?>>علمي</option>
                            <option value="أدبي" <?php echo $student['section'] === 'أدبي' ? 'selected' : ''; ?>>أدبي</option>
                        </select>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_language" id="is_language" value="1" <?php echo $student['is_language'] ? 'checked' : ''; ?>>
                        <label for="is_language" style="display: inline; font-weight: normal;">هل تدرس لغات؟</label>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit">
                            <i class="fas fa-save"></i> حفظ
                        </button>
                        <button type="button" class="btn-danger" onclick="cancelEdit('academic-form', 'academic-info')">
                            <i class="fas fa-times"></i> إلغاء
                        </button>
                    </div>
                </form>
                
                <!-- عرض المعلومات (ظاهر في البداية) -->
                <div id="academic-info">
                    <div class="info-group">
                        <strong>المرحلة الدراسية</strong>
                        <span>{{ htmlspecialchars($student['stage']) }}</span>
                    </div>
                    
                    <div class="info-group">
                        <strong>الصف الدراسي</strong>
                        <span>{{ htmlspecialchars($student['class']) }}</span>
                    </div>
                    
                    <div class="info-group">
                        <strong>نوع الدراسة</strong>
                        <span>{{ htmlspecialchars($student['educational_type']) }}</span>
                    </div>
                    
                    <div class="info-group">
                        <strong>القسم</strong>
                        <span>{{ htmlspecialchars($student['section']) }}</span>
                    </div>
                    
                    <div class="info-group">
                        <strong>دراسة اللغات</strong>
                        <span>{{ $student['is_language'] ? 'نعم' : 'لا' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- تغيير كلمة المرور -->
            <div class="account-card">
                <h3><i class="fas fa-lock"></i> تغيير كلمة المرور</h3>
                
                @if (session('password_success'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> تم تغيير كلمة المرور بنجاح
                    </div>
                @endif
                
                @if (session('corrent_password'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ session('corrent_password') }}
                    </div>
                @endif
                
                <form method="POST" action="">
                    <input type="hidden" name="change_password" value="1">
                    
                    <div class="form-group">
                        <label for="current_password"><i class="fas fa-key"></i> كلمة المرور الحالية</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="current_password" name="current_password" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password"><i class="fas fa-key"></i> كلمة المرور الجديدة</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="new_password" name="new_password" required minlength="6">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password"><i class="fas fa-check-circle"></i> تأكيد كلمة المرور</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
                        </div>
                    </div>
                    
                    <button type="submit">
                        <i class="fas fa-sync-alt"></i> تغيير كلمة المرور
                    </button>
                </form>
            </div>
            
            <!-- إحصائيات الحساب -->
            <div class="account-card">
                <h3><i class="fas fa-chart-bar"></i> إحصائيات الحساب</h3>
                
                <div class="info-group">
                    <strong>تاريخ إنشاء الحساب</strong>
                    <span>{{ date('Y-m-d', strtotime($student['created_at'])) }}</span>
                </div>
                
                <div class="info-group">
                    <strong>آخر تحديث للحساب</strong>
                    <span>{{ date('Y-m-d', strtotime($student['updated_at'])) }}</span>
                </div>
                
                <div class="info-group">
                    <strong>حالة الحساب</strong>
                    <span style="color: var(--success);">نشط</span>
                </div>
                
                <button class="btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> حذف الحساب
                </button>
            </div>
        </div>
    </div>

    @vite([
        'resources/js/profile.js',
        'resources/js/header.js',
        'resources/js/loading-screen.js',
        'resources/js/backBtn.js',
    ])
</body>
</html>