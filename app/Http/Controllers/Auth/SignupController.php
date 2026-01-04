<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;



class SignupController extends Controller
{
    public function showForm()
    {
        return view('auth.signup'); // صفحة التسجيل
    }

    public function process(Request $request)
    {
        $compoundPrefixes = ["عبد", "نور", "علاء", "سيف", "زين", "شمس", "صدر"];
        //dd($request->all());

        // Validate basic fields
        $request->validate([
            'name' => 'required|string',
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/', 'unique:students,phone'],
            'parent_phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'stage' => ['required', Rule::in(['إعدادية', 'ثانوية'])],
            'class' => ['required', Rule::in(['الأول','الثاني','الثالث'])],
            'section' => 'nullable|string',
            'educational_type' => ['required', Rule::in(['عام','أزهري'])],
            'is_language' => 'nullable|boolean',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $parent_phone = $request->input('parent_phone');
        $stage = $request->input('stage');
        $class = $request->input('class');
        $section = $request->input('section') ?? 'علمي';
        $educational_type = $request->input('educational_type');
        $is_language = $request->has('is_language') ? 1 : 0;
        $password = $request->input('password');

        // التحقق من الاسم الثلاثي
        $parts = preg_split('/\s+/', trim($name));
        $adjustedParts = [];
        for ($i = 0; $i < count($parts); $i++) {
            if (in_array($parts[$i], $compoundPrefixes) && isset($parts[$i + 1])) {
                $adjustedParts[] = $parts[$i] . ' ' . $parts[$i + 1];
                $i++;
            } else {
                $adjustedParts[] = $parts[$i];
            }
        }

        if (count($adjustedParts) < 3) {
            return back()->withInput()->withErrors(['name' => 'نريد الاسم الثلاثي على الأقل.']);
        }

        // منع رقم الطالب من أن يطابق رقم ولي الأمر
        if ($phone === $parent_phone) {
            return back()->withInput()->withErrors(['phone' => 'رقم الطالب لا يجب أن يطابق رقم ولي الأمر.']);
        }

        // منع الأرقام المتكررة مثل 11111111111
        if (preg_match('/^(\d)\1{10}$/', $phone) || preg_match('/^(\d)\1{10}$/', $parent_phone)) {
            return back()->withInput()->withErrors(['phone' => 'رقم الهاتف غير صالح (متكرر).']);
        }

        // إنشاء الطالب
        $student = Student::create([
            'name' => $name,
            'password' => Hash::make($password),
            'phone' => $phone,
            'parent_phone' => $parent_phone,
            'stage' => $stage,
            'section' => $section,
            'class' => $class,
            'educational_type' => $educational_type,
            'is_language' => $is_language,
        ]);

        // تسجيل دخول الطالب مباشرة بعد التسجيل
        Auth::guard('student')->login($student);

        return redirect()->route('home'); // صفحة بعد التسجيل
    }
}
