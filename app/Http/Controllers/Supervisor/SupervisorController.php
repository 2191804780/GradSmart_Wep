<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Project;
use App\Models\Task;
use App\Models\File;
use App\Models\Evaluation;
use App\Models\Notification;
use App\Models\Message;
use App\Models\AiReport;
use App\Models\User;

class SupervisorController extends Controller
{
    public function __construct()
    {
        // سطر تجاوز المصادقة المؤقت - يسجل الدخول تلقائياً كـ د. أحمد السالم (المشرف ID = 9)
        if (!Auth::check()) {
            Auth::loginUsingId(9);
        }
    }

    /**
     * لوحة تحكم المشرف (Dashboard)
     */
    public function dashboard()
    {
        $supervisorId = Auth::id();
        $supervisor = Auth::user();

        // 1. الفرق تحت إشراف هذا المشرف
        $teams = Team::where('supervisor_id', $supervisorId)
            ->with(['project.aiReports', 'members'])
            ->get();

        // 2. حساب الإحصائيات
        $teamsCount = $teams->count();
        
        $onTrackCount = 0;
        $urgentCount = 0;
        foreach ($teams as $t) {
            if ($t->project) {
                // نأخذ آخر تقرير ذكاء اصطناعي للمشروع
                $latestReport = $t->project->aiReports()->orderBy('generated_at', 'desc')->first();
                if ($latestReport) {
                    if ($latestReport->risk_level === 'LOW') {
                        $onTrackCount++;
                    } elseif ($latestReport->risk_level === 'HIGH') {
                        $urgentCount++;
                    }
                }
            }
        }

        // 3. التنبيهات العاجلة (الإشعارات)
        $alerts = Notification::where('user_id', $supervisorId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 4. طلبات الإشراف الجديدة (الفرق التي لم يعين لها مشرف بعد)
        $newRequests = Team::whereNull('supervisor_id')
            ->with(['project', 'creator'])
            ->take(5)
            ->get();

        // 5. الاجتماعات المجدولة (نحاكيها برمجياً لعدم وجود جدول اجتماعات منفصل في قاعدة البيانات)
        $meetings = [
            [
                'day' => 'اليوم',
                'time' => '2:00 م',
                'team' => 'فريق Alpha',
                'title' => 'مراجعة أسبوعية',
                'type' => 'Zoom · 30 دقيقة',
                'color' => 'green'
            ],
            [
                'day' => 'غداً',
                'time' => '10:00 ص',
                'team' => 'فريق Beta',
                'title' => 'جلسة إنقاذ عاجلة',
                'type' => 'حضوري · ساعة',
                'color' => 'blue'
            ],
            [
                'day' => 'الخميس',
                'time' => '4:00 م',
                'team' => 'فريق Delta',
                'title' => 'عرض التقدم',
                'type' => 'Zoom · 45 دقيقة',
                'color' => 'yellow'
            ]
        ];

        return view('supervisor.supervisor_dashboard', compact(
            'supervisor',
            'teams',
            'teamsCount',
            'onTrackCount',
            'urgentCount',
            'alerts',
            'newRequests',
            'meetings'
        ));
    }

    /**
     * صفحة تفاصيل مشاريع الفرق والتقييمات وتقرير الـ AI
     */
    public function projects(Request $request)
    {
        $supervisorId = Auth::id();
        $supervisor = Auth::user();

        // جلب كل الفرق للمشرف لعرض القائمة المنسدلة للتنقل
        $teams = Team::where('supervisor_id', $supervisorId)
            ->with('project')
            ->get();

        if ($teams->isEmpty()) {
            return redirect()->route('supervisor.dashboard')->with('error', 'لا توجد فرق تحت إشرافك حالياً.');
        }

        // تحديد الفريق النشط (المختار)
        $selectedTeamId = $request->query('team_id', $teams->first()->id);
        
        $selectedTeam = Team::where('id', $selectedTeamId)
            ->where('supervisor_id', $supervisorId)
            ->with([
                'project.tasks.assignedTo',
                'project.files.uploader',
                'project.milestones',
                'project.aiReports',
                'members'
            ])
            ->firstOrFail();

        // التقييمات السابقة لهذا الفريق
        $evaluations = Evaluation::where('team_id', $selectedTeamId)
            ->orderBy('created_at', 'desc')
            ->get();

        // حساب الدرجة الكلية لآخر تقييم (إن وجد)
        $latestEvaluation = $evaluations->first();

        return view('supervisor.supervisor_projects', compact(
            'supervisor',
            'teams',
            'selectedTeam',
            'evaluations',
            'latestEvaluation'
        ));
    }

    /**
     * نظام المحادثات والدردشة (Chat)
     */
    public function chat(Request $request)
    {
        $supervisorId = Auth::id();
        $supervisor = Auth::user();

        // جلب الفرق لتمثيل غرف المحادثة الجماعية
        $teams = Team::where('supervisor_id', $supervisorId)
            ->with(['project', 'members'])
            ->get();

        if ($teams->isEmpty()) {
            return redirect()->route('supervisor.dashboard')->with('error', 'لا توجد فرق تحت إشرافك للمراسلة.');
        }

        // تحديد الفريق المختار للمحادثة
        $selectedTeamId = $request->query('team_id', $teams->first()->id);
        $selectedTeam = $teams->firstWhere('id', $selectedTeamId);

        if (!$selectedTeam) {
            $selectedTeam = $teams->first();
        }

        // جلب معرفات أعضاء الفريق المختار
        $memberIds = $selectedTeam->members->pluck('id')->toArray();

        // جلب الرسائل بين المشرف وأي عضو في هذا الفريق
        $messages = Message::where(function($q) use ($supervisorId, $memberIds) {
                $q->where('sender_id', $supervisorId)->whereIn('receiver_id', $memberIds);
            })
            ->orWhere(function($q) use ($supervisorId, $memberIds) {
                $q->whereIn('sender_id', $memberIds)->where('receiver_id', $supervisorId);
            })
            ->orderBy('sent_at', 'asc')
            ->with(['sender', 'receiver'])
            ->get();

        // وضع علامة مقروءة للرسائل المستلمة من هذا الفريق
        Message::whereIn('sender_id', $memberIds)
            ->where('receiver_id', $supervisorId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // جلب آخر رسالة وعدد الرسائل غير المقروءة لكل فريق (لعرضها في قائمة المحادثات النشطة)
        $chatPreviews = [];
        foreach ($teams as $team) {
            $tMemberIds = $team->members->pluck('id')->toArray();
            
            // آخر رسالة
            $lastMsg = Message::where(function($q) use ($supervisorId, $tMemberIds) {
                    $q->where('sender_id', $supervisorId)->whereIn('receiver_id', $tMemberIds);
                })
                ->orWhere(function($q) use ($supervisorId, $tMemberIds) {
                    $q->whereIn('sender_id', $tMemberIds)->where('receiver_id', $supervisorId);
                })
                ->orderBy('sent_at', 'desc')
                ->first();

            // عدد الرسائل غير المقروءة
            $unreadCount = Message::whereIn('sender_id', $tMemberIds)
                ->where('receiver_id', $supervisorId)
                ->where('is_read', false)
                ->count();

            $chatPreviews[$team->id] = [
                'last_message' => $lastMsg ? $lastMsg->content : 'لا توجد رسائل سابقة',
                'time' => $lastMsg ? $lastMsg->sent_at->format('h:i A') : '',
                'unread_count' => $unreadCount
            ];
        }

        return view('supervisor.supervisor_chat', compact(
            'supervisor',
            'teams',
            'selectedTeam',
            'messages',
            'chatPreviews'
        ));
    }

    /**
     * إرسال رسالة جديدة في الشات
     */
    public function sendMessage(Request $request, $teamId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $supervisorId = Auth::id();
        $team = Team::where('id', $teamId)
            ->where('supervisor_id', $supervisorId)
            ->firstOrFail();

        // نرسل الرسالة لرئيس الفريق (المنشئ) كقناة تواصل رئيسية
        $receiverId = $team->created_by; 

        Message::create([
            'sender_id' => $supervisorId,
            'receiver_id' => $receiverId,
            'content' => $request->content,
            'is_read' => false,
            'sent_at' => now(),
        ]);

        return redirect()->route('supervisor.chat', ['team_id' => $teamId])->with('success', 'تم إرسال الرسالة بنجاح.');
    }

    /**
     * حفظ تقييم جديد للفريق
     */
    public function storeEvaluation(Request $request, $teamId)
    {
        $request->validate([
            'score_documentation' => 'required|numeric|min:0|max:30',
            'score_implementation' => 'required|numeric|min:0|max:40',
            'score_presentation' => 'required|numeric|min:0|max:30',
            'feedback' => 'nullable|string'
        ]);

        $supervisorId = Auth::id();
        $team = Team::where('id', $teamId)
            ->where('supervisor_id', $supervisorId)
            ->firstOrFail();

        // حساب المجموع الكلي
        $totalScore = $request->score_documentation + $request->score_implementation + $request->score_presentation;

        Evaluation::create([
            'team_id' => $teamId,
            'evaluator_id' => $supervisorId,
            'evaluation_type' => 'SUPERVISOR',
            'score_documentation' => $request->score_documentation,
            'score_implementation' => $request->score_implementation,
            'score_presentation' => $request->score_presentation,
            'total_score' => $totalScore,
            'feedback' => $request->feedback,
            'created_at' => now(),
        ]);

        return redirect()->route('supervisor.projects', ['team_id' => $teamId])->with('success', 'تم حفظ التقييم وإرساله للفريق بنجاح.');
    }

    /**
     * قبول طلب إشراف جديد
     */
    public function acceptRequest($teamId)
    {
        $supervisorId = Auth::id();
        
        $team = Team::where('id', $teamId)
            ->whereNull('supervisor_id')
            ->firstOrFail();

        // إسناد المشرف للفريق
        $team->supervisor_id = $supervisorId;
        $team->save();

        // تحديث المشروع المقابل
        if ($team->project) {
            $team->project->supervisor_id = $supervisorId;
            $team->project->save();
        }

        // إنشاء إشعار لرئيس الفريق
        Notification::create([
            'user_id' => $team->created_by,
            'message' => 'تم قبول طلب إشراف مشروعك من قبل المشرف د. أحمد السالم.',
            'type' => 'SUCCESS',
            'is_read' => false,
            'created_at' => now(),
        ]);

        return redirect()->route('supervisor.dashboard')->with('success', 'تم قبول الإشراف على الفريق بنجاح.');
    }

    /**
     * رفض طلب إشراف جديد
     */
    public function rejectRequest($teamId)
    {
        $team = Team::where('id', $teamId)
            ->whereNull('supervisor_id')
            ->firstOrFail();

        // نرسل إشعاراً بالرفض لرئيس الفريق ليتمكنوا من طلب مشرف آخر
        Notification::create([
            'user_id' => $team->created_by,
            'message' => 'عذراً، تعذر قبول طلب الإشراف الخاص بفريقك من قبل المشرف د. أحمد السالم.',
            'type' => 'WARNING',
            'is_read' => false,
            'created_at' => now(),
        ]);

        return redirect()->route('supervisor.dashboard')->with('success', 'تم رفض طلب الإشراف.');
    }
}
