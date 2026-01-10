<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // الأعمدة اللي يمكن كتابتها مباشرة (Mass assignable)
    protected $fillable = [
        'platform_name',
        'phone',
        'email',
    ];
}
