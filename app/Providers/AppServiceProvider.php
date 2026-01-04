<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Administrator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-admins', function (Administrator $user) {
            return $user->role === 'super_admin';
        });

        Gate::define('manage-students', function (Administrator $user) {
            return in_array($user->role, ['admin', 'super_admin']);
        });

        Gate::define('manage-content', function (Administrator $user) {
            return in_array($user->role, ['content_manager', 'admin', 'super_admin']);
        });

        Gate::define('view-reports', function (Administrator $user) {
            return in_array($user->role, ['support', 'content_manager', 'admin', 'super_admin']);
        });
    }

}
