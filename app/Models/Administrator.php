<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // مهم عشان المسؤول يقدر يسجل دخول
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrators';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'permissions',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public $timestamps = true;
}

