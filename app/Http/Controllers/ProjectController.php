<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\SupervisorRequest;
use App\Models\User;
use App\Services\AiProjectAnalyzer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $team = $user->teams()
        ->with(['department', 'members'])
        ->first();

    if (! $team) {
        return redirect()->route('student.teams.management')
            ->withErrors(['team' => 'يجب إنشاء فريق أولاً قبل إنشاء مشروع.']);
    }

    $project = Project::where('team_id', $team->id)
        ->with(['supervisor'])
        ->first();

    $supervisors = collect();
    $pendingRequest = null;
    $recommendedSupervisor = null;
    $aiScore = 0;
    $aiReasons = [];
    $aiReport = null;
    $daysLeft = null;
    

    if ($project) {
        $supervisorRoleId = Role::where('role_name', 'SUPERVISOR')->value('id');

        $supervisors = User::where('role_id', $supervisorRoleId)
            ->where('department_id', $team->department_id)
            ->where('is_active', true)
            ->get();

        $pendingRequest = SupervisorRequest::where('project_id', $project->id)
            ->where('status', 'PENDING')
            ->first();

        $aiReport = \DB::table('ai_reports')
            ->where('project_id', $project->id)
            ->latest('generated_at')
            ->first();

        $recommendedSupervisor = $supervisors->first();

        if ($recommendedSupervisor) {
            $aiScore = 82;

            if ($recommendedSupervisor->department_id == $team->department_id) {
                $aiScore += 8;
                $aiReasons[] = 'نفس قسم الفريق';
            }

            if ($project->keywords) {
                $aiScore += 5;
                $aiReasons[] = 'متوافق مع كلمات المشروع المفتاحية';
            }

            $aiReasons[] = 'متاح حاليًا للإشراف';
            $aiReasons[] = 'مناسب كبداية لهذا النوع من المشاريع';

            $aiScore = min($aiScore, 95);
        }
        $daysLeft = null;

       if ($project && $project->expected_end_date) {
        $daysLeft = max(
           0,
         intval(
        now()->diffInDays($project->expected_end_date, false)
    )
);

}
    }

    return view('student.project', compact(
        'team',
        'project',
        'supervisors',
        'pendingRequest',
        'recommendedSupervisor',
        'aiScore',
        'aiReasons',
        'aiReport',
        'daysLeft'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200|unique:projects,title',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string|max:500',
            'expected_end_date' => 'required|date|after_or_equal:today',
        ]);

        $user = Auth::user();

        $team = $user->teams()->first();

        if (! $team) {
            return redirect()->route('student.teams.management')
                ->withErrors(['team' => 'يجب إنشاء فريق أولاً قبل إنشاء مشروع.']);
        }

        if (Project::where('team_id', $team->id)->exists()) {
            return back()->withErrors([
                'project' => 'هذا الفريق لديه مشروع بالفعل.',
            ])->withInput();
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'status' => 'ACTIVE',
            'team_id' => $team->id,
            'supervisor_id' => null,
            'expected_end_date' => $request->expected_end_date,
            'actual_end_date' => null,
            'progress' => 0,
            'created_at' => now(),
        ]);

        return redirect()->route('student.project.index')
            ->with('success', 'تم إنشاء المشروع بنجاح.');
    }

    public function requestSupervisor(Request $request, User $supervisor)
    {
        $user = Auth::user();

        $team = $user->teams()->first();

        if (! $team) {
            return redirect()->route('student.teams.management')
                ->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return back()->withErrors([
                'project' => 'يجب إنشاء المشروع أولاً قبل اختيار المشرف.',
            ]);
        }

        if ($project->supervisor_id) {
            return back()->withErrors([
                'supervisor' => 'تم اختيار مشرف لهذا المشروع بالفعل.',
            ]);
        }

        $supervisorRoleId = Role::where('role_name', 'SUPERVISOR')->value('id');

        if (
            $supervisor->role_id != $supervisorRoleId ||
            $supervisor->department_id != $team->department_id
        ) {
            return back()->withErrors([
                'supervisor' => 'لا يمكن إرسال الطلب لهذا المستخدم.',
            ]);
        }

        $hasPending = SupervisorRequest::where('project_id', $project->id)
            ->where('status', 'PENDING')
            ->exists();

        if ($hasPending) {
            return back()->withErrors([
                'supervisor' => 'لديك طلب إشراف قيد الانتظار بالفعل.',
            ]);
        }

        SupervisorRequest::create([
            'project_id' => $project->id,
            'supervisor_id' => $supervisor->id,
            'status' => 'PENDING',
        ]);

        return back()->with('success', 'تم إرسال طلب الإشراف بنجاح.');
    }
    public function analyzeWithAi(AiProjectAnalyzer $analyzer)
{
    $user = Auth::user();

    $team = $user->teams()
        ->with(['department', 'members'])
        ->first();

    if (!$team) {
        return back()->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
    }

    $project = Project::where('team_id', $team->id)->first();

    if (!$project) {
        return back()->withErrors(['project' => 'يجب إنشاء المشروع أولاً.']);
    }

    $supervisorRoleId = Role::where('role_name', 'SUPERVISOR')->value('id');

    $supervisors = User::where('role_id', $supervisorRoleId)
        ->where('department_id', $team->department_id)
        ->where('is_active', true)
        ->get();

    $result = $analyzer->analyze($project, $team, $supervisors);

    if (!$result) {
        return back()->withErrors([
            'ai' => 'فشل تحليل المشروع بالذكاء الاصطناعي.'
        ]);
    }

    DB::table('ai_reports')->insert([
        'project_id' => $project->id,
        'risk_level' => $result['risk_level'] ?? 'MEDIUM',
        'delay_probability' => $result['delay_probability'] ?? 0,
        'completion_rate' => $result['completion_rate'] ?? $project->progress,
        'time_consumed_rate' => $result['time_consumed_rate'] ?? 0,
        'generated_at' => now(),
    ]);

    return back()->with('success', 'تم تحليل المشروع بالذكاء الاصطناعي بنجاح.');
}
}