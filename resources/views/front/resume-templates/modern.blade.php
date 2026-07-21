<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - {{ $about->name ?? 'Portfolio' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
        }
        
        .resume {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }
        
        /* Header */
        .header {
            background: {{ $settings->primary_color }};
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }
        
        .header-text h1 {
            font-size: 28pt;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .header-text h2 {
            font-size: 14pt;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 0.75rem;
        }
        
        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            font-size: 10pt;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        
        @if($settings->include_photo && $about->photo_url)
        .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        @endif
        
        /* Body */
        .body {
            padding: 2rem;
        }
        
        .section {
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 13pt;
            font-weight: 700;
            color: {{ $settings->primary_color }};
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid {{ $settings->primary_color }};
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        
        /* Summary */
        .summary p {
            text-align: justify;
            color: #555;
        }
        
        /* Experience */
        .experience-item {
            margin-bottom: 1rem;
        }
        
        .experience-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.25rem;
        }
        
        .experience-title {
            font-weight: 700;
            font-size: 12pt;
            color: #333;
        }
        
        .experience-date {
            font-size: 10pt;
            color: {{ $settings->primary_color }};
            font-weight: 600;
        }
        
        .experience-company {
            font-style: italic;
            color: #666;
            margin-bottom: 0.35rem;
        }
        
        .experience-description {
            color: #555;
            font-size: 10pt;
        }
        
        /* Skills */
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .skill-tag {
            background: {{ $settings->primary_color }}15;
            color: {{ $settings->primary_color }};
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 9pt;
            font-weight: 600;
        }
        
        /* Education */
        .education-item {
            margin-bottom: 0.75rem;
        }
        
        .education-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        
        .education-degree {
            font-weight: 700;
        }
        
        .education-date {
            font-size: 10pt;
            color: {{ $settings->primary_color }};
        }
        
        .education-school {
            color: #666;
            font-style: italic;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 0.75rem;
        }
        
        .project-title {
            font-weight: 700;
        }
        
        .project-description {
            color: #555;
            font-size: 10pt;
        }
        
        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 1rem 2rem;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="resume">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                @if($settings->include_photo && $about->photo_url)
                    <img src="{{ $about->photo_url }}" alt="{{ $about->name }}" class="photo">
                @endif
                <div class="header-text">
                    <h1>{{ $about->name ?? 'Your Name' }}</h1>
                    <h2>{{ $about->title ?? 'Professional Title' }}</h2>
                    <div class="contact-info">
                        @if($about->email)
                            <span class="contact-item">{{ $about->email }}</span>
                        @endif
                        @if($about->phone)
                            <span class="contact-item">{{ $about->phone }}</span>
                        @endif
                        @if($about->address)
                            <span class="contact-item">{{ $about->address }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="body">
            <!-- Summary -->
            @if($about->short_intro)
                <div class="section">
                    <div class="section-title">Professional Summary</div>
                    <div class="summary">
                        <p>{{ $about->short_intro }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Skills -->
            @if($settings->include_skills && $skills->count() > 0)
                <div class="section">
                    <div class="section-title">Skills</div>
                    <div class="skills-grid">
                        @foreach($skills as $skill)
                            <span class="skill-tag">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Experience -->
            @if($settings->include_experience && $experiences->count() > 0)
                <div class="section">
                    <div class="section-title">Work Experience</div>
                    @foreach($experiences as $exp)
                        <div class="experience-item">
                            <div class="experience-header">
                                <span class="experience-title">{{ $exp->designation }}</span>
                                <span class="experience-date">
                                    {{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : $exp->end_date?->format('M Y') }}
                                </span>
                            </div>
                            <div class="experience-company">{{ $exp->company_name }}</div>
                            @if($exp->description)
                                <div class="experience-description">{{ $exp->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            
            <!-- Education -->
            @if($settings->include_education && $educations->count() > 0)
                <div class="section">
                    <div class="section-title">Education</div>
                    @foreach($educations as $edu)
                        <div class="education-item">
                            <div class="education-header">
                                <span class="education-degree">{{ $edu->degree }} </span>
                                <span class="education-date">
                                    {{ $edu->start_date }}
                                    -
                                    {{ $edu->end_year ?? 'Present' }}
                                </span>
                            </div>
                            <div class="education-school">{{ $edu->institute_name }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <!-- Projects -->
            @if($settings->include_projects && $projects->count() > 0)
                <div class="section">
                    <div class="section-title">Projects</div>
                    @foreach($projects as $project)
                        <div class="project-item">
                            <span class="project-title">{{ $project->title }}</span>
                            @if($project->description)
                                <div class="project-description">{{ Str::limit(strip_tags($project->description), 150) }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Generated on {{ now()->format('F d, Y') }} | {{ $about->email ?? '' }}</p>
        </div>
    </div>
</body>
</html>
