<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
            line-height: 1.5;
            color: #1f2937;
            width: 210mm;
            min-height: 297mm;
        }
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: {{ $settings->background_color ?? '{{ $settings->background_color ?? '#ffffff'' }};
        }
        .header {
            background: {{ $settings->header_bg_color ?? '{{ $settings->header_bg_color ?? '#1e293b'' }};
            padding: 15mm;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 10mm;
        }
        .photo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 2px solid {{ $settings->primary_color }};
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-size: 20pt;
            font-weight: 700;
            color: {{ $settings->background_color ?? '#ffffff';
            margin-bottom: 2px;
        }
        .header-text h2 {
            font-size: 10pt;
            font-weight: 400;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .contact-grid {
            display: flex;
            gap: 8mm;
        }
        .contact-item {
            font-size: 8pt;
            color: #94a3b8;
        }
        .contact-item span {
            color: {{ $settings->primary_color }};
            font-weight: 500;
        }
        .body { padding: 12mm 15mm; }
        .two-column {
            display: flex;
            gap: 12mm;
        }
        .main-content { width: 60%; }
        .sidebar { width: 40%; }
        .section { margin-bottom: 10mm; }
        .section-header {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }
        .section-icon {
            width: 20px;
            height: 20px;
            background: {{ $settings->primary_color }};
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10pt;
        }
        .section-title {
            font-size: 10pt;
            font-weight: 600;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary p { color: #475569; font-size: 8pt; }
        .experience-item {
            background: #f8fafc;
            padding: 8px 10px;
            margin-bottom: 6px;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .experience-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .experience-title { font-weight: 700; font-size: 9pt; color: #0f172a; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 8pt; color: #64748b; margin-bottom: 2px; }
        .experience-description { color: #475569; font-size: 8pt; }
        .skill-card {
            background: #f8fafc;
            padding: 6px 8px;
            margin-bottom: 4px;
        }
        .skill-name { font-weight: 600; font-size: 8pt; color: #0f172a; margin-bottom: 2px; }
        .skill-bar {
            height: 3px;
            background: #e2e8f0;
        }
        .skill-progress {
            height: 100%;
            background: {{ $settings->primary_color }};
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 6px 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-info { flex: 1; }
        .education-degree { font-weight: 600; font-size: 8pt; color: #0f172a; }
        .education-school { font-size: 8pt; color: #64748b; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .project-item {
            background: #f8fafc;
            padding: 6px 8px;
            margin-bottom: 4px;
        }
        .project-title { font-weight: 600; font-size: 8pt; color: #0f172a; }
        .project-description { color: #475569; font-size: 8pt; margin-top: 2px; }
        .footer {
            background: {{ $settings->header_bg_color ?? '#1e293b';
            padding: 6px 15mm;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-text { font-size: 8pt; color: #94a3b8; }
        .footer-badge {
            background: {{ $settings->primary_color }};
            color: white;
            padding: 2px 8px;
            font-size: 8pt;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-content">
                @if($settings->include_photo && $about->photo_url)
                    <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
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
                                <div class="section-icon">+</div>
                                <div class="section-title">About Me</div>
                            </div>
                            <div class="summary"><p>{{ $about->short_intro }}</p></div>
                        </div>
                    @endif
                    @if($settings->include_experience && $experiences->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-icon">*</div>
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
                                <div class="section-icon">^</div>
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
                                <div class="section-icon">#</div>
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
                                <div class="section-icon">!</div>
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