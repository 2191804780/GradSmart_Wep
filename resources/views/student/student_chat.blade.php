@extends('layouts.student')

@section('title', 'GradSmart — المحادثة')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_chat.css') }}">
@endsection

@section('page_title')
<h1>💬 المحادثة</h1>
<p>GradSmart — تواصل مع فريقك ومشرفك</p>
@endsection

@section('content')
  <div class="chat-layout">
 
    <!-- Conversations -->
    <div class="conv-list">
      <div class="conv-header">
        <h2>💬 الرسائل</h2>
        <div class="conv-search">
          <span>🔍</span>
          <input placeholder="ابحث في المحادثات...">
        </div>
        <div class="conv-tabs">
          <button class="ctab active">الكل</button>
          <button class="ctab">المشرفون</button>
          <button class="ctab">الفريق</button>
        </div>
      </div>
      <div class="conv-items">
 
        <div class="conv-item active">
          <div class="ci-avatar" style="background:linear-gradient(135deg,var(--green),var(--teal))">
            أح
            <div class="online-dot"></div>
          </div>
          <div class="ci-info">
            <div class="ci-name">د. أحمد السالم</div>
            <div class="ci-preview">أداء ممتاز في الجزء الخلفي...</div>
          </div>
          <div class="ci-meta">
            <div class="ci-time">6:30 م</div>
          </div>
        </div>
 
        <div class="conv-item">
          <div class="ci-avatar" style="background:linear-gradient(135deg,var(--pink),var(--orange))">
            سا
          </div>
          <div class="ci-info">
            <div class="ci-name">سارة علي — الفريق</div>
            <div class="ci-preview">هل راجعت التصميم الجديد؟</div>
          </div>
          <div class="ci-meta">
            <div class="ci-time">3:15 م</div>
            <div class="ci-unread">2</div>
          </div>
        </div>
 
        <div class="conv-item">
          <div class="ci-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
            عم
            <div class="online-dot"></div>
          </div>
          <div class="ci-info">
            <div class="ci-name">عمر خالد — الفريق</div>
            <div class="ci-preview">انتهيت من الـ API اليوم</div>
          </div>
          <div class="ci-meta">
            <div class="ci-time">1:00 م</div>
          </div>
        </div>
 
        <div class="conv-item">
          <div class="ci-avatar" style="background:linear-gradient(135deg,var(--yellow),var(--orange))">
            لي
          </div>
          <div class="ci-info">
            <div class="ci-name">ليلى يوسف — الفريق</div>
            <div class="ci-preview">جداول قاعدة البيانات جاهزة</div>
          </div>
          <div class="ci-meta">
            <div class="ci-time">أمس</div>
          </div>
        </div>
 
      </div>
    </div>
 
    <!-- Chat Window -->
    <div class="chat-window">
 
      <!-- Topbar -->
      <div class="chat-topbar">
        <div class="ct-avatar">
          أح
          <div class="online-dot"></div>
        </div>
        <div>
          <div class="ct-name">د. أحمد السالم</div>
          <div class="ct-status">🟢 متاح الآن</div>
        </div>
        <div class="ct-actions">
          <div class="ct-btn">📞</div>
          <div class="ct-btn">📹</div>
          <div class="ct-btn">📎</div>
          <div class="ct-btn">⋮</div>
        </div>
      </div>
 
      <!-- Messages -->
      <div class="messages-area">
 
        <div class="date-divider">أمس</div>
 
        <div class="msg-group me">
          <div class="msg-sender">د. أحمد السالم</div>
          <div class="msg-bubble">
            مرحباً محمد، كيف يسير العمل في المشروع هذا الأسبوع؟
          </div>
          <div class="msg-time">أمس 2:00 م</div>
        </div>
 
        <div class="msg-group other">
          <div class="msg-bubble">
            السلام عليكم دكتور! العمل يسير بشكل جيد. أنهينا تصميم قاعدة البيانات وبدأنا في واجهات المستخدم 🎉
          </div>
          <div class="msg-time">أمس 2:10 م</div>
        </div>
 
        <div class="msg-group me">
          <div class="msg-bubble">
            ممتاز! هل يمكنك إرسال تقرير التقدم المرحلي؟
          </div>
          <div class="msg-time">أمس 2:15 م</div>
        </div>
 
        <div class="msg-group other">
          <div style="display:flex;justify-content:flex-end">
            <div class="file-bubble">
              <div class="file-icon">📄</div>
              <div>
                <div class="file-name">تقرير_المرحلة_الثانية.pdf</div>
                <div class="file-size">2.4 MB · PDF</div>
              </div>
            </div>
          </div>
          <div class="msg-time">أمس 2:20 م</div>
        </div>
 
        <div class="date-divider">اليوم</div>
 
        <div class="msg-group me">
          <div class="msg-sender">د. أحمد السالم</div>
          <div class="msg-bubble">
            أداء ممتاز في الجزء الخلفي. أرجو التركيز على واجهة المستخدم وتحسين تجربة الطالب قبل الموعد النهائي. كذلك أنصح بإضافة صفحة الأخطاء 404.
          </div>
          <div class="msg-time">6:30 م</div>
        </div>
 
        <div class="msg-group other">
          <div class="msg-bubble">
            شكراً دكتور! سنعمل على واجهة المستخدم خلال هذا الأسبوع وسنضيف صفحة 404 كما اقترحتم 👍
          </div>
          <div class="msg-time">6:45 م</div>
        </div>
 
        <!-- Typing -->
        <div class="msg-group me">
          <div class="msg-sender">د. أحمد يكتب...</div>
          <div class="typing">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
          </div>
        </div>
 
      </div>
 
      <!-- Input -->
      <div class="chat-input-area">
        <div class="input-row">
          <div class="input-actions">
            <button class="ia-btn">😊</button>
            <button class="ia-btn">📎</button>
          </div>
          <textarea class="chat-input" placeholder="اكتب رسالتك..." rows="1"></textarea>
          <button class="send-btn">➤</button>
        </div>
      </div>
 
    </div>
  </div>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    const navChat = document.getElementById('nav-chat');
    if (navChat) navChat.classList.add('active');
</script>
@endsection
