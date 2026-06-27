<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    public function showLogin()
{
    $departments = Department::all();

    return view('Index', compact('departments'));
}

public function showRegister()
{
    $departments = Department::all();

    return view('Index', compact('departments'));
}
    public function register(Request $request)
{
    $roleName = $request->role_name === 'SUPERVISOR' ? 'SUPERVISOR' : 'STUDENT';

    $rules = [
        'role_name' => 'required|in:STUDENT,SUPERVISOR',
        'name' => 'required|string|max:100',
        'email' => [
                   'required',
                    'email',
                     'max:150',
                    'unique:users,email',
                     'regex:/^[A-Za-z0-9._%+-]+@uot\.edu\.ly$/'],

        'password' => 'required|string|min:6',
        'department_id' => 'required|exists:departments,id',
    ];

    if ($roleName === 'STUDENT') {
        $rules['student_id'] = 'required|string|max:20|unique:users,student_id';
    }

    
    $validator = validator::make($request->all(), $rules);

      if ($validator->fails()) {
       return redirect('/')
        ->withErrors($validator)
        ->withInput()
        ->with('active_tab', 'register');
         }
    $role = Role::where('role_name', $roleName)->first();

    User::create([
        'student_id' => $roleName === 'STUDENT' ? $request->student_id : null,
        'department_id' => $request->department_id,
        'is_department_head' => false,
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role_id' => $role?->id ?? 1,
        'is_active' => true,
    ]);

    return redirect('/login')->with('success', 'تم إنشاء الحساب بنجاح، يمكنك الآن تسجيل الدخول.');
  }
        public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
            ])->withInput();
        }

        $request->session()->regenerate();

        $role = Auth::user()->role?->role_name;

        return match ($role) {
            'ADMIN' => redirect('/admin/dashboard'),
            'SUPERVISOR' => redirect('/supervisor/dashboard'),
            default => redirect('/student/dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}