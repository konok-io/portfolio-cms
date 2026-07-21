<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 9pt;
            line-height: 1.6;
            color: #1a1a1a;
            background: #e5e5e5;
        }
        .resume {
            max-width: 794px;
            margin: 0 auto;
            background: #ffffff;
        }
        .top-bar {
            background: {{ $settings->primary_color }};
            padding: 0.4rem 2.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header {
            background: #1a1a1a;
            padding: 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(135deg, transparent, {{ $settings->primary_color }}30);
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        @if($settings->include_photo && $about->photo_url)
        .photo-container {
            position: relative;
        }
        .photo {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border: 4px solid {{ $settings->primary_color }};
            display: block;
        }
        .photo-frame {
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border: 2px solid {{ $settings->primary_color }}60;
        }
        @endif
        .header-text { flex: 1; }
        .header-text h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48pt;
            font-weight: 400;
            color: #ffffff;
            letter-spacing: 4px;
            line-height: 1;
            margin-bottom: 0.25rem;
        }
        .header-text h2 {
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 14pt;
            font-weight: 300;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 6px;
            margin-bottom: 1rem;
        }
        .contact-strip {
            display: flex;
            gap: 1.5rem;
            font-size: 8.5pt;
            color: #888;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .contact-separator {
            width: 1px;
            height: 14px;
            background: #444;
        }
        .body { padding: 2rem 2.5rem; }
        .three-column {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 2rem;
        }
        .main-content, .sidebar-left, .sidebar-right { min-width: 0; }
        .section { margin-bottom: 1.5rem; }
        .section-header {
            margin-bottom: 1rem;
            position: relative;
        }
        .section-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36pt;
            color: {{ $settings->primary_color }}20;
            position: absolute;
            top: -10px;
            left: -5px;
            line-height: 1;
        }
        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18pt;
            color: #1a1a1a;
            letter-spacing: 3px;
            padding-bottom: 0.3rem;
            border-bottom: 2px solid {{ $settings->primary_color }};
        }
        .summary p { color: #555; font-size: 9pt; line-height: 1.8; }
        .experience-item {
            margin-bottom: 1.2rem;
            position: relative;
            padding-left: 1.5rem;
        }
        .experience-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.3rem;
            width: 8px;
            height: 8px;
            background: {{ $settings->primary_color }};
            transform: rotate(45deg);
        }
        .experience-item::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 0.8rem;
            width: 1px;
            height: calc(100% + 0.8rem);
            background: #e0e0e0;
        }
        .experience-item:last-child::after { display: none; }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 0.1rem; }
        .experience-title { font-weight: 700; font-size: 10pt; color: #1a1a1a; }
        .experience-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 700; }
        .experience-company { font-size: 9pt; color: #777; margin-bottom: 0.2rem; font-weight: 500; }
        .experience-description { color: #555; font-size: 8.5pt; }
        .skill-item {
            margin-bottom: 0.6rem;
            padding: 0.5rem 0;
            border-bottom: 1px dashed #eee;
        }
        .skill-name { font-weight: 600; font-size: 9pt; color: #1a1a1a; }
        .skill-level { font-size: 7.5pt; color: {{ $settings->primary_color }}; text-transform: uppercase; letter-spacing: 1px; }
        .education-item { margin-bottom: 0.8rem; }
        .education-degree { font-weight: 700; font-size: 9.5pt; color: #1a1a1a; }
        .education-school { font-size: 8.5pt; color: #777; }
        .education-date { font-size: 8pt; color: {{ $settings->primary_color }}; font-weight: 600; }
        .project-item {
            background: #f8f8f8;
            padding: 0.6rem 0.8rem;
            margin-bottom: 0.4rem;
        }
        .project-title { font-weight: 700; font-size: 9pt; color: #1a1a1a; }
        .project-description { color: #555; font-size: 8pt; margin-top: 0.15rem; }
        .footer {
            background: #1a1a1a;
            color: #666;
            padding: 0.8rem 2.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 7.5pt;
            text-transform: uppercase;
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
        <div class="top-bar">
            <span>Portfolio CV</span>
            <span>{{ now()->format('F d, Y') }}</span>
        </div>
        <div class="header">
            <div class="header-content">
                <div class="header-text">
                    <h1>{{ $about->name ?? 'YOUR NAME' }}</h1>
                    <h2>{{ $about->title ?? 'Professional Title' }}</h2>
                    <div class="contact-strip">
                        @if($about->email)
                            <div class="contact-item">{{ $about->email }}</div>
                            <div class="contact-separator"></div>
                        @endif
                        @if($about->phone)
                            <div class="contact-item">{{ $about->phone }}</div>
                            <div class="contact-separator"></div>
                        @endif
                        @if($about->address)
                            <div class="contact-item">{{ $about->address }}</div>
                        @endif
                    </div>
                </div>
                @if($settings->include_photo && $about->photo_url)
                    <div class="photo-container">
                        <div class="photo-frame"></div>
                        <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                    </div>
                @endif
            </div>
        </div>
        <div class="body">
            <div class="three-column">
                <div class="main-content">
                    @if($about->short_intro)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-number">01</div>
                                <div class="section-title">About Me</div>
                            </div>
                            <div class="summary"><p>{{ $about->short_intro }}</p></div>
                        </div>
                    @endif
                    @if($settings->include_experience && $experiences->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-number">02</div>
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
                    @if($settings->include_projects && $projects->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-number">03</div>
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
                <div class="sidebar-left">
                    @if($settings->include_skills && $skills->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-number">04</div>
                                <div class="section-title">Skills</div>
                            </div>
                            @foreach($skills as $index => $skill)
                                <div class="skill-item">
                                    <div class="skill-name">{{ $skill->name }}</div>
                                    <div class="skill-level">
                                        @php
                                            $levels = ['Novice', 'Developing', 'Proficient', 'Advanced', 'Expert'];
                                            $levelIndex = min(floor($index / 2), 4);
                                        @endphp
                                        {{ $levels[$levelIndex] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="sidebar-right">
                    @if($settings->include_education && $educations->count() > 0)
                        <div class="section">
                            <div class="section-header">
                                <div class="section-number">05</div>
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
                </div>
            </div>
        </div>
        <div class="footer">
            <span>Contact: {{ $about->email ?? '' }}</span>
            <span>Generated by <span>Portfolio CMS</span></span>
        </div>
    </div>
</body>
</html>