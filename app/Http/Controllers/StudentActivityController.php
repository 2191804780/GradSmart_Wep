<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class StudentActivityController extends Controller
{
    // عرض صفحة سجل الأنشطة الخاصة بالطالب
    public function index()
    {
        $user = Auth::user();

        // جلب أنشطة الطالب من قاعدة البيانات
        $activities = ActivityLog::where('user_id', $user->id)
            ->latest('timestamp')
            ->get();

        return view('student.activities', compact('activities'));
    }
}