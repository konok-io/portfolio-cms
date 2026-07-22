<!DOCTYPE html>
<html lang="bn">
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
            color: {{ $settings->text_color ?? '#4a5568' }};
            background: linear-gradient(135deg, {{ $settings->primary_color }}22 0%, {{ $settings->primary_color }}11 100%);
            padding: 40px;
            min-height: 100vh;
        }
        .resume {
            max-width: 850px;
            margin: 0 auto;
            background: {{ $settings->background_color ?? '#ffffff' }};
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        .header {
            background: {{ $settings->header_bg_color ?? '#1a1a2e' }};
            color: white;
            padding: 0;
            display: flex;
        }
        .header-left {
            flex: 0 0 30%;
            background: rgba(0,0,0,0.15);
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .header-right {
            flex: 1;
            padding: 40px;
        }
        .header-right h1 {
            font-size: 28pt;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
            color: {{ $settings->heading_color ?? '#ffffff' }};
        }
        .header-right h2 {
            font-size: 12pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 20px;
            color: {{ $settings->primary_color }};
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            font-size: 9pt;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0.95;
        }
        .body {
            padding: 30px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        .main-content, .sidebar { min-width: 0; }
        .section { margin-bottom: 25px; }
        .section-title {
            font-size: 12pt;
            font-weight: 700;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid {{ $settings->primary_color }}30;
        }
        .summary p { color: {{ $settings->text_color ?? '#4a5568' }}; text-align: justify; font-size: 10pt; line-height: 1.7; }
        .experience-item {
            margin-bottom: 15px;
            padding: 15px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            padding-left: 20px;
            border-left: 4px solid {{ $settings->primary_color }};
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .experience-title { font-weight: 700; font-size: 11pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .experience-date { font-size: 9pt; color: {{ $settings->primary_color }}; font-weight: 600; margin-bottom: 5px; }
        .experience-company { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 10pt; margin-bottom: 5px; }
        .experience-description { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 9pt; }
        .skill-item { margin-bottom: 12px; }
        .skill-name { font-size: 9pt; font-weight: 600; color: {{ $settings->heading_color ?? '#1a1a2e' }}; margin-bottom: 5px; }
        .skill-bar { height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden; }
        .skill-progress { height: 100%; background: linear-gradient(90deg, {{ $settings->primary_color }}, {{ $settings->primary_color }}aa); border-radius: 3px; }
        .education-item { margin-bottom: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; }
        .education-degree { font-weight: 700; font-size: 10pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .education-school { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 9pt; margin-bottom: 3px; }
        .education-date { font-size: 9pt; color: {{ $settings->primary_color }}; }
        .project-item { margin-bottom: 10px; padding: 12px; background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 10px; }
        .project-title { font-weight: 700; font-size: 10pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .project-description { color: {{ $settings->text_color ?? '#4a5568' }}; font-size: 9pt; margin-top: 5px; }
        .certification-item { margin-bottom: 10px; padding: 12px; background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 10px; border-left: 4px solid {{ $settings->primary_color }}; }
        .certification-name { font-weight: 700; font-size: 10pt; color: {{ $settings->heading_color ?? '#1a1a2e' }}; }
        .certification-issuer { color: {{ $settings->primary_color }}; font-size: 9pt; margin-top: 3px; }
        .footer { background: {{ $settings->footer_bg_color ?? '#1a1a2e' }}; color: #9ca3af; padding: 15px 30px; text-align: center; font-size: 8pt; }
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
                                <div class="experience-date">{{ $exp->start_date }} - {{ $exp->end_year ?? 'Present' }}</div>
                                <div class="experience-title">{{ $exp->designation }}</div>
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
                @if($settings->include_certifications && $certifications && $certifications->count() > 0)
                    <div class="section">
                        <div class="section-title">Certifications</div>
                        @foreach($certifications as $cert)
                            <div class="certification-item">
                                <div class="certification-name">{{ $cert->name }}</div>
                                <div class="certification-issuer">{{ $cert->issuer ?? '' }} - {{ $cert->issue_date ?? '' }}</div>
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