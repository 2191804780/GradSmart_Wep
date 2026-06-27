<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TeamInvitation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['members', 'department', 'supervisor'])
            ->first();

        $myInvitations = TeamInvitation::where('invited_user_id', $user->id)
            ->where('status', 'PENDING')
            ->with(['team', 'sender'])
            ->latest('created_at')
            ->get();

        $project = null;
        $tasks = collect();

        $totalTasks = 0;
        $doneTasks = 0;
        $progressTasks = 0;
        $todoTasks = 0;
        $lateTasks = 0;
        $projectProgress = 0;
        $daysLeft = '--';

        $riskLevel = 'منخفض';
        $riskColor = 'var(--green)';
        $riskMessage = 'المشروع على المسار الصحيح';

        if ($team) {
            $project = Project::where('team_id', $team->id)
                ->with('supervisor')
                ->first();

            if ($project) {
                $tasks = Task::where('project_id', $project->id)
                    ->with('assignee')
                    ->orderBy('id', 'desc')
                    ->get();

                $totalTasks = $tasks->count();
                $doneTasks = $tasks->where('status', 'DONE')->count();
                $progressTasks = $tasks->where('status', 'IN_PROGRESS')->count();
                $todoTasks = $tasks->where('status', 'TODO')->count();

                $lateTasks = $tasks->filter(function ($task) {
                    return $task->deadline
                        && $task->status !== 'DONE'
                        && Carbon::parse($task->deadline)->isPast();
                })->count();

                $projectProgress = $totalTasks > 0
                    ? round(($doneTasks / $totalTasks) * 100)
                    : 0;

                $project->progress = $projectProgress;
                $project->save();

                if ($project->expected_end_date) {
                    $daysLeft = max(
                        0,
                        now()->startOfDay()->diffInDays(
                            Carbon::parse($project->expected_end_date)->startOfDay(),
                            false
                        )
                    );
                }

                if ($projectProgress < 40 || $lateTasks >= 3) {
                    $riskLevel = 'مرتفع';
                    $riskColor = 'var(--orange)';
                    $riskMessage = 'المشروع يحتاج متابعة';
                } elseif ($projectProgress < 70 || $lateTasks > 0) {
                    $riskLevel = 'متوسط';
                    $riskColor = 'var(--yellow)';
                    $riskMessage = 'المشروع يحتاج بعض التنظيم';
                }
            }
        }

        $activities = collect();

        if ($team) {
            $activities->push([
                'icon' => '👥',
                'text' => 'أنت ضمن فريق ' . $team->name,
                'time' => 'عضو حالي',
                'bg' => '#eff6ff',
            ]);
        }

        if ($project) {
            $activities->push([
                'icon' => '📋',
                'text' => 'المشروع الحالي: ' . $project->title,
                'time' => 'نشط',
                'bg' => '#f0fdf4',
            ]);
        }

        foreach ($tasks->take(4) as $task) {
            $activities->push([
                'icon' => $task->status === 'DONE' ? '✅' : '📝',
                'text' => 'مهمة: ' . $task->title,
                'time' => $task->status === 'DONE' ? 'منجزة' : 'قيد المتابعة',
                'bg' => $task->status === 'DONE' ? '#f0fdf4' : '#fff7ed',
            ]);
        }

        return view('student.student_dashboard', compact(
            'user',
            'team',
            'project',
            'tasks',
            'myInvitations',
            'totalTasks',
            'doneTasks',
            'progressTasks',
            'todoTasks',
            'lateTasks',
            'projectProgress',
            'daysLeft',
            'riskLevel',
            'riskColor',
            'riskMessage',
            'activities'
        ));
    }
}