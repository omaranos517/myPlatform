<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلاب</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
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
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        h1 {
            color: var(--secondary);
            margin: 0;
            font-size: 28px;
        }
        
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-add {
            background: var(--success);
            color: white;
        }
        
        .btn-edit {
            background: var(--primary);
            color: white;
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .btn-delete {
            background: var(--danger);
            color: white;
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .btn-view {
            background: var(--warning);
            color: white;
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .back-btn {
            background: var(--gray);
            color: white;
        }
        
        .filter-btn {
            background: var(--warning);
            color: white;
        }
        
        .btn-clear {
            background: var(--danger);
            color: white;
        }
        
        .btn-page {
            background: white;
            color: var(--primary);
            border: 1px solid #ddd;
            padding: 8px 14px;
        }
        
        .btn-page.active {
            background: var(--primary);
            color: white;
        }
        
        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .filter-group select, .filter-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Cairo', sans-serif;
        }
        
        .filter-group select:focus, .filter-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 10px;
        }
        
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }
        
        th, td {
            padding: 15px;
            border-bottom: 1px solid #eaeaea;
            text-align: center;
        }
        
        th {
            background: var(--primary);
            color: white;
            font-weight: 700;
            position: sticky;
            top: 0;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background: #f1f7ff;
        }
        
        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        
        .no-data {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
        }
        
        .no-data i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ddd;
        }
        
        .no-data h3 {
            color: var(--gray);
            margin-bottom: 10px;
        }
        
        .no-data p {
            color: #aaa;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .badge-stage {
            background: #e3f2fd;
            color: var(--primary);
        }
        
        .badge-type {
            background: #e8f5e9;
            color: var(--success);
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary);
            margin: 0 auto;
        }
        
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
            align-items: center;
        }
        
        .filter-tag {
            background: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .filter-tag i {
            cursor: pointer;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            text-align: center;
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .stat-title {
            color: var(--gray);
            font-size: 14px;
        }
        
        .stat-icon {
            font-size: 24px;
            color: var(--primary);
            opacity: 0.7;
        }
        
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .page-info {
            color: var(--gray);
            font-weight: 600;
        }
        
        .pagination {
            display: flex;
            gap: 5px;
        }
        
        .pagination .btn-page {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background: white;
            color: var(--primary);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .pagination .btn-page:hover {
            background: #f5f5f5;
        }
        
        .pagination .btn-page.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-success i {
            color: #28a745;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .controls {
                flex-direction: column;
            }
            
            .search-box {
                min-width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .filter-row {
                grid-template-columns: 1fr;
            }
            
            .stats {
                grid-template-columns: 1fr;
            }
            
            .pagination-container {
                flex-direction: column;
                gap: 15px;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 10px 5px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .filter-section {
                padding: 15px;
            }
            
            .stat-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- رسالة النجاح -->
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button class="btn" onclick="this.parentElement.style.display='none'" style="margin-left:auto; background:none; color:inherit; font-size:20px;">&times;</button>
        </div>
        @endif
        
        <!-- عنوان الصفحة -->
        <header>
            <h1>
                <i class="fas fa-users"></i>
                إدارة الطلاب
            </h1>
            <a href="#" class="btn btn-add">
                <i class="fas fa-plus"></i>
                إضافة طالب جديد
            </a>
        </header>
        
        <!-- إحصائيات سريعة -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-title">إجمالي الطلاب</div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['preparatory'] }}</div>
                <div class="stat-title">طلاب إعدادية</div>
                <div class="stat-icon">
                    <i class="fas fa-school"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['secondary']}}</div>
                <div class="stat-title">طلاب ثانوية</div>
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['azhari'] }}</div>
                <div class="stat-title">طلاب أزهري</div>
                <div class="stat-icon">
                    <i class="fas fa-mosque"></i>
                </div>
            </div>
        </div>
        
        <!-- قسم الفلترة -->
        <div class="filter-section">
            <form method="GET" action="{{ route('admin.students.index') }}">
                <div class="filter-row">
                    <!-- حقل البحث -->
                    <div class="filter-group">
                        <label>البحث عن طالب</label>
                        <div class="search-box">
                            <input type="text" name="search" 
                                   placeholder="ابحث بالاسم أو رقم الهاتف..." 
                                   value="{{ request('search') }}">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    
                    <!-- فلترة المرحلة -->
                    <div class="filter-group">
                        <label>المرحلة</label>
                        <select name="stage">
                            <option value="">جميع المراحل</option>
                            <option value="إعدادية" {{ request('stage') == 'إعدادية' ? 'selected' : '' }}>إعدادية</option>
                            <option value="ثانوية" {{ request('stage') == 'ثانوية' ? 'selected' : '' }}>ثانوية</option>
                        </select>
                    </div>
                    
                    <!-- فلترة النوع التعليمي -->
                    <div class="filter-group">
                        <label>النوع التعليمي</label>
                        <select name="educational_type">
                            <option value="">جميع الأنواع</option>
                            <option value="أزهري" {{ request('educational_type') == 'أزهري' ? 'selected' : '' }}>أزهري</option>
                            <option value="عام" {{ request('educational_type') == 'عام' ? 'selected' : '' }}>عام</option>
                        </select>
                    </div>
                    
                    <!-- فلترة الصف -->
                    <div class="filter-group">
                        <label>الصف</label>
                        <select name="class">
                            <option value="">جميع الصفوف</option>
                            <option value="الأول" {{ request('class') == 'الأول' ? 'selected' : '' }}>الأول</option>
                            <option value="الثاني" {{ request('class') == 'الثاني' ? 'selected' : '' }}>الثاني</option>
                            <option value="الثالث" {{ request('class') == 'الثالث' ? 'selected' : '' }}>الثالث</option>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="btn filter-btn">
                        <i class="fas fa-filter"></i>
                        تطبيق الفلترة
                    </button>
                    @if(request()->hasAny(['search', 'stage', 'educational_type', 'class']))
                    <a href="{{ route('admin.students.index') }}" class="btn btn-clear">
                        <i class="fas fa-times"></i>
                        إلغاء الفلترة
                    </a>
                    @endif
                </div>
            </form>
            
            <!-- الفلاتر النشطة -->
            @if(request()->hasAny(['search', 'stage', 'educational_type', 'class']))
            <div class="active-filters">
                <span>الفلاتر النشطة:</span>
                @if(request('search'))
                <div class="filter-tag">
                    بحث: {{ request('search') }}
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" style="color:white;">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @endif
                @if(request('stage'))
                <div class="filter-tag">
                    مرحلة: {{ request('stage') }}
                    <a href="{{ request()->fullUrlWithQuery(['stage' => null]) }}" style="color:white;">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @endif
                @if(request('educational_type'))
                <div class="filter-tag">
                    نوع: {{ request('educational_type') }}
                    <a href="{{ request()->fullUrlWithQuery(['educational_type' => null]) }}" style="color:white;">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @endif
                @if(request('class'))
                <div class="filter-tag">
                    صف: {{ request('class') }}
                    <a href="{{ request()->fullUrlWithQuery(['class' => null]) }}" style="color:white;">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>
        
        <!-- جدول الطلاب -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>الطالب</th>
                        <th>رقم الهاتف</th>
                        <th>رقم ولي الأمر</th>
                        <th>المرحلة</th>
                        <th>الصف</th>
                        <th>القسم</th>
                        <th>النوع التعليمي</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>
                            <div class="student-avatar">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                        </td>
                        <td>
                            <strong>{{ $student->name }}</strong>
                            @if($student->email)
                            <div style="color: var(--gray); font-size: 13px; margin-top: 3px;">
                                <i class="fas fa-envelope" style="margin-left: 5px;"></i>
                                {{ $student->email }}
                            </div>
                            @endif
                        </td>
                        <td>{{ $student->phone ?? 'غير محدد' }}</td>
                        <td>{{ $student->parent_phone ?? 'غير محدد' }}</td>
                        <td>
                            <span class="badge badge-stage">{{ $student->stage }}</span>
                        </td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->section }}</td>
                        <td>
                            <span class="badge badge-type">{{ $student->educational_type }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.students.edit', $student) }}" 
                                   class="btn btn-edit" 
                                   title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form method="POST" 
                                      action="{{ route('admin.students.destroy', $student) }}" 
                                      style="display:inline;"
                                      onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الطالب؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                
                                <a href="#" class="btn btn-view" title="عرض الملف">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="no-data">
                                <i class="fas fa-user-graduate"></i>
                                <h3>لا توجد بيانات</h3>
                                <p>لم يتم العثور على طلاب مطابقين لمعايير البحث</p>
                                @if(request()->hasAny(['search', 'stage', 'educational_type', 'class']))
                                <a href="{{ route('admin.students.index') }}" class="btn btn-clear" style="margin-top: 15px;">
                                    <i class="fas fa-times"></i>
                                    إلغاء جميع الفلاتر
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- الترقيم -->
        @if($students->hasPages())
        <div class="pagination-container">
            <div class="page-info">
                عرض <strong>{{ $students->firstItem() ?: 0 }}</strong> إلى <strong>{{ $students->lastItem() ?: 0 }}</strong> من أصل <strong>{{ $students->total() }}</strong> طالب
            </div>
            <div class="pagination">
                @if ($students->onFirstPage())
                    <span class="btn-page disabled">&laquo; السابق</span>
                @else
                    <a href="{{ $students->previousPageUrl() }}" class="btn-page">&laquo; السابق</a>
                @endif
                
                @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                    @if ($page == $students->currentPage())
                        <span class="btn-page active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn-page">{{ $page }}</a>
                    @endif
                @endforeach
                
                @if ($students->hasMorePages())
                    <a href="{{ $students->nextPageUrl() }}" class="btn-page">التالي &raquo;</a>
                @else
                    <span class="btn-page disabled">التالي &raquo;</span>
                @endif
            </div>
        </div>
        @endif
    </div>

    <script>
        // تأكيد الحذف
        function confirmDelete(event) {
            return confirm('هل أنت متأكد من رغبتك في حذف هذا الطالب؟');
        }
        
        // إخفاء رسائل النجاح تلقائياً بعد 5 ثواني
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 300);
                }, 5000);
            });
            
            // إضافة تأثيرات للجدول
            var tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(function(row, index) {
                row.style.animationDelay = (index * 0.05) + 's';
                row.style.animation = 'fadeIn 0.5s ease forwards';
            });
            
            // تنسيق أرقام الهواتف
            document.querySelectorAll('td:nth-child(3), td:nth-child(4)').forEach(function(cell) {
                var phone = cell.textContent.trim();
                if (phone && phone !== 'غير محدد' && /^\d+$/.test(phone.replace(/\s/g, ''))) {
                    var cleaned = phone.replace(/\D/g, '');
                    if (cleaned.length === 10) {
                        var formatted = cleaned.replace(/(\d{4})(\d{3})(\d{3})/, '$1 $2 $3');
                        cell.textContent = formatted;
                    }
                }
            });
        });
        
        // إضافة تأثير fadeIn
        var style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            tbody tr {
                opacity: 0;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>