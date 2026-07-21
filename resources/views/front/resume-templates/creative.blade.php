<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Crimson+Pro:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 9.5pt;
            line-height: 1.7;
            color: #2d3436;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, {{ $settings->primary_color }} 0%, #4a5568 100%);
            color: white;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: -60%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        @endif
        .header-text { flex: 1; }
        .header-text h1 {
            font-size: 28pt;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.25rem;
        }
        .header-text h2 {
            font-size: 11pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 1rem;
        }
        .contact-row {
            display: flex;
            gap: 1.5rem;
            font-size: 9pt;
            opacity: 0.95;
        }
        .contact-item { display: flex; align-items: center; gap: 0.4rem; }
        .body { padding: 2rem 2.5rem; }
        .section { margin-bottom: 1.8rem; }
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .section-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, {{ $settings->primary_color }}aa);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14pt;
            margin-right: 0.75rem;
        }
        .section-title {
            font-size: 13pt;
            font-weight: 700;
            color: #1a202c;
        }
        .summary p { color: #4a5568; font-size: 10pt; }
        .experience-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.8rem;
            border-left: 4px solid {{ $settings->primary_color }};
        }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 0.2rem; }
        .experience-title { font-weight: 700; font-size: 10pt; color: #1a202c; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 9pt; color: #718096; margin-bottom: 0.25rem; }
        .experience-description { color: #4a5568; font-size: 9pt; }
        .skills-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; }
        .skill-item {
            background: linear-gradient(135deg, {{ $settings->primary_color }}15, {{ $settings->primary_color }}08);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 9pt;
            font-weight: 500;
            color: #2d3748;
            text-align: center;
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-degree { font-weight: 600; font-size: 10pt; color: #1a202c; }
        .education-school { font-size: 9pt; color: #718096; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: linear-gradient(135deg, #f8fafc, #edf2f7);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }
        .project-title { font-weight: 600; font-size: 10pt; color: #1a202c; }
        .project-description { color: #4a5568; font-size: 9pt; margin-top: 0.2rem; }
        .footer {
            background: #1a202c;
            color: #a0aec0;
            padding: 1rem 2.5rem;
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
                        <div class="section-icon">◆</div>
                        <div class="section-title">About Me</div>
                    </div>
                    <div class="summary"><p>{{ $about->short_intro }}</p></div>
                </div>
            @endif
            @if($settings->include_experience && $experiences->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">◇</div>
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
                        <div class="section-icon">★</div>
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
                        <div class="section-icon">✦</div>
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
                        <div class="section-icon">●</div>
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
