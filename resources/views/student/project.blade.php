@extends('layouts.student')

@section('title', 'GradSmart — مشروعي')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/student_dashboard.css') }}">
@endsection

@section('content')

@if ($errors->any())
  <div class="card" style="background:#fee2e2;color:#991b1b;margin-bottom:16px">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
@endif

@if (session('success'))
  <div class="card" style="background:#dcfce7;color:#166534;margin-bottom:16px">
    {{ session('success') }}
  </div>
@endif

@if (! $project)

<div class="stats-grid">
  <div class="stat-card blue">
    <div class="stat-icon">👥</div>
    <div class="stat-num">{{ $team->members()->count() }}</div>
    <div class="stat-label">أعضاء الفريق</div>
    <div class="stat-change up">{{ $team->name }}</div>
  </div>

  <div class="stat-card green">
    <div class="stat-icon">🏫</div>
    <div class="stat-num" style="font-size:1rem">{{ $team->department->name ?? 'غير محدد' }}</div>
    <div class="stat-label">القسم</div>
    <div class="stat-change up">قسم الفريق</div>
  </div>

  <div class="stat-card orange">
    <div class="stat-icon">📋</div>
    <div class="stat-num">0</div>
    <div class="stat-label">المشاريع</div>
    <div class="stat-change warn">لم يتم إنشاء مشروع بعد</div>
  </div>

  <div class="stat-card purple">
    <div class="stat-icon">👨‍🏫</div>
    <div class="stat-num" style="font-size:1rem">لا يوجد</div>
    <div class="stat-label">المشرف</div>
    <div class="stat-change up">يتم اختياره لاحقًا</div>
  </div>
</div>

<div class="progress-section">
  <div class="card">
    <div class="card-header">
      <div class="card-title">🚀 إنشاء مشروع التخرج</div>
    </div>

    <form method="POST" action="{{ route('student.project.store') }}" style="display:flex;flex-direction:column;gap:16px">
      @csrf

      <div>
        <label style="font-weight:800;font-size:.85rem">عنوان المشروع *</label>
        <input name="title" value="{{ old('title') }}" required
          placeholder="مثال: GradSmart — نظام إدارة مشاريع التخرج"
          style="width:100%;margin-top:8px;padding:13px 15px;border:1.8px solid var(--border);border-radius:14px;font-family:'Cairo',sans-serif">
      </div>

      <div>
        <label style="font-weight:800;font-size:.85rem">وصف المشروع</label>
        <textarea name="description" rows="5"
          placeholder="اكتبي فكرة المشروع، المشكلة التي يحلها، والهدف الرئيسي منه..."
          style="width:100%;margin-top:8px;padding:13px 15px;border:1.8px solid var(--border);border-radius:14px;font-family:'Cairo',sans-serif;line-height:1.8">{{ old('description') }}</textarea>
      </div>

      <div>
        <label style="font-weight:800;font-size:.85rem">الكلمات المفتاحية</label>
        <input name="keywords" value="{{ old('keywords') }}"
          placeholder="AI, Laravel, Web, Education"
          style="width:100%;margin-top:8px;padding:13px 15px;border:1.8px solid var(--border);border-radius:14px;font-family:'Cairo',sans-serif">
        <div style="font-size:.72rem;color:var(--muted);margin-top:6px">
          ستُستخدم لاحقًا في اقتراح المشرف المناسب.
        </div>
      </div>

      <div>
        <label style="font-weight:800;font-size:.85rem">تاريخ التسليم المتوقع *</label>
        <input type="date" name="expected_end_date" value="{{ old('expected_end_date') }}" required
          style="width:100%;margin-top:8px;padding:13px 15px;border:1.8px solid var(--border);border-radius:14px;font-family:'Cairo',sans-serif">
      </div>

      <button class="msg-btn" type="submit" style="margin-top:6px">
        إنشاء المشروع
      </button>
    </form>
  </div>

  <div style="display:flex;flex-direction:column;gap:16px;">
    <div class="risk-card">
      <div class="card-header">
        <div class="card-title">💡 ملاحظات مهمة</div>
      </div>

      <div class="risk-factors">
        <div class="risk-factor">
          <span class="rf-label">اكتبي عنوانًا واضحًا للمشروع</span>
          <div class="rf-bar-wrap"><div class="rf-bar" style="width:85%;background:var(--green)"></div></div>
        </div>

        <div class="risk-factor">
          <span class="rf-label">الكلمات المفتاحية تساعد في اقتراح المشرف</span>
          <div class="rf-bar-wrap"><div class="rf-bar" style="width:70%;background:var(--blue)"></div></div>
        </div>

        <div class="risk-factor">
          <span class="rf-label">بعد إنشاء المشروع ننتقل لإدارة المهام</span>
          <div class="rf-bar-wrap"><div class="rf-bar" style="width:60%;background:var(--purple)"></div></div>
        </div>
      </div>
    </div>
  </div>
</div>

@else

<div class="stats-grid">
  <div class="stat-card blue">
    <div class="stat-icon">📋</div>
    <div class="stat-num">1</div>
    <div class="stat-label">مشروع الفريق</div>
    <div class="stat-change up">{{ $project->status }}</div>
  </div>

  <div class="stat-card green">
    <div class="stat-icon">👥</div>
    <div class="stat-num">{{ $team->members()->count() }}</div>
    <div class="stat-label">أعضاء الفريق</div>
    <div class="stat-change up">{{ $team->name }}</div>
  </div>

  <div class="stat-card orange">
    <div class="stat-icon">📊</div>
    <div class="stat-num">{{ $project->progress }}%</div>
    <div class="stat-label">نسبة الإنجاز</div>
    <div class="stat-change warn">تُحسب من المهام لاحقًا</div>
  </div>

  <div class="stat-card purple">
    <div class="stat-icon">👨‍🏫</div>
    <div class="stat-num" style="font-size:1rem">
      {{ $project->supervisor->name ?? 'لا يوجد' }}
    </div>
    <div class="stat-label">المشرف</div>
    <div class="stat-change up">اختيار المشرف لاحقًا</div>
  </div>
</div>

<div class="progress-section">
  <div class="card">
    <div class="card-header">
      <div class="card-title">📂 بيانات المشروع</div>
      <a class="card-action" href="/student/progress">عرض التقدم ←</a>
    </div>

    <div class="project-info">
      <div class="project-emoji">🌐</div>
      <div>
        <div class="project-name">{{ $project->title }}</div>
        <div class="project-meta">
          🏫 {{ $team->department->name ?? 'غير محدد' }}
          &nbsp;|&nbsp; 👥 {{ $team->members()->count() }} أعضاء
          &nbsp;|&nbsp; 📅 {{ $project->expected_end_date }}
        </div>
      </div>
    </div>

    <p style="color:var(--muted);font-size:.85rem;line-height:1.9;margin:16px 0">
      {{ $project->description ?? 'لا يوجد وصف للمشروع.' }}
    </p>

    <div class="mini-stats">
      <div class="mini-stat">
        <div class="mini-stat-num" style="color:var(--blue)">🏷️</div>
        <div class="mini-stat-label">{{ $project->keywords ?? 'لا توجد كلمات مفتاحية' }}</div>
      </div>

      <div class="mini-stat">
        <div class="mini-stat-num" style="color:var(--green)">{{ $project->status }}</div>
        <div class="mini-stat-label">حالة المشروع</div>
      </div>

      <div class="mini-stat">
        <div class="mini-stat-num" style="color:var(--orange)">0</div>
        <div class="mini-stat-label">المهام حاليًا</div>
      </div>

      <div class="mini-stat">
        <div class="mini-stat-num" style="color:var(--purple)">{{ $project->progress }}%</div>
        <div class="mini-stat-label">الإنجاز</div>
      </div>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:16px;">
    <div class="card">
      <div class="card-header">
        <div class="card-title">👨‍🏫 المشرف</div>
      </div>

      <div class="supervisor-card">
        <div class="sup-avatar">؟</div>
        <div>
          <div class="sup-name">{{ $project->supervisor->name ?? 'لم يتم اختيار مشرف بعد' }}</div>
          <div class="sup-title">سيتم ربط المشرف لاحقًا حسب الكلمات المفتاحية</div>
        </div>
        <div class="sup-status">⏳ قيد الاختيار</div>
      </div>

      <a href="#supervisor-section" class="msg-btn" style="margin-top:14px;text-decoration:none;text-align:center;display:block">
        👨‍🏫 اختيار مشرف
      </a>
    </div>
  </div>
</div>

<div class="bottom-row">
  <div class="card">
    <div class="card-header">
      <div class="card-title">✅ الخطوة التالية</div>
    </div>

    <a href="{{ route('student.tasks.index') }}" style="text-decoration:none;color:inherit;display:block;">
      <div class="task-item">
        <div class="task-check inprogress"></div>

        <div class="task-info">
          <div class="task-name">الانتقال إلى إدارة المهام</div>
          <div class="task-meta">
            <span>بعد إنشاء المشروع</span>
            <span>ابدئي بإنشاء المهام وربطها بالمشروع</span>
          </div>
        </div>

        <span class="task-tag tag-progress">إدارة المهام</span>
      </div>
    </a>
  </div>

  <div class="card" id="supervisor-section">
    <div class="card-header">
      <div class="card-title">👨‍🏫 اختيار المشرف</div>
    </div>

    @if($project->supervisor)

      <div class="supervisor-card">
        <div class="sup-avatar">
          {{ mb_substr($project->supervisor->name, 0, 1) }}
        </div>

        <div>
          <div class="sup-name">
            {{ $project->supervisor->name }}
          </div>

          <div class="sup-title">
            تم قبول الإشراف على المشروع
          </div>
        </div>

        <div class="sup-status">
          ✅ مرتبط
        </div>
      </div>

    @elseif($pendingRequest)

      <div class="last-note">
        ⏳ يوجد طلب إشراف قيد الانتظار.

        <div class="note-from">
          بانتظار رد المشرف.
        </div>
      </div>

    @else

      @forelse($supervisors as $supervisor)

        <div class="supervisor-card" style="margin-bottom:12px">
          <div class="sup-avatar">
            {{ mb_substr($supervisor->name, 0, 1) }}
          </div>

          <div>
            <div class="sup-name">
              {{ $supervisor->name }}
            </div>

            <div class="sup-title">
              {{ $supervisor->email }}
            </div>
          </div>

          <form method="POST" action="{{ route('student.project.requestSupervisor', $supervisor->id) }}">
            @csrf

            <button class="msg-btn">
              إرسال طلب
            </button>
          </form>
        </div>

      @empty

        <div class="last-note">
          لا يوجد مشرفون متاحون في هذا القسم حالياً.
        </div>

      @endforelse

    @endif
  </div>
</div>

@endif

@endsection

@section('scripts')
<script>
const navProject = document.getElementById('nav-project');
if (navProject) navProject.classList.add('active');
</script>
@endsection