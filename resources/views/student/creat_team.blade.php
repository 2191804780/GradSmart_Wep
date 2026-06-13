@extends('layouts.student')

@section('title', 'GradSmart — إنشاء فريق')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/creat_team.css') }}">
@endsection

@section('content')
<!-- Stepper -->
    <div class="stepper">
      <div class="step active"><div class="step-circle">1</div><div class="step-label">بيانات الفريق</div></div>
      <div class="step-line pending"></div>
      <div class="step pending"><div class="step-circle">2</div><div class="step-label">إضافة الأعضاء</div></div>
      <div class="step-line pending"></div>
      <div class="step pending"><div class="step-circle">3</div><div class="step-label">إنشاء المشروع</div></div>
      <div class="step-line pending"></div>
      <div class="step pending"><div class="step-circle">4</div><div class="step-label">اختيار المشرف</div></div>
    </div>
 
    <div class="create-team-layout">
      <!-- Form -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header"><div class="card-title">🏷️ بيانات الفريق الأساسية</div></div>
 
        <div class="form-group">
          <label class="form-label">اسم الفريق <span class="req">*</span></label>
          <input class="form-input" placeholder="مثال: Team Alpha، فريق النجوم..." oninput="document.getElementById('preview-name').textContent=this.value||'اسم فريقك'">
        </div>
 
        <div class="form-group">
          <label class="form-label">اختر إيموجي الفريق</label>
          <div class="emoji-picker">
            <div class="emoji-opt selected" onclick="selectEmoji(this,'🚀')">🚀</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'⚡')">⚡</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🔥')">🔥</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'💡')">💡</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🌟')">🌟</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🎯')">🎯</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🦁')">🦁</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🐉')">🐉</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🌊')">🌊</div>
            <div class="emoji-opt" onclick="selectEmoji(this,'🎮')">🎮</div>
          </div>
        </div>
 
        <div class="form-group">
          <label class="form-label">لون الفريق</label>
          <div class="color-picker">
            <div class="color-opt selected" style="background:linear-gradient(135deg,#4f8ef7,#9b6ef3)" onclick="selectColor(this)"></div>
            <div class="color-opt" style="background:linear-gradient(135deg,#3ecf8e,#06b6d4)" onclick="selectColor(this)"></div>
            <div class="color-opt" style="background:linear-gradient(135deg,#f97316,#fbbf24)" onclick="selectColor(this)"></div>
            <div class="color-opt" style="background:linear-gradient(135deg,#f472b6,#9b6ef3)" onclick="selectColor(this)"></div>
            <div class="color-opt" style="background:linear-gradient(135deg,#ef4444,#f97316)" onclick="selectColor(this)"></div>
            <div class="color-opt" style="background:linear-gradient(135deg,#1e293b,#475569)" onclick="selectColor(this)"></div>
          </div>
        </div>
 
        <div class="form-group">
          <label class="form-label">وصف الفريق <span style="font-size:.7rem;color:var(--muted)">(اختياري)</span></label>
          <textarea class="form-textarea" placeholder="أهداف الفريق وتخصصاته..."></textarea>
        </div>
 
        <hr style="border:none;border-top:1px solid var(--border);margin:18px 0">
 
        <div class="card-header" style="margin-bottom:14px"><div class="card-title">👤 إضافة أعضاء الفريق</div></div>
 
        <div class="member-add-list" id="members-list">
          <!-- Current user (auto-added as leader) -->
          <div class="mal-item" style="background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-color:#ddd6fe">
            <div class="mal-av" style="background:linear-gradient(135deg,var(--blue),var(--purple))">م أ</div>
            <div class="mal-info"><div class="mal-name">محمد أحمد (أنت)</div><div class="mal-email">m.ahmed@university.edu</div></div>
            <select class="mal-role" style="background:#eff6ff;color:var(--blue)"><option>👑 قائد الفريق</option></select>
          </div>
        </div>
 
        <!-- Add member row -->
        <div style="display:flex;gap:8px;margin-bottom:16px">
          <input class="form-input" placeholder="📧 البريد الجامعي للعضو الجديد..." id="member-email-input" style="flex:1">
          <button class="btn btn-primary" style="flex-shrink:0" onclick="addMember()">➕ إضافة</button>
        </div>
 
        <div style="display:flex;gap:10px">
          <button class="btn btn-outline" style="flex:1;justify-content:center">← رجوع</button>
          <button class="btn btn-primary" style="flex:2;justify-content:center">إنشاء الفريق ←</button>
        </div>
      </div>
 
      <!-- Preview -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="team-preview">
          <div style="position:relative;z-index:1">
            <div id="preview-emoji" style="font-size:3rem;margin-bottom:10px;animation:bounce 2s infinite">🚀</div>
            <div id="preview-name" class="tp-name">اسم فريقك</div>
            <div class="tp-sub">فريق GradSmart · 2026</div>
          </div>
        </div>
 
        <!-- Tips -->
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">💡 نصائح لفريق ناجح</div></div>
          <div style="display:flex;flex-direction:column;gap:10px">
            <div style="display:flex;gap:10px;font-size:.75rem;line-height:1.6;padding:10px;background:var(--bg);border-radius:9px">
              <span style="flex-shrink:0">✅</span><span>اختر اسماً يعبّر عن روح فريقك ويسهل تذكّره</span>
            </div>
            <div style="display:flex;gap:10px;font-size:.75rem;line-height:1.6;padding:10px;background:var(--bg);border-radius:9px">
              <span style="flex-shrink:0">✅</span><span>أضف أعضاء يكملون بعضهم في المهارات (Frontend, Backend, Design)</span>
            </div>
            <div style="display:flex;gap:10px;font-size:.75rem;line-height:1.6;padding:10px;background:var(--bg);border-radius:9px">
              <span style="flex-shrink:0">✅</span><span>يُنصح بـ 3-4 أعضاء كحد أمثل لمشاريع التخرج</span>
            </div>
            <div style="display:flex;gap:10px;font-size:.75rem;line-height:1.6;padding:10px;background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-radius:9px;border:1px solid #ddd6fe">
              <span style="flex-shrink:0">🤖</span><span><strong>AI سيقترح لك المشرف الأنسب</strong> بناءً على مهارات فريقك وفكرة مشروعك تلقائياً</span>
            </div>
          </div>
        </div>
 
        <!-- Rules -->
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">📋 أحكام وشروط</div></div>
          <div style="display:flex;flex-direction:column;gap:6px;font-size:.72rem;color:var(--muted)">
            <div style="display:flex;gap:8px"><span style="color:var(--blue)">•</span><span>لا يمكن لطالب الانضمام لأكثر من فريق واحد</span></div>
            <div style="display:flex;gap:8px"><span style="color:var(--blue)">•</span><span>يجب أن يكون جميع الأعضاء مسجلين في النظام</span></div>
            <div style="display:flex;gap:8px"><span style="color:var(--blue)">•</span><span>قائد الفريق مسؤول عن اعتماد التغييرات الكبرى</span></div>
            <div style="display:flex;gap:8px"><span style="color:var(--blue)">•</span><span>لكل فريق مشروع تخرج واحد فقط</span></div>
          </div>
        </div>
 
      </div>
    </div>
@endsection