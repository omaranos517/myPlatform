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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;
}
