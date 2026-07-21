<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #1f2937;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 40px;
            min-height: 100vh;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            padding: 40px;
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
            background: linear-gradient(135deg, {{ $settings->primary_color }}30, transparent);
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, transparent, {{ $settings->primary_color }}80, transparent);
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
            z-index: 1;
        }
        .photo-container {
            position: relative;
        }
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid {{ $settings->primary_color }};
            box-shadow: 0 0 30px {{ $settings->primary_color }}50;
        }
        .photo-glow {
            position: absolute;
            inset: -6px;
            border-radius: 20px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, #06b6d4);
            z-index: -1;
            opacity: 0.5;
            filter: blur(15px);
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 30pt;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
        }
        .header-text h2 {
            font-family: 'Inter', sans-serif;
            font-size: 12pt;
            font-weight: 400;
            color: {{ $settings->primary_color }};
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 9pt;
            color: #94a3b8;
        }
        .contact-item span {
            color: {{ $settings->primary_color }};
            font-weight: 600;
        }
        .body { padding: 30px 40px; }
        .two-column {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 40px;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 25px; }
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        .section-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, #06b6d4);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16pt;
            box-shadow: 0 4px 15px {{ $settings->primary_color }}40;
        }
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13pt;
            font-weight: 600;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary p { color: #475569; font-size: 10pt; line-height: 1.8; }
        .experience-item {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
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
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .experience-title { font-weight: 700; font-size: 11pt; color: #0f172a; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 10pt; color: #64748b; margin-bottom: 5px; }
        .experience-description { color: #475569; font-size: 9pt; }
        .skill-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .skill-name { font-weight: 600; font-size: 10pt; color: #0f172a; margin-bottom: 8px; }
        .skill-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }
        .skill-progress {
            height: 100%;
            background: linear-gradient(90deg, {{ $settings->primary_color }}, #06b6d4);
            border-radius: 3px;
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-info { flex: 1; }
        .education-degree { font-weight: 600; font-size: 10pt; color: #0f172a; }
        .education-school { font-size: 9pt; color: #64748b; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .project-item {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .project-title { font-weight: 600; font-size: 10pt; color: #0f172a; }
        .project-description { color: #475569; font-size: 9pt; margin-top: 5px; }
        .footer {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-text { font-size: 9pt; color: #64748b; }
        .footer-badge {
            background: {{ $settings->primary_color }}25;
            color: {{ $settings->primary_color }};
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 9pt;
            font-weight: 600;
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