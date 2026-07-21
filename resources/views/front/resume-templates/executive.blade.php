<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.7;
            color: #333;
            background: #f0f0f0;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: white;
        }
        .header {
            background: #0d1b2a;
            color: white;
            padding: 0;
        }
        .header-top {
            background: {{ $settings->primary_color }};
            padding: 0.5rem 2.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 9pt;
        }
        .header-main {
            padding: 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 130px;
            height: 130px;
            border-radius: 0;
            object-fit: cover;
            border: 3px solid {{ $settings->primary_color }};
        }
        @endif
        .header-text h1 {
            font-family: 'Libre Baskerville', serif;
            font-size: 30pt;
            font-weight: 700;
            margin-bottom: 0.3rem;
            letter-spacing: 1px;
        }
        .header-text h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 12pt;
            font-weight: 300;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }
        .contact-row {
            display: flex;
            gap: 2rem;
            font-size: 9pt;
            color: #ccc;
        }
        .contact-item { display: flex; align-items: center; gap: 0.4rem; }
        .body { padding: 2rem 2.5rem; display: grid; grid-template-columns: 2fr 1fr; gap: 2.5rem; }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 1.8rem; }
        .section-header {
            border-bottom: 2px solid {{ $settings->primary_color }};
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        .section-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 14pt;
            font-weight: 700;
            color: #0d1b2a;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .summary p { color: #555; text-align: justify; font-size: 10pt; }
        .experience-item {
            margin-bottom: 1.3rem;
            padding-bottom: 1.3rem;
            border-bottom: 1px solid #eee;
        }
        .experience-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 0.25rem; }
        .experience-title { font-weight: 700; font-size: 11pt; color: #0d1b2a; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 10pt; color: #666; margin-bottom: 0.3rem; font-weight: 600; }
        .experience-description { color: #555; font-size: 9pt; }
        .skill-category { margin-bottom: 1.2rem; }
        .skill-category-title {
            font-size: 10pt;
            font-weight: 700;
            color: #0d1b2a;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .skill-list { display: flex; flex-wrap: wrap; gap: 0.4rem; }
        .skill-tag {
            background: {{ $settings->primary_color }}15;
            color: {{ $settings->primary_color }};
            padding: 0.3rem 0.8rem;
            font-size: 9pt;
            font-weight: 600;
            border-radius: 4px;
        }
        .education-item { margin-bottom: 1rem; }
        .education-degree { font-weight: 700; font-size: 10pt; color: #0d1b2a; }
        .education-school { font-size: 9pt; color: #666; margin-bottom: 0.2rem; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item { margin-bottom: 0.8rem; }
        .project-title { font-weight: 700; font-size: 10pt; color: #0d1b2a; }
        .project-description { color: #555; font-size: 9pt; }
        .footer {
            background: #0d1b2a;
            color: #888;
            padding: 1rem 2.5rem;
            text-align: center;
            font-size: 8pt;
        }
        .footer span { color: {{ $settings->primary_color }}; }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-top">
                <span>EXECUTIVE PROFILE</span>
                <span>CONFIDENTIAL</span>
            </div>
            <div class="header-main">
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
            <div class="main-content">
                @if($about->short_intro)
                    <div class="section">
                        <div class="section-header">
                            <div class="section-title">Executive Summary</div>
                        </div>
                        <div class="summary"><p>{{ $about->short_intro }}</p></div>
                    </div>
                @endif
                @if($settings->include_experience && $experiences->count() > 0)
                    <div class="section">
                        <div class="section-header">
                            <div class="section-title">Professional Experience</div>
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
                            <div class="section-title">Education</div>
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
                            <div class="section-title">Notable Projects</div>
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
                        <div class="skill-category">
                            <div class="skill-list">
                                @foreach($skills as $skill)
                                    <span class="skill-tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="footer">Contact: <span>{{ $about->email ?? '' }}</span> | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
