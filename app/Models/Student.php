<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // مهم لو عايز تسجيل دخول
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'password',
        'phone',
        'parent_phone',
        'stage',
        'section',
        'educational_type',
        'class',
        'is_language',
        'dark_mode',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;

    // ** دالة الحصول علي الاسم الأول للطالب
    public function getFirstNameAttribute()
    {
        $parts = explode(' ', trim($this->name));
        $prefixes = ['عبد', 'أبو', 'أم', 'آل'];

        if (count($parts) > 1 && in_array($parts[0], $prefixes)) {
            return $parts[0] . ' ' . $parts[1];
        }
        return $parts[0];
    }
}