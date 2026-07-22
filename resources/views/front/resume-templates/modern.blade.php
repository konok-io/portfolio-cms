<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #1a1a2e;
            background: #f8f9fa;
            width: 210mm;
            min-height: 297mm;
        }
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: {{ $settings->background_color ?? '#ffffff' }};
        }
        .header {
            background: {{ $settings->header_bg_color ?? '#1a1a2e' }};
            color: white;
            padding: 25mm 15mm;
            display: flex;
        }
        .header-left {
            width: 30%;
            background: rgba(0,0,0,0.15);
            padding: 15mm 10mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin-bottom: 8px;
        }
        .header-right {
            width: 70%;
            padding: 10mm 15mm;
        }
        .header-right h1 {
            font-size: 22pt;
            font-weight: 700;
            margin-bottom: 3px;
            color: {{ $settings->heading_color ?? '#ffffff' }};
        }
        .header-right h2 {
            font-size: 11pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 12px;
            color: {{ $settings->primary_color }};
        }
        .contact-grid {
            font-size: 9pt;
        }
        .contact-item {
            margin-bottom: 4px;
        }
        .body {
            padding: 15mm;
            display: flex;
            gap: 12mm;
        }
        .main-content { width: 65%; }
        .sidebar { width: 35%; }
        .section { margin-bottom: 12mm; }
        .section-title {
            font-size: 11pt;
            font-weight: 700;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid {{ $settings->primary_color }};
        }
        .summary p { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 9pt; text-align: justify; }
        .experience-item {
            margin-bottom: 10px;
            padding-left: 8px;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .experience-title { font-weight: 700; font-size: 10pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .experience-company { color: {{ $settings->text_color ?? '#6b7280' }}; font-size: 9pt; margin-bottom: 3px; }
        .experience-description { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 8pt; }
        .skill-item { margin-bottom: 6px; }
        .skill-name { font-size: 9pt; font-weight: 600; color: {{ $settings->heading_color ?? '#1a1a2e' }}; margin-bottom: 2px; }
        .skill-bar { height: 4px; background: #e5e7eb; }
        .skill-progress { height: 100%; background: {{ $settings->primary_color }}; }
        .education-item { margin-bottom: 8px; }
        .education-degree { font-weight: 700; font-size: 9pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .education-school { color: {{ $settings->text_color ?? '#6b7280' }}; font-size: 8pt; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; }
        .project-item { margin-bottom: 6px; }
        .project-title { font-weight: 700; font-size: 9pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .project-description { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 8pt; }
        .certification-item { margin-bottom: 8px; padding: 6px 0; border-bottom: 1px dashed #e2e8f0; }
        .certification-item:last-child { border-bottom: none; }
        .certification-name { font-weight: 700; font-size: 9pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .certification-issuer { font-size: 8pt; color: {{ $settings->primary_color }}; }
        .footer { background: {{ $settings->footer_bg_color ?? '#1a1a2e' }}; color: #9ca3af; padding: 8px 15mm; text-align: center; font-size: 8pt; }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-left">
                @if($settings->include_photo && $about->photo_url)
                    <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                @endif
            </div>
            <div class="header-right">
                <h1>{{ $about->name ?? 'Your Name' }}</h1>
                <h2>{{ $about->title ?? 'Professional Title' }}</h2>
                <div class="contact-grid">
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
        </div>
        <div class="body">
            <div class="main-content">
                @if($about->short_intro)
                    <div class="section">
                        <div class="section-title">About</div>
                        <div class="summary"><p>{{ $about->short_intro }}</p></div>
                    </div>
                @endif
                @if($settings->include_experience && $experiences->count() > 0)
                    <div class="section">
                        <div class="section-title">Experience</div>
                        @foreach($experiences as $exp)
                            <div class="experience-item">
                                <div class="experience-title">{{ $exp->designation }}</div>
                                <div class="experience-date">{{ $exp->start_date }} - {{ $exp->end_year ?? 'Present' }}</div>
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
                        <div class="section-title">Education</div>
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
                        <div class="section-title">Projects</div>
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
                @if($settings->include_certifications && $certifications && $certifications->count() > 0)
                    <div class="section">
                        <div class="section-title">Certifications</div>
                        @foreach($certifications as $cert)
                            <div class="certification-item">
                                <div class="certification-name">{{ $cert->name }}</div>
                                <div class="certification-issuer">{{ $cert->issuer ?? '' }} - {{ $cert->issue_date ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="sidebar">
                @if($settings->include_skills && $skills->count() > 0)
                    <div class="section">
                        <div class="section-title">Skills</div>
                        @foreach($skills as $index => $skill)
                            <div class="skill-item">
                                <div class="skill-name">{{ $skill->name }}</div>
                                <div class="skill-bar">
                                    <div class="skill-progress" style="width: {{ 100 - ($index * 8) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="footer">{{ $about->email ?? '' }} | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
