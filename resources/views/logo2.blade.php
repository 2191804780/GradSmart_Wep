<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشعار البيضاوي كحرف مكتوب وواضح</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap');

        :root {
            --bg-color: #f7f4eb;       /* نفس درجة لون الخلفية الدافئة في الصورة */
            --navy-blue: #0c2340;      /* الكحلي الداكن للخطوط الخارجية */
            --gold-yellow: #d1a13b;    /* الذهبي الدافئ للسهم */
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--bg-color);
            font-family: 'Cairo', sans-serif;
        }

        .logo-card {
            background-color: #ffffff;
            padding: 50px 70px;
            border-radius: 28px;
            box-shadow: 0 12px 35px rgba(12, 35, 64, 0.03);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .logo-card:hover {
            transform: translateY(-4px);
        }

        /* حاوية الـ SVG */
        .logo-svg {
            width: 380px;  
            height: 300px;
            overflow: visible;
        }

        /* حركات تفاعلية ناعمة واحترافية */
        .grad-cap {
            transform-origin: 210px 105px;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .logo-card:hover .grad-cap {
            transform: translate(110px, 10px) rotate(-19deg) scale(1.03);
        }

        .gold-arrow {
            transition: transform 0.35s ease;
        }

        .logo-card:hover .gold-arrow {
            transform: translateY(-6px);
        }
    </style>
</head>
<body>j

    <div class="logo-card">
        
        <svg class="logo-svg" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
            
            <!-- 1. حرف الـ G كأنه مكتوب بخط يدوي صريح، واضح، وذو سماكة موحدة ممتازة -->
            <path class="g-shape" 
                  d="M 360, 150 
                     C 290, 100 160, 110 160, 220 
                     C 160, 330 290, 340 370, 290 
                     L 370, 225 
                     L 300, 225" 
                  fill="none" 
                  stroke="#0c2340" 
                  stroke-width="26" 
                  stroke-linecap="round" 
                  stroke-linejoin="round" />

            <!-- 2. السهم الذهبي المستقر فوق خط الكتابة مباشرة بوضوح -->
            <polygon class="gold-arrow" 
                     points="326,212 344,212 344,190 358,190 335,155 312,190 326,190" 
                     fill="#d1a13b" />

            <!-- 3. قبعة التخرج المائلة المستقرة فوق الحرف بانسيابية -->
            <g class="grad-cap" transform="translate(110, 10) rotate(-16)">
                <!-- قاعدة القبعة -->
                <path d="M 65,92 L 65,108 C 65,125 135,125 135,108 L 135,92" 
                      fill="#ffffff" 
                      stroke="#0c2340" 
                      stroke-width="9" 
                      stroke-linejoin="round" />
                
                <!-- السطح العلوي المعين -->
                <polygon points="100,40 170,75 100,110 30,75" 
                         fill="#ffffff" 
                         stroke="#0c2340" 
                         stroke-width="9" 
                         stroke-linejoin="round" />

                <!-- خيط الشرابة المنسدل لليسار -->
                <path d="M 100,75 Q 70,80 48,105 L 48,145" 
                      fill="none" 
                      stroke="#0c2340" 
                      stroke-width="7" 
                      stroke-linecap="round" />
                
                <!-- الشرابة السفلى (شكل الجرس) -->
                <path d="M 42,145 L 54,145 L 56,165 C 56,170 40,170 40,165 Z" 
                      fill="#0c2340" />
            </g>

        </svg>

    </div>

</body>
</html>