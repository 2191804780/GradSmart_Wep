<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['members', 'department'])
            ->first();

        if (! $team) {
            return view('student.student_progress', [
                'state' => 'no_team',
                'team' => null,
                'project' => null,
            ]);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return view('student.student_progress', [
                'state' => 'no_project',
                'team' => $team,
                'project' => null,
            ]);
        }

        $tasks = Task::where('project_id', $project->id)
            ->with(['assignee'])
            ->orderBy('deadline')
            ->get();

        $totalTasks = $tasks->count();
        $doneTasks = $tasks->where('status', 'DONE')->count();
        $inProgressTasks = $tasks->where('status', 'IN_PROGRESS')->count();
        $todoTasks = $tasks->where('status', 'TODO')->count();

        $lateTasks = $tasks->filter(function ($task) {
            return $task->deadline
                && $task->status !== 'DONE'
                && Carbon::parse($task->deadline)->isPast();
        })->count();

        $progressPercent = $totalTasks > 0
            ? round(($doneTasks / $totalTasks) * 100)
            : 0;

        $projectStartDate = $project->start_date
            ?? $project->created_at
            ?? now();

        $projectEndDate = $project->expected_end_date
            ?? $project->end_date
            ?? $project->deadline
            ?? null;

        $daysLeft = $projectEndDate
            ? max(0, now()->startOfDay()->diffInDays(Carbon::parse($projectEndDate)->startOfDay(), false))
            : 0;

        $expectedProgress = 0;

        if ($projectStartDate && $projectEndDate) {
            $start = Carbon::parse($projectStartDate)->startOfDay();
            $end = Carbon::parse($projectEndDate)->startOfDay();

            if ($end->greaterThan($start)) {
                $totalDays = max(1, $start->diffInDays($end));
                $passedDays = max(0, $start->diffInDays(now()->startOfDay()));
                $expectedProgress = min(100, round(($passedDays / $totalDays) * 100));
            }
        }

        $riskLevel = 'منخفض';
        $riskColor = 'var(--green)';

        if ($lateTasks >= 3 || $progressPercent < 35) {
            $riskLevel = 'مرتفع';
            $riskColor = 'var(--red)';
        } elseif ($lateTasks >= 1 || $progressPercent < 60) {
            $riskLevel = 'متوسط';
            $riskColor = 'var(--orange)';
        }

        $supervisorName = $project->supervisor->name ?? 'لم يتم اختيار مشرف';
        $teamSize = $team->members->count();
        $startDate = $projectStartDate
            ? Carbon::parse($projectStartDate)->format('Y-m-d')
            : 'غير محدد';

        $memberProgress = $team->members->map(function ($member) use ($tasks) {
            $memberTasks = $tasks->where('assigned_to', $member->id);
            $memberTotal = $memberTasks->count();
            $memberDone = $memberTasks->where('status', 'DONE')->count();

            return [
                'member' => $member,
                'total' => $memberTotal,
                'done' => $memberDone,
                'percent' => $memberTotal > 0 ? round(($memberDone / $memberTotal) * 100) : 0,
            ];
        });

        $phaseProgress = [
            [
                'name' => '📋 لم تبدأ',
                'done' => $todoTasks,
                'total' => $totalTasks,
                'percent' => $totalTasks > 0 ? round(($todoTasks / $totalTasks) * 100) : 0,
                'color' => 'var(--muted)',
            ],
            [
                'name' => '🔄 قيد التنفيذ',
                'done' => $inProgressTasks,
                'total' => $totalTasks,
                'percent' => $totalTasks > 0 ? round(($inProgressTasks / $totalTasks) * 100) : 0,
                'color' => 'var(--blue)',
            ],
            [
                'name' => '✅ منجزة',
                'done' => $doneTasks,
                'total' => $totalTasks,
                'percent' => $totalTasks > 0 ? round(($doneTasks / $totalTasks) * 100) : 0,
                'color' => 'var(--green)',
            ],
            [
                'name' => '⚠️ متأخرة',
                'done' => $lateTasks,
                'total' => $totalTasks,
                'percent' => $totalTasks > 0 ? round(($lateTasks / $totalTasks) * 100) : 0,
                'color' => 'var(--orange)',
            ],
        ];

        return view('student.student_progress', compact(
            'team',
            'project',
            'tasks',
            'totalTasks',
            'doneTasks',
            'inProgressTasks',
            'todoTasks',
            'lateTasks',
            'progressPercent',
            'daysLeft',
            'riskLevel',
            'riskColor',
            'expectedProgress',
            'memberProgress',
            'phaseProgress',
            'projectEndDate',
            'supervisorName',
            'teamSize',
            'startDate'
        ))->with('state', 'ready');
    }
}