<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['members'])
            ->first();

        if (! $team) {
            return redirect()->route('student.teams.create')
                ->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return redirect()->route('student.project.index')
                ->withErrors(['project' => 'يجب إنشاء مشروع أولاً قبل إدارة المهام.']);
        }

        $tasks = Task::where('project_id', $project->id)
            ->with(['assignee', 'creator'])
            ->orderBy('id', 'desc')
            ->get();

        return view('student.task_management', compact('team', 'project', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'status' => 'required|in:TODO,IN_PROGRESS,DONE',
            'deadline' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $user = Auth::user();
        $team = $user->teams()->first();

        if (! $team) {
            return redirect()->route('student.teams.create')
                ->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return redirect()->route('student.project.index')
                ->withErrors(['project' => 'يجب إنشاء مشروع أولاً.']);
        }

        Task::create([
            'parent_id' => null,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'project_id' => $project->id,
            'assigned_to' => $request->assigned_to,
            'created_by' => $user->id,
        ]);

        return redirect()->route('student.tasks.index')
            ->with('success', 'تم إنشاء المهمة بنجاح.');
    }
}