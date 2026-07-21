<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 10pt;
            line-height: 1.7;
            color: #2d2d2d;
            background: #f5f5f5;
        }
        .resume {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }
        .header {
            background: #1a1a1a;
            color: white;
            padding: 3rem 2.5rem;
            text-align: center;
        }
        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32pt;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }
        .header h2 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 12pt;
            font-weight: 300;
            color: {{ $settings->primary_color }};
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            font-size: 9pt;
            color: #aaa;
        }
        .contact-item { display: flex; align-items: center; gap: 0.5rem; }
        .body { padding: 2.5rem; }
        .section { margin-bottom: 2rem; }
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.2rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 14pt;
            font-weight: 600;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .section-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, {{ $settings->primary_color }}, transparent);
            margin-left: 1rem;
        }
        .summary p { color: #555; text-align: justify; font-style: italic; }
        .experience-item {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
            border-left: 2px solid {{ $settings->primary_color }}30;
            position: relative;
        }
        .experience-item::before {
            content: '';
            position: absolute;
            left: -5px;
            top: 0;
            width: 8px;
            height: 8px;
            background: {{ $settings->primary_color }};
            border-radius: 50%;
        }
        .experience-title { font-weight: 700; font-size: 11pt; color: #1a1a1a; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; margin-bottom: 0.25rem; }
        .experience-company { font-size: 10pt; color: #666; margin-bottom: 0.3rem; }
        .experience-description { color: #555; font-size: 9pt; }
        .skills-grid { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .skill-tag {
            background: {{ $settings->primary_color }}15;
            color: {{ $settings->primary_color }};
            padding: 0.35rem 1rem;
            font-size: 9pt;
            font-weight: 600;
            border: 1px solid {{ $settings->primary_color }}30;
        }
        .education-item { margin-bottom: 1rem; }
        .education-degree { font-weight: 700; font-size: 11pt; color: #1a1a1a; }
        .education-school { font-size: 10pt; color: #666; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; }
        .project-item { margin-bottom: 0.8rem; }
        .project-title { font-weight: 700; font-size: 10pt; color: #1a1a1a; }
        .project-description { color: #555; font-size: 9pt; }
        .footer {
            background: #f8f8f8;
            border-top: 1px solid #eee;
            padding: 1rem 2.5rem;
            text-align: center;
            font-size: 8pt;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            @if($settings->include_photo && $about->photo_url)
                <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid {{ $settings->primary_color }}; margin-bottom: 1rem;">
            @endif
            <h1>{{ $about->name ?? 'Your Name' }}</h1>
            <h2>{{ $about->title ?? 'Professional Title' }}</h2>
            <div class="contact-info">
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
        <div class="body">
            @if($about->short_intro)
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">Profile</div>
                        <div class="section-line"></div>
                    </div>
                    <div class="summary"><p>{{ $about->short_intro }}</p></div>
                </div>
            @endif
            @if($settings->include_experience && $experiences->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">Experience</div>
                        <div class="section-line"></div>
                    </div>
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
            @if($settings->include_skills && $skills->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">Skills</div>
                        <div class="section-line"></div>
                    </div>
                    <div class="skills-grid">
                        @foreach($skills as $skill)
                            <span class="skill-tag">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($settings->include_education && $educations->count() > 0)
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">Education</div>
                        <div class="section-line"></div>
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
                        <div class="section-title">Projects</div>
                        <div class="section-line"></div>
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
        <div class="footer">{{ $about->email ?? '' }} | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
