import re
import os

VIEWS = '/Applications/XAMPP/xamppfiles/htdocs/GradSmartLaravel/resources/views'

files_to_convert = [
    ('admin', 'admin_management', 'layouts.admin', 'GradSmart — إدارة النظام'),
    ('admin', 'admin_pages', 'layouts.admin', 'GradSmart — الأقسام والكليات'),
    ('student', 'creat_team', 'layouts.student', 'GradSmart — إنشاء فريق'),
    ('student', 'file_upload', 'layouts.student', 'GradSmart — رفع الملفات'),
    ('student', 'sup_profile', 'layouts.student', 'GradSmart — ملف المشرف'),
    ('student', 'sup_projects', 'layouts.student', 'GradSmart — مشاريع المشرف'),
    ('student', 'task_detail', 'layouts.student', 'GradSmart — تفاصيل المهمة'),
]

def find_div_end(text, start):
    """Find the closing </div> for a div that starts at 'start'"""
    depth = 0
    i = start
    while i < len(text):
        if text[i:i+4] == '<div':
            depth += 1
        elif text[i:i+6] == '</div>':
            depth -= 1
            if depth == 0:
                return i + 6
        i += 1
    return len(text)

def convert_file(folder, name, layout, title):
    filepath = os.path.join(VIEWS, folder, f'{name}.blade.php')
    content = open(filepath, encoding='utf-8').read()

    # 1. Extract CSS file path
    css_match = re.search(r'href=["\']\.\.\/css\/([^"\']+)["\']', content)
    css_asset = css_match.group(1) if css_match else None

    # 2. Extract inline styles
    style_match = re.search(r'<style>(.*?)</style>', content, re.DOTALL)
    inline_style = style_match.group(1).strip() if style_match else ''

    # 3. Extract inline scripts (last one / main one)
    script_matches = re.findall(r'<script>(.*?)</script>', content, re.DOTALL)
    # exclude Google Fonts and tracking scripts
    inline_scripts = [s for s in script_matches if 'function' in s or 'document.' in s or 'localStorage' in s]
    inline_script = inline_scripts[-1].strip() if inline_scripts else ''

    # 4. Extract topbar actions
    topbar_actions_match = re.search(r'<div class="topbar-actions">(.*?)</div>\s*</div>', content, re.DOTALL)
    topbar_actions = topbar_actions_match.group(1).strip() if topbar_actions_match else ''

    # 5. Extract page title from topbar
    h1_match = re.search(r'<h1[^>]*>(.*?)</h1>', content)
    page_h1 = h1_match.group(1).strip() if h1_match else title

    p_match = re.search(r'<p>(.*?)</p>', content)
    page_subtitle = p_match.group(1).strip() if p_match else ''

    # 6. Extract main content - find <div class="main"> then skip topbar
    main_start = content.find('<div class="main">')
    if main_start == -1:
        print(f'  WARNING: No <div class="main"> found in {name}')
        return

    main_section = content[main_start:]

    topbar_pos = main_section.find('<div class="topbar">')
    if topbar_pos != -1:
        topbar_end = find_div_end(main_section, topbar_pos)
        content_body = main_section[topbar_end:].strip()
    else:
        # No topbar in main - take all content after opening main div
        content_body = main_section[18:].strip()  # skip <div class="main">

    # Remove closing </div> of main, and </style><script>...</script></body></html>
    content_body = re.sub(r'\s*</div>\s*\n?\s*<style>.*?</style>.*?</body>\s*</html>\s*$', '', content_body, flags=re.DOTALL)
    content_body = re.sub(r'\s*<style>.*?</style>.*?</body>\s*</html>\s*$', '', content_body, flags=re.DOTALL)
    content_body = re.sub(r'\s*<script>.*?</script>\s*</body>\s*</html>\s*$', '', content_body, flags=re.DOTALL)
    content_body = re.sub(r'\s*</body>\s*</html>\s*$', '', content_body, flags=re.DOTALL)
    # Remove the last closing </div> (the main wrapper)
    content_body = content_body.rstrip()
    if content_body.endswith('</div>'):
        content_body = content_body[:-6].rstrip()

    # 7. Build the new Blade file
    lines = []
    lines.append(f"@extends('{layout}')")
    lines.append('')
    lines.append(f"@section('title', '{title}')")
    lines.append('')

    # Styles section
    lines.append("@section('styles')")
    if css_asset:
        lines.append(f"<link rel=\"stylesheet\" href=\"{{{{ asset('css/{css_asset}') }}}}\">")
    if inline_style:
        lines.append(f"<style>\n{inline_style}\n</style>")
    lines.append("@endsection")
    lines.append('')

    # Topbar actions section
    if topbar_actions:
        lines.append("@section('topbar_actions')")
        lines.append(topbar_actions)
        lines.append("@endsection")
        lines.append('')

    # Content section
    lines.append("@section('content')")
    lines.append(content_body.strip())
    lines.append("@endsection")
    lines.append('')

    # Scripts section
    if inline_script:
        lines.append("@section('scripts')")
        lines.append("<script>")
        lines.append(inline_script)
        lines.append("</script>")
        lines.append("@endsection")

    new_content = '\n'.join(lines)
    open(filepath, 'w', encoding='utf-8').write(new_content)
    print(f'  ✅ Converted: {folder}/{name}.blade.php')

print('🚀 Starting conversion...')
for args in files_to_convert:
    try:
        convert_file(*args)
    except Exception as e:
        print(f'  ❌ Error in {args[1]}: {e}')
print('✅ Done!')
