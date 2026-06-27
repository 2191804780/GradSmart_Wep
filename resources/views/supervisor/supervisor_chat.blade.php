@extends('layouts.supervisor')

@section('title', 'محادثات المشرف')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/supervisor/supervisor_chat.css') }}">
<style>
  .conv-item {
    cursor: pointer;
  }
  .messages-area {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 20px;
    overflow-y: auto;
    height: 400px;
  }
  .chat-input-area form {
    width: 100%;
  }
  .chat-input-area .input-row {
    display: flex;
    align-items: center;
    background: var(--bg);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 8px 12px;
    gap: 10px;
  }
  .chat-input-area textarea {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    resize: none;
    font-family: 'Cairo', sans-serif;
    font-size: 0.85rem;
    direction: rtl;
  }
  .chat-input-area .send-btn {
    border: none;
    background: var(--primary);
    color: white;
    padding: 8px 16px;
    border-radius: 9px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.2s;
  }
  .chat-input-area .send-btn:hover {
    background: var(--secondary);
  }
</style>
@endsection

@section('no_topbar', true)

@section('content')
  <div class="chat-layout">
    
    <!-- قائمة المحادثات النشطة -->
    <div class="conv-list">
      <div class="conv-header">
        <h2>المراسلات الفورية</h2>
        <div class="conv-search">
          <input type="text" id="chat-search" oninput="searchChats(this.value)" placeholder="البحث عن مجموعة أو طالب...">
        </div>
        <div class="conv-tabs">
          <button class="ctab active">مجموعات التخرج</button>
        </div>
      </div>
      
      <div class="conv-items" id="conv-items-list">
        @foreach($teams as $team)
          @php
            $preview = $chatPreviews[$team->id] ?? null;
            $isActive = $team->id == $selectedTeam->id;
          @endphp
          <!-- محادثة نشطة -->
          <div class="conv-item {{ $isActive ? 'active' : '' }}" onclick="window.location='{{ route('supervisor.chat') }}?team_id={{ $team->id }}'">
            <div class="ci-avatar" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">👥
              <div class="online-dot"></div>
            </div>
            <div class="ci-info">
              <div class="ci-name">فريق {{ $team->name }} — {{ $team->project->title ?? 'لا يوجد مشروع' }}</div>
              <div class="ci-preview">{{ $preview ? $preview['last_message'] : 'لا توجد رسائل سابقة' }}</div>
            </div>
            <div class="ci-meta">
              <span class="ci-time">{{ $preview ? $preview['time'] : '' }}</span>
              @if($preview && $preview['unread_count'] > 0)
                <span class="ci-unread">{{ $preview['unread_count'] }}</span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- نافذة الدردشة النشطة -->
    <div class="chat-window">
      
      <div class="chat-topbar">
        <div class="ct-avatar">👥</div>
        <div>
          <div class="ct-name">فريق {{ $selectedTeam->name }} — {{ $selectedTeam->project->title ?? 'نظام إدارة التخرج' }}</div>
          <div class="ct-status">🟢 متصل الآن ({{ $selectedTeam->members->count() }} أعضاء نشطين)</div>
        </div>
        <div class="ct-actions">
          <button class="theme-toggle-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
        </div>
      </div>

      <!-- منطقة الرسائل -->
      <div class="messages-area" id="messages-box">
        <div class="date-divider">سجل المحادثة الجماعية</div>

        @forelse($messages as $message)
          @php
            $isMe = $message->sender_id == $supervisor->id;
          @endphp
          
          <div class="msg-group {{ $isMe ? 'me' : 'other' }}">
            <span class="msg-sender">
              @if($isMe)
                👨‍🏫 {{ $message->sender->name }} (أنت)
              @else
                👤 {{ $message->sender->name }}
              @endif
            </span>
            <div class="msg-bubble">
              {{ $message->content }}
            </div>
            <span class="msg-time">{{ $message->sent_at ? $message->sent_at->format('h:i A') : '' }}</span>
          </div>
        @empty
          <p style="text-align:center;color:var(--muted);padding:40px;font-size:0.85rem">لا توجد رسائل في هذه المحادثة بعد. ابدأ النقاش مع الطلاب!</p>
        @endforelse
      </div>

      <!-- مساحة الإدخال والكتابة -->
      <div class="chat-input-area">
        <form action="{{ route('supervisor.sendMessage', ['team' => $selectedTeam->id]) }}" method="POST">
          @csrf
          <div class="input-row">
            <textarea name="content" placeholder="اكتب رسالة للفريق..." rows="1" required></textarea>
            <div class="input-actions">
              <button type="submit" class="send-btn" title="إرسال">✈️</button>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Set active link in sidebar
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    const navChat = document.getElementById('nav-chat');
    if (navChat) navChat.classList.add('active');

    // Scroll to bottom of chat
    const messagesBox = document.getElementById('messages-box');
    if(messagesBox) {
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }
});

function searchChats(query) {
    query = query.toLowerCase();
    const items = document.querySelectorAll('.conv-item');
    items.forEach(item => {
        const text = item.innerText.toLowerCase();
        if(text.includes(query)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endsection
