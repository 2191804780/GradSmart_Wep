@extends('layouts.student')

@section('title', 'GradSmart — إنشاء فريق')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/creat_team.css') }}">
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
 
     @if(isset($myInvitations) && $myInvitations->count())
    <div class="card" style="margin-bottom:18px">
        <div class="card-header">
            <div class="card-title">📨 دعوات الانضمام للفريق</div>
        </div>

        @foreach($myInvitations as $invitation)
            <div style="padding:14px;border:1px solid var(--border);border-radius:14px;margin-bottom:12px;background:#fff">
                <div style="font-weight:800;margin-bottom:6px">
                    لديك دعوة للانضمام إلى فريق:
                    {{ $invitation->team->name ?? 'فريق غير معروف' }}
                </div>

                <div style="font-size:.85rem;color:var(--muted);line-height:1.8">
                    المرسل: {{ $invitation->sender->name ?? 'غير معروف' }} <br>
                    الدور المقترح: {{ $invitation->member_role }} <br>
                    الملاحظة: {{ $invitation->note ?? 'لا توجد ملاحظة' }}
                </div>

                <div style="display:flex;gap:10px;margin-top:12px">
                    <form method="POST" action="{{ route('student.teams.acceptInvitation', $invitation->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">✅ قبول</button>
                    </form>

                    <form method="POST" action="{{ route('student.teams.rejectInvitation', $invitation->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline">❌ رفض</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
    <div class="create-team-layout">

      <!-- Form -->
      
      <form method="POST" action="{{ route('student.teams.store') }}" class="card" style="animation-delay:.3s">
       @csrf
        <div class="card-header"><div class="card-title">🏷️ بيانات الفريق الأساسية</div></div>
 
        <div class="form-group">
          <label class="form-label">اسم الفريق <span class="req">*</span></label>
          <input name="name" class="form-input" placeholder="مثال: Team Alpha، فريق النجوم..." required oninput="document.getElementById('preview-name').textContent=this.value||'اسم فريقك'">
        </div>
         <div class="form-group">
            <label class="form-label">القسم</label>
            <input class="form-input"
           value="{{ auth()->user()->department->name ?? 'لا يوجد قسم' }}"
           readonly>
         </div>
        <div class="form-group">
          <label class="form-label">وصف الفريق <span style="font-size:.7rem;color:var(--muted)">(اختياري)</span></label>
          <textarea class="form-textarea" placeholder="أهداف الفريق وتخصصاته..."></textarea>
        </div>
 
        <hr style="border:none;border-top:1px solid var(--border);margin:18px 0">
 
       
        <div class="member-add-list" id="members-list">
          <!-- Current user (auto-added as leader) -->
          <div class="mal-item" style="background:linear-gradient(135deg,#eff6ff,#f5f3ff);border-color:#ddd6fe">
            <div class="mal-av" style="background:linear-gradient(135deg,var(--blue),var(--purple))">م أ</div>
            <div class="mal-info"><div class="mal-name">{{ auth()->user()->name }}</div><div class="mal-email">{{ auth()->user()->email }}</div></div>
            <select class="mal-role" style="background:#eff6ff;color:var(--blue)"><option>👑 قائد الفريق</option></select>
          </div>
        </div>

 
        <div style="display:flex;gap:10px">
          <button class="btn btn-outline" style="flex:1;justify-content:center">← رجوع</button>
         <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center">إنشاء الفريق ←</button>
        </div>
      </form>
 
      <!-- Preview -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="team-preview">
          <div style="position:relative;z-index:1">
            <div id="preview-emoji" style="font-size:3rem;margin-bottom:10px;animation:bounce 2s infinite">🚀</div>
            <div id="preview-name" class="tp-name">{{ old('team_name') }}</div>
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