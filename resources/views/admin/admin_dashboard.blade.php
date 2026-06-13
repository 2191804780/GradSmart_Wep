@extends('layouts.admin')

@section('title', 'GradSmart — لوحة المسؤول')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
  <!-- شبكة الإحصائيات (Stats Grid) -->
  <div class="stats-grid">
    <div class="stat-card blue">
      <div class="stat-icon">🎓</div>
      <div class="stat-num">120</div>
      <div class="stat-label">إجمالي الطلاب</div>
    </div>
    <div class="stat-card purple">
      <div class="stat-icon">👨‍🏫</div>
      <div class="stat-num">24</div>
      <div class="stat-label">المشرفين النشطين</div>
    </div>
    <div class="stat-card green">
      <div class="stat-icon">💼</div>
      <div class="stat-num">32</div>
      <div class="stat-label">المشاريع المسجلة</div>
    </div>
    <div class="stat-card orange">
      <div class="stat-icon">⏳</div>
      <div class="stat-num">5</div>
      <div class="stat-label">طلبات قيد المراجعة</div>
    </div>
  </div>

  <!-- الشبكة الثنائية للبطاقات الرئيسية (Main Grid) -->
  <div class="grid-main">
    
    <!-- قسم الطلبات والموافقات -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">📨 طلبات اعتماد المشاريع والفرق الجديدة</div>
        <a class="card-action" href="#">عرض جميع الطلبات ←</a>
      </div>
      
      <div class="requests-list">
        
        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">نظام إدارة العيادات الطبية الذكي</div>
            <div class="req-meta">👤 فريق البواسل · 4 طلاب · المشرف المقترح: د. خالد العتيبي</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">تطبيق تتبع الباصات الجامعية بالوقت الفعلي</div>
            <div class="req-meta">👤 فريق المستقبل · 3 طلاب · المشرف المقترح: د. سارة العلي</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

        <div class="request-item">
          <div class="req-icon">💡</div>
          <div class="req-details">
            <div class="req-title">منصة التبرع بالكتب الدراسية المستعملة</div>
            <div class="req-meta">👤 فريق العطاء · 4 طلاب · المشرف المقترح: د. أحمد السالم</div>
          </div>
          <div class="req-actions">
            <button class="action-btn btn-approve">✓ اعتماد</button>
            <button class="action-btn btn-reject">✕ رفض</button>
          </div>
        </div>

      </div>
    </div>

    <!-- القسم الأيسر: الرسوم البيانية والأنشطة -->
    <div style="display: flex; flex-direction: column; gap: 16px;">
      
      <!-- إحصائيات الأقسام والكليات -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">🏛️ توزيع المشاريع حسب الأقسام</div>
        </div>
        <div class="chart-container">
          <div class="chart-bars">
            <div class="bar-wrap">
              <div class="bar" style="height: 85%;"></div>
              <div class="bar-label">علوم حاسب</div>
            </div>
            <div class="bar-wrap">
              <div class="bar purple" style="height: 60%;"></div>
              <div class="bar-label">هندسة برمجيات</div>
            </div>
            <div class="bar-wrap">
              <div class="bar green" style="height: 45%;"></div>
              <div class="bar-label">تقنية معلومات</div>
            </div>
            <div class="bar-wrap">
              <div class="bar orange" style="height: 30%;"></div>
              <div class="bar-label">نظم معلومات</div>
            </div>
          </div>
        </div>
      </div>

      <!-- سجل الأنشطة الأمنية والبرمجية للنظام -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">📜 سجل الأنشطة والأمان للنظام</div>
          <a class="card-action" href="#">السجلات الكاملة ←</a>
        </div>
        <div class="activity-list">
          <div class="activity-item">
            <div class="act-icon" style="background: #eff6ff;">👥</div>
            <div class="act-text">
              <div class="act-main">تم تسجيل حساب مشرف جديد: د. محمد الخالدي</div>
              <div class="act-time">منذ 20 دقيقة</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background: #f0fdf4;">✅</div>
            <div class="act-text">
              <div class="act-main">تم اعتماد مشروع "نظام إدارة التخرج GradSmart"</div>
              <div class="act-time">منذ ساعتين</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background: #fff7ed;">⚠️</div>
            <div class="act-text">
              <div class="act-main">تنبيه أمني: محاولة دخول فاشلة لحساب المشرف د. أحمد السالم</div>
              <div class="act-time">منذ 4 ساعات</div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
@endsection

@section('scripts')
<script>
    // تفعيل كلاس active للرابط الحالي في السايدبار تلقائياً
    const navDashboard = document.getElementById('nav-dashboard');
    if (navDashboard) navDashboard.classList.add('active');
</script>
@endsection
