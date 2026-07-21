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
            color: #2d3436;
            width: 210mm;
            min-height: 297mm;
        }
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
        }
        .header {
            background: {{ $settings->primary_color }};
            color: white;
            padding: 20mm 15mm;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 12mm;
        }
        .photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-size: 22pt;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .header-text h2 {
            font-size: 11pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        .contact-row {
            display: flex;
            gap: 10mm;
            font-size: 9pt;
        }
        .contact-item { margin-bottom: 2px; }
        .body { padding: 15mm; }
        .section { margin-bottom: 12mm; }
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }
        .section-icon {
            width: 24px;
            height: 24px;
            background: {{ $settings->primary_color }};
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12pt;
            margin-right: 6px;
        }
        .section-title {
            font-size: 11pt;
            font-weight: 700;
            color: #1a202c;
        }
        .summary p { color: #4a5568; font-size: 9pt; }
        .experience-item {
            background: #f8fafc;
            padding: 8px 10px;
            margin-bottom: 6px;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 2px; }
        .experience-title { font-weight: 700; font-size: 9pt; color: #1a202c; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 8pt; color: #718096; margin-bottom: 2px; }
        .experience-description { color: #4a5568; font-size: 8pt; }
        .skills-grid { display: flex; flex-wrap: wrap; gap: 4px; }
        .skill-item {
            background: #f0f0f0;
            padding: 4px 8px;
            font-size: 8pt;
            font-weight: 500;
            color: #2d3748;
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-degree { font-weight: 600; font-size: 9pt; color: #1a202c; }
        .education-school { font-size: 8pt; color: #718096; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: #f8fafc;
            padding: 6px 8px;
            margin-bottom: 4px;
        }
        .project-title { font-weight: 600; font-size: 9pt; color: #1a202c; }
        .project-description { color: #4a5568; font-size: 8pt; margin-top: 2px; }
        .footer {
            background: #1a202c;
            color: #a0aec0;
            padding: 8px 15mm;
            text-align: center;
            font-size: 8pt;
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
            </div>
        </div>
        <div class="body">
            @if($about->short_intro)
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">*</div>
                        <div class="section-title">About Me</div>
                    </div>
                    <div class="summary"><p>{{ $about->short_intro }}</p></div>
                </div>
            @endif
            @if($settings->include_experience && $experiences->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">+</div>
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
            @if($settings->include_skills && $skills->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">#</div>
                        <div class="section-title">Skills</div>
                    </div>
                    <div class="skills-grid">
                        @foreach($skills as $skill)
                            <div class="skill-item">{{ $skill->name }}</div>
                        @endforeach
                    </div>
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
                            <div>
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
                        <div class="section-icon">!</div>
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
        <div class="footer">{{ $about->email ?? '' }} | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
