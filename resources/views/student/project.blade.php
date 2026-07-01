@extends('layouts.student')

@section('title','GradSmart - مشروعي')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/project.css') }}?v={{ time() }}">
@endsection

@section('content')

@if(session('success'))
<div class="gs-alert gs-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="gs-alert gs-error">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

@if(!$project)

<div class="empty-project-card">
    <div class="empty-icon">🚀</div>
    <h2>ابدأ إنشاء مشروع التخرج</h2>
    <p>أنشئ مشروعك ليتمكن GradSmart من تحليل المشروع واقتراح المشرف المناسب.</p>

    <form method="POST" action="{{ route('student.project.store') }}" class="project-form">
        @csrf

        <label>عنوان المشروع</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>وصف المشروع</label>
        <textarea name="description" rows="4">{{ old('description') }}</textarea>

        <label>الكلمات المفتاحية</label>
        <input type="text" name="keywords" value="{{ old('keywords') }}" placeholder="web, AI, Laravel">

        <label>تاريخ التسليم المتوقع</label>
        <input type="date" name="expected_end_date" value="{{ old('expected_end_date') }}" required>

        <button type="submit" class="main-btn">إنشاء المشروع</button>
    </form>
</div>

@else

<div class="project-page">

    <div class="project-hero">
        <div class="hero-icon">🚀</div>

        <div class="hero-info">
            <h1>{{ $project->title }}</h1>
            <p>
                فريق {{ $team->name }} يعمل على المشروع
                
                
            </p>
        </div>

        <div class="hero-meta">
           
            <div>
                <span>المتبقي للتسليم</span>
                <strong>{{ $daysLeft !== null ? max($daysLeft, 0) : '--' }} أيام</strong>
            </div>
        </div>
    </div>

    <div class="stats-row">

        <div class="mini-card purple">
            <div class="mini-icon">🧠</div>
            <span>اقتراح الذكاء الاصطناعي</span>
            <strong>{{ $aiScore ?: '--' }}%</strong>
            <small>{{ $recommendedSupervisor->name ?? 'لا يوجد اقتراح' }}</small>
        </div>

        <div class="mini-card green">
            <div class="mini-icon">📈</div>
            <span>تقدم المشروع</span>
            <strong>{{ $project->progress }}%</strong>
            <small>نسبة الإنجاز الحالية</small>
        </div>

        <div class="mini-card blue">
            <div class="mini-icon">🕒</div>
            <span>آخر تحليل</span>
            <strong>
                {{ $aiReport ? \Carbon\Carbon::parse($aiReport->generated_at)->format('d/m/Y') : '--' }}
            </strong>
            <small>
                {{ $aiReport ? \Carbon\Carbon::parse($aiReport->generated_at)->format('h:i A') : 'لم يتم التحليل' }}
            </small>
        </div>

        <div class="mini-card green-soft">
            <div class="mini-icon">✅</div>
            <span>حالة المشروع</span>
            <strong>{{ $project->status }}</strong>
            <small>قيد التنفيذ</small>
        </div>

    </div>

    <div class="project-grid">

        <div class="panel info-panel">
            <h3>ⓘ معلومات المشروع</h3>

            <div class="info-list">
                <div>
                    <span>العنوان</span>
                    <strong>{{ $project->title }}</strong>
                </div>

                <div>
                    <span>القسم</span>
                    <strong>{{ $team->department->name ?? 'غير محدد' }}</strong>
                </div>

                <div>
                    <span>الفريق</span>
                    <strong>{{ $team->name }}</strong>
                </div>

                <div>
                    <span>عدد الأعضاء</span>
                    <strong>{{ $team->members->count() }}</strong>
                </div>

                <div>
                    <span>موعد التسليم</span>
                    <strong>{{ $project->expected_end_date ?? 'غير محدد' }}</strong>
                </div>

                <div>
                    <span>الكلمات المفتاحية</span>
                    <strong>{{ $project->keywords ?? 'لا توجد' }}</strong>
                </div>
            </div>
        </div>

        <div class="panel timeline-panel">
            <h3>تقدم المراحل</h3>

            <div class="stage done">
                <span>إنشاء الفريق</span>
                <b>مكتمل</b>
                <i>✓</i>
            </div>

            <div class="stage done">
                <span>إنشاء المشروع</span>
                <b>مكتمل</b>
                <i>✓</i>
            </div>

            <div class="stage {{ $project->supervisor ? 'done' : 'active' }}">
                <span>اختيار المشرف</span>
                <b>{{ $project->supervisor ? 'مكتمل' : 'قيد التنفيذ' }}</b>
                <i>{{ $project->supervisor ? '✓' : '○' }}</i>
            </div>

            <div class="stage {{ $project->supervisor ? 'done' : 'active' }}">
                <span>بدء تنفيذ المهام</span>
                <b> {{ $project->tasks->isNotEmpty() ? 'مكتمل' : 'قيد التنفيذ'}} </b> 
                <i>{{ $project->tasks->isNotEmpty() ? '✓' : '○' }}</i>
                
            </div>

            <div class="stage {{ $project->report_submitted ? 'done' : 'active' }}">
                <span>رفع التقرير</span>
                <b> {{ $project->report_submitted ? 'مكتمل' : 'قيد التنفيذ'}} </b> 
                <i>{{ $project->report_submitted ? '✓' : '○' }}</i>
            </div>

            <div class="stage {{ $project->final_submission ? 'done' : 'active' }}">
                <span>التسليم النهائي</span>
                <b> {{ $project->final_submission ? 'مكتمل' : 'قيد التنفيذ'}} </b> 
                <i>{{ $project->final_submission ? '✓' : '○' }}</i>
            </div>
        </div>

        <div class="panel ai-panel">
            <h3>✦ التحليل الذكي للمشروع</h3>

            <div class="ai-ring">
                <span>{{ $aiScore ?: '--' }}%</span>
            </div>

            <p>نسبة التوافق مع المشروع</p>

            @if($aiReasons && count($aiReasons))
                <ul class="ai-reasons">
                    @foreach($aiReasons as $reason)
                        <li>✅ {{ $reason }}</li>
                    @endforeach
                </ul>
            @else
                <div class="empty-text">لم يتم إنشاء تحليل بعد.</div>
            @endif

            <form method="POST" action="{{ route('student.project.analyzeAi') }}">
                @csrf
                <button type="submit" class="main-btn ai-btn">
                    🤖 تحليل المشروع بالذكاء الاصطناعي
                </button>
            </form>
        </div>

        <div class="panel supervisor-panel">
            <h3>👨‍🏫 المشرف المقترح</h3>

            @if($project->supervisor)
                <div class="supervisor-box">
                    <div class="avatar">{{ mb_substr($project->supervisor->name, 0, 1) }}</div>

                    <div>
                        <strong>{{ $project->supervisor->name }}</strong>
                        <span>دكتور</span>
                    </div>

                    <b class="accepted-badge">تم القبول</b>
                </div>

                <div class="green-note">✅ تم قبول طلب الإشراف على المشروع</div>

            @elseif($pendingRequest)
                <div class="orange-note">⏳ يوجد طلب إشراف قيد الانتظار</div>

            @elseif($recommendedSupervisor)
                <div class="supervisor-box">
                    <div class="avatar">{{ mb_substr($recommendedSupervisor->name, 0, 1) }}</div>

                    <div>
                        <strong>{{ $recommendedSupervisor->name }}</strong>
                        <span>{{ $recommendedSupervisor->email }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('student.project.requestSupervisor', $recommendedSupervisor->id) }}">
                    @csrf
                    <button type="submit" class="main-btn">اختيار المشرف المقترح</button>
                </form>

            @else
                <div class="empty-text">لا يوجد مشرف مقترح حتى الآن.</div>
            @endif
        </div>

        <div class="panel actions-panel">
            <h3>⚡ إجراءات سريعة</h3>

            <a href="{{ route('student.tasks.index') }}">
                <span>إدارة المهام</span>
                <i>☑️</i>
            </a>

            <a href="{{ route('student.chat.index') }}">
                <span>المحادثة</span>
                <i>💬</i>
            </a>

            <a href="{{ route('student.progress.index') }}">
                <span>متابعة التقدم</span>
                <i>📊</i>
            </a>
        </div>

        <div class="panel supervisors-panel">
            <h3>👥 المشرفون المتاحون</h3>

            @if(!$project->supervisor && !$pendingRequest)
                @forelse($supervisors->take(3) as $supervisor)
                    <div class="sup-row">
                        <div>
                            <strong>{{ $supervisor->name }}</strong>
                            <span>{{ $supervisor->email }}</span>
                        </div>

                        <form method="POST" action="{{ route('student.project.requestSupervisor', $supervisor->id) }}">
                            @csrf
                            <button type="submit">اختيار</button>
                        </form>
                    </div>
                @empty
                    <div class="empty-text">لا يوجد مشرفون متاحون.</div>
                @endforelse
            @else
                <div class="green-note">تم تعيين المشرف لهذا المشروع.</div>
            @endif
        </div>

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