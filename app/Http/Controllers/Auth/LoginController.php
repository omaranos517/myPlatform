<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    public function process(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^01[0-9]{9}$/'],
            'password' => 'required|string',
        ]);

        if (Auth::guard('student')->attempt([
            'phone' => $request->phone,
            'password' => $request->password,
        ])) {

            $request->session()->regenerate(); // أمان

            return redirect()->route('home');
        }

        return back()->with('error', 'بيانات تسجيل الدخول غير صحيحة');
    }
}