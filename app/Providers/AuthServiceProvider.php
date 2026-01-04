<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Student;
use App\Policies\StudentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    // تسجيل الـ Policies
    protected $policies = [
        Student::class => StudentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // هنا ممكن تضيف Gates إضافية لو حبيت
    }
}
