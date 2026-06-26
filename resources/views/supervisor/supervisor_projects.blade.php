@extends('layouts.supervisor')

@section('title', 'مشاريعي')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/supervisor/supervisor_projects.css') }}">
<style>
  .ptab {
    cursor: pointer;
  }
  .eval-input {
    width: 80px;
    padding: 6px 10px;
    border: 2px solid var(--border);
    border-radius: 8px;
    outline: none;
    font-family: 'Cairo', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    text-align: center;
  }
  .eval-input:focus {
    border-color: var(--primary);
  }
</style>
@endsection

@section('no_topbar', true)

@section('content')
  <!-- Page Tabs -->
  <div class="page-tabs">
    <button class="ptab active" onclick="switchPage('proj-details',this)">🔍 تفاصيل المشروع</button>
    <button class="ptab" onclick="switchPage('evaluation',this)">📝 التقييم</button>
    <button class="ptab" onclick="switchPage('ai-report',this)">🤖 تقرير AI</button>
  </div>
 
  <!-- ══ PROJECT DETAILS ══ -->
  <div class="page-content active" id="proj-details">
    <div class="topbar">
      <div class="page-title">
        <h1>🔍 تفاصيل مشروع الفريق</h1>
        <p>فريق {{ $selectedTeam->name }} — {{ $selectedTeam->project->title ?? 'لا يوجد مشروع' }}</p>
      </div>
      <div class="topbar-actions" style="display:flex; gap:10px; align-items:center;">
        <!-- تبديل المشروع -->
        <select onchange="window.location='{{ route('supervisor.projects') }}?team_id=' + this.value" style="padding:10px 14px;border:2px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.85rem;outline:none;background:#f8fafc">
          @foreach($teams as $t)
            <option value="{{ $t->id }}" {{ $t->id == $selectedTeam->id ? 'selected' : '' }}>فريق {{ $t->name }} ({{ $t->project->title ?? '' }})</option>
          @endforeach
        </select>
        <a class="btn btn-outline" style="text-decoration:none;" href="{{ route('supervisor.chat', ['team_id' => $selectedTeam->id]) }}">💬 مراسلة الفريق</a>
        <button class="btn btn-primary" onclick="switchPage('evaluation', document.querySelectorAll('.ptab')[1])">📝 إضافة تقييم</button>
      </div>
    </div>
 
    @php
      $project = $selectedTeam->project;
      $aiReport = $project ? $project->aiReports()->orderBy('generated_at', 'desc')->first() : null;
      
      $riskText = 'منخفض';
      $riskColor = 'var(--green)';
      if ($aiReport) {
          if ($aiReport->risk_level === 'HIGH') {
              $riskText = 'خطر عالي';
              $riskColor = 'var(--red)';
          } elseif ($aiReport->risk_level === 'MEDIUM') {
              $riskText = 'خطر متوسط';
              $riskColor = 'var(--orange)';
          }
      }
      
      $totalTasks = $project ? $project->tasks()->count() : 0;
      $doneTasks = $project ? $project->tasks()->where('status', 'DONE')->count() : 0;
      
      $daysLeft = 0;
      if ($project && $project->expected_end_date) {
          $daysLeft = now()->diffInDays($project->expected_end_date, false);
      }
    @endphp

    <!-- Team Bar -->
    <div class="team-bar">
      <div class="tb-icon">
        @if($selectedTeam->department_id == 1) 🌐
        @elseif($selectedTeam->department_id == 4) 🧠
        @elseif($selectedTeam->department_id == 7) 🛒
        @else 📂
        @endif
      </div>
      <div>
        <div class="tb-name">{{ $project->title ?? 'لا يوجد مشروع' }}</div>
        <div class="tb-meta">👥 فريق {{ $selectedTeam->name }} · {{ $selectedTeam->members->count() }} أعضاء · بدأ في {{ $selectedTeam->created_at ? $selectedTeam->created_at->format('Y/m/d') : 'غير محدد' }}</div>
      </div>
      <div class="tb-right">
        <div class="tb-stat"><div class="tb-stat-num">{{ intval($project->progress ?? 0) }}%</div><div class="tb-stat-label">إنجاز</div></div>
        <div class="tb-stat"><div class="tb-stat-num">{{ $doneTasks }}/{{ $totalTasks }}</div><div class="tb-stat-label">مهام</div></div>
        <div class="tb-stat"><div class="tb-stat-num">{{ $daysLeft > 0 ? $daysLeft : 0 }}</div><div class="tb-stat-label">أيام متبقية</div></div>
      </div>
      <div class="tb-risk" style="color: {{ $riskColor }}">{{ $riskText }}</div>
    </div>
 
    <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px">
      <!-- Tasks -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header">
          <div class="card-title">✅ مهام الفريق — يراها المشرف كاملة</div>
          <div style="display:flex;gap:6px">
            <select id="task-filter" onchange="filterTasks(this.value)" style="padding:5px 10px;border:1px solid var(--border);border-radius:7px;font-family:'Cairo',sans-serif;font-size:.72rem;outline:none;background:var(--bg)">
              <option value="all">كل المهام</option>
              <option value="late">المتأخرة</option>
              <option value="done">المنجزة</option>
            </select>
          </div>
        </div>
        <div class="sup-tasks">
          @if($project)
            @forelse($project->tasks as $task)
              @php
                $statusBg = 'var(--blue)';
                $badgeText = 'جديدة';
                $badgeStyle = 'background:#f1f5f9;color:var(--muted);border:1px solid var(--border)';
                $isLate = false;

                if ($task->status === 'DONE') {
                    $statusBg = 'var(--green)';
                    $badgeText = 'منجزة';
                    $badgeStyle = 'background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0';
                } elseif ($task->status === 'IN_PROGRESS') {
                    $statusBg = 'var(--blue)';
                    $badgeText = 'جارية';
                    $badgeStyle = 'background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe';
                }

                if ($task->status !== 'DONE' && $task->deadline && \Carbon\Carbon::parse($task->deadline)->isPast()) {
                    $isLate = true;
                    $statusBg = 'var(--red)';
                    $badgeText = 'متأخرة';
                    $badgeStyle = 'background:#fef2f2;color:var(--red);border:1px solid #fecaca';
                }
              @endphp
              <div class="sup-task-item task-row {{ $isLate ? 'is-late' : '' }} {{ $task->status === 'DONE' ? 'is-done' : '' }}">
                <div class="sti-status" style="background:{{ $statusBg }}"></div>
                <div class="sti-info">
                  <div class="sti-name">{{ $task->title }}</div>
                  <div class="sti-meta">
                    👤 {{ $task->assignedTo->name ?? 'غير مكلف' }} · 
                    @if($task->status === 'DONE')
                      تم الإنجاز
                    @else
                      الموعد {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y/m/d') : 'غير محدد' }}
                    @endif
                    @if($isLate)
                      · <span style="color:var(--red);font-weight:700">⚠ متأخرة</span>
                    @endif
                  </div>
                </div>
                <div class="sti-progress">
                  <div class="stp-track"><div class="stp-fill" style="width:{{ $task->status === 'DONE' ? 100 : ($task->status === 'IN_PROGRESS' ? 50 : 0) }}%;background:{{ $statusBg }}"></div></div>
                  <div class="stp-label">{{ $task->status === 'DONE' ? 100 : ($task->status === 'IN_PROGRESS' ? 50 : 0) }}%</div>
                </div>
                <span class="sti-badge" style="{{ $badgeStyle }}">{{ $badgeText }}</span>
                <a class="sti-comment-btn" style="text-decoration:none;" href="{{ route('supervisor.chat', ['team_id' => $selectedTeam->id]) }}">💬 تعليق</a>
              </div>
            @empty
              <p style="text-align:center;padding:20px;color:var(--muted)">لا توجد مهام حالياً لهذا المشروع.</p>
            @endforelse
          @endif
        </div>
      </div>
 
      <!-- Right: Files + Activity + Members -->
      <div style="display:flex;flex-direction:column;gap:14px">
        <!-- Uploaded Files -->
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">📁 الملفات المرفوعة</div><a class="card-action">الكل ←</a></div>
          <div style="display:flex;flex-direction:column;gap:8px">
            @if($project)
              @forelse($project->files as $file)
                @php
                  $icon = '📄';
                  $ext = pathinfo($file->filename, PATHINFO_EXTENSION);
                  if (in_array(strtolower($ext), ['png', 'jpg', 'jpeg', 'gif'])) $icon = '🎨';
                  elseif (in_array(strtolower($ext), ['zip', 'rar', 'tar', 'gz'])) $icon = '💻';
                @endphp
                <div style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--bg);border-radius:9px;cursor:pointer" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='var(--bg)'">
                  <span style="font-size:1.1rem">{{ $icon }}</span>
                  <div style="flex:1">
                    <div style="font-size:.75rem;font-weight:700">{{ $file->filename }}</div>
                    <div style="font-size:.62rem;color:var(--muted)">
                      {{ $file->uploader->name ?? 'طالب' }} · 
                      {{ $file->uploaded_at ? \Carbon\Carbon::parse($file->uploaded_at)->format('Y/m/d') : '' }} · 
                      {{ number_format($file->size / (1024 * 1024), 1) }} MB
                    </div>
                  </div>
                  <a href="{{ asset($file->path) }}" download style="padding:4px 10px;border:1px solid var(--border);background:var(--white);border-radius:7px;font-size:.68rem;cursor:pointer;text-decoration:none;color:inherit">⬇ تحميل</a>
                </div>
              @empty
                <p style="text-align:center;padding:10px;color:var(--muted);font-size:.75rem">لا توجد ملفات مرفوعة حالياً.</p>
              @endforelse
            @endif
          </div>
        </div>
 
        <!-- Members performance -->
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">👥 أداء الأعضاء</div></div>
          <div style="display:flex;flex-direction:column;gap:10px">
            @foreach($selectedTeam->members as $member)
              @php
                $totalMemberTasks = $project ? $project->tasks()->where('assigned_to', $member->id)->count() : 0;
                $doneMemberTasks = $project ? $project->tasks()->where('assigned_to', $member->id)->where('status', 'DONE')->count() : 0;
                $memberProgress = $totalMemberTasks > 0 ? intval(($doneMemberTasks / $totalMemberTasks) * 100) : 0;
                
                $initials = mb_substr($member->name, 0, 2);
                $gradient = 'linear-gradient(135deg,var(--blue),var(--purple))';
                $barColor = 'linear-gradient(90deg,var(--blue),var(--purple))';
                $color = 'var(--blue)';

                if($member->id % 3 == 0) {
                    $gradient = 'linear-gradient(135deg,var(--pink),var(--orange))';
                    $barColor = 'linear-gradient(90deg,var(--pink),var(--orange))';
                    $color = 'var(--pink)';
                } elseif($member->id % 3 == 1) {
                    $gradient = 'linear-gradient(135deg,var(--green),var(--teal))';
                    $barColor = 'linear-gradient(90deg,var(--green),var(--teal))';
                    $color = 'var(--green)';
                }
              @endphp
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ $gradient }};display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:white;flex-shrink:0">{{ $initials }}</div>
                <div style="flex:1">
                  <div style="font-size:.75rem;font-weight:700;margin-bottom:3px">{{ $member->name }}</div>
                  <div style="height:5px;background:var(--bg);border-radius:10px;overflow:hidden">
                    <div style="width:{{ $memberProgress }}%;height:100%;background:{{ $barColor }};border-radius:10px"></div>
                  </div>
                </div>
                <div style="font-size:.75rem;font-weight:700;color:{{ $color }}">{{ $memberProgress }}%</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ EVALUATION ══ -->
  <div class="page-content" id="evaluation">
    <div class="topbar">
      <div class="page-title">
        <h1>📝 تقييم الفريق</h1>
        <p>فريق {{ $selectedTeam->name }} — نموذج تقييم المرحلة</p>
      </div>
      <div class="topbar-actions">
        <button class="btn btn-outline" onclick="switchPage('proj-details', document.querySelectorAll('.ptab')[0])">📋 عرض تفاصيل المشروع</button>
      </div>
    </div>
 
    <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px">
      <!-- Eval Form -->
      <div class="card" style="animation-delay:.3s">
        <div class="card-header">
          <div class="card-title">⭐ نموذج التقييم التفصيلي</div>
        </div>
        <div style="margin-bottom:14px">
          <label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:7px">الفريق المختار</label>
          <select onchange="window.location='{{ route('supervisor.projects') }}?team_id=' + this.value" style="width:100%;padding:10px 14px;border:2px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.85rem;outline:none;background:#f8fafc">
            @foreach($teams as $t)
              <option value="{{ $t->id }}" {{ $t->id == $selectedTeam->id ? 'selected' : '' }}>فريق {{ $t->name }} — {{ $t->project->title ?? '' }}</option>
            @endforeach
          </select>
        </div>

        <form action="{{ route('supervisor.storeEvaluation', ['team' => $selectedTeam->id]) }}" method="POST">
          @csrf
          <div class="eval-form">
            <div class="eval-criteria" style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
              <div class="ec-top" style="display:flex; justify-content:space-between; align-items:center;">
                <span class="ec-title" style="font-weight:700; font-size:0.9rem;">🏗️ جودة التوثيق والتحليل</span>
                <span class="ec-weight" style="color:var(--muted); font-size:0.8rem;">الحد الأقصى: 30 درجة</span>
              </div>
              <div style="display:flex; gap:10px; align-items:center;">
                <input type="number" name="score_documentation" min="0" max="30" step="0.5" value="25" class="eval-input" id="score_doc" required oninput="calculateTotalScore()">
                <span style="font-size:0.8rem; color:var(--muted);">اكتب الدرجة المستحقة من 30</span>
              </div>
            </div>

            <div class="eval-criteria" style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
              <div class="ec-top" style="display:flex; justify-content:space-between; align-items:center;">
                <span class="ec-title" style="font-weight:700; font-size:0.9rem;">💻 جودة الكود والتنفيذ البرمجي</span>
                <span class="ec-weight" style="color:var(--muted); font-size:0.8rem;">الحد الأقصى: 40 درجة</span>
              </div>
              <div style="display:flex; gap:10px; align-items:center;">
                <input type="number" name="score_implementation" min="0" max="40" step="0.5" value="30" class="eval-input" id="score_impl" required oninput="calculateTotalScore()">
                <span style="font-size:0.8rem; color:var(--muted);">اكتب الدرجة المستحقة من 40</span>
              </div>
            </div>

            <div class="eval-criteria" style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
              <div class="ec-top" style="display:flex; justify-content:space-between; align-items:center;">
                <span class="ec-title" style="font-weight:700; font-size:0.9rem;">🎨 العرض التقديمي وتجربة المستخدم</span>
                <span class="ec-weight" style="color:var(--muted); font-size:0.8rem;">الحد الأقصى: 30 درجة</span>
              </div>
              <div style="display:flex; gap:10px; align-items:center;">
                <input type="number" name="score_presentation" min="0" max="30" step="0.5" value="25" class="eval-input" id="score_pres" required oninput="calculateTotalScore()">
                <span style="font-size:0.8rem; color:var(--muted);">اكتب الدرجة المستحقة من 30</span>
              </div>
            </div>
          </div>

          <div style="margin-top:16px">
            <label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:7px">📝 ملاحظات ومقترحات المشف</label>
            <textarea name="feedback" style="width:100%;padding:12px;border:2px solid var(--border);border-radius:10px;font-family:'Cairo',sans-serif;font-size:.82rem;resize:none;height:90px;outline:none;direction:rtl;background:#f8fafc" placeholder="اكتب ملاحظاتك التفصيلية للفريق ورأيك في التقدم الحالي..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:14px">📤 إرسال التقييم للفريق</button>
        </form>
      </div>
 
      <!-- Grade + Previous -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card" style="animation-delay:.35s">
          <div class="card-header"><div class="card-title">📊 الدرجة الكلية للتقييم الحالي</div></div>
          <div class="grade-display">
            <div class="gd-num" id="total_score_preview">80</div>
            <div class="gd-label">من 100 درجة</div>
            <div class="gd-grade" id="grade_text_preview">تقدير: جيد جداً ✨</div>
          </div>
          <div style="margin-top:14px;display:flex;flex-direction:column;gap:6px">
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--muted)">التوثيق (30%)</span><span style="font-weight:700;color:var(--blue)" id="preview_doc">25.0/30</span></div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--muted)">الكود والتنفيذ (40%)</span><span style="font-weight:700;color:var(--orange)" id="preview_impl">30.0/40</span></div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;padding:6px 0"><span style="color:var(--muted)">العرض والواجهة (30%)</span><span style="font-weight:700;color:var(--green)" id="preview_pres">25.0/30</span></div>
          </div>
        </div>
 
        <div class="card" style="animation-delay:.40s">
          <div class="card-header"><div class="card-title">📜 التقييمات السابقة لهذا الفريق</div></div>
          <div class="prev-evals">
            @forelse($evaluations as $eval)
              @php
                $evalDate = \Carbon\Carbon::parse($eval->created_at);
                $stars = '☆☆☆☆☆';
                $score = $eval->total_score;
                if ($score >= 90) $stars = '★★★★★';
                elseif ($score >= 80) $stars = '★★★★☆';
                elseif ($score >= 70) $stars = '★★★☆☆';
                elseif ($score >= 60) $stars = '★★☆☆☆';
                else $stars = '★☆☆☆☆';
              @endphp
              <div class="pe-item" style="margin-bottom:8px; padding:10px; border-radius:8px; border:1px solid var(--border)">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                  <div>
                    <div class="pe-phase" style="font-weight:700; font-size:0.8rem;">تقييم المشرف</div>
                    <div class="pe-date" style="font-size:0.65rem; color:var(--muted);">{{ $evalDate->format('Y/m/d') }}</div>
                  </div>
                  <div class="pe-stars" style="color:var(--yellow); font-size:0.8rem;">{{ $stars }}</div>
                  <div class="pe-grade" style="font-weight:700; color:var(--primary)">{{ intval($eval->total_score) }}</div>
                </div>
                @if($eval->feedback)
                  <p style="font-size:0.7rem; color:var(--muted); margin-top:5px; direction:rtl;">{{ $eval->feedback }}</p>
                @endif
              </div>
            @empty
              <p style="text-align:center;padding:10px;color:var(--muted);font-size:.75rem">لا توجد تقييمات سابقة.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- ══ AI REPORT ══ -->
  <div class="page-content" id="ai-report">
    <div class="topbar">
      <div class="page-title">
        <h1>🤖 تقرير الذكاء الاصطناعي</h1>
        <p>فريق {{ $selectedTeam->name }} — تحليل تلقائي لحظي</p>
      </div>
      <div class="topbar-actions">
        <button class="btn btn-outline" onclick="window.print()">📥 تصدير التقرير</button>
      </div>
    </div>
 
    @if($aiReport)
      <!-- Risk Card -->
      <div class="ai-risk-card" style="background:var(--white); border:2px solid var(--border); border-radius:12px; padding:20px; margin-bottom:20px;">
        <div class="arc-header" style="display:flex; gap:12px; align-items:center; margin-bottom:15px;">
          <div class="arc-icon" style="font-size:1.8rem;">🧠</div>
          <div>
            <div class="arc-title" style="font-weight:900; font-size:1.1rem;">نتيجة التحليل الذكي — فريق {{ $selectedTeam->name }}</div>
            <div class="arc-sub" style="font-size:0.7rem; color:var(--muted);">آخر تحديث: {{ \Carbon\Carbon::parse($aiReport->generated_at)->diffForHumans() }}</div>
          </div>
        </div>
        <div style="margin-bottom:16px">
          <div style="font-size:.78rem;font-weight:700;margin-bottom:8px">مستوى خطر المشروع الكلي</div>
          <div class="risk-levels" style="display:flex; gap:10px;">
            <div class="rl-item {{ $aiReport->risk_level === 'LOW' ? 'active-low' : 'inactive' }}" style="flex:1; padding:10px; text-align:center; border-radius:8px; font-weight:700; font-size:0.8rem;">🟢 منخفض</div>
            <div class="rl-item {{ $aiReport->risk_level === 'MEDIUM' ? 'active-mid' : 'inactive' }}" style="flex:1; padding:10px; text-align:center; border-radius:8px; font-weight:700; font-size:0.8rem;">🟡 متوسط</div>
            <div class="rl-item {{ $aiReport->risk_level === 'HIGH' ? 'active-high' : 'inactive' }}" style="flex:1; padding:10px; text-align:center; border-radius:8px; font-weight:700; font-size:0.8rem;">🔴 عالي</div>
          </div>
        </div>
        <div style="font-size:.8rem;font-weight:600;color:{{ $riskColor }}">
          @if($aiReport->risk_level === 'LOW')
            ✅ المشروع على المسار الصحيح ويبدي تقدماً ممتازاً.
          @elseif($aiReport->risk_level === 'MEDIUM')
            🟡 هناك بعض التأخيرات الطفيفة، يرجى تتبع المهام المتأخرة.
          @else
            🚨 خطر عالي! يتطلب المشروع تدخلاً فورياً لحل مشاكل التأخر الكبيرة.
          @endif
        </div>
      </div>
 
      <!-- AI Factors -->
      <div class="ai-factors-grid">
        <div class="aif-card">
          <div class="aif-icon">📈</div>
          <div class="aif-label">معدل الإنجاز</div>
          <div class="aif-value" style="color:var(--blue)">{{ intval($aiReport->completion_rate) }}%</div>
          <div class="aif-bar"><div class="aif-fill" style="width:{{ $aiReport->completion_rate }}%;background:var(--blue)"></div></div>
        </div>
        <div class="aif-card">
          <div class="aif-icon">⏰</div>
          <div class="aif-label">الزمن المستهلك</div>
          <div class="aif-value" style="color:var(--orange)">{{ intval($aiReport->time_consumed_rate) }}%</div>
          <div class="aif-bar"><div class="aif-fill" style="width:{{ $aiReport->time_consumed_rate }}%;background:var(--orange)"></div></div>
        </div>
        <div class="aif-card">
          <div class="aif-icon">⚠️</div>
          <div class="aif-label">احتمالية التأخر</div>
          <div class="aif-value" style="color:var(--red)">{{ intval($aiReport->delay_probability) }}%</div>
          <div class="aif-bar"><div class="aif-fill" style="width:{{ $aiReport->delay_probability }}%;background:var(--red)"></div></div>
        </div>
      </div>
 
      <!-- Recommendations -->
      <div class="card" style="animation-delay:.3s; margin-top:20px;">
        <div class="card-header"><div class="card-title">💡 توصيات الذكاء الاصطناعي للمشرف بناءً على المشروع</div></div>
        <div class="ai-recommendations" style="display:flex; flex-direction:column; gap:10px; margin-top:10px;">
          @if($aiReport->risk_level === 'LOW')
            <div class="air-item good" style="display:flex; gap:10px; padding:12px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px;">
              <div class="air-icon">✅</div>
              <div class="air-text" style="font-size:0.8rem;"><strong>مستوى النشاط ممتاز:</strong> يستمر الطلاب في رفع الملفات وتحديث المهام بشكل متناسق. يوصى بالحفاظ على هذا النمط.</div>
            </div>
            <div class="air-item info" style="display:flex; gap:10px; padding:12px; background:#f8fafc; border:1px solid var(--border); border-radius:10px;">
              <div class="air-icon">📊</div>
              <div class="air-text" style="font-size:0.8rem;"><strong>الاستعداد للعرض:</strong> نسبة الإنجاز تخطت 60%، يمكن توجيه الطلاب للبدء بكتابة التقرير النهائي للمشروع.</div>
            </div>
          @elseif($aiReport->risk_level === 'MEDIUM')
            <div class="air-item warn" style="display:flex; gap:10px; padding:12px; background:#fff7ed; border:1px solid #fed7aa; border-radius:10px;">
              <div class="air-icon">⚠️</div>
              <div class="air-text" style="font-size:0.8rem;"><strong>المهام المفتوحة:</strong> توجد بعض المهام المعلقة التي تجاوزت موعدها. يرجى تذكير الطلاب بضرورة إغلاقها.</div>
            </div>
          @else
            <div class="air-item danger" style="display:flex; gap:10px; padding:12px; background:#fef2f2; border:1px solid #fecaca; border-radius:10px;">
              <div class="air-icon">🚨</div>
              <div class="air-text" style="font-size:0.8rem; color:var(--red);"><strong>تدخل عاجل مطلوب:</strong> معدل الإنجاز متأخر بشكل حرج بالنسبة للزمن المستهلك. يُنصح بجدولة اجتماع طارئ مع الفريق.</div>
            </div>
          @endif
        </div>
      </div>
    @else
      <div class="card" style="padding:40px; text-align:center; color:var(--muted)">
        لا يوجد تقرير ذكاء اصطناعي متاح حالياً لهذا المشروع. سيتم إنشاؤه تلقائياً عند تحديث البيانات.
      </div>
    @endif
  </div>
@endsection

@section('scripts')
<script>
function switchPage(id,btn){
  document.querySelectorAll('.page-content').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(b=>b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
}

function filterTasks(status) {
    const tasks = document.querySelectorAll('.task-row');
    tasks.forEach(task => {
        if(status === 'all') {
            task.style.display = 'grid';
        } else if(status === 'late') {
            if(task.classList.contains('is-late')) {
                task.style.display = 'grid';
            } else {
                task.style.display = 'none';
            }
        } else if(status === 'done') {
            if(task.classList.contains('is-done')) {
                task.style.display = 'grid';
            } else {
                task.style.display = 'none';
            }
        }
    });
}

function calculateTotalScore() {
    const doc = parseFloat(document.getElementById('score_doc').value) || 0;
    const impl = parseFloat(document.getElementById('score_impl').value) || 0;
    const pres = parseFloat(document.getElementById('score_pres').value) || 0;
    
    const total = doc + impl + pres;
    document.getElementById('total_score_preview').innerText = total;
    
    document.getElementById('preview_doc').innerText = doc.toFixed(1) + '/30';
    document.getElementById('preview_impl').innerText = impl.toFixed(1) + '/40';
    document.getElementById('preview_pres').innerText = pres.toFixed(1) + '/30';
    
    let grade = 'مقبول ⚠️';
    if(total >= 90) grade = 'امتياز ✨';
    else if(total >= 80) grade = 'جيد جداً ✨';
    else if(total >= 70) grade = 'جيد 👍';
    else if(total >= 50) grade = 'مقبول ⚠️';
    else grade = 'ضعيف ❌';
    
    document.getElementById('grade_text_preview').innerText = 'تقدير: ' + grade;
}

document.addEventListener("DOMContentLoaded", () => {
    // Set active link in sidebar
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    const navProj = document.getElementById('nav-projects');
    if (navProj) navProj.classList.add('active');
    
    calculateTotalScore();
});
</script>
@endsection