@extends('layouts.student')

@section('title', 'GradSmart — المحادثة')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_chat.css') }}">
@endsection

@section('page_title')
<h1>💬 المحادثة</h1>

@endsection

@section('content')

@if($state === 'no_team')

<div class="card" style="text-align:center;padding:50px 25px">
    <div style="font-size:60px;margin-bottom:15px">💬</div>
    <h2>لا يمكن استخدام المحادثة بعد</h2>
    <p style="color:var(--muted);line-height:1.9;max-width:650px;margin:auto">
        يجب أن تكوني ضمن فريق أولاً حتى تتمكني من مراسلة أعضاء الفريق.
    </p>

    <div style="display:flex;justify-content:center;gap:12px;margin-top:24px;flex-wrap:wrap">
        <a href="{{ route('student.teams.create') }}" class="btn btn-primary">🚀 إنشاء فريق</a>
        <a href="{{ route('student.teams.create') }}#my-invitations" class="btn btn-outline">📨 عرض الدعوات</a>
    </div>
</div>

@else

<div class="chat-layout">

    <!-- Conversations -->
    <div class="conv-list">
        <div class="conv-header">
            <h2>💬 الرسائل</h2>

            <div class="conv-search">
                <span>🔍</span>
                <input id="chatSearch" placeholder="ابحث في المحادثات...">
            </div>

            <div class="conv-tabs">
                <button class="ctab active" type="button">الفريق</button>
            </div>
        </div>

        <div class="conv-items" id="contactsList">

            @forelse($contacts as $contact)
                @php
                    $initials = collect(explode(' ', trim($contact->name)))
                        ->filter()
                        ->take(2)
                        ->map(fn($p) => mb_substr($p, 0, 1))
                        ->implode('');

                    $lastMessage = \App\Models\Message::where(function($q) use ($contact) {
                            $q->where('sender_id', auth()->id())
                              ->where('receiver_id', $contact->id);
                        })
                        ->orWhere(function($q) use ($contact) {
                            $q->where('sender_id', $contact->id)
                              ->where('receiver_id', auth()->id());
                        })
                        ->orderByDesc('sent_at')
                        ->first();

                    $unread = \App\Models\Message::where('sender_id', $contact->id)
                        ->where('receiver_id', auth()->id())
                        ->where('is_read', 0)
                        ->count();
                @endphp

                <a href="{{ route('student.chat.index', ['receiver_id' => $contact->id]) }}"
                   class="conv-item {{ $selectedContact && $selectedContact->id == $contact->id ? 'active' : '' }}"
                   style="text-decoration:none"
                   data-name="{{ strtolower($contact->name) }}">

                    <div class="ci-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
                        {{ $initials ?: 'ع' }}
                        <div class="online-dot"></div>
                    </div>

                    <div class="ci-info">
                        <div class="ci-name">{{ $contact->name }} — الفريق</div>
                        <div class="ci-preview">
                            {{ $lastMessage->content ?? 'لا توجد رسائل بعد' }}
                        </div>
                    </div>

                    <div class="ci-meta">
                        <div class="ci-time">
                            {{ $lastMessage?->sent_at ? \Carbon\Carbon::parse($lastMessage->sent_at)->format('H:i') : '' }}
                        </div>

                        @if($unread > 0)
                            <div class="ci-unread">{{ $unread }}</div>
                        @endif
                    </div>
                </a>
            @empty
                <div style="padding:25px;text-align:center;color:var(--muted)">
                    لا يوجد أعضاء آخرون في الفريق.
                </div>
            @endforelse

        </div>
    </div>

    <!-- Chat Window -->
    <div class="chat-window">

        @if($selectedContact)

            @php
                $selectedInitials = collect(explode(' ', trim($selectedContact->name)))
                    ->filter()
                    ->take(2)
                    ->map(fn($p) => mb_substr($p, 0, 1))
                    ->implode('');
            @endphp

            <!-- Topbar -->
            <div class="chat-topbar">
                <div class="ct-avatar">
                    {{ $selectedInitials ?: 'ع' }}
                    <div class="online-dot"></div>
                </div>

                <div>
                    <div class="ct-name">{{ $selectedContact->name }}</div>
                    <div class="ct-status">🟢 عضو في الفريق</div>
                </div>

                <div class="ct-actions">
                    <div class="ct-btn">📞</div>
                    <div class="ct-btn">📹</div>
                    <div class="ct-btn">📎</div>
                    <div class="ct-btn">⋮</div>
                </div>
            </div>

            <!-- Messages -->
            <div class="messages-area" id="messagesArea">

                @forelse($messages as $message)

                    @php
                        $isMe = $message->sender_id == auth()->id();
                    @endphp

                    <div class="msg-group {{ $isMe ? 'other' : 'me' }}">
                        @if(! $isMe)
                            <div class="msg-sender">{{ $message->sender->name }}</div>
                        @endif

                        <div class="msg-bubble">
                            {{ $message->content }}
                        </div>

                        <div class="msg-time">
                            {{ \Carbon\Carbon::parse($message->sent_at)->format('Y-m-d H:i') }}
                        </div>
                    </div>

                @empty
                    <div style="text-align:center;color:var(--muted);padding:60px 20px">
                        <div style="font-size:50px;margin-bottom:12px">💬</div>
                        <h3>لا توجد رسائل بعد</h3>
                        <p>ابدئي المحادثة مع {{ $selectedContact->name }}</p>
                    </div>
                @endforelse

            </div>

            <!-- Input -->
            <div class="chat-input-area">
                <form method="POST" action="{{ route('student.chat.send') }}" class="input-row">
                    @csrf

                    <input type="hidden" name="receiver_id" value="{{ $selectedContact->id }}">

                    <div class="input-actions">
                        <button class="ia-btn" type="button">😊</button>
                        <button class="ia-btn" type="button">📎</button>
                    </div>

                    <textarea class="chat-input"
                              name="content"
                              placeholder="اكتب رسالتك..."
                              rows="1"
                              required></textarea>

                    <button class="send-btn" type="submit">➤</button>
                </form>
            </div>

        @else

            <div style="display:flex;align-items:center;justify-content:center;height:100%;text-align:center;color:var(--muted)">
                <div>
                    <div style="font-size:60px;margin-bottom:12px">👥</div>
                    <h3>لا يوجد عضو للمحادثة</h3>
                    <p>أضيفي أعضاء للفريق حتى تبدأ المحادثة.</p>
                </div>
            </div>

        @endif

    </div>
</div>

@endif

@endsection

@section('scripts')
<script>
const navChat = document.getElementById('nav-chat');
if (navChat) navChat.classList.add('active');

const search = document.getElementById('chatSearch');

if (search) {
    search.addEventListener('keyup', function () {
        const value = this.value.toLowerCase();

        document.querySelectorAll('.conv-item').forEach(item => {
            item.style.display = item.dataset.name.includes(value) ? '' : 'none';
        });
    });
}

const messagesArea = document.getElementById('messagesArea');
if (messagesArea) {
    messagesArea.scrollTop = messagesArea.scrollHeight;
}
</script>
@endsection