<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        return view('profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();

        try {
            $request->validate([
                'name' => 'required|string',
                'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/'],
                'parent_phone' => ['required', 'regex:/^01[0125][0-9]{8}$/', 'different:phone'],
            ]);

            $student->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'parent_phone' => $request->parent_phone,
            ]);

            return back()->with('profile_success', 'تم تحديث البيانات بنجاح');
        } catch (\Expection $e) {
            return back()->withErrors(['profile_error' => 'حدث خطأ أثناء تحديث البيانات. يرجى المحاولة مرة أخرى.']);
        }
    }

    public function updateAcademic(Request $request)
    {
        try {
            $request->validate([
                'stage' => 'required',
                'class' => 'required',
                'educational_type' => 'required',
                'section' => 'nullable',
            ]);

            $student = Auth::guard('student')->user();

            $student->update([
                'stage' => $request->stage,
                'class' => $request->class,
                'educational_type' => $request->educational_type,
                'section' => $request->section,
                'is_language' => $request->has('is_language'),
            ]);

            return back()->with('academic_success', 'تم تحديث المعلومات الدراسية');
        } catch (\Exception $e) {
            return back()->withError('academic_error', 'حدث خطأ أثناء تحديث المعلومات الدراسية. يرجى المحاولة مرة أخرى.');
        }
    }

    public function changePassword(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $student->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('password_success', 'تم تغيير كلمة المرور بنجاح');
    }
}
