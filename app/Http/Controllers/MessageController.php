<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        $team = $user->teams()
            ->with(['members'])
            ->first();

        if (! $team) {
            return view('student.student_chat', [
                'state' => 'no_team',
                'team' => null,
                'contacts' => collect(),
                'selectedContact' => null,
                'messages' => collect(),
            ]);
        }

        $contacts = $team->members
            ->where('id', '!=', $user->id)
            ->values();

        $selectedContact = null;

        if ($request->receiver_id) {
            $selectedContact = $contacts->firstWhere('id', (int) $request->receiver_id);
        }

        if (! $selectedContact) {
            $selectedContact = $contacts->first();
        }

        $messages = collect();

        if ($selectedContact) {
            Message::where('sender_id', $selectedContact->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            $messages = Message::with(['sender', 'receiver'])
                ->where(function ($q) use ($user, $selectedContact) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $selectedContact->id);
                })
                ->orWhere(function ($q) use ($user, $selectedContact) {
                    $q->where('sender_id', $selectedContact->id)
                      ->where('receiver_id', $user->id);
                })
                ->orderBy('sent_at')
                ->get();
        }

        return view('student.student_chat', [
            'state' => 'ready',
            'team' => $team,
            'contacts' => $contacts,
            'selectedContact' => $selectedContact,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $user = Auth::user();

        Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'is_read' => 0,
            'sent_at' => now(),
        ]);

        return redirect()
            ->route('student.chat.index', ['receiver_id' => $request->receiver_id])
            ->with('success', 'تم إرسال الرسالة بنجاح');
    }
}