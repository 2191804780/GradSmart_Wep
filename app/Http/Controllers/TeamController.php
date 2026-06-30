<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function create()

    {
        $user = Auth::user();

        $myInvitations = TeamInvitation::where('invited_user_id', $user->id)
        ->where('status', 'PENDING')
        ->with(['team', 'sender'])
        ->latest('created_at')
        ->get();

       return view('student.creat_team', compact('myInvitations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:teams,name',
        ]);

        $user = Auth::user();

        if (! $user->department_id) {
            return back()->withErrors(['department_id' => 'يجب أن يكون لديك قسم قبل إنشاء فريق.'])->withInput();
        }

        if ($user->teams()->exists()) {
            return back()->withErrors(['team' => 'لا يمكنك إنشاء أو الانضمام لأكثر من فريق واحد.'])->withInput();
        }

        $team = Team::create([
            'name' => $request->name,
            'department_id' => $user->department_id,
            'invite_code' => strtoupper(Str::random(8)),
            'max_members' => 5,
            'supervisor_id' => null,
            'created_by' => $user->id,
        ]);

        $team->members()->attach($user->id, [
            'is_leader' => true,
            'member_role' => 'LEADER',
            'joined_at' => now(),
        ]);

        return redirect()->route('student.teams.management')
            ->with('success', 'تم إنشاء الفريق بنجاح.');
    }

    public function management()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['department', 'members', 'supervisor'])
            ->first();

        if (! $team) {
            return redirect()->route('student.teams.create')
                ->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
        }

        $project = Project::where('team_id', $team->id)->with('supervisor')->first();

        $tasks = $project
            ? Task::where('project_id', $project->id)->with('assignee')->get()
            : collect();

        $totalTasks = $tasks->count();
        $doneTasks = $tasks->where('status', 'DONE')->count();
        $progressTasks = $tasks->where('status', 'IN_PROGRESS')->count();

        $projectProgress = $totalTasks > 0 ? round(($doneTasks / $totalTasks) * 100) : 0;

        if ($project) {
            $project->progress = $projectProgress;
            $project->save();
        }

        $daysLeft = '--';

        if ($project && $project->expected_end_date) {
            $daysLeft = max(0, now()->startOfDay()->diffInDays(
                \Carbon\Carbon::parse($project->expected_end_date)->startOfDay(),
                false
            ));
        }

        $currentUserIsLeader = $team->members()
            ->where('users.id', $user->id)
            ->wherePivot('is_leader', true)
            ->exists();

        $memberStats = [];

        foreach ($team->members as $member) {
            $memberTasks = $tasks->where('assigned_to', $member->id);
            $memberTotal = $memberTasks->count();
            $memberDone = $memberTasks->where('status', 'DONE')->count();

            $memberStats[$member->id] = [
                'total' => $memberTotal,
                'done' => $memberDone,
                'progress' => $memberTotal > 0 ? round(($memberDone / $memberTotal) * 100) : 0,
            ];
        }

        $activities = collect();

        foreach ($team->members as $member) {
            $activities->push([
                'color' => 'var(--blue)',
                'text' => $member->name . ' ضمن أعضاء الفريق',
                'time' => $member->pivot->is_leader ? 'قائد الفريق' : 'عضو حالي',
            ]);
        }

        foreach ($tasks->take(5) as $task) {
            $activities->push([
                'color' => $task->status === 'DONE' ? 'var(--green)' : 'var(--orange)',
                'text' => 'مهمة: ' . $task->title,
                'time' => $task->status === 'DONE' ? 'منجزة' : 'قيد المتابعة',
            ]);
        }
        $pendingInvitations = TeamInvitation::where('team_id', $team->id)
            ->where('status', 'PENDING')
            ->with(['invitedUser', 'sender'])
            ->latest('created_at')
            ->get();

        $myInvitations = TeamInvitation::where('invited_user_id', $user->id)
            ->where('status', 'PENDING')
            ->with(['team', 'sender'])
            ->latest('created_at')
            ->get();

        return view('student.team_management', compact(
            'team',
            'project',
            'tasks',
            'totalTasks',
            'doneTasks',
            'progressTasks',
            'projectProgress',
            'daysLeft',
            'currentUserIsLeader',
            'memberStats',
            'activities',
            'pendingInvitations',
            'myInvitations'
        ));
    }

    public function inviteMember(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'member_role' => 'required|string|max:50',
            'note' => 'nullable|string|max:500',
        ]);

        $leader = Auth::user();

        $team = $leader->teams()->with(['members', 'department'])->first();

        if (! $team) {
            return back()->withErrors(['team' => 'يجب إنشاء فريق أولاً.']);
        }

        $isLeader = $team->members()
            ->where('users.id', $leader->id)
            ->wherePivot('is_leader', true)
            ->exists();

        if (! $isLeader) {
            return back()->withErrors(['member' => 'فقط قائد الفريق يمكنه إرسال دعوة.']);
        }

        if ($team->members()->count() >= $team->max_members) {
            return back()->withErrors(['member' => 'الفريق وصل إلى الحد الأقصى من الأعضاء.']);
        }

        $member = User::where('email', $request->email)->first();

        if ($member->id === $leader->id) {
            return back()->withErrors(['member' => 'أنت قائد الفريق بالفعل.']);
        }

        if ($member->role?->role_name !== 'STUDENT') {
            return back()->withErrors(['member' => 'يمكن دعوة الطلاب فقط.']);
        }

        if ($member->department_id !== $team->department_id) {
            return back()->withErrors(['member' => 'لا يمكن دعوة طالب من قسم مختلف.']);
        }

        if ($member->teams()->exists()) {
            return back()->withErrors(['member' => 'هذا الطالب موجود بالفعل في فريق آخر.']);
        }

        $exists = TeamInvitation::where('team_id', $team->id)
            ->where('invited_user_id', $member->id)
            ->where('status', 'PENDING')
            ->exists();

        if ($exists) {
            return back()->withErrors(['member' => 'تم إرسال دعوة لهذا الطالب مسبقاً.']);
        }

        TeamInvitation::create([
            'team_id' => $team->id,
            'invited_user_id' => $member->id,
            'invited_by' => $leader->id,
            'member_role' => $request->member_role,
            'note' => $request->note,
            'status' => 'PENDING',
            'created_at' => now(),
        ]);

        return back()->with('success', 'تم إرسال الدعوة بنجاح. بانتظار قبول الطالب.');
    }

    public function acceptInvitation(TeamInvitation $invitation)
    {
        $user = Auth::user();

        if ($invitation->invited_user_id !== $user->id) {
            return back()->withErrors(['invite' => 'هذه الدعوة ليست موجهة لك.']);
        }

        if ($invitation->status !== 'PENDING') {
            return back()->withErrors(['invite' => 'هذه الدعوة لم تعد متاحة.']);
        }

        if ($user->teams()->exists()) {
            return back()->withErrors(['invite' => 'أنت موجود بالفعل في فريق آخر.']);
        }

        $team = $invitation->team;

        if ($team->members()->count() >= $team->max_members) {
            return back()->withErrors(['invite' => 'الفريق أصبح ممتلئاً.']);
        }

        $team->members()->attach($user->id, [
            'is_leader' => false,
            'member_role' => $invitation->member_role,
            'joined_at' => now(),
        ]);
        $invitation->update(['status' => 'ACCEPTED']);

        return redirect()->route('student.teams.management')->with('success', 'تم قبول الدعوة والانضمام للفريق بنجاح.');
    }

    public function rejectInvitation(TeamInvitation $invitation)
    {
        $user = Auth::user();

        if ($invitation->invited_user_id !== $user->id) {
            return back()->withErrors(['invite' => 'هذه الدعوة ليست موجهة لك.']);
        }

        $invitation->update(['status' => 'REJECTED']);

        return back()->with('success', 'تم رفض الدعوة.');
    }

    public function makeLeader(User $member)
    {
        $user = Auth::user();

        $team = $user->teams()->with('members')->first();

        if (! $team) {
            return back()->withErrors(['team' => 'لا يوجد فريق.']);
        }

        $isLeader = $team->members()
            ->where('users.id', $user->id)
            ->wherePivot('is_leader', true)
            ->exists();

        if (! $isLeader) {
            return back()->withErrors(['member' => 'فقط قائد الفريق يمكنه تغيير الأدوار.']);
        }

        if (! $team->members()->where('users.id', $member->id)->exists()) {
            return back()->withErrors(['member' => 'هذا المستخدم ليس ضمن الفريق.']);
        }

        DB::table('team_members')->where('team_id', $team->id)->update([
            'is_leader' => false,
        ]);

        DB::table('team_members')
            ->where('team_id', $team->id)
            ->where('user_id', $member->id)
            ->update([
                'is_leader' => true,
                'member_role' => 'LEADER',
            ]);

        return back()->with('success', 'تم تعيين قائد جديد للفريق.');
    }

    public function removeMember(User $member)
    {
        $user = Auth::user();

        $team = $user->teams()->with('members')->first();

        if (! $team) {
            return back()->withErrors(['team' => 'لا يوجد فريق.']);
        }

        $isLeader = $team->members()
            ->where('users.id', $user->id)
            ->wherePivot('is_leader', true)
            ->exists();

        if (! $isLeader) {
            return back()->withErrors(['member' => 'فقط قائد الفريق يمكنه حذف الأعضاء.']);
        }

        $memberIsLeader = $team->members()
            ->where('users.id', $member->id)
            ->wherePivot('is_leader', true)
            ->exists();

        if ($memberIsLeader) {
            return back()->withErrors(['member' => 'لا يمكن حذف قائد الفريق.']);
        }

        $team->members()->detach($member->id);

        return back()->with('success', 'تم حذف العضو من الفريق.');
    }
}
