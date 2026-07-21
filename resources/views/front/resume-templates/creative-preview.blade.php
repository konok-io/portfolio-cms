<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Crimson+Pro:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 10pt;
            line-height: 1.7;
            color: #2d3436;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            min-height: 100vh;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        }
        .header {
            background: linear-gradient(135deg, {{ $settings->primary_color }} 0%, #4a5568 100%);
            color: white;
            padding: 50px;
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
            gap: 30px;
            position: relative;
            z-index: 1;
        }
        .photo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        .header-text { flex: 1; }
        .header-text h1 {
            font-size: 32pt;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
        }
        .header-text h2 {
            font-size: 14pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        .contact-row {
            display: flex;
            gap: 25px;
            font-size: 10pt;
            opacity: 0.95;
        }
        .contact-item { display: flex; align-items: center; gap: 6px; }
        .body { padding: 40px; }
        .section { margin-bottom: 30px; }
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, {{ $settings->primary_color }}, {{ $settings->primary_color }}aa);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16pt;
            margin-right: 12px;
            box-shadow: 0 4px 15px {{ $settings->primary_color }}40;
        }
        .section-title {
            font-size: 14pt;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: 1px;
        }
        .summary p { color: #4a5568; font-size: 11pt; line-height: 1.8; }
        .experience-item {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 5px solid {{ $settings->primary_color }};
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .experience-title { font-weight: 700; font-size: 11pt; color: #1a202c; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .experience-company { font-size: 10pt; color: #718096; margin-bottom: 8px; }
        .experience-description { color: #4a5568; font-size: 9pt; }
        .skills-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .skill-item {
            background: linear-gradient(135deg, {{ $settings->primary_color }}15, {{ $settings->primary_color }}08);
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 10pt;
            font-weight: 500;
            color: #2d3748;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        .education-degree { font-weight: 600; font-size: 11pt; color: #1a202c; }
        .education-school { font-size: 10pt; color: #718096; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: linear-gradient(135deg, #f8fafc, #edf2f7);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .project-title { font-weight: 600; font-size: 11pt; color: #1a202c; }
        .project-description { color: #4a5568; font-size: 9pt; margin-top: 5px; }
        .footer {
            background: linear-gradient(135deg, #1a202c, #2d3748);
            color: #a0aec0;
            padding: 20px 40px;
            text-align: center;
            font-size: 9pt;
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