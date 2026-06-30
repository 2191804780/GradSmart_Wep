<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['members', 'supervisor'])
            ->first();

        if (!$team) {
            return view('student.student_chat', [
                'state' => 'no_team',
                'team' => null,
                'contacts' => collect(),
                'selectedContact' => null,
                'messages' => collect(),
                'chatType' => null,
            ]);
        }

        $contacts = collect();

        if ($team->supervisor) {
            $contacts->push([
                'type' => 'supervisor',
                'id' => $team->supervisor->id,
                'name' => $team->supervisor->name,
                'subtitle' => 'مشرف المشروع',
                'avatar' => mb_substr($team->supervisor->name, 0, 2),
            ]);
        }

        $contacts->push([
            'type' => 'group',
            'id' => $team->id,
            'name' => 'مجموعة المشروع',
            'subtitle' => $team->name,
            'avatar' => '👥',
        ]);

        foreach ($team->members->where('id', '!=', $user->id) as $member) {
            $contacts->push([
                'type' => 'user',
                'id' => $member->id,
                'name' => $member->name,
                'subtitle' => 'عضو في الفريق',
                'avatar' => mb_substr($member->name, 0, 2),
            ]);
        }

        $chatType = $request->get('type');
        $receiverId = $request->get('receiver_id');

        if (!$chatType || !$receiverId) {
            $first = $contacts->first();
            $chatType = $first['type'] ?? null;
            $receiverId = $first['id'] ?? null;
        }

        $selectedContact = $contacts->first(function ($contact) use ($chatType, $receiverId) {
            return $contact['type'] === $chatType
                && (int) $contact['id'] === (int) $receiverId;
        });

        if (!$selectedContact && $contacts->isNotEmpty()) {
            $selectedContact = $contacts->first();
            $chatType = $selectedContact['type'];
            $receiverId = $selectedContact['id'];
        }

        $messages = collect();

        if ($selectedContact) {
            if ($chatType === 'group') {
                $messages = Message::with(['sender', 'receiver'])
                    ->where('team_id', $team->id)
                    ->where('conversation_type', 'group')
                    ->orderBy('sent_at')
                    ->get();
            } else {
                Message::where('sender_id', $receiverId)
                    ->where('receiver_id', $user->id)
                    ->where('is_read', 0)
                    ->update(['is_read' => 1]);

                $messages = Message::with(['sender', 'receiver'])
                    ->where(function ($q) {
                        $q->where('conversation_type', 'private')
                          ->orWhereNull('conversation_type');
                    })
                    ->where(function ($q) use ($user, $receiverId) {
                        $q->where(function ($q2) use ($user, $receiverId) {
                            $q2->where('sender_id', $user->id)
                               ->where('receiver_id', $receiverId);
                        })->orWhere(function ($q2) use ($user, $receiverId) {
                            $q2->where('sender_id', $receiverId)
                               ->where('receiver_id', $user->id);
                        });
                    })
                    ->orderBy('sent_at')
                    ->get();
            }
        }

        return view('student.student_chat', [
            'state' => 'ready',
            'team' => $team,
            'contacts' => $contacts,
            'selectedContact' => $selectedContact,
            'messages' => $messages,
            'chatType' => $chatType,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conversation_type' => ['required', 'in:private,group'],
            'receiver_id' => ['nullable', 'integer'],
            'team_id' => ['nullable', 'integer'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $user = Auth::user();

        if ($request->conversation_type === 'group') {
            $team = $user->teams()
                ->where('teams.id', $request->team_id)
                ->first();

            if (!$team) {
                return back()->withErrors([
                    'message' => 'لا يمكنك الإرسال لهذه المجموعة.'
                ]);
            }

            Message::create([
                'sender_id' => $user->id,
                'receiver_id' => $user->id,
                'team_id' => $team->id,
                'conversation_type' => 'group',
                'content' => $request->content,
                'is_read' => 0,
                'sent_at' => now(),
            ]);

            $receivers = $team->members
                ->where('id', '!=', $user->id)
                ->pluck('id')
                ->toArray();

            if ($team->supervisor_id && $team->supervisor_id != $user->id) {
                $receivers[] = $team->supervisor_id;
            }

            foreach (array_unique($receivers) as $receiverId) {
                Notification::create([
                    'user_id' => $receiverId,
                    'message' => 'رسالة جديدة في مجموعة المشروع من ' . $user->name,
                    'type' => 'message',
                    'is_read' => 0,
                    'created_at' => now(),
                ]);
            }

            return redirect()->route('student.chat.index', [
                'type' => 'group',
                'receiver_id' => $team->id,
            ]);
        }

        Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'team_id' => null,
            'conversation_type' => 'private',
            'content' => $request->content,
            'is_read' => 0,
            'sent_at' => now(),
        ]);

        Notification::create([
            'user_id' => $request->receiver_id,
            'message' => 'رسالة جديدة من ' . $user->name,
            'type' => 'message',
            'is_read' => 0,
            'created_at' => now(),
        ]);

        return redirect()->route('student.chat.index', [
            'type' => 'user',
            'receiver_id' => $request->receiver_id,
        ]);
    }
}