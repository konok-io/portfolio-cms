<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 9.5pt;
            line-height: 1.65;
            color: #2d3748;
            background: #cbd5e0;
        }
        .resume {
            max-width: 794px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .header {
            background: linear-gradient(180deg, #1a365d 0%, #2c5282 100%);
            color: white;
            padding: 0;
        }
        .header-top {
            background: {{ $settings->primary_color }};
            padding: 0.6rem 2.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header-main {
            padding: 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-family: 'Merriweather', serif;
            font-size: 28pt;
            font-weight: 700;
            margin-bottom: 0.25rem;
            letter-spacing: 1px;
        }
        .header-text h2 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 11pt;
            font-weight: 400;
            color: #bee3f8;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1.2rem;
        }
        .contact-row {
            display: flex;
            gap: 2rem;
            font-size: 8.5pt;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #e2e8f0;
        }
        .header-photo {
            text-align: center;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 4px;
            object-fit: cover;
            border: 3px solid {{ $settings->primary_color }};
        }
        @endif
        .body { padding: 2rem 2.5rem; }
        .two-column {
            display: grid;
            grid-template-columns: 1.6fr 1.4fr;
            gap: 2.5rem;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 1.6rem; }
        .section-header {
            background: linear-gradient(90deg, {{ $settings->primary_color }}, {{ $settings->primary_color }}20);
            padding: 0.6rem 1rem;
            margin-bottom: 1rem;
            border-radius: 0 4px 4px 0;
            margin-left: -1rem;
        }
        .section-title {
            font-family: 'Merriweather', serif;
            font-size: 12pt;
            font-weight: 700;
            color: #1a365d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary p { color: #4a5568; font-size: 9.5pt; text-align: justify; }
        .experience-item {
            margin-bottom: 1.2rem;
            padding-bottom: 1.2rem;
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
            margin-bottom: 0.2rem;
        }
        .experience-title { font-weight: 700; font-size: 10pt; color: #1a365d; }
        .experience-date { font-size: 8.5pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 9pt; color: #718096; margin-bottom: 0.3rem; font-weight: 600; }
        .experience-description { color: #4a5568; font-size: 9pt; }
        .skills-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem; }
        .skill-item {
            background: #f7fafc;
            padding: 0.5rem 0.8rem;
            border-left: 3px solid {{ $settings->primary_color }};
            font-size: 8.5pt;
            color: #2d3748;
        }
        .education-item {
            margin-bottom: 1rem;
            padding-left: 1rem;
            border-left: 2px solid {{ $settings->primary_color }};
        }
        .education-degree { font-weight: 700; font-size: 10pt; color: #1a365d; }
        .education-school { font-size: 9pt; color: #718096; margin-bottom: 0.15rem; }
        .education-date { font-size: 8.5pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: #f7fafc;
            padding: 0.7rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0 4px 4px 0;
            border-left: 4px solid {{ $settings->primary_color }};
        }
        .project-title { font-weight: 700; font-size: 9.5pt; color: #1a365d; }
        .project-description { color: #4a5568; font-size: 8.5pt; margin-top: 0.2rem; }
        .footer {
            background: #1a365d;
            color: #a0aec0;
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
        }
        .footer span { color: {{ $settings->primary_color }}; }
        @page {
            size: A4;
            margin: 0;
        }
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