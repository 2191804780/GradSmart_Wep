<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supervisor\SupervisorController;

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
    return view('index');
})->name('home');

Route::get('/forgot-password', function () {
    return view('auth.forgot_password');
})->name('password.request');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/srs', function () {
    return view('srs');
});

Route::get('/logo', function () {
    return view('logo2');
});

Route::get('/gs-logo', function () {
    return view('GradSmartLogo');
});

// --- Student Routes ---
Route::prefix('student')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.student_dashboard');
    });

    Route::get('/dashboard-php', function () {
        return view('student.student_dashboard_php');
    });

    Route::get('/chat', function () {
        return view('student.student_chat');
    });

    Route::get('/chat-php', function () {
        return view('student.student_chat_php');
    });

    Route::get('/file-upload', function () {
        return view('student.file_upload');
    });

    Route::get('/sup-profile', function () {
        return view('student.sup_profile');
    });

    Route::get('/progress', function () {
        return view('student.student_progress');
    });

    Route::get('/team-management', function () {
        return view('student.team_management');
    });

    Route::get('/task-detail', function () {
        return view('student.task_detail');
    });

    Route::get('/task-management', function () {
        return view('student.task_management');
    });

    Route::get('/create-team', function () {
        return view('student.creat_team');
    });

    Route::get('/sup-projects', function () {
        return view('student.sup_projects');
    });
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

