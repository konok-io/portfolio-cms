<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            font-size: 9pt;
            line-height: 1.6;
            color: #1f2937;
            background: #0f172a;
        }
        .resume {
            max-width: 794px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4);
        }
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background: linear-gradient(135deg, {{ $settings->primary_color }}20, transparent);
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 1px;
            background: linear-gradient(90deg, transparent, {{ $settings->primary_color }}60, transparent);
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo-container {
            position: relative;
        }
        .photo {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid {{ $settings->primary_color }};
            box-shadow: 0 0 30px {{ $settings->primary_color }}40;
        }
        .photo-glow {
            position: absolute;
            inset: -4px;
            border-radius: 16px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, #06b6d4);
            z-index: -1;
            opacity: 0.5;
            filter: blur(10px);
        }
        @endif
        .header-text { flex: 1; }
        .header-text h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26pt;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 0.25rem;
        }
        .header-text h2 {
            font-family: 'Inter', sans-serif;
            font-size: 11pt;
            font-weight: 400;
            color: {{ $settings->primary_color }};
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.8rem;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 8pt;
            color: #94a3b8;
        }
        .contact-item span {
            color: {{ $settings->primary_color }};
            font-weight: 500;
        }
        .body { padding: 2rem 2.5rem; }
        .two-column {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 2.5rem;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 1.6rem; }
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }
        .section-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, #06b6d4);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14pt;
        }
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 12pt;
            font-weight: 600;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary p { color: #475569; font-size: 9pt; line-height: 1.7; }
        .experience-item {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: 0.8rem;
            position: relative;
            overflow: hidden;
        }
        .experience-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, {{ $settings->primary_color }}, #06b6d4);
        }
        .experience-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.15rem;
        }
        .experience-title { font-weight: 700; font-size: 10pt; color: #0f172a; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 9pt; color: #64748b; margin-bottom: 0.25rem; }
        .experience-description { color: #475569; font-size: 8.5pt; }
        .skill-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.6rem;
        }
        .skill-name { font-weight: 600; font-size: 9pt; color: #0f172a; margin-bottom: 0.3rem; }
        .skill-bar {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
        }
        .skill-progress {
            height: 100%;
            background: linear-gradient(90deg, {{ $settings->primary_color }}, #06b6d4);
            border-radius: 2px;
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.8rem 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-info { flex: 1; }
        .education-degree { font-weight: 600; font-size: 9pt; color: #0f172a; }
        .education-school { font-size: 8.5pt; color: #64748b; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .project-item {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
        }
        .project-title { font-weight: 600; font-size: 9pt; color: #0f172a; }
        .project-description { color: #475569; font-size: 8.5pt; margin-top: 0.2rem; }
        .footer {
            background: #0f172a;
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-text { font-size: 8pt; color: #64748b; }
        .footer-badge {
            background: {{ $settings->primary_color }}20;
            color: {{ $settings->primary_color }};
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 8pt;
            font-weight: 600;
        }
        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-content">
                @if($settings->include_photo && $about->photo_url)
                    <div class="photo-container">
                        <div class="photo-glow"></div>
                        <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                    </div>
                @endif
                <div class="header-text">
                    <h1>{{ $about->name ?? 'Your Name' }}</h1>
                    <h2>{{ $about->title ?? 'Professional Title' }}</h2>
                    <div class="contact-grid">
                        @if($about->email)
                            <div class="contact-item"><span>Email:</span> {{ $about->email }}</div>
                        @endif
                        @if($about->phone)
                            <div class="contact-item"><span>Phone:</span> {{ $about->phone }}</div>
                        @endif
                        @if($about->address)
                            <div class="contact-item"><span>Location:</span> {{ $about->address }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="two-column">
                <div class="main-content">
                    @if($about->short_intro)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">⚡</div>
                                <div class="section-title">About Me</div>
                            </div>
                            <div class="summary"><p>{{ $about->short_intro }}</p></div>
                        </div>
                    @endif
                    @if($settings->include_experience && $experiences->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">💼</div>
                                <div class="section-title">Experience</div>
                            </div>
                            @foreach($experiences as $exp)
                                <div class="experience-item">
                                    <div class="experience-header">
                                        <span class="experience-title">{{ $exp->designation }}</span>
                                        <span class="experience-date">{{ $exp->start_date }} - {{ $exp->end_year ?? 'Present' }}</span>
                                    </div>
                                    <div class="experience-company">{{ $exp->company_name }}</div>
                                    @if($exp->description)
                                        <div class="experience-description">{{ $exp->description }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($settings->include_education && $educations->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">🎓</div>
                                <div class="section-title">Education</div>
                            </div>
                            @foreach($educations as $edu)
                                <div class="education-item">
                                    <div class="education-info">
                                        <div class="education-degree">{{ $edu->degree }}</div>
                                        <div class="education-school">{{ $edu->institute_name }}</div>
                                    </div>
                                    <div class="education-date">{{ $edu->start_date }} - {{ $edu->end_year ?? 'Present' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($settings->include_projects && $projects->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">🚀</div>
                                <div class="section-title">Projects</div>
                            </div>
                            @foreach($projects as $project)
                                <div class="project-item">
                                    <div class="project-title">{{ $project->title }}</div>
                                    @if($project->description)
                                        <div class="project-description">{{ Str::limit(strip_tags($project->description), 100) }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="sidebar">
                    @if($settings->include_skills && $skills->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">⚙️</div>
                                <div class="section-title">Skills</div>
                            </div>
                            @foreach($skills as $index => $skill)
                                <div class="skill-card">
                                    <div class="skill-name">{{ $skill->name }}</div>
                                    <div class="skill-bar">
                                        <div class="skill-progress" style="width: {{ 100 - ($index * 6) }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-text">{{ $about->email ?? '' }} | Generated on {{ now()->format('F d, Y') }}</div>
            <div class="footer-badge">Open for opportunities</div>
        </div>
    </div>
</body>
</html>