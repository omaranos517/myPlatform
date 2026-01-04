<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // الأعمدة اللي مسموح بالتعبئة الجماعية (Mass Assignment)
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'explanation_url',
        'solution_url',
    ];

    // العلاقة مع الكورس
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
