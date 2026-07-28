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
            font-size: 9.5pt;
            line-height: 1.5;
            color: #2d3748;
            width: 210mm;
            min-height: 297mm;
        }
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: {{ $settings->background_color ?? '#ffffff';
        }
        .header {
            background: {{ $settings->header_bg_color ?? '#1a365d';
            color: white;
        }
        .header-top {
            background: {{ $settings->primary_color }};
            padding: 4px 15mm;
            display: flex;
            justify-content: space-between;
            font-size: 7pt;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header-main {
            padding: 15mm;
            display: flex;
            align-items: center;
            gap: 12mm;
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-size: 22pt;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .header-text h2 {
            font-size: 10pt;
            font-weight: 400;
            color: #bee3f8;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }
        .contact-row {
            display: flex;
            gap: 10mm;
            font-size: 8pt;
        }
        .contact-item {
            color: #e2e8f0;
        }
        .header-photo {
            text-align: center;
        }
        .photo {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 2px solid {{ $settings->primary_color }};
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
            background: {{ $settings->primary_color }};
            padding: 4px 8px;
            margin-bottom: 6px;
        }
        .section-title {
            font-size: 10pt;
            font-weight: 700;
            color: {{ $settings->background_color ?? '#ffffff';
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary p { color: #4a5568; font-size: 9pt; text-align: justify; }
        .experience-item {
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        .experience-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .experience-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .experience-title { font-weight: 700; font-size: 9pt; color: {{ $settings->header_bg_color ?? '#1a365d'; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 8pt; color: #718096; margin-bottom: 2px; font-weight: 600; }
        .experience-description { color: #4a5568; font-size: 8pt; }
        .skills-grid { display: flex; flex-direction: column; gap: 3px; }
        .skill-item {
            background: #f7fafc;
            padding: 4px 6px;
            border-left: 2px solid {{ $settings->primary_color }};
            font-size: 8pt;
            color: #2d3748;
        }
        .education-item {
            margin-bottom: 6px;
            padding-left: 8px;
            border-left: 2px solid {{ $settings->primary_color }};
        }
        .education-degree { font-weight: 700; font-size: 9pt; color: {{ $settings->header_bg_color ?? '#1a365d'; }
        .education-school { font-size: 8pt; color: #718096; margin-bottom: 1px; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: #f7fafc;
            padding: 6px 8px;
            margin-bottom: 4px;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .project-title { font-weight: 700; font-size: 9pt; color: {{ $settings->header_bg_color ?? '#1a365d'; }
        .project-description { color: #4a5568; font-size: 8pt; margin-top: 2px; }
        .footer {
            background: {{ $settings->header_bg_color ?? '#1a365d';
            color: #a0aec0;
            padding: 6px 15mm;
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
        }
        .footer span { color: {{ $settings->primary_color }}; }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-top">
                <span>Curriculum Vitae</span>
                <span>Professional Document</span>
            </div>
            <div class="header-main">
                <div class="header-text">
                    <h1>{{ $about->name ?? 'Your Name' }}</h1>
                    <h2>{{ $about->title ?? 'Professional Title' }}</h2>
                    <div class="contact-row">
                        @if($about->email)
                            <div class="contact-item">{{ $about->email }}</div>
                        @endif
                        @if($about->phone)
                            <div class="contact-item">{{ $about->phone }}</div>
                        @endif
                        @if($about->address)
                            <div class="contact-item">{{ $about->address }}</div>
                        @endif
                    </div>
                </div>
                <div class="header-photo">
                    @if($settings->include_photo && $about->photo_url)
                        <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                    @endif
                </div>
            </div>
        </div>
        <div class="body">
            <div class="two-column">
                <div class="main-content">
                    @if($about->short_intro)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-title">Professional Summary</div>
                            </div>
                            <div class="summary"><p>{{ $about->short_intro }}</p></div>
                        </div>
                    @endif
                    @if($settings->include_experience && $experiences->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-title">Work Experience</div>
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
                                <div class="section-title">Academic Background</div>
                            </div>
                            @foreach($educations as $edu)
                                <div class="education-item">
                                    <div class="education-degree">{{ $edu->degree }}</div>
                                    <div class="education-school">{{ $edu->institute_name }}</div>
                                    <div class="education-date">{{ $edu->start_date }} - {{ $edu->end_year ?? 'Present' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($settings->include_projects && $projects->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-title">Key Projects</div>
                            </div>
                            @foreach($projects as $project)
                                <div class="project-item">
                                    <div class="project-title">{{ $project->title }}</div>
                                    @if($project->description)
                                        <div class="project-description">{{ Str::limit(strip_tags($project->description), 120) }}</div>
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
                                <div class="section-title">Core Competencies</div>
                            </div>
                            <div class="skills-grid">
                                @foreach($skills as $skill)
                                    <div class="skill-item">{{ $skill->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer">
            <span>{{ $about->email ?? '' }}</span>
            <span>Generated on {{ now()->format('F d, Y') }}</span>
        </div>
    </div>
</body>
</html>