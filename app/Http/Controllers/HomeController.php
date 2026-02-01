<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('student')->user();
        $subjects = collect();

        if ($user) {
            $subjects = Subject::where('stage', $user->stage)
                ->where('class', $user->class)
                ->where('section', $user->section)
                ->where('educational_type', $user->educational_type)
                ->where('is_language', $user->is_language)
                ->get();
        }

        // استخراج الاسم الأول (عبد الله / عبد الرحمن ...)
        $firstName = '';
        if ($user && $user->name) {
            $parts = explode(' ', trim($user->name));
            $firstName = ($parts[0] === 'عبد' && isset($parts[1]))
                ? $parts[0] . ' ' . $parts[1]
                : $parts[0];
        }

        return view('pages.Home.home', [
            'subjects' => $subjects,
            'firstName' => $firstName,
            'totalStudents' => rand(500, 5000),
            'successRate' => rand(80, 95),
            'totalTeachers' => rand(10, 50),
            'ParentalSatisfaction' => rand(85, 98),
        ]);
    }
}