<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #1a1a2e;
            background: #f8f9fa;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, {{ $settings->primary_color }} 0%, {{ $settings->primary_color }}cc 100%);
            color: white;
            padding: 0;
            display: flex;
        }
        .header-left {
            flex: 0 0 30%;
            background: rgba(0,0,0,0.15);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 1rem;
        }
        @endif
        .header-right {
            flex: 1;
            padding: 2.5rem;
        }
        .header-right h1 {
            font-size: 26pt;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.3rem;
        }
        .header-right h2 {
            font-size: 12pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            font-size: 9pt;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0.95;
        }
        .body {
            padding: 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 1.5rem; }
        .section-title {
            font-size: 11pt;
            font-weight: 700;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid {{ $settings->primary_color }}20;
        }
        .summary p { color: #4a4a68; text-align: justify; }
        .experience-item {
            margin-bottom: 1.2rem;
            padding-left: 1rem;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .experience-title { font-weight: 700; font-size: 11pt; color: #1a1a2e; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .experience-company { color: #6b7280; font-size: 10pt; margin-bottom: 0.3rem; }
        .experience-description { color: #4a4a68; font-size: 9pt; }
        .skill-item { margin-bottom: 0.8rem; }
        .skill-name { font-size: 9pt; font-weight: 600; color: #1a1a2e; margin-bottom: 0.25rem; }
        .skill-bar { height: 4px; background: #e5e7eb; border-radius: 2px; overflow: hidden; }
        .skill-progress { height: 100%; background: linear-gradient(90deg, {{ $settings->primary_color }}, {{ $settings->primary_color }}aa); border-radius: 2px; }
        .education-item { margin-bottom: 1rem; }
        .education-degree { font-weight: 700; font-size: 10pt; color: #1a1a2e; }
        .education-school { color: #6b7280; font-size: 9pt; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; }
        .project-item { margin-bottom: 0.8rem; }
        .project-title { font-weight: 700; font-size: 10pt; color: #1a1a2e; }
        .project-description { color: #4a4a68; font-size: 9pt; }
        .footer { background: #1a1a2e; color: #9ca3af; padding: 1rem 2rem; text-align: center; font-size: 8pt; }
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
