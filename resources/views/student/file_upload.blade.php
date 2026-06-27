@extends('layouts.student')

@section('title', 'GradSmart — رفع الملفات')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/file_upload.css') }}">
@endsection

@section('topbar_actions')
<button class="btn btn-outline">🗂️ مجلد جديد</button><button class="btn btn-primary">⬆ رفع ملف</button>
@endsection

@section('content')

  <!-- ══ FILES ══ -->
  <div class="page-content active" id="files">
    <div class="topbar" style="margin-bottom:20px">
      <div class="page-title"><h1>📁 الملفات والتقارير</h1><p>12 ملف مرفوع — 245 MB من أصل 1 GB</p></div>
      <div class="topbar-actions"><button class="btn btn-outline">🗂️ مجلد جديد</button><button class="btn btn-primary">⬆ رفع ملف</button></div>
    </div>
 
    <!-- Upload Zone -->
    <div class="upload-zone">
      <div class="uz-icon">☁️</div>
      <div class="uz-title">اسحب الملفات هنا أو اضغط للرفع</div>
      <div class="uz-sub">الحد الأقصى 50 MB للملف الواحد</div>
      <div class="uz-types">
        <span class="uz-type">PDF</span><span class="uz-type">Word</span><span class="uz-type">Excel</span>
        <span class="uz-type">PNG/JPG</span><span class="uz-type">ZIP</span><span class="uz-type">MP4</span>
      </div>
    </div>
 
    <!-- Filter -->
    <div class="files-filter">
      <button class="ff-tab active">الكل (12)</button>
      <button class="ff-tab">📄 تقارير (5)</button>
      <button class="ff-tab">🎨 تصاميم (3)</button>
      <button class="ff-tab">💻 أكواد (2)</button>
      <button class="ff-tab">📊 عروض (2)</button>
      <div class="ff-spacer"></div>
      <input class="ff-search" placeholder="🔍 ابحث في الملفات...">
    </div>
 
    <!-- Files Grid -->
    <div class="files-grid">
      <div class="file-card" style="animation-delay:.05s">
        <div class="fc-top"><div class="fc-icon" style="background:#fef2f2">📄</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">تقرير_المرحلة_الثانية.pdf</div>
        <div class="fc-meta">📅 9 مايو 2026 · 👤 محمد · 2.4 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">PDF</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.10s">
        <div class="fc-top"><div class="fc-icon" style="background:#eff6ff">🎨</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">Figma_Design_GradSmart.fig</div>
        <div class="fc-meta">📅 8 مايو 2026 · 👤 سارة · 18.7 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#eff6ff;color:var(--blue);border:1px solid #bfdbfe">Figma</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.15s">
        <div class="fc-top"><div class="fc-icon" style="background:#f0fdf4">📊</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">GradSmart_ERD_Final.png</div>
        <div class="fc-meta">📅 1 مايو 2026 · 👤 محمد · 3.1 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#f0fdf4;color:var(--green);border:1px solid #bbf7d0">Image</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.20s">
        <div class="fc-top"><div class="fc-icon" style="background:#faf5ff">💻</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">gradsmart_backend_v1.zip</div>
        <div class="fc-meta">📅 7 مايو 2026 · 👤 عمر · 45.2 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#faf5ff;color:var(--purple);border:1px solid #ddd6fe">ZIP</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.25s">
        <div class="fc-top"><div class="fc-icon" style="background:#fff7ed">📝</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">وثيقة_المتطلبات_SRS.docx</div>
        <div class="fc-meta">📅 15 أبريل 2026 · 👤 محمد · 1.8 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fff7ed;color:var(--orange);border:1px solid #fed7aa">Word</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
 
      <div class="file-card" style="animation-delay:.30s">
        <div class="fc-top"><div class="fc-icon" style="background:#fef9f9">🎬</div><div class="fc-menu">⋮</div></div>
        <div class="fc-name">عرض_المشروع_PPT.pptx</div>
        <div class="fc-meta">📅 3 مايو 2026 · 👤 سارة · 12.5 MB</div>
        <div class="fc-footer">
          <span class="fc-type" style="background:#fef2f2;color:var(--red);border:1px solid #fecaca">PPT</span>
          <div class="fc-actions"><div class="fc-btn">👁</div><div class="fc-btn">⬇</div><div class="fc-btn">🗑</div></div>
        </div>
      </div>
    </div>
 
    <!-- Storage Usage -->
    <div class="card">
      <div class="card-header"><div class="card-title">💾 مساحة التخزين</div><span style="font-size:.75rem;color:var(--muted)">245 MB من 1 GB</span></div>
      <div style="height:10px;background:var(--bg);border-radius:10px;overflow:hidden;margin-bottom:12px">
        <div style="width:24%;height:100%;background:linear-gradient(90deg,var(--blue),var(--purple));border-radius:10px"></div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--red);display:inline-block"></span>PDF — 45 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--blue);display:inline-block"></span>Figma — 87 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--purple);display:inline-block"></span>ZIP — 68 MB</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:.72rem"><span style="width:10px;height:10px;border-radius:3px;background:var(--orange);display:inline-block"></span>أخرى — 45 MB</div>
      </div>
    </div>
  </div>
 
 
@endsection

@section('scripts')
<script>
function switchPage(id, btn) {
  document.querySelectorAll('.page-content').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(b => b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
  // Update sidebar active
  const map = {files:'📁'};
  document.querySelectorAll('.nav-item').forEach(item => {
    item.classList.remove('active');
    if(id==='files' && item.textContent.includes('الملفات')) item.classList.add('active');
  });
}
function switchSettings(id, el) {
  document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.sn-item').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  el.classList.add('active');
}
</script>
@endsection