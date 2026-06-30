<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentAccountController extends Controller
{
    // عرض صفحة الملف الشخصي
    public function profile()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['department', 'project'])
            ->first();

        $project = $team?->project;

        return view('student.profile', compact('user', 'team', 'project'));
    }

    // عرض صفحة الإعدادات
    public function settings()
    {
        $user = Auth::user();

        return view('student.settings', compact('user'));
    }

    // تحديث بيانات الحساب
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
           
        ]);

       

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'تم تحديث بيانات الحساب بنجاح.');
    }

    // تغيير كلمة المرور
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'كلمة المرور الحالية غير صحيحة.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'تم تسجيل الخروج بنجاح.');
    }
}