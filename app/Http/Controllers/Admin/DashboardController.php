<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Administrator;
use App\Models\Subject;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_input' => 'required',
            'password' => 'required',
        ]);

        $login = $credentials['login_input'];
        $password = $credentials['password'];

        // تحقق من البريد أو الهاتف
        if (Auth::guard('admin')->attempt(['email' => $login, 'password' => $password], $request->has('remember')) ||
            Auth::guard('admin')->attempt(['phone' => $login, 'password' => $password], $request->has('remember'))
        ) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'login_error' => 'بيانات الدخول غير صحيحة',
        ])->withInput();
    }

    public function showSignupForm()
    {
        return view('admin.signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:administrators,email',
            'phone' => ['required', 'regex:/^01[0-9]{9}$/'],
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string',
        ]);

        // أول أدمن؟
        $permissions = null;

        if (Administrator::count() === 0) {
            $permissions = [
                "manage_students" => true,
                "manage_subjects" => true,
                "manage_lessons" => true,
                "access_support" => true,
            ];
        }

        $admin = Administrator::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'permissions' => $permissions,
        ]);

        auth('admin')->login($admin);

        return redirect()->route('admin.dashboard')
            ->with('success', 'تم إنشاء الحساب الإداري بنجاح');
    }
    
    public function index()
    {
        $user = Auth::guard('admin')->user();

        $studentCount = Student::query()->count();
        $adminCount = Administrator::query()->count();
        $subjectCount = Subject::query()->count();
        $lessonCount = Lesson::query()->count();

        return view('admin.dashboard', compact(
            'user', 'studentCount', 'adminCount', 'subjectCount', 'lessonCount'
        ));
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view('admin.subjects', compact('subjects'));
    }

    public function students(Request $request)
    {
        $perPage = $request->get('rows_per_page', 10);

        $students = Student::query()
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        // قيم التصفية
        $stages = Student::whereNotNull('stage')->distinct()->pluck('stage')->sort()->values()->toArray();
        $sections = Student::whereNotNull('section')->distinct()->pluck('section')->sort()->values()->toArray();
        $types = Student::whereNotNull('educational_type')->distinct()->pluck('educational_type')->sort()->values()->toArray();


        return view('admin.students', [
            'students' => $students,
            'stages' => $stages,
            'sections' => $sections,
            'types' => $types,
        ]);
    }

    public function admins()
    {
        $admins = Administrator::all();
        return view('admin.admins', compact('admins'));
    }

    public function stats()
    {
        return response()->json([
            'studentCount' => Student::count(),
            'adminCount' => Administrator::count(),
            'subjectCount' => Subject::count(),
            'lessonCount' => Lesson::count(),
        ]);
    }

}
