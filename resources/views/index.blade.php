<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — تسجيل الدخول</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;900&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── نظام المتغيرات وتخصيص الألوان (Theme System & Colors) ── */
:root {
  /* الوضع المضيء الراقي (Premium Light Theme) */
  --primary: #4f46e5;       /* لون إنديغو أزرق بنفسجي أساسي */
  --primary-light: #6366f1; /* إنديغو فاتح */
  --primary-dark: #3730a3;  /* إنديغو غامق */
  --secondary: #8b5cf6;     /* اللون البنفسجي المكمل */
  --bg: #f8fafc;            /* خلفية ناصعة ومريحة */
  --white: #ffffff;
  --text: #0f172a;          /* نص داكن جداً */
  --muted: #64748b;         /* نص رمادي للمسميات الفرعية */
  --border: #e2e8f0;        /* حدود رمادية خفيفة */
  
  /* متغيرات واجهة الزجاج (Glassmorphism Variables) */
  --glass-bg: rgba(255, 255, 255, 0.75);
  --glass-border: rgba(255, 255, 255, 0.5);
  --input-bg: #f8fafc;
  --tab-bg: #f1f5f9;
  --tab-btn-active: #ffffff;
  --role-bg: #f8fafc;
  --role-selected-bg: #eff6ff;
  
  --shape-1-bg: #c7d2fe;    /* ألوان الأشكال الطافية في الخلفية */
  --shape-2-bg: #a5f3fc;
  
  --card-shadow: 0 25px 60px rgba(99, 102, 241, 0.1), 0 8px 20px rgba(0, 0, 0, 0.05);
}

body.dark-theme {
  /* الوضع المظلم الفخم (Premium Dark Theme) */
  --bg: #090d16;            /* خلفية داكنة جداً مستوحاة من السماء الليلية */
  --white: #111827;         /* بطاقات داكنة */
  --text: #f3f4f6;          /* نص فاتح ناصع */
  --muted: #9ca3af;         /* نص رمادي باهت */
  --border: #1f2937;        /* حدود داكنة متماشية مع الخلفية */
  
  /* متغيرات واجهة الزجاج للوضع المظلم */
  --glass-bg: rgba(17, 24, 39, 0.65);
  --glass-border: rgba(255, 255, 255, 0.07);
  --input-bg: #1e293b;
  --tab-bg: #0f172a;
  --tab-btn-active: #1e293b;
  --role-bg: #1e293b;
  --role-selected-bg: rgba(99, 102, 241, 0.15);
  
  --shape-1-bg: #312e81;    /* ألوان داكنة للأشكال لتقليل الوهج */
  --shape-2-bg: #1e1b4b;
  
  --card-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 0 8px 20px rgba(0, 0, 0, 0.2);
}

body {
  font-family: 'Cairo', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
  overflow: hidden;
  position: relative;
  transition: background 0.4s ease, color 0.4s ease;
}

/* شبكة الخلفية التفاعلية */
body::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image: 
    linear-gradient(var(--border) 1px, transparent 1px), 
    linear-gradient(90deg, var(--border) 1px, transparent 1px);
  background-size: 40px 40px;
  pointer-events: none;
  opacity: 0.25;
  z-index: 0;
}

/* الأشكال الطافية المتحركة (Floating Background Shapes) */
.shape { 
  position: fixed; 
  border-radius: 50%; 
  filter: blur(90px); 
  opacity: 0.45; 
  animation: float 10s ease-in-out infinite; 
  pointer-events: none; 
  z-index: 0; 
  transition: background 0.5s ease;
}
.shape-1 { width: 600px; height: 600px; background: var(--shape-1-bg); top: -200px; right: -200px; animation-delay: 0s; }
.shape-2 { width: 400px; height: 400px; background: var(--shape-2-bg); bottom: -100px; left: -100px; animation-delay: 3s; }
@keyframes float { 
  0%, 100% { transform: translateY(0) scale(1); } 
  50% { transform: translateY(-40px) scale(1.05); } 
}

/* ── زر تبديل المظهر (Theme Toggle Button) ── */
.theme-toggle {
  position: fixed;
  left: 24px;
  top: 24px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid var(--glass-border);
  box-shadow: 0 8px 32px rgba(0,0,0,0.06);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  z-index: 999;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.theme-toggle:hover {
  transform: scale(1.1) rotate(15deg);
  box-shadow: 0 12px 35px rgba(99, 102, 241, 0.2);
}

/* ── اللوحة اليسارية الترويجية (Left Panel) ── */
.left-panel {
  width: 55%; 
  background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4f46e5 100%);
  display: flex; 
  flex-direction: column; 
  justify-content: center; 
  align-items: center;
  padding: 60px; 
  position: relative; 
  overflow: hidden; 
  z-index: 1;
  border-left: 1px solid rgba(255, 255, 255, 0.08);
}
.left-panel::before {
  content: ''; 
  position: absolute; 
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.035'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
}
.left-panel::after {
  content: ''; 
  position: absolute; 
  width: 500px; 
  height: 500px; 
  border-radius: 50%;
  background: rgba(99, 102, 241, 0.08); 
  bottom: -200px; 
  left: -150px;
}

.logo-area { text-align: center; margin-bottom: 50px; position: relative; z-index: 2; }
.logo-icon {
  width: 96px; 
  height: 96px; 
  background: rgba(255, 255, 255, 0.12); 
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.25); 
  border-radius: 26px;
  display: flex; 
  align-items: center; 
  justify-content: center; 
  font-size: 2.7rem;
  margin: 0 auto 24px; 
  animation: logoFloat 4s ease-in-out infinite;
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
@keyframes logoFloat { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

.logo-name { 
  font-family: 'Montserrat', sans-serif; 
  font-size: 3rem; 
  font-weight: 900; 
  color: white; 
  letter-spacing: -1px; 
}
.logo-name span { color: #a5b4fc; } /* لون أزرق فاتح مكمل للوغو */
.logo-tagline { color: rgba(255, 255, 255, 0.75); font-size: 1rem; margin-top: 8px; font-weight: 500; }

.features { display: flex; flex-direction: column; gap: 16px; width: 100%; max-width: 400px; position: relative; z-index: 2; }
.feature-item {
  display: flex; 
  align-items: center; 
  gap: 16px;
  background: rgba(255, 255, 255, 0.08); 
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1); 
  border-radius: 18px; 
  padding: 16px 20px;
  transition: all 0.3s;
  animation: slideIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
}
.feature-item:hover {
  background: rgba(255, 255, 255, 0.13);
  transform: translateX(-5px);
  border-color: rgba(255, 255, 255, 0.2);
}
.feature-item:nth-child(1){animation-delay:.1s} 
.feature-item:nth-child(2){animation-delay:.2s}
.feature-item:nth-child(3){animation-delay:.3s} 
.feature-item:nth-child(4){animation-delay:.4s}

@keyframes slideIn { from { opacity: 0; transform: translateX(40px); } to { opacity: 1; transform: translateX(0); } }
.feature-icon { 
  width: 44px; 
  height: 44px; 
  background: rgba(255, 255, 255, 0.15); 
  border-radius: 12px; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  font-size: 1.3rem; 
  flex-shrink: 0; 
}
.feature-text { color: white; text-align: right; }
.feature-text strong { display: block; font-size: 0.95rem; font-weight: 700; margin-bottom: 2px; }
.feature-text span { font-size: 0.78rem; opacity: 0.75; }

/* ── اللوحة اليمينية للنماذج (Right Panel & Auth Card) ── */
.right-panel { 
  width: 45%; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  padding: 40px; 
  position: relative; 
  z-index: 1; 
}

/* بطاقة الزجاج المذهلة (Glassmorphic Auth Card) */
.auth-card { 
  background: var(--glass-bg); 
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid var(--glass-border);
  border-radius: 30px; 
  padding: 48px 40px; 
  width: 100%; 
  max-width: 450px; 
  box-shadow: var(--card-shadow); 
  animation: cardUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; 
  transition: background 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
}
@keyframes cardUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

/* التبويبات (Tabs Layout) */
.tabs { display: flex; background: var(--tab-bg); border-radius: 14px; padding: 5px; margin-bottom: 32px; transition: background 0.4s ease; }
.tab-btn { 
  flex: 1; 
  padding: 11px; 
  border: none; 
  background: transparent; 
  border-radius: 11px; 
  font-family: 'Cairo', sans-serif; 
  font-size: 0.9rem; 
  font-weight: 700; 
  color: var(--muted); 
  cursor: pointer; 
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
}
.tab-btn.active { 
  background: var(--tab-btn-active); 
  color: var(--primary); 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); 
}

.form-section { display: none; }
.form-section.active { display: block; }
.form-title { font-size: 1.6rem; font-weight: 900; color: var(--text); margin-bottom: 6px; }
.form-subtitle { color: var(--muted); font-size: 0.88rem; margin-bottom: 28px; }

.form-group { margin-bottom: 20px; }
.form-label { display: block; font-size: 0.88rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
.input-wrapper { position: relative; }
.input-icon { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: 1.1rem; pointer-events: none; opacity: 0.7; }

/* تصميم الحقول الحديثة */
.form-input { 
  width: 100%; 
  padding: 13px 48px 13px 16px; 
  border: 2px solid var(--border); 
  border-radius: 14px; 
  font-family: 'Cairo', sans-serif; 
  font-size: 0.9rem; 
  color: var(--text); 
  background: var(--input-bg); 
  transition: all 0.3s; 
  outline: none; 
  direction: rtl; 
}
.form-input::placeholder { color: var(--muted); opacity: 0.6; }
.form-input:focus { 
  border-color: var(--primary); 
  background: var(--white); 
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15); 
}

/* اختيار نوع الحساب (Role Selector) */
.role-selector { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }
.role-option { 
  display: flex; 
  flex-direction: column; 
  align-items: center; 
  gap: 6px; 
  padding: 14px 8px; 
  border: 2px solid var(--border); 
  border-radius: 14px; 
  cursor: pointer; 
  transition: all 0.25s ease; 
  background: var(--role-bg); 
}
.role-option:hover { 
  border-color: var(--primary-light); 
  background: var(--role-selected-bg); 
  transform: translateY(-2px);
}
.role-option.selected { 
  border-color: var(--primary); 
  background: var(--role-selected-bg); 
  box-shadow: 0 4px 15px rgba(99, 102, 241, 0.1);
}
.role-icon { 
  width: 38px; 
  height: 38px; 
  border-radius: 10px; 
  background: var(--border); 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  font-size: 1.15rem; 
  transition: all 0.3s;
}
.role-option.selected .role-icon { 
  background: var(--primary); 
  color: white; 
}
.role-label { font-size: 0.8rem; font-weight: 700; color: var(--text); }

/* الأزرار الأساسية الفخمة */
.btn-primary { 
  width: 100%; 
  padding: 15px; 
  background: linear-gradient(135deg, var(--primary), var(--secondary)); 
  color: white; 
  border: none; 
  border-radius: 14px; 
  font-family: 'Cairo', sans-serif; 
  font-size: 1rem; 
  font-weight: 700; 
  cursor: pointer; 
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
  margin-top: 8px; 
  box-shadow: 0 8px 25px rgba(99, 102, 241, 0.25);
}
.btn-primary:hover { 
  transform: translateY(-2px); 
  box-shadow: 0 12px 30px rgba(99, 102, 241, 0.4); 
}
.btn-primary:active {
  transform: translateY(0);
}

.forgot-link { 
  display: block; 
  text-align: center; 
  color: var(--primary); 
  font-size: 0.85rem; 
  font-weight: 700; 
  text-decoration: none; 
  margin-top: 16px; 
  transition: color 0.2s;
}
.forgot-link:hover { color: var(--secondary); text-decoration: underline; }

.security-badges { 
  display: flex; 
  justify-content: center; 
  gap: 16px; 
  margin-top: 26px; 
  padding-top: 20px; 
  border-top: 1px solid var(--border); 
}
.badge { display: flex; align-items: center; gap: 5px; font-size: 0.75rem; color: var(--muted); font-weight: 600; }

@media (max-width: 900px) {
  body { flex-direction: column; overflow-y: auto; }
  .left-panel { width: 100%; padding: 40px 24px; min-height: auto; border-left: none; border-bottom: 1px solid rgba(255, 255, 255, 0.08); }
  .right-panel { width: 100%; padding: 32px 16px; }
  .features { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .theme-toggle { left: 16px; top: 16px; width: 42px; height: 42px; font-size: 1.15rem; }
}
@media (max-width: 600px) {
  .features { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<!-- زر تبديل الوضع المظلم (Theme Toggle Button) -->
<button class="theme-toggle" id="themeToggle" aria-label="تبديل المظهر">
  <span class="toggle-icon">🌙</span>
</button>

<div class="shape shape-1"></div>
<div class="shape shape-2"></div>

<div class="left-panel">
  <div class="logo-area">
    <div class="logo-icon">🎓</div>
    <div class="logo-name">Grad<span>Smart</span></div>
    <div class="logo-tagline">نظام إدارة مشاريع التخرج الذكي</div>
  </div>
  <div class="features">
    <div class="feature-item">
      <div class="feature-icon">👥</div>
      <div class="feature-text"><strong>إدارة الفرق بسهولة</strong><span>أنشئ فريقك وتعاون مع زملائك</span></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon">✅</div>
      <div class="feature-text"><strong>تتبع المهام لحظة بلحظة</strong><span>راقب تقدم مشروعك في الوقت الفعلي</span></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon">🤖</div>
      <div class="feature-text"><strong>ذكاء اصطناعي تنبؤي</strong><span>توقع المخاطر قبل حدوثها</span></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon">💬</div>
      <div class="feature-text"><strong>تواصل مع مشرفك</strong><span>ملاحظات وتقييمات فورية</span></div>
    </div>
  </div>
</div>

<div class="right-panel">
  <div class="auth-card">
    <div class="tabs">
      <button class="tab-btn active" onclick="switchTab('login')">تسجيل الدخول</button>
      <button class="tab-btn" onclick="switchTab('register')">حساب جديد</button>
    </div>

    <div class="form-section active" id="login">
      <div class="form-title">أهلاً بعودتك 👋</div>
      <div class="form-subtitle">سجّل دخولك للوصول إلى مشاريعك</div>
      <div class="form-group">
        <label class="form-label">البريد الالكتروني</label>
        <div class="input-wrapper">
          <span class="input-icon">✉️</span>
          <input type="email" class="form-input" placeholder="example@university.edu">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">كلمة المرور</label>
        <div class="input-wrapper">
          <span class="input-icon">🔒</span>
          <input type="password" class="form-input" placeholder="••••••••">
        </div>
      </div>
      <button class="btn-primary">تسجيل الدخول ←</button>
      <a href="forgot_password.html" class="forgot-link">نسيت كلمة المرور؟</a>
    </div>

    <div class="form-section" id="register">
      <div class="form-title">إنشاء حساب جديد ✨</div>
      <div class="form-subtitle">انضم إلى منصة GradSmart اليوم</div>
      <div class="form-group">
        <label class="form-label">نوع الحساب</label>
        <div class="role-selector">
          <div class="role-option selected" onclick="selectRole(this)">
            <div class="role-icon">👨‍🎓</div><span class="role-label">طالب</span>
          </div>
          <div class="role-option" onclick="selectRole(this)">
            <div class="role-icon">👨‍🏫</div><span class="role-label">مشرف</span>
          </div>
          <div class="role-option" onclick="selectRole(this)">
            <div class="role-icon">🏛️</div><span class="role-label">إدارة</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">الاسم الكامل</label>
        <div class="input-wrapper">
          <span class="input-icon">👤</span>
          <input type="text" class="form-input" placeholder="محمد أحمد علي">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">البريد الالكتروني</label>
        <div class="input-wrapper">
          <span class="input-icon">✉️</span>
          <input type="email" class="form-input" placeholder="example@university.edu">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">كلمة المرور</label>
        <div class="input-wrapper">
          <span class="input-icon">🔒</span>
          <input type="password" class="form-input" placeholder="••••••••">
        </div>
      </div>
      <button class="btn-primary">إنشاء الحساب ←</button>
    </div>

    <div class="security-badges">
      <div class="badge">🔐 اتصال آمن</div>
      <div class="badge">🎓 للجامعات فقط</div>
      <div class="badge">✅ موثوق</div>
    </div>
  </div>
</div>

<script>
// نظام تبديل التبويبات (Login / Register Tab Switcher)
function switchTab(tab) {
  document.querySelectorAll('.tab-btn').forEach((btn,i) => btn.classList.toggle('active', (i===0&&tab==='login')||(i===1&&tab==='register')));
  document.getElementById('login').classList.toggle('active', tab==='login');
  document.getElementById('register').classList.toggle('active', tab==='register');
}

// نظام اختيار دور المستخدم (User Role Selection)
function selectRole(el) {
  document.querySelectorAll('.role-option').forEach(r => r.classList.remove('selected'));
  el.classList.add('selected');
}

// نظام تبديل المظهر وحفظ تفضيل المستخدم في المتصفح (Dark/Light Theme Controller)
const themeToggle = document.getElementById('themeToggle');
const toggleIcon = themeToggle.querySelector('.toggle-icon');

// التحقق من الإعدادات المحفوظة مسبقاً لدى المستخدم
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