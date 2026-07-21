<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.8;
            color: #333;
            background: #e8e8e8;
        }
        .resume {
            max-width: 750px;
            margin: 0 auto;
            background: white;
            padding: 3rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }
        .header-left h1 {
            font-size: 28pt;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.25rem;
            letter-spacing: -1px;
        }
        .header-left h2 {
            font-size: 11pt;
            font-weight: 400;
            color: {{ $settings->primary_color }};
            letter-spacing: 1px;
        }
        .header-right {
            text-align: right;
            font-size: 9pt;
            color: #666;
        }
        .header-right div { margin-bottom: 0.25rem; }
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 0.75rem;
        }
        @endif
        .two-column { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
        .section { margin-bottom: 2rem; }
        .section-title {
            font-size: 9pt;
            font-weight: 700;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1rem;
        }
        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: {{ $settings->primary_color }};
        }
        .summary p { color: #555; font-size: 10pt; }
        .experience-item { margin-bottom: 1.2rem; }
        .experience-header { display: flex; justify-content: space-between; margin-bottom: 0.2rem; }
        .experience-title { font-weight: 700; font-size: 10pt; color: #111; }
        .experience-date { font-size: 9pt; color: #999; }
        .experience-company { font-size: 9pt; color: {{ $settings->primary_color }}; margin-bottom: 0.3rem; }
        .experience-description { color: #666; font-size: 9pt; }
        .skills-list { display: flex; flex-wrap: wrap; gap: 0.4rem; }
        .skill-tag {
            background: #f5f5f5;
            color: #333;
            padding: 0.3rem 0.8rem;
            font-size: 9pt;
            font-weight: 500;
        }
        .education-item { margin-bottom: 1rem; }
        .education-degree { font-weight: 600; font-size: 10pt; color: #111; }
        .education-school { font-size: 9pt; color: #666; }
        .education-date { font-size: 9pt; color: #999; }
        .project-item { margin-bottom: 0.8rem; }
        .project-title { font-weight: 600; font-size: 10pt; color: #111; }
        .project-description { color: #666; font-size: 9pt; }
        .footer {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 8pt;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="resume">
        <div class="header">
            <div class="header-left">
                @if($settings->include_photo && $about->photo_url)
                    <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                @endif
                <h1>{{ $about->name ?? 'Your Name' }}</h1>
                <h2>{{ $about->title ?? 'Professional Title' }}</h2>
            </div>
            <div class="header-right">
                @if($about->email)
                    <div>{{ $about->email }}</div>
                @endif
                @if($about->phone)
                    <div>{{ $about->phone }}</div>
                @endif
                @if($about->address)
                    <div>{{ $about->address }}</div>
                @endif
            </div>
        </div>
        <div class="two-column">
            <div>
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
                                <div class="experience-header">
                                    <span class="experience-title">{{ $exp->designation }}</span>
                                    <span class="experience-date">{{ $exp->start_date }}</span>
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
                                    <div class="project-description">{{ Str::limit(strip_tags($project->description), 100) }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                @if($settings->include_skills && $skills->count() > 0)
                    <div class="section">
                        <div class="section-title">Skills</div>
                        <div class="skills-list">
                            @foreach($skills as $skill)
                                <span class="skill-tag">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="footer">{{ $about->email ?? '' }} | Generated on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
