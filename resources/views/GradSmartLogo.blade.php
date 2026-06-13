<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GradSmart — Brand Identity</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400&family=Outfit:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg: #0C1220;
  --bg2: #111827;
  --navy: #1C2E4A;
  --blue: #2A4A8A;
  --sky: #4A78C8;
  --gold: #D4A853;
  --gold2: #F0C97A;
  --cream: #EEE8D8;
  --white: #F8F6F0;
  --muted: #8A96A8;
  --line: rgba(212,168,83,0.25);
}

html { scroll-behavior: smooth; }

body {
  background: var(--bg);
  font-family: 'Outfit', sans-serif;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  overflow-x: hidden;
}

/* ── Background stars/grid ── */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background-image:
    radial-gradient(circle at 20% 20%, rgba(42,74,138,0.25) 0%, transparent 50%),
    radial-gradient(circle at 80% 80%, rgba(212,168,83,0.12) 0%, transparent 50%),
    radial-gradient(circle at 50% 50%, rgba(28,46,74,0.4) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}

body::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image:
    repeating-linear-gradient(0deg, transparent, transparent 59px, rgba(255,255,255,0.018) 60px),
    repeating-linear-gradient(90deg, transparent, transparent 59px, rgba(255,255,255,0.018) 60px);
  pointer-events: none;
  z-index: 0;
}

/* ── Floating particles ── */
.particle {
  position: fixed;
  border-radius: 50%;
  pointer-events: none;
  z-index: 0;
  animation: float linear infinite;
}
@keyframes float {
  0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
  10%  { opacity: 1; }
  90%  { opacity: 0.6; }
  100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
}

/* ── Main card ── */
.card {
  position: relative;
  z-index: 1;
  width: 100%;
  max-width: 1100px;
  background: linear-gradient(145deg, #141E30 0%, #0E1825 50%, #121C2C 100%);
  border: 1px solid rgba(212,168,83,0.2);
  border-radius: 24px;
  padding: 72px 64px 80px;
  box-shadow:
    0 0 0 1px rgba(255,255,255,0.04),
    0 40px 120px rgba(0,0,0,0.7),
    0 0 80px rgba(42,74,138,0.15),
    inset 0 1px 0 rgba(255,255,255,0.07);
  overflow: hidden;
}

/* Corner ornaments */
.card::before, .card::after {
  content: '';
  position: absolute;
  width: 120px; height: 120px;
  border: 1px solid rgba(212,168,83,0.18);
  pointer-events: none;
}
.card::before { top: 20px; left: 20px; border-right: none; border-bottom: none; border-radius: 12px 0 0 0; }
.card::after  { bottom: 20px; right: 20px; border-left: none; border-top: none; border-radius: 0 0 12px 0; }

/* Inner corner ornaments via JS-injected elements */
.corner-tr, .corner-bl {
  position: absolute;
  width: 120px; height: 120px;
  border: 1px solid rgba(212,168,83,0.18);
  pointer-events: none;
}
.corner-tr { top: 20px; right: 20px; border-left: none; border-bottom: none; border-radius: 0 12px 0 0; }
.corner-bl { bottom: 20px; left: 20px; border-right: none; border-top: none; border-radius: 0 0 0 12px; }

/* ── Header ── */
.header {
  text-align: center;
  margin-bottom: 64px;
  animation: fadeDown 0.9s ease both;
}
@keyframes fadeDown {
  from { opacity: 0; transform: translateY(-20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.header-eyebrow {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  margin-bottom: 18px;
}
.eyebrow-line {
  width: 48px; height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold));
}
.eyebrow-line.right {
  background: linear-gradient(90deg, var(--gold), transparent);
}
.eyebrow-text {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.38em;
  color: var(--gold);
  text-transform: uppercase;
}

.header-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 4vw, 46px);
  font-weight: 700;
  color: var(--white);
  letter-spacing: 0.02em;
  line-height: 1.15;
  margin-bottom: 10px;
}
.header-title span {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 50%, var(--gold) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.header-sub {
  font-size: 13px;
  font-weight: 300;
  color: var(--muted);
  letter-spacing: 0.12em;
}

/* ── Divider ── */
.divider {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 56px;
  opacity: 0.5;
}
.divider-line { flex: 1; height: 1px; background: var(--line); }
.divider-diamond {
  width: 6px; height: 6px;
  background: var(--gold);
  transform: rotate(45deg);
  flex-shrink: 0;
}

/* ── Concepts grid ── */
.concepts {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2px;
  position: relative;
}

/* ── Single concept ── */
.concept {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 20px 36px;
  position: relative;
  cursor: default;
  border-radius: 16px;
  transition: background 0.4s ease;
  animation: riseIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
}
.concept:nth-child(1) { animation-delay: 0.2s; }
.concept:nth-child(2) { animation-delay: 0.35s; }
.concept:nth-child(3) { animation-delay: 0.5s; }
.concept:nth-child(4) { animation-delay: 0.65s; }

@keyframes riseIn {
  from { opacity: 0; transform: translateY(32px) scale(0.96); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

.concept:hover {
  background: rgba(42,74,138,0.12);
}

/* Vertical separator */
.concept:not(:last-child)::after {
  content: '';
  position: absolute;
  right: 0; top: 15%; bottom: 15%;
  width: 1px;
  background: linear-gradient(to bottom, transparent, rgba(212,168,83,0.2), transparent);
}

/* ── Circle ── */
.circle {
  width: 156px;
  height: 156px;
  border-radius: 50%;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 32px;
  flex-shrink: 0;
}

/* Outer ring - dashed */
.circle::before {
  content: '';
  position: absolute;
  inset: -1px;
  border-radius: 50%;
  border: 1.5px solid rgba(212,168,83,0.3);
  transition: border-color 0.4s ease;
}

/* Inner fill */
.circle::after {
  content: '';
  position: absolute;
  inset: 10px;
  border-radius: 50%;
  background: radial-gradient(circle at 35% 35%, rgba(42,74,138,0.35) 0%, rgba(12,18,32,0.8) 100%);
  border: 1px solid rgba(255,255,255,0.06);
  transition: all 0.4s ease;
}

.concept:hover .circle::before { border-color: rgba(212,168,83,0.7); }
.concept:hover .circle::after  { background: radial-gradient(circle at 35% 35%, rgba(42,74,138,0.55) 0%, rgba(18,28,44,0.9) 100%); }

/* Rotating outer ring on hover */
.circle-ring {
  position: absolute;
  inset: -8px;
  border-radius: 50%;
  border: 1px dashed rgba(212,168,83,0.15);
  transition: border-color 0.4s ease;
  animation: spinSlow 30s linear infinite;
}
@keyframes spinSlow { to { transform: rotate(360deg); } }
.concept:hover .circle-ring { border-color: rgba(212,168,83,0.3); }

/* Glow dot at top of ring */
.circle-glow {
  position: absolute;
  top: -3px; left: 50%;
  transform: translateX(-50%);
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--gold);
  box-shadow: 0 0 10px var(--gold), 0 0 20px rgba(212,168,83,0.5);
  opacity: 0;
  transition: opacity 0.4s ease;
  z-index: 2;
}
.concept:hover .circle-glow { opacity: 1; }

.icon-wrap {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ── Text ── */
.label-num {
  font-size: 9px;
  font-weight: 600;
  letter-spacing: 0.3em;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 8px;
  opacity: 0.8;
}

.label {
  font-family: 'Playfair Display', serif;
  font-size: 15px;
  font-weight: 500;
  color: var(--white);
  text-align: center;
  margin-bottom: 10px;
  line-height: 1.3;
}

.desc {
  font-size: 11px;
  font-weight: 300;
  color: var(--muted);
  text-align: center;
  line-height: 1.75;
  max-width: 165px;
}

/* ── Footer ── */
.footer {margin-top: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 28px;
  border-top: 1px solid rgba(212,168,83,0.12);
  animation: fadeUp 1s ease 0.8s both;
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: translateY(0); }
}

.footer-brand {
  display: flex;
  align-items: center;
  gap: 10px;
}
.footer-logo-mark {
  width: 28px; height: 28px;
  border-radius: 50%;
  border: 1px solid rgba(212,168,83,0.4);
  display: flex; align-items: center; justify-content: center;
  font-family: 'Playfair Display', serif;
  font-size: 13px;
  color: var(--gold);
}
.footer-name {
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.2em;
  color: var(--cream);
  text-transform: uppercase;
}

.footer-tags {
  display: flex;
  gap: 20px;
}
.footer-tag {
  font-size: 9.5px;
  letter-spacing: 0.18em;
  color: var(--muted);
  text-transform: uppercase;
  font-weight: 400;
}

.footer-year {
  font-family: 'Playfair Display', serif;
  font-size: 11px;
  color: rgba(212,168,83,0.5);
  letter-spacing: 0.1em;
}
</style>
</head>
<body>

<!-- Floating particles -->
<script>
  const colors = ['rgba(212,168,83,0.6)','rgba(74,120,200,0.5)','rgba(240,201,122,0.4)'];
  for(let i=0;i<18;i++){
    const p = document.createElement('div');
    p.className='particle';
    const s = Math.random()*3+1;
    p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;background:${colors[i%3]};animation-duration:${12+Math.random()*20}s;animation-delay:${Math.random()*15}s;`;
    document.body.appendChild(p);
  }
</script>

<div class="card">
  <div class="corner-tr"></div>
  <div class="corner-bl"></div>

  <!-- Header -->
  <div class="header">
    <div class="header-eyebrow">
      <span class="eyebrow-line"></span>
      <span class="eyebrow-text">Brand Identity Concept</span>
      <span class="eyebrow-line right"></span>
    </div>
    <h1 class="header-title">GRAD<span>SMART</span></h1>
    <p class="header-sub">Graduation Project Management Platform</p>
  </div>

  <div class="divider">
    <div class="divider-line"></div>
    <div class="divider-diamond"></div>
    <div class="divider-line"></div>
  </div>

  <!-- Concepts -->
  <div class="concepts">

    <!-- 1 · Full Logo -->
    <div class="concept">
      <div class="circle">
        <div class="circle-ring"></div>
        <div class="circle-glow"></div>
        <div class="icon-wrap">
          <!--
            GRADSMART LOGO
            • G  : white stroke-only letter (fill=none, stroke=white)
            • Cap: navy-blue outline graduation cap, tilted, top-left
            • Arrow: solid gold, upward, inside G counter
          -->
          <svg width="120" height="116" viewBox="0 0 120 116" fill="none"
               xmlns="http://www.w3.org/2000/svg">

            <!-- ════════════════════════════════
                 1. WHITE OUTLINE LETTER G
                 font-size=90, baseline y=108, x=14
                 ════════════════════════════════ -->
            <text
              x="14" y="108"
              font-family="Georgia, 'Times New Roman', serif"
              font-size="90" font-weight="700"
              fill="none"
              stroke="#FFFFFF"
              stroke-width="4.5"
              stroke-linejoin="round"
              paint-order="stroke">G</text>

            <!-- ════════════════════════════════
                 2. SOLID GOLD ARROW (inside G)
                 G at 90px/Georgia x=14 → counter
                 approx center x=65, range y=54–88
                 ════════════════════════════════ -->
            <!-- Arrow: shaft + triangular head, pointing UP -->
            <rect  x="60"  y="66" width="12" height="28"
                   fill="#D4A853" rx="2"/>
            <polygon points="52,66  66,44  80,66"
                     fill="#D4A853"/>

            <!-- ════════════════════════════════
                 3. BLUE OUTLINE GRADUATION CAP
                 Tilted −13°, centered ≈ (34, 24)
                 overlaps top-left of the G
                 ════════════════════════════════ -->
            <g transform="rotate(-13, 34, 24)">

              <!-- Board: rhombus/diamond (square seen at angle) -->
              <polygon
                points="34,6  58,18  34,30  10,18"
                fill="none"
                stroke="#3D5FA0"
                stroke-width="3.5"
                stroke-linejoin="round"/>

              <!-- 3-D peak: right-rear corner of board rising upward -->
              <polyline
                points="34,6  46,12  58,18"
                fill="none"
                stroke="#3D5FA0"
                stroke-width="3"
                stroke-linejoin="round"/>

              <!-- Cap dome / body below the board -->
              <path
                d="M14 22 Q14 40 34 47 Q54 40 54 22"
                fill="none"
                stroke="#3D5FA0"
                stroke-width="3.5"
                stroke-linecap="round"/>

              <!-- Bottom brim line -->
              <line x1="14" y1="22" x2="54" y2="22"
                    stroke="#3D5FA0" stroke-width="2" opacity="0.4"/>

              <!-- Tassel cord: from left corner of board, droops down-left -->
              <path
                d="M10 18 Q4 26 3 38"
                stroke="#3D5FA0"
                stroke-width="2.8"
                stroke-linecap="round"
                fill="none"/>

              <!-- Tassel knot (circle) -->
              <circle cx="3" cy="42" r="4.5"
                      fill="none"
                      stroke="#3D5FA0"
                      stroke-width="2.8"/>

              <!-- Tassel strands -->
              <line x1="0"  y1="46.5" x2="-1" y2="57"
                    stroke="#3D5FA0" stroke-width="2.2" stroke-linecap="round"/>
              <line x1="3"  y1="46.5" x2="2"  y2="58"
                    stroke="#3D5FA0" stroke-width="2.2" stroke-linecap="round"/>
              <line x1="6"  y1="46.5" x2="7"  y2="57"
                    stroke="#3D5FA0" stroke-width="2.2" stroke-linecap="round"/>

            </g>

          </svg>
            <defs>
              <!-- White gradient for G letter body -->
              <linearGradient id="gWhite" x1="0" y1="0" x2="50" y2="70" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#FFFFFF"/>
                <stop offset="100%" stop-color="#C8D0DC"/>
              </linearGradient>
              <!-- Gold gradient for arrow -->
              <linearGradient id="arrowGold" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                <stop offset="0%" stop-color="#F0C97A"/>
                <stop offset="100%" stop-color="#D4A853"/>
              </linearGradient>
              <!-- Blue gradient for cap -->
              <linearGradient id="capBlue" x1="0" y1="0" x2="1" y2="1" gradientUnits="objectBoundingBox">
                <stop offset="0%" stop-color="#6A98E8"/>
                <stop offset="100%" stop-color="#2A4A8A"/>
              </linearGradient>
              <!-- Soft glow filter for G -->
              <filter id="gSoftGlow" x="-10%" y="-10%" width="120%" height="120%">
                <feGaussianBlur stdDeviation="1.5" result="blur"/>
                <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
              </filter>
            </defs>

            <!-- ── GRADUATION CAP (tilted -15°, positioned top-left above G) ── -->
            <g transform="translate(8, 2) rotate(-15, 22, 14)">
              <!-- Board top face -->
              <polygon points="22,4 42,12 22,20 2,12" fill="url(#capBlue)" opacity="0.95"/>
              <!-- Board shine -->
              <polygon points="22,4 38,10 22,16 6,10" fill="white" opacity="0.10"/>
              <!-- Cap body sides -->
              <path d="M8 14 L8 26 Q22 33 36 26 L36 14 Q22 21 8 14Z" fill="#2A4A8A" opacity="0.9"/>
              <!-- Tassel string -->
              <path d="M40 12 Q44 16 42 22 Q41 26 40 30" stroke="#D4A853" stroke-width="1.6" stroke-linecap="round" fill="none"/>
              <!-- Tassel ball -->
              <circle cx="40" cy="32" r="3" fill="#D4A853"/>
              <circle cx="40" cy="32" r="1.5" fill="#F0C97A"/>
            </g>

            <!-- ── LETTER G (clear Playfair Display, white) ── -->
            <!-- Shadow layer for depth -->
            <text x="7" y="72"
                  font-family="Playfair Display, Georgia, serif"
                  font-size="60" font-weight="700"
                  fill="#0A1020" opacity="0.5">G</text>
            <!-- Main white G -->
            <text x="5" y="70"
                  font-family="Playfair Display, Georgia, serif"
                  font-size="60" font-weight="700"
                  fill="url(#gWhite)"
                  filter="url(#gSoftGlow)">G</text>

            <!-- ── GOLDEN ARROW (fused inside G opening, pointing up-right) ── -->
            <!-- Arrow shaft — sits in the open right side of G -->
            <line x1="52" y1="50" x2="52" y2="36"
                  stroke="#F0C97A" stroke-width="2.8"
                  stroke-linecap="round"/>
            <!-- Arrow head pointing up -->
            <polyline points="46,41 52,35 58,41"
                      stroke="#F0C97A" stroke-width="2.8"
                      stroke-linecap="round" stroke-linejoin="round"
                      fill="none"/>
            <!-- Subtle glow behind arrow tip -->
            <circle cx="52" cy="35" r="5" fill="#D4A853" opacity="0.18"/>

          </svg>
        </div>
      </div>
      <p class="label-num">01</p>
      <p class="label">Full Logo Mark</p>
      <p class="desc">The complete brand mark — G monogram fused with the graduation cap and upward golden arrow.</p>
    </div>

    <!-- 2 · Letter G -->
    <div class="concept">
      <div class="circle">
        <div class="circle-ring"></div>
        <div class="circle-glow"></div>
        <div class="icon-wrap">
          <svg width="76" height="76" viewBox="0 0 76 76" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="gGold" x1="0" y1="0" x2="76" y2="76" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#F0C97A"/>
                <stop offset="50%" stop-color="#D4A853"/>
                <stop offset="100%" stop-color="#B88A30"/>
              </linearGradient>
              <filter id="gGlow">
                <feGaussianBlur stdDeviation="2.5" result="blur"/>
                <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
              </filter>
            </defs>
            <!-- Shadow G -->
            <text x="9" y="63" font-family="Playfair Display, serif" font-size="62" font-weight="700" fill="#1C2E4A" opacity="0.6">G</text>
            <!-- Main G with gold gradient -->
            <text x="7" y="61" font-family="Playfair Display, serif" font-size="62" font-weight="700" fill="url(#gGold)" filter="url(#gGlow)">G</text>
            <!-- Gold accent dot -->
            <circle cx="64" cy="38" r="3.5" fill="#F0C97A" opacity="0.9"/>
            <circle cx="64" cy="38" r="6" fill="#D4A853" opacity="0.2"/>
          </svg>
        </div>
      </div>
      <p class="label-num">02</p>
      <p class="label">Letter G</p>
      <p class="desc">Represents GradSmart and the student's full academic journey from start to finish.</p>
    </div>

    <!-- 3 · Cap & Tassel -->
    <div class="concept">
      <div class="circle">
        <div class="circle-ring"></div>
        <div class="circle-glow"></div>
        <div class="icon-wrap">
          <svg width="76" height="66" viewBox="0 0 76 66" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="capGrad" x1="0" y1="0" x2="76" y2="66" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#4A78C8"/>
                <stop offset="100%" stop-color="#1C2E4A"/>
              </linearGradient>
              <linearGradient id="topGrad" x1="0" y1="0" x2="60" y2="30" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#6A98E8"/>
                <stop offset="100%" stop-color="#2A4A8A"/>
              </linearGradient>
              <filter id="capShadow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#000" flood-opacity="0.5"/>
              </filter>
            </defs>
            <!-- Board base -->
            <polygon points="38,4 72,18 38,32 4,18" fill="url(#capGrad)" filter="url(#capShadow)"/>
            <!-- Top face -->
            <polygon points="38,4 72,18 38,32 4,18" fill="url(#topGrad)" opacity="0.8"/>
            <!-- Board edge shine -->
            <polygon points="38,4 66,15 38,26 10,15" fill="white" opacity="0.07"/>
            <!-- Cap body -->
            <path d="M20 26 L20 44 Q38 54 56 44 L56 26 Q38 36 20 26Z" fill="url(#capGrad)" opacity="0.85"/>
            <!-- Cap rim -->
            <ellipse cx="38" cy="44" rx="18" ry="5.5" fill="#1C2E4A" opacity="0.7"/>
            <!-- Tassel cord -->
            <path d="M66 18 Q70 22 68 30 Q67 36 66 44" stroke="#D4A853" stroke-width="2" stroke-linecap="round" fill="none"/>
            <!-- Tassel ball -->
            <circle cx="66" cy="46" r="4" fill="#D4A853"/>
            <circle cx="66" cy="46" r="2" fill="#F0C97A"/>
            <!-- Glow -->
            <circle cx="66" cy="46" r="7" fill="#D4A853" opacity="0.15"/>
          </svg>
        </div>
      </div>
      <p class="label-num">03</p>
      <p class="label">Cap &amp; Tassel</p>
      <p class="desc">Symbolizes achievement, success, and the ultimate goal of graduation day.</p>
    </div>

    <!-- 4 · Progress -->
    <div class="concept">
      <div class="circle">
        <div class="circle-ring"></div>
        <div class="circle-glow"></div>
        <div class="icon-wrap">
            <svg width="72" height="68" viewBox="0 0 72 68" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="bar1" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                <stop offset="0%" stop-color="#4A78C8" stop-opacity="0.5"/>
                <stop offset="100%" stop-color="#1C2E4A" stop-opacity="0.3"/>
              </linearGradient>
              <linearGradient id="bar4" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                <stop offset="0%" stop-color="#6A98E8"/>
                <stop offset="100%" stop-color="#2A4A8A"/>
              </linearGradient>
            </defs>
            <!-- Progress bars -->
            <rect x="4"  y="50" width="12" height="14" rx="3" fill="#1C2E4A" opacity="0.5"/>
            <rect x="20" y="40" width="12" height="24" rx="3" fill="#2A4A8A" opacity="0.65"/>
            <rect x="36" y="28" width="12" height="36" rx="3" fill="#4A78C8" opacity="0.8"/>
            <rect x="52" y="14" width="12" height="50" rx="3" fill="url(#bar4)"/>
            <!-- Bar tops glow -->
            <rect x="52" y="14" width="12" height="5" rx="3" fill="#6A98E8" opacity="0.6"/>
            <!-- Arrow up -->
            <line x1="58" y1="13" x2="58" y2="4" stroke="#D4A853" stroke-width="2.2" stroke-linecap="round"/>
            <polyline points="53,9 58,4 63,9" stroke="#D4A853" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <!-- Glow on arrow tip -->
            <circle cx="58" cy="4" r="4" fill="#D4A853" opacity="0.2"/>
            <!-- Checkmark badge -->
            <circle cx="18" cy="20" r="12" fill="#0E1825" opacity="0.9"/>
            <circle cx="18" cy="20" r="12" fill="none" stroke="#4A78C8" stroke-width="1.5"/>
            <polyline points="12,20 16,24 25,14" stroke="#D4A853" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          </svg>
        </div>
      </div>
      <p class="label-num">04</p>
      <p class="label">Tracking &amp; Progress</p>
      <p class="desc">Represents task completion, milestones reached, and supervisor visibility.</p>
    </div>

  </div>

  <!-- Footer -->
  <div class="footer">
    <div class="footer-brand">
      <div class="footer-logo-mark">G</div>
      <span class="footer-name">GradSmart</span>
    </div>
    <div class="footer-tags">
      <span class="footer-tag">Academic</span>
      <span class="footer-tag">Trustworthy</span>
      <span class="footer-tag">Innovative</span>
    </div>
    <span class="footer-year">2025</span>
  </div>

</div>

</body>
</html>