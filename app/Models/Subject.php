<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'stage',
        'class',
        'section',
        'educational_type',
        'is_language'
    ];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
