<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — استعادة كلمة المرور</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="forgot_password.css">
</head>
<body>

<!-- زر تبديل الوضع المظلم (Theme Toggle Button) -->
<button class="theme-toggle" id="themeToggle" aria-label="تبديل المظهر">
  <span class="toggle-icon">🌙</span>
</button>

<div class="shape shape-1"></div>
<div class="shape shape-2"></div>

<div class="page-content" id="page-forgot">
  <div class="forgot-wrap">
    <a class="back-link" href="index.php">← العودة لتسجيل الدخول</a>

    <div class="forgot-card">

      <!-- الخطوة الأولى: البريد الجامعي -->
      <div class="forgot-step active" id="forgot-step1">
        <div class="fc-icon-big" style="background: linear-gradient(135deg, #eff6ff, #f5f3ff);">🔑</div>
        <div class="fc-title">نسيت كلمة المرور؟</div>
        <div class="fc-sub">أدخل بريدك الجامعي وسنرسل لك رمز التحقق لإعادة تعيين كلمة المرور الخاصة بك.</div>
        <div class="form-group">
          <label class="form-label">البريد الجامعي</label>
          <input class="form-input" placeholder="example@university.edu" type="email" id="reset-email">
        </div>
        <button class="btn btn-primary" style="width: 100%;" onclick="goToStep('forgot-step2')">
          📧 إرسال رمز التحقق
        </button>
        <div style="text-align: center; margin-top: 16px; font-size: 0.85rem; color: var(--muted); font-weight: 600;">
          تذكرت كلمة المرور؟ <a href="index.php" style="color: var(--primary); font-weight: 700; text-decoration: none;">تسجيل الدخول</a>
        </div>
      </div>

      <!-- الخطوة الثانية: إدخال رمز التحقق OTP -->
      <div class="forgot-step" id="forgot-step2">
        <div class="fc-icon-big" style="background: linear-gradient(135deg, #fffbeb, #fff7ed);">📨</div>
        <div class="fc-title">تحقق من بريدك</div>
        <div class="fc-sub">أرسلنا رمزاً مكوناً من 6 أرقام إلى بريدك الجامعي<br><strong style="color: var(--text)">example@university.edu</strong></div>

        <div class="otp-row">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
          <input class="otp-input" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrev(event,this)">
        </div>
        <div class="otp-hint">أدخل الرمز المكوّن من 6 أرقام لتأكيد الهوية.</div>

        <button class="btn btn-primary" style="width: 100%;" onclick="goToStep('forgot-step3')">
          ✅ تحقق من الرمز
        </button>
        <a class="resend-link" href="#">لم تستلم الرمز؟ إعادة الإرسال (00:45)</a>
      </div>

      <!-- الخطوة الثالثة: تعيين كلمة المرور الجديدة -->
      <div class="forgot-step" id="forgot-step3">
        <div class="fc-icon-big" style="background: linear-gradient(135deg, #f0fdf4, #ecfdf5);">🔒</div>
        <div class="fc-title">تعيين كلمة المرور الجديدة</div>
        <div class="fc-sub">اختر كلمة مرور قوية وغير مكررة لحماية حسابك الجامعي.</div>

        <div class="form-group">
          <label class="form-label">كلمة المرور الجديدة</label>
          <input class="form-input" type="password" placeholder="••••••••••" oninput="checkStrength(this)">
          <div class="pw-strength">
            <div class="pw-str-bars">
              <div class="pw-bar" id="bar1"></div>
              <div class="pw-bar" id="bar2"></div>
              <div class="pw-bar" id="bar3"></div>
              <div class="pw-bar" id="bar4"></div>
            </div>
            <div class="pw-str-label" id="pw-label" style="color: var(--muted); margin-top: 4px;">قوة كلمة المرور</div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">تأكيد كلمة المرور</label>
          <input class="form-input" type="password" placeholder="••••••••••">
        </div>
        <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 14px; font-size: 0.78rem; color: var(--muted); margin-bottom: 18px;">
          <div style="font-weight: 700; color: var(--green); margin-bottom: 6px;">✅ شروط كلمة المرور:</div>
          <div>• 8 أحرف على الأقل</div>
          <div>• حرف كبير وصغير (A, a)</div>
          <div>• رقم واحد على الأقل (0-9)</div>
          <div>• رمز خاص واحد على الأقل (!@#$)</div>
        </div>
        <button class="btn btn-primary" style="width: 100%;" onclick="goToStep('forgot-step4')">
          💾 حفظ كلمة المرور الجديدة
        </button>
      </div>

      <!-- الخطوة الرابعة: نجاح العملية -->
      <div class="forgot-step" id="forgot-step4">
        <div class="success-animation">
          <div class="success-icon">✅</div>
          <div style="font-size: 1.3rem; font-weight: 900; margin-bottom: 8px; color: var(--text)">تم بنجاح! 🎉</div>
          <div style="font-size: 0.88rem; color: var(--muted); line-height: 1.7; margin-bottom: 24px;">تم تغيير كلمة مرورك بنجاح. يمكنك الآن تسجيل الدخول بكلمة المرور الجديدة واستخدام النظام بالكامل.</div>
          <a class="btn btn-primary" style="width: 100%; text-decoration: none;" href="index.php">
            🔐 تسجيل الدخول الآن
          </a>
        </div>
      </div>

    </div>

    <!-- نقاط تتبع الخطوات -->
    <div style="display: flex; justify-content: center; gap: 8px; margin-top: 24px;" id="step-dots">
      <div style="width: 20px; height: 8px; border-radius: 10px; background: var(--primary);" id="dot1"></div>
      <div style="width: 8px; height: 8px; border-radius: 10px; background: var(--border);" id="dot2"></div>
      <div style="width: 8px; height: 8px; border-radius: 10px; background: var(--border);" id="dot3"></div>
      <div style="width: 8px; height: 8px; border-radius: 10px; background: var(--border);" id="dot4"></div>
    </div>
  </div>
</div>

<script>
let currentStep=1;
function goToStep(stepId){
  document.querySelectorAll('.forgot-step').forEach(s=>s.classList.remove('active'));
  document.getElementById(stepId).classList.add('active');
  currentStep=parseInt(stepId.replace('forgot-step',''));
  document.querySelectorAll('[id^="dot"]').forEach((d,i)=>{
    d.style.background=i+1<=currentStep?'var(--primary)':'var(--border)';
    d.style.width=i+1===currentStep?'20px':'8px';
    d.style.transition='all .3s cubic-bezier(0.4, 0, 0.2, 1)';
    d.style.borderRadius='10px';
  });
}

// التحكم بحقول الـ OTP والانتقال التلقائي للتركيز
function moveToNext(el) {
  if (el.value.length === el.maxLength && el.nextElementSibling) {
    el.nextElementSibling.focus();
  }
}
function moveToPrev(e, el) {
  if (e.key === "Backspace" && el.value.length === 0 && el.previousElementSibling) {
    el.previousElementSibling.focus();
  }
}

// مدقق قوة كلمة المرور الجامعية
function checkStrength(el){
  const val=el.value;
  let score=0;
  if(val.length>=8) score++;
  if(/[A-Z]/.test(val)&&/[a-z]/.test(val)) score++;
  if(/\d/.test(val)) score++;
  if(/[!@#$%^&*]/.test(val)) score++;
  const bars=['bar1','bar2','bar3','bar4'];
  const colors=['var(--red)','var(--orange)','var(--yellow)','var(--green)'];
  const labels=['ضعيفة جداً 🚨','ضعيفة ⚠️','متوسطة 🛡️','قوية قوية 💪'];
  bars.forEach((b,i)=>{
    document.getElementById(b).style.background=(i<score?colors[score-1]:'var(--border)');
  });
  if(score>0){
    document.getElementById('pw-label').textContent=labels[score-1];
    document.getElementById('pw-label').style.color=colors[score-1];
  } else {
    document.getElementById('pw-label').textContent='قوة كلمة المرور';
    document.getElementById('pw-label').style.color='var(--muted)';
  }
}

// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح وتزامنه (Dark/Light Theme Controller)
const themeToggle = document.getElementById('themeToggle');
const toggleIcon = themeToggle.querySelector('.toggle-icon');

if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add('dark-theme');
  toggleIcon.textContent = '☀️';
} else {
  toggleIcon.textContent = '🌙';
}

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  const isDark = document.body.classList.contains('dark-theme');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
  toggleIcon.textContent = isDark ? '☀️' : '🌙';
});
</script>
</body>
</html>
