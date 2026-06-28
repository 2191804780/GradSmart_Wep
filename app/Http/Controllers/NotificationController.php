<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * عرض صفحة الإشعارات
     */
   public function index()
{
    $notifications = Notification::where('user_id', Auth::id())
        ->latest('created_at')
        ->get();

    Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->update([
            'is_read' => true
        ]);

    return view('student.notifications', compact('notifications'));
}
}