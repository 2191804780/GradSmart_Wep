@extends('layouts.student')

@section('title', 'GradSmart — المحادثة')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_chat.css') }}">
@endsection

@section('page_title')
<h1>💬 المحادثة</h1>
<p>تواصل مع أعضاء الفريق والمشرف ومجموعة المشروع</p>
@endsection

@section('content')

<div class="chat-page">

    @if($state === 'no_team')

        <div class="chat-empty-page">
            <div class="empty-icon">👥</div>
            <h2>لا يوجد فريق بعد</h2>
            <p>
                لا يمكنك استخدام المحادثة قبل الانضمام إلى فريق أو إنشاء فريق جديد.
            </p>
            <a href="{{ route('student.teams.create') }}" class="chat-main-btn">
                إنشاء فريق
            </a>
        </div>

    @else

        <div class="chat-layout">

            {{-- قائمة المحادثات --}}
            <div class="chat-sidebar">

                <div class="chat-sidebar-header">
                    <h2>💬 الرسائل</h2>

                    <div class="chat-search">
                        <span>🔍</span>
                        <input type="text" id="chatSearch" placeholder="ابحث في المحادثات...">
                    </div>
                </div>

                <div class="chat-tabs">
                    <button type="button" class="chat-tab active" data-filter="all">الكل</button>
                    <button type="button" class="chat-tab" data-filter="supervisor">المشرف</button>
                    <button type="button" class="chat-tab" data-filter="group">المجموعة</button>
                    <button type="button" class="chat-tab" data-filter="user">الفريق</button>
                </div>

                <div class="conversation-list">

                    @forelse($contacts as $contact)

                        @php
                            $isActive =
                                $selectedContact &&
                                $selectedContact['type'] === $contact['type'] &&
                                (int) $selectedContact['id'] === (int) $contact['id'];
                        @endphp

                        <a
                            href="{{ route('student.chat.index', [
                                'type' => $contact['type'],
                                'receiver_id' => $contact['id']
                            ]) }}"
                            class="conversation-item {{ $isActive ? 'active' : '' }}"
                            data-type="{{ $contact['type'] }}"
                            data-name="{{ strtolower($contact['name']) }}">

                            <div class="conversation-avatar {{ $contact['type'] }}">
                                {{ $contact['avatar'] }}

                                @if($contact['type'] !== 'group')
                                    <span class="online-dot"></span>
                                @endif
                            </div>

                            <div class="conversation-info">
                                <div class="conversation-name">
                                    {{ $contact['name'] }}
                                </div>

                                <div class="conversation-subtitle">
                                    {{ $contact['subtitle'] }}
                                </div>
                            </div>

                            @if($contact['type'] === 'group')
                                <span class="conversation-badge">Group</span>
                            @endif

                        </a>

                    @empty

                        <div class="chat-side-empty">
                            لا توجد محادثات حالياً.
                        </div>

                    @endforelse

                </div>
            </div>


            {{-- نافذة المحادثة --}}
            <div class="chat-window">

                @if($selectedContact)

                    {{-- أعلى المحادثة --}}
                    <div class="chat-header">

                        <div class="chat-header-info">

                            <div class="conversation-avatar big {{ $selectedContact['type'] }}">
                                {{ $selectedContact['avatar'] }}

                                @if($selectedContact['type'] !== 'group')
                                    <span class="online-dot"></span>
                                @endif
                            </div>

                            <div>
                                <h3>{{ $selectedContact['name'] }}</h3>
                                <p>
                                    @if($selectedContact['type'] === 'group')
                                        👥 مجموعة المشروع — {{ $team->name }}
                                    @elseif($selectedContact['type'] === 'supervisor')
                                        👨‍🏫 مشرف المشروع
                                    @else
                                        👤 عضو الفريق
                                    @endif
                                </p>
                            </div>

                        </div>

                        <div class="chat-header-actions">
                            <button type="button" class="header-btn" title="اتصال" onclick="featureSoon()">📞</button>
                            <button type="button" class="header-btn" title="فيديو" onclick="featureSoon()">🎥</button>
                            <button type="button" class="header-btn" title="خيارات" onclick="toggleOptionsMenu()">⋮</button>

                            <div class="chat-options-menu" id="chatOptionsMenu">
                                <button type="button">تحديد كمقروء</button>
                                <button type="button">كتم المحادثة</button>
                                <button type="button">حذف المحادثة</button>
                            </div>
                        </div>

                    </div>


                    {{-- الرسائل --}}
                    <div class="messages-area" id="messagesArea">

                        @forelse($messages as $message)

                            @php
                                $isMine = $message->sender_id === auth()->id();
                            @endphp

                            <div class="message-row {{ $isMine ? 'mine' : 'other' }}">

                                @if(!$isMine)
                                    <div class="message-sender">
                                        {{ $message->sender->name ?? 'مستخدم' }}
                                    </div>
                                @endif

                                <div class="message-bubble">

                                    <div class="message-content">
                                        {{ $message->content }}
                                    </div>

                                    <div class="message-meta">
                                        <span>
                                            {{ $message->sent_at ? \Carbon\Carbon::parse($message->sent_at)->format('H:i') : '' }}
                                        </span>

                                        @if($isMine)
                                            <span class="read-state">
                                                {{ $message->is_read ? '✓✓' : '✓' }}
                                            </span>
                                        @endif
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="no-messages">
                                <div>💬</div>
                                <h3>ابدأ المحادثة الآن</h3>
                                <p>اكتب رسالة في الأسفل لبدء التواصل.</p>
                            </div>

                        @endforelse

                    </div>


                    {{-- إرسال رسالة --}}
                    <form
                        class="chat-input-area"
                        method="POST"
                        action="{{ route('student.chat.send') }}"
                        enctype="multipart/form-data"
                        id="chatForm">

                        @csrf

                        <input type="hidden" name="conversation_type" value="{{ $chatType === 'group' ? 'group' : 'private' }}">

                        @if($chatType === 'group')
                            <input type="hidden" name="team_id" value="{{ $team->id }}">
                        @else
                            <input type="hidden" name="receiver_id" value="{{ $selectedContact['id'] }}">
                        @endif

                        <div class="input-tools">
                            <button type="button" class="tool-btn" id="emojiBtn">😊</button>

                            <button type="button" class="tool-btn" id="attachBtn">📎</button>
                            <input type="file" id="chatFileInput" name="attachment" style="display:none">
                        </div>

                        <div class="input-wrapper">
                            <textarea
                                name="content"
                                class="chat-input"
                                id="chatInput"
                                placeholder="اكتب رسالتك..."
                                rows="1"
                                required></textarea>

                            <div class="emoji-picker" id="emojiPicker">
                                <span>😀</span>
                                <span>😂</span>
                                <span>😍</span>
                                <span>👍</span>
                                <span>🎉</span>
                                <span>✅</span>
                                <span>📌</span>
                                <span>🔥</span>
                                <span>🙏</span>
                            </div>

                            <div class="file-preview" id="filePreview"></div>
                        </div>

                        <button type="submit" class="send-btn">
                            ➤
                        </button>

                    </form>

                @else

                    <div class="chat-empty-page">
                        <div class="empty-icon">💬</div>
                        <h2>اختاري محادثة</h2>
                        <p>اختاري شخصاً أو مجموعة من القائمة لبدء المحادثة.</p>
                    </div>

                @endif

            </div>

        </div>

    @endif

</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // تفعيل رابط المحادثة في السايدبار
    const navChat = document.getElementById('nav-chat');
    if (navChat) navChat.classList.add('active');

    // تمرير تلقائي لآخر رسالة
    const messagesArea = document.getElementById('messagesArea');
    if (messagesArea) {
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    // إرسال بالضغط على Enter
    const chatInput = document.getElementById('chatInput');
    const chatForm = document.getElementById('chatForm');

    if (chatInput && chatForm) {
        chatInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();

                if (chatInput.value.trim() !== '') {
                    chatForm.submit();
                }
            }
        });
    }

    // الإيموجي
    const emojiBtn = document.getElementById('emojiBtn');
    const emojiPicker = document.getElementById('emojiPicker');

    if (emojiBtn && emojiPicker && chatInput) {
        emojiBtn.addEventListener('click', function () {
            emojiPicker.classList.toggle('show');
        });

        emojiPicker.querySelectorAll('span').forEach(function (emoji) {
            emoji.addEventListener('click', function () {
                chatInput.value += this.textContent;
                emojiPicker.classList.remove('show');
                chatInput.focus();
            });
        });
    }

    // المرفقات
    const attachBtn = document.getElementById('attachBtn');
    const fileInput = document.getElementById('chatFileInput');
    const filePreview = document.getElementById('filePreview');

    if (attachBtn && fileInput) {
        attachBtn.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0 && filePreview) {
                filePreview.textContent = '📎 ' + fileInput.files[0].name;
                filePreview.style.display = 'block';
            }
        });
    }

    // البحث في المحادثات
    const chatSearch = document.getElementById('chatSearch');
    const conversationItems = document.querySelectorAll('.conversation-item');

    if (chatSearch) {
        chatSearch.addEventListener('keyup', function () {
            const value = this.value.toLowerCase();

            conversationItems.forEach(function (item) {
                item.style.display = item.dataset.name.includes(value) ? 'flex' : 'none';
            });
        });
    }

    // فلترة المحادثات
    const tabs = document.querySelectorAll('.chat-tab');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            conversationItems.forEach(function (item) {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});

// قائمة الخيارات
function toggleOptionsMenu() {
    const menu = document.getElementById('chatOptionsMenu');
    if (menu) menu.classList.toggle('show');
}

// ميزات لاحقة
function featureSoon() {
    alert('هذه الميزة ستضاف لاحقاً');
}
</script>
@endsection