<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentActivityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\MessageController;
use App\Models\Department;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StudentAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- General & Auth Routes ---


Route::get('/', function () {
    $departments = Department::all();
    return view('index', compact('departments'));
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
    return view('auth.forgot_password');
    })->name('password.request');
    
// --- Student Routes ---
Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])
    ->name('student.dashboard');

    Route::get('/dashboard-php', function () {
        return view('student.student_dashboard_php');
    });

    // صفحة سجل الأنشطة
     Route::get('/activities', [StudentActivityController::class, 'index'])
    ->name('student.activities.index');

    Route::get('/chat', function () {
        return view('student.student_chat');
    });
    
    Route::get('/project', [ProjectController::class, 'index'])->name('student.project.index');
    Route::post('/project', [ProjectController::class, 'store'])->name('student.project.store');

    Route::get('/chat', [MessageController::class, 'index'])
    ->name('student.chat.index');

    Route::post('/chat/send', [MessageController::class, 'store'])
    ->name('student.chat.send');
    
    Route::get('/file-upload', [FileController::class, 'index'])
    ->name('student.files.index');

    Route::post('/file-upload', [FileController::class, 'store'])
    ->name('student.files.store');

    Route::get('/file-upload/download/{file}', [FileController::class, 'download'])
    ->name('student.files.download');

    Route::delete('/file-upload/delete/{file}', [FileController::class, 'destroy'])
    ->name('student.files.destroy');

    Route::get('/files-upload/{file}/preview', [FileController::class, 'preview'])
    ->name('student.files.preview');

    Route::get('/sup-profile', function () {
        return view('student.sup_profile');
    });

    Route::get('/progress', [ProgressController::class, 'index'])
    ->name('student.progress.index');

    Route::get('/team-management', function () {
        return view('student.team_management');
    });

    Route::get('/task-detail', function () {
        return view('student.task_detail');
    });

    Route::get('/task-management', [TaskController::class, 'index'])
    ->name('student.tasks.index');

     Route::post('/task-management', [TaskController::class, 'store'])
    ->name('student.tasks.store');


    Route::get('/create-team', [TeamController::class, 'create'])->name('student.teams.create');
    Route::post('/create-team', [TeamController::class, 'store'])->name('student.teams.store');

    Route::get('/sup-projects', function () {
        return view('student.sup_projects');
    });
    
   Route::get('/team-management', [TeamController::class, 'management'])
    ->name('student.teams.management');

Route::post('/team-management/invite', [TeamController::class, 'inviteMember'])
    ->name('student.teams.invite');

Route::post('/team-management/make-leader/{member}', [TeamController::class, 'makeLeader'])
    ->name('student.teams.makeLeader');

Route::delete('/team-management/remove-member/{member}', [TeamController::class, 'removeMember'])
    ->name('student.teams.removeMember');

Route::post('/team-invitations/{invitation}/accept', [TeamController::class, 'acceptInvitation'])
    ->name('student.teams.acceptInvitation');

Route::post('/team-invitations/{invitation}/reject', [TeamController::class, 'rejectInvitation'])
    ->name('student.teams.rejectInvitation');
    
    Route::post('/project/request-supervisor/{supervisor}', [ProjectController::class, 'requestSupervisor'])
    ->name('student.project.requestSupervisor');

    Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('student.notifications');


Route::get('/profile', [StudentAccountController::class, 'profile'])
    ->name('student.profile');

Route::get('/settings', [StudentAccountController::class, 'settings'])
    ->name('student.settings');

Route::post('/profile/update', [StudentAccountController::class, 'updateProfile'])
    ->name('student.profile.update');

Route::post('/settings/password', [StudentAccountController::class, 'updatePassword'])
    ->name('student.password.update');

Route::post('/logout', [StudentAccountController::class, 'logout'])
    ->name('student.logout');

    // صفحة الإعدادات
Route::get('/student/settings',
    [StudentAccountController::class,'settings'])
    ->name('student.settings');


// تحديث الملف الشخصي
Route::post('/student/profile/update',
    [StudentAccountController::class,'updateProfile'])
    ->name('student.profile.update');


// تغيير كلمة المرور
Route::post('/student/password/update',
    [StudentAccountController::class,'updatePassword'])
    ->name('student.password.update');

    Route::post('/project/analyze-ai', [ProjectController::class, 'analyzeWithAi'])
    ->name('student.project.analyzeAi');

});

// --- Supervisor Routes ---
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', [SupervisorController::class, 'dashboard'])->name('dashboard');
    Route::get('/projects', [SupervisorController::class, 'projects'])->name('projects');
    Route::post('/projects/{team}/evaluation', [SupervisorController::class, 'storeEvaluation'])->name('storeEvaluation');
    Route::get('/chat', [SupervisorController::class, 'chat'])->name('chat');
    Route::post('/chat/{team}/send', [SupervisorController::class, 'sendMessage'])->name('sendMessage');
    Route::post('/request/{team}/accept', [SupervisorController::class, 'acceptRequest'])->name('acceptRequest');
    Route::post('/request/{team}/reject', [SupervisorController::class, 'rejectRequest'])->name('rejectRequest');
});

// --- Admin Routes ---
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admin_dashboard');
    });

    Route::get('/dashboard-php', function () {
        return view('admin.admin_dashboard_php');
    });

    Route::get('/pages', function () {
        return view('admin.admin_pages');
    });

    Route::get('/management', function () {
        return view('admin.admin_management');
    });
});

