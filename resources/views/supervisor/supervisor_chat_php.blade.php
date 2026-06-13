<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — محادثات المشرف</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/supervisor_chat.css">
</head>
<body>

<?php 
  // استدعاء البار الجانبي المشترك للمشرف
  include $_SERVER['DOCUMENT_ROOT'] . '/GradSmart/layouts/supervisor_sidebar.php'; 
?>

<!-- ── القسم الرئيسي (Main Section) ── -->
<div class="main">
  
  <div class="chat-layout">
    
    <!-- قائمة المحادثات النشطة -->
    <div class="conv-list">
      <div class="conv-header">
        <h2>المراسلات الفورية</h2>
        <div class="conv-search">
          <input type="text" placeholder="البحث عن مجموعة أو طالب...">
        </div>
        <div class="conv-tabs">
          <button class="ctab active">مجموعات التخرج</button>
          <button class="ctab">استفسارات فردية</button>
        </div>
      </div>
      
      <div class="conv-items">
        <!-- محادثة نشطة -->
        <div class="conv-item active">
          <div class="ci-avatar" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">👥
            <div class="online-dot"></div>
          </div>
          <div class="ci-info">
            <div class="ci-name">فريق Alpha — مشروع GradSmart</div>
            <div class="ci-preview">سارة: تم إرفاق تقرير المرحلة الثالثة...</div>
          </div>
          <div class="ci-meta">
            <span class="ci-time">2:30 م</span>
            <span class="ci-unread">2</span>
          </div>
        </div>

        <div class="conv-item">
          <div class="ci-avatar" style="background: linear-gradient(135deg, var(--orange), var(--red));">👥
            <div class="online-dot" style="background: #9ca3af;"></div>
          </div>
          <div class="ci-info">
            <div class="ci-name">فريق Beta — مكتبة SmartLibrary</div>
            <div class="ci-preview">عمر: هل يمكن تحديد موعد لمراجعة الـ ERD؟</div>
          </div>
          <div class="ci-meta">
            <span class="ci-time">أمس</span>
            <span class="ci-unread">1</span>
          </div>
        </div>

        <div class="conv-item">
          <div class="ci-avatar" style="background: linear-gradient(135deg, var(--purple), var(--blue));">👥</div>
          <div class="ci-info">
            <div class="ci-name">فريق Gamma — متجر إلكتروني</div>
            <div class="ci-preview">المشرف: يرجى تسريع العمل لتجنب التأخير</div>
          </div>
          <div class="ci-meta">
            <span class="ci-time">20 مايو</span>
          </div>
        </div>
      </div>
    </div>

    <!-- نافذة الدردشة النشطة -->
    <div class="chat-window">
      
      <div class="chat-topbar">
        <div class="ct-avatar">👥</div>
        <div>
          <div class="ct-name">فريق Alpha — نظام إدارة التخرج GradSmart</div>
          <div class="ct-status">🟢 متصل الآن (3 أعضاء نشطين)</div>
        </div>
        <div class="ct-actions">
          <button class="ct-btn" title="مكالمة فيديو جماعية">📞</button>
          <button class="ct-btn" title="ملفات المجموعة">📁</button>
          <button class="theme-toggle-btn" id="themeToggle" aria-label="تبديل المظهر">🌙</button>
        </div>
      </div>

      <!-- منطقة الرسائل -->
      <div class="messages-area">
        
        <div class="date-divider">الأربعاء، 27 مايو 2026</div>

        <!-- رسالة من الطالب -->
        <div class="msg-group other">
          <span class="msg-sender">👤 محمد أحمد (رئيس الفريق)</span>
          <div class="msg-bubble">
            أهلاً يا دكتور، لقد قمنا بتعديل الواجهات الأمامية بالكامل بناءً على ملاحظاتك الأخيرة، وأضفنا الوضع المظلم وتأثير الزجاج كما اقترحت.
          </div>
          <span class="msg-time">2:15 م</span>
        </div>

        <!-- رسالة مرفق من طالب آخر -->
        <div class="msg-group other">
          <span class="msg-sender">👤 سارة العلي</span>
          <div class="file-bubble">
            <div class="file-icon">📄</div>
            <div class="file-info">
              <div class="file-name">التقرير_المرقّي_المرحلة_3.pdf</div>
              <div class="file-size">4.2 MB</div>
            </div>
          </div>
          <span class="msg-time">2:20 م</span>
        </div>

        <!-- رسالة من المشرف (أنا) -->
        <div class="msg-group me">
          <span class="msg-sender">👨‍🏫 د. أحمد السالم (أنت)</span>
          <div class="msg-bubble">
            عمل رائع ومتميز يا شباب! الواجهات تبدو استثنائية وجذابة للغاية الآن. سأقوم بمراجعة تقرير المرحلة الثالثة وإرسال الملاحظات والتقييم لكم قبل اجتماعنا اليوم الساعة 2:00 م.
          </div>
          <span class="msg-time">2:25 م</span>
        </div>

        <!-- مؤشر الكتابة التفاعلي -->
        <div class="msg-group other">
          <span class="msg-sender">👤 عمر أحمد يكتب الآن...</span>
          <div class="typing">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
          </div>
        </div>

      </div>

      <!-- مساحة الإدخال والكتابة -->
      <div class="chat-input-area">
        <div class="input-row">
          <textarea class="chat-input" placeholder="اكتب رسالة للفريق..." rows="1"></textarea>
          <div class="input-actions">
            <button class="ia-btn" title="إرفاق ملف">📎</button>
            <button class="ia-btn" title="إضافة رموز تعبيرية">😊</button>
            <button class="send-btn" title="إرسال">✈️</button>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<script>
// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح وتزامنه (Dark/Light Theme Controller)
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
