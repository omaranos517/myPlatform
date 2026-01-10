<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Administrator;
use App\Models\Setting;
use App\Models\SocialLink;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // الصلاحيات
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

        // مشاركة الإعدادات
        if (Schema::hasTable('settings')) {
            $settings = Setting::first() ?? (object)[
                'platform_name' => '(اسم المنصة)',
                'phone' => '201557582785',
                'email' => 'info@al-azhari.edu',
            ];
            View::share('settings', $settings);
        }

        // مشاركة روابط التواصل الاجتماعي
        if (Schema::hasTable('social_links')) {
            $socialLinks = SocialLink::all()->pluck('url', 'name')->toArray();
            View::share('socialLinks', $socialLinks);
        }
    }
}
