<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // 🔍 البحث بالاسم أو الإيميل
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }


        // 🎯 الفلترة
        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }

        if ($request->filled('educational_type')) {
            $query->where('educational_type', $request->educational_type);
        }

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $students = $query->paginate(10)->withQueryString();

        $stats = [
            'total' => Student::count(),
            'preparatory' => Student::where('stage', 'إعدادية')->count(),
            'secondary' => Student::where('stage', 'ثانوية')->count(),
            'azhari' => Student::where('educational_type', 'أزهري')->count(),
        ];

        return view('admin.students.index', compact('students', 'stats'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:students,phone,' . $student->id,
            'parent_phone' => 'required|string',
            'stage' => 'required',
            'class' => 'required',
            'section' => 'required',
            'educational_type' => 'required',
            
        ]);

        $student->update($data);

        return redirect()->route('admin.students.index')
            ->with('success', 'تم تحديث بيانات الطالب');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        
        return redirect()->back()->with('success', 'تم حذف الطالب');
    }
}
