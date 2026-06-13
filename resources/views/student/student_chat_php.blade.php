<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — المحادثة</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/student_chat.css">
</head>
<body>

<?php 
  // استدعاء البار الجانبي المشترك للطالب
  include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/student_sidebar.php'; 
?>
 
<div class="main">
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
          <button class="ct-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
          <div class="ct-btn">📞</div>
          <div class="ct-btn">📹</div>
          <div class="ct-btn">📎</div>
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
</div>

<script>
// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح وتزامنه (Dark/Light Theme)
const themeToggle = document.getElementById('themeToggle');

// التحقق من الإعدادات المحفوظة مسبقاً لدى المستخدم في الـ localStorage
if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add('dark-theme');
  themeToggle.textContent = '☀️';
} else {
  themeToggle.textContent = '🌙';
}

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  const isDark = document.body.classList.contains('dark-theme');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
  themeToggle.textContent = isDark ? '☀️' : '🌙';
});

// تفعيل كلاس active للبند الحالي في السايدبار تلقائياً
document.getElementById('nav-chat').classList.add('active');
</script>
</body>
</html>
