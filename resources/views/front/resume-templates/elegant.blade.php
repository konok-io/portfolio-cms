<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Montserrat', sans-serif;
            font-size: 9pt;
            line-height: 1.7;
            color: #2c2c2c;
            background: #d4d4d4;
        }
        .resume {
            max-width: 794px;
            margin: 0 auto;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        .resume::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, {{ $settings->primary_color }}, #c9a962, {{ $settings->primary_color }});
        }
        .header {
            padding: 2.5rem 2.5rem 1.5rem;
            background: linear-gradient(180deg, #fafafa 0%, #fff 100%);
            border-bottom: 1px solid #eee;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .header-left {
            flex: 1;
        }
        .header-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 50px,
                #f5f5f5 50px,
                #f5f5f5 51px
            );
            opacity: 0.3;
        }
        .name-line {
            position: relative;
        }
        .name-line::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: {{ $settings->primary_color }};
        }
        .header h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32pt;
            font-weight: 600;
            color: #1a1a1a;
            letter-spacing: 2px;
            margin-bottom: 0.3rem;
        }
        .header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 10pt;
            font-weight: 400;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 1.2rem;
        }
        .contact-row {
            display: flex;
            gap: 1.5rem;
            font-size: 8.5pt;
            color: #666;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .header-right {
            text-align: center;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid {{ $settings->primary_color }};
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        @endif
        .body {
            padding: 2rem 2.5rem;
            display: grid;
            grid-template-columns: 2.5fr 1.5fr;
            gap: 2.5rem;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 1.8rem; }
        .section-header {
            margin-bottom: 1rem;
            position: relative;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14pt;
            font-weight: 600;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 3px;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        .summary p {
            color: #555;
            font-size: 9pt;
            font-style: italic;
            line-height: 1.8;
        }
        .experience-item {
            margin-bottom: 1.2rem;
            padding-left: 1rem;
            border-left: 2px solid {{ $settings->primary_color }}40;
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
        .experience-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.15rem;
        }
        .experience-title { font-weight: 600; font-size: 10pt; color: #1a1a1a; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 500; }
        .experience-company { font-size: 9pt; color: #777; margin-bottom: 0.25rem; }
        .experience-description { color: #555; font-size: 8.5pt; }
        .skills-list { display: flex; flex-direction: column; gap: 0.6rem; }
        .skill-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .skill-dot {
            width: 6px;
            height: 6px;
            background: {{ $settings->primary_color }};
            border-radius: 50%;
        }
        .skill-name { font-size: 9pt; color: #444; }
        .education-item {
            margin-bottom: 1rem;
            padding-left: 1rem;
            border-left: 2px solid {{ $settings->primary_color }}40;
            position: relative;
        }
        .education-item::before {
            content: '';
            position: absolute;
            left: -5px;
            top: 0;
            width: 8px;
            height: 8px;
            background: {{ $settings->primary_color }};
            border-radius: 50%;
        }
        .education-degree { font-weight: 600; font-size: 10pt; color: #1a1a1a; }
        .education-school { font-size: 9pt; color: #777; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; }
        .project-item {
            margin-bottom: 0.8rem;
            padding: 0.6rem 0.8rem;
            background: #fafafa;
            border-left: 3px solid {{ $settings->primary_color }};
        }
        .project-title { font-weight: 600; font-size: 9pt; color: #1a1a1a; }
        .project-description { color: #555; font-size: 8.5pt; margin-top: 0.2rem; }
        .footer {
            background: #1a1a1a;
            color: #888;
            padding: 0.8rem 2.5rem;
            text-align: center;
            font-size: 7.5pt;
            letter-spacing: 1px;
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
            <div class="header-content">
                <div class="header-left">
                    <div class="name-line">
                        <h1>{{ $about->name ?? 'Your Name' }}</h1>
                    </div>
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
                <div class="header-right">
                    @if($settings->include_photo && $about->photo_url)
                        <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                    @endif
                </div>
            </div>
        </div>
        <div class="body">
            <div class="main-content">
                @if($about->short_intro)
                    <div class="section">
                        <div class="section-header">
                            <div class="section-title">Profile</div>
                        </div>
                        <div class="summary"><p>{{ $about->short_intro }}</p></div>
                    </div>
                @endif
                @if($settings->include_experience && $experiences->count() > 0)
                    <div class="section">
                        <div class="section-header">
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
                            <div class="section-title">Skills</div>
                        </div>
                        <div class="skills-list">
                            @foreach($skills as $skill)
                                <div class="skill-item">
                                    <div class="skill-dot"></div>
                                    <div class="skill-name">{{ $skill->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="footer">Contact: <span>{{ $about->email ?? '' }}</span> | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>