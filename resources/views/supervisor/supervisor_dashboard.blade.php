@extends('layouts.supervisor')

@section('title', 'GradSmart — لوحة المشرف')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/supervisor/supervisor_dashboard.css') }}">
<style>
  .project-item {
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .project-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }
</style>
@endsection

@section('content')
  <!-- Stats -->
  <div class="stats-grid">
    <div class="stat-card green">
      <div class="stat-icon">👥</div>
      <div class="stat-num">{{ $teamsCount }}</div>
      <div class="stat-label">فرق تحت إشرافي</div>
    </div>
    <div class="stat-card blue">
      <div class="stat-icon">✅</div>
      <div class="stat-num">{{ $onTrackCount }}</div>
      <div class="stat-label">مشاريع على المسار</div>
    </div>
    <div class="stat-card orange">
      <div class="stat-icon">⚠️</div>
      <div class="stat-num">{{ $urgentCount }}</div>
      <div class="stat-label">تحتاج تدخل عاجل</div>
    </div>
    <div class="stat-card red">
      <div class="stat-icon">🔔</div>
      <div class="stat-num">{{ $newRequests->count() }}</div>
      <div class="stat-label">طلبات جديدة</div>
    </div>
  </div>
 
  <!-- Main Grid -->
  <div class="grid-main">
 
    <!-- Projects List -->
    <div class="card" style="animation-delay:.3s">
      <div class="card-header">
        <div class="card-title">📂 مشاريع الفرق</div>
        <a class="card-action" href="{{ route('supervisor.projects') }}">عرض الكل ←</a>
      </div>
      <div class="projects-list">
        @forelse($teams as $team)
          @php
            $project = $team->project;
            $aiReport = $project ? $project->aiReports()->orderBy('generated_at', 'desc')->first() : null;
            
            $riskText = 'منخفض';
            $riskClass = 'risk-low';
            $riskBadge = '🟢';
            $color = 'blue';
            $bgColor = '#eff6ff';

            if ($aiReport) {
                if ($aiReport->risk_level === 'HIGH') {
                    $riskText = 'خطر عالي';
                    $riskClass = 'risk-high';
                    $riskBadge = '🔴';
                    $color = 'red';
                    $bgColor = '#fef2f2';
                } elseif ($aiReport->risk_level === 'MEDIUM') {
                    $riskText = 'متوسط';
                    $riskClass = 'risk-mid';
                    $riskBadge = '🟡';
                    $color = 'orange';
                    $bgColor = '#fff7ed';
                }
            }
          @endphp
          
          @if($project)
            <div class="project-item {{ $riskClass === 'risk-high' ? 'danger' : '' }}" onclick="window.location='{{ route('supervisor.projects', ['team_id' => $team->id]) }}'" style="cursor: pointer;">
              <div class="pi-top">
                <div class="pi-icon" style="background: {{ $bgColor }}">
                  @if($team->department_id == 1) 🌐
                  @elseif($team->department_id == 4) 🧠
                  @elseif($team->department_id == 7) 🛒
                  @else 📂
                  @endif
                </div>
                <div>
                  <div class="pi-name">{{ $project->title }}</div>
                  <div class="pi-meta">👥 فريق {{ $team->name }} · {{ $team->members->count() }} أعضاء</div>
                </div>
                <div class="pi-risk {{ $riskClass }}">{{ $riskBadge }} {{ $riskText }}</div>
              </div>
              <div class="pi-progress">
                <div class="pip-top">
                  <span style="color:var(--muted)">الإنجاز</span>
                  <span style="color:var(--{{ $color }});font-weight:700">{{ intval($project->progress) }}%</span>
                </div>
                <div class="pip-track"><div class="pip-fill" style="width:{{ $project->progress }}%;background:var(--{{ $color }})"></div></div>
              </div>
              <div class="pi-footer">
                <div class="pi-avatars">
                  @foreach($team->members->take(3) as $member)
                    @php
                      $initials = mb_substr($member->name, 0, 2);
                      $avatarColors = ['#3b82f6', '#ec4899', '#10b981', '#f59e0b', '#8b5cf6'];
                      $colorIndex = $member->id % count($avatarColors);
                    @endphp
                    <div class="pi-av" style="background: {{ $avatarColors[$colorIndex] }}">{{ $initials }}</div>
                  @endforeach
                </div>
                @if($project->expected_end_date && $project->expected_end_date->isPast())
                  <span style="color: var(--red)">⚠ متأخر</span>
                @else
                  <span>✅ على المسار</span>
                @endif
                <span>📅 الموعد: {{ $project->expected_end_date ? $project->expected_end_date->format('Y/m/d') : 'غير محدد' }}</span>
              </div>
            </div>
          @endif
        @empty
          <p style="text-align:center;padding:40px;color:var(--muted)">لا توجد مشاريع مسندة إليك حالياً.</p>
        @endforelse
      </div>
    </div>
 
    <!-- Right side -->
    <div style="display:flex;flex-direction:column;gap:16px">
 
      <!-- AI Report -->
      <div class="card" style="animation-delay:.35s">
        <div class="card-header">
          <div class="card-title">🤖 تقرير الذكاء الاصطناعي</div>
          <a class="card-action" href="{{ route('supervisor.projects') }}">تفاصيل ←</a>
        </div>
        <div class="ai-card">
          <div class="ai-header-row">
            <div class="ai-icon-box">🧠</div>
            <div>
              <div class="ai-title">تحليل المشاريع</div>
              <div class="ai-sub">آخر تحديث: تلقائي لحظي</div>
            </div>
          </div>
          <div class="ai-items">
            <div class="ai-item">
              <span class="ai-item-label">🔴 عالي الخطورة</span>
              <span class="ai-item-val" style="color:var(--red)">{{ $teams->filter(fn($t) => $t->project && $t->project->aiReports()->orderBy('generated_at', 'desc')->first()?->risk_level === 'HIGH')->count() }} مشاريع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">🟡 متوسط الخطورة</span>
              <span class="ai-item-val" style="color:var(--orange)">{{ $teams->filter(fn($t) => $t->project && $t->project->aiReports()->orderBy('generated_at', 'desc')->first()?->risk_level === 'MEDIUM')->count() }} مشروع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">🟢 منخفض الخطورة</span>
              <span class="ai-item-val" style="color:var(--green)">{{ $teams->filter(fn($t) => $t->project && $t->project->aiReports()->orderBy('generated_at', 'desc')->first()?->risk_level === 'LOW')->count() }} مشاريع</span>
            </div>
            <div class="ai-item">
              <span class="ai-item-label">📈 متوسط الإنجاز</span>
              <span class="ai-item-val" style="color:var(--blue)">
                @php
                  $avgProgress = $teams->avg(fn($t) => $t->project?->progress ?? 0);
                @endphp
                {{ number_format($avgProgress ?? 0, 1) }}%
              </span>
            </div>
          </div>
        </div>
        <div style="margin-top:14px">
          <div style="font-size:.75rem;font-weight:700;margin-bottom:8px">إنجاز الفرق الحقيقي</div>
          <div class="chart-bars">
            @foreach($teams as $team)
              @if($team->project)
                @php
                  $colors = ['#10b981', '#3b82f6', '#f97316', '#8b5cf6', '#ec4899'];
                  $color = $colors[$team->id % count($colors)];
                @endphp
                <div class="bar-wrap">
                  <div class="bar" style="height:{{ $team->project->progress }}%;background:{{ $color }}"></div>
                  <div class="bar-label">{{ $team->name }}</div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
 
      <!-- Alerts -->
      <div class="card" style="animation-delay:.40s">
        <div class="card-header">
          <div class="card-title">🔔 تنبيهات عاجلة</div>
          <a class="card-action" href="#">الكل ←</a>
        </div>
        <div class="alerts-list">
          @forelse($alerts as $alert)
            @php
              $class = 'info';
              $icon = '💬';
              if ($alert->type === 'DANGER') {
                  $class = 'danger';
                  $icon = '🚨';
              } elseif ($alert->type === 'WARNING') {
                  $class = 'warning';
                  $icon = '⚠️';
              } elseif ($alert->type === 'SUCCESS') {
                  $class = 'info';
                  $icon = '✅';
              }
            @endphp
            <div class="alert-item {{ $class }}">
              <div class="al-icon">{{ $icon }}</div>
              <div>
                <div class="al-title">{{ $alert->message }}</div>
                <div class="al-time">{{ $alert->created_at ? $alert->created_at->diffForHumans() : '' }}</div>
              </div>
            </div>
          @empty
            <p style="text-align:center;padding:20px;color:var(--muted);font-size:.8rem">لا توجد تنبيهات جديدة.</p>
          @endforelse
        </div>
      </div>
 
    </div>
  </div>
 
  <!-- Bottom Grid -->
  <div class="grid-bottom">
 
    <!-- New Requests -->
    <div class="card" style="animation-delay:.45s">
      <div class="card-header">
        <div class="card-title">📨 طلبات إشراف جديدة</div>
        <span style="background:#fef2f2;color:var(--red);font-size:.65rem;font-weight:700;padding:3px 9px;border-radius:20px">{{ $newRequests->count() }} جديد</span>
      </div>
      <div class="requests-list">
        @forelse($newRequests as $req)
          <div class="request-item">
            <div class="req-avatar" style="background:linear-gradient(135deg,var(--blue),var(--purple))">
              {{ mb_substr($req->creator->name ?? 'ط', 0, 2) }}
            </div>
            <div>
              <div class="req-name">{{ $req->creator->name ?? 'طالب' }}</div>
              <div class="req-desc">مشروع: {{ $req->project->title ?? 'لم يحدد' }}</div>
            </div>
            <div class="req-actions">
              <form action="{{ route('supervisor.acceptRequest', ['team' => $req->id]) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="req-btn req-accept">✓ قبول</button>
              </form>
              <form action="{{ route('supervisor.rejectRequest', ['team' => $req->id]) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="req-btn req-reject">✕</button>
              </form>
            </div>
          </div>
        @empty
          <p style="text-align:center;padding:20px;color:var(--muted);font-size:.8rem">لا توجد طلبات إشراف حالياً.</p>
        @endforelse
      </div>
    </div>
 
    <!-- Quick Eval -->
    <div class="card" style="animation-delay:.50s">
      <div class="card-header">
        <div class="card-title">📝 تقييم سريع</div>
        <a class="card-action" href="{{ route('supervisor.projects') }}">كل التقييمات ←</a>
      </div>
      <form action="" id="quick-eval-form" method="POST">
        @csrf
        <div style="display:flex;flex-direction:column;gap:10px">
          <select id="quick-eval-team" onchange="updateQuickEvalAction(this.value)" style="width:100%;padding:10px;border:1.5px solid var(--border);border-radius:9px;font-family:'Cairo',sans-serif;font-size:.82rem;outline:none;background:#f8fafc" required>
            <option value="">اختر الفريق...</option>
            @foreach($teams as $team)
              <option value="{{ $team->id }}">فريق {{ $team->name }} ({{ $team->project->title ?? '' }})</option>
            @endforeach
          </select>
          <div style="display:flex;gap:8px">
            <div onclick="setQuickEvalGrade(30, 25, 25)" class="quick-grade-btn" style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s">🟢 ممتاز</div>
            <div onclick="setQuickEvalGrade(24, 20, 20)" class="quick-grade-btn" style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s">🔵 جيد</div>
            <div onclick="setQuickEvalGrade(18, 15, 15)" class="quick-grade-btn" style="flex:1;padding:10px;background:var(--bg);border-radius:9px;text-align:center;cursor:pointer;border:1.5px solid var(--border);font-size:.75rem;font-weight:700;transition:all .2s">🟡 تحسين</div>
          </div>
          
          <!-- Hidden Inputs -->
          <input type="hidden" name="score_documentation" id="quick_doc" value="30">
          <input type="hidden" name="score_implementation" id="quick_impl" value="25">
          <input type="hidden" name="score_presentation" id="quick_pres" value="25">

          <textarea name="feedback" style="width:100%;padding:10px;border:1.5px solid var(--border);border-radius:9px;font-family:'Cairo',sans-serif;font-size:.78rem;resize:none;height:80px;outline:none;direction:rtl;background:#f8fafc" placeholder="اكتب ملاحظاتك للفريق..." required></textarea>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">📤 إرسال التقييم</button>
        </div>
      </form>
    </div>

    <!-- Schedule -->
    <div class="card" style="animation-delay:.55s">
      <div class="card-header">
        <div class="card-title">📅 جدول الاجتماعات</div>
        <a class="card-action" href="#">إضافة ←</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:10px">
        @foreach($meetings as $meeting)
          @php
            $bg = '#f8fafc';
            $border = 'var(--border)';
            if($meeting['color'] === 'green') {
                $bg = 'linear-gradient(135deg,#f0fdf4,#ecfdf5)';
                $border = '#bbf7d0';
            } elseif($meeting['color'] === 'blue') {
                $bg = 'linear-gradient(135deg,#eff6ff,#f0fdf4)';
                $border = '#bfdbfe';
            }
          @endphp
          <div style="padding:12px;background:{{ $bg }};border:1px solid {{ $border }};border-radius:11px">
            <div style="font-size:.8rem;font-weight:800;margin-bottom:3px">
              @if($meeting['color'] === 'green') 🟢 @elseif($meeting['color'] === 'blue') 🔵 @else 🟡 @endif
              {{ $meeting['day'] }} — {{ $meeting['time'] }}
            </div>
            <div style="font-size:.75rem;font-weight:600">{{ $meeting['team'] }} — {{ $meeting['title'] }}</div>
            <div style="font-size:.68rem;color:var(--muted);margin-top:3px">{{ $meeting['type'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
 
  </div>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    const navDashboard = document.getElementById('nav-dashboard');
    if (navDashboard) navDashboard.classList.add('active');

    function updateQuickEvalAction(teamId) {
        const form = document.getElementById('quick-eval-form');
        if(teamId) {
            form.action = `/supervisor/projects/${teamId}/evaluation`;
        } else {
            form.action = '';
        }
    }

    function setQuickEvalGrade(doc, impl, pres) {
        document.getElementById('quick_doc').value = doc;
        document.getElementById('quick_impl').value = impl;
        document.getElementById('quick_pres').value = pres;
        
        // Highlight active button
        const buttons = document.querySelectorAll('.quick-grade-btn');
        buttons.forEach(b => b.style.borderColor = 'var(--border)');
        
        event.currentTarget.style.borderColor = 'var(--primary)';
    }
</script>
@endsection