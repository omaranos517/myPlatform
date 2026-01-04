<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        $student = Auth::guard('student')->user();

        // حماية: الطالب يشوف بس المواد الخاصة بيه
        if (
            $subject->stage !== $student->stage ||
            $subject->class !== $student->class ||
            $subject->educational_type !== $student->educational_type ||
            $subject->is_language != $student->is_language
        ) {
            abort(403);
        }

        $courses = $subject->courses()->orderBy('month')->get();

        return view('subject', [
            'subject' => $subject,
            'courses' => $courses,
        ]);
    }

    public function showCourse(Course $course) {
        $student = Auth::guard('student')->user();
        if (
            $course->subject->stage !== $student->stage ||
            $course->subject->class !== $student->class ||
            $course->subject->educational_type !== $student->educational_type ||
            $course->subject->is_language != $student->is_language
        ) {
            abort(403);
        }

        $course->load('lessons');
        return view('course', compact('course'));
    }
}
