<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Student\AccountController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/signup', [SignupController::class, 'showForm'])->name('signup.showForm');
Route::post('/signup', [SignupController::class, 'process'])->name('signup.process');

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'process'])->name('login.process');

Route::get('/support', function () {
    abort(503, 'Support system under development');
})
->name('guest.support.submit');

/*
|--------------------------------------------------------------------------
| Student Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:student')->group(function () {

    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile');
    Route::post('/account/academic', [AccountController::class, 'updateAcademic'])->name('account.academic');
    Route::post('/account/password', [AccountController::class, 'changePassword'])->name('account.password');
    Route::delete('/account/delete-account', [AccountController::class, 'deleteAccount'])->name('account.delete');

    // صفحة المادة (ID إجباري)
    Route::get('/subject/{subject}', [SubjectController::class, 'show'])
        ->name('subjects.show');

    Route::get('/course/{course}', [SubjectController::class, 'showCourse'])->name('courses.show');

    Route::post('/support', function () {
        abort(503, 'Support system under development');
    })
    ->name('support.submit');

    Route::post('/logout', function () {
        auth('student')->logout();
        return redirect()->route('home');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function() {
    // صفحة تسجيل الدخول للإداري
    Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [DashboardController::class, 'login'])->name('admin.login.process');
    Route::get('/signup', [DashboardController::class, 'showSignupForm'])->name('admin.signup');
    Route::post('/signup', [DashboardController::class, 'signup'])->name('admin.signup.process');

    // جميع الصفحات المحمية للوحة الإدارة
    Route::middleware('auth:admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::middleware('can:manage-content')->group(function () {
            Route::get('/courses', [DashboardController::class, 'courses'])
                ->name('admin.courses');

            Route::get('/subjects', [DashboardController::class, 'subjects'])
                ->name('admin.subjects');
        });

        Route::middleware('can:manage-students')->group(function () {

            Route::get('/students', [StudentController::class, 'index'])
                ->name('admin.students.index');
            
            Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
                ->name('admin.students.edit');

            Route::put('/students/{student}', [StudentController::class, 'update'])
                ->name('admin.students.update');
                
            Route::delete('/students/{student}', [StudentController::class, 'destroy'])
                ->name('admin.students.destroy');
        });


        Route::middleware('can:manage-admins')
            ->get('/admins', [DashboardController::class, 'admins'])
            ->name('admin.admins');
            
        Route::get('/stats', [DashboardController::class, 'stats'])->name('admin.stats');
        Route::post('/logout', function () {
            auth('admin')->logout();
            return redirect()->route('admin.login');
        })->name('admin.logout');
        // أي صفحات أخرى للإدارة
    });
});