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
            font-family: 'Times New Roman', Georgia, serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #000;
        }
        
        .resume {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }
        
        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 26pt;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .header h2 {
            font-size: 12pt;
            font-weight: normal;
            margin-bottom: 10px;
        }
        
        .contact-info {
            font-size: 10pt;
        }
        
        .contact-info span {
            margin: 0 8px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 12px;
        }
        
        /* Summary */
        .summary p {
            text-align: justify;
        }
        
        /* Experience */
        .experience-item {
            margin-bottom: 15px;
        }
        
        .experience-header {
            margin-bottom: 3px;
        }
        
        .experience-title {
            font-weight: bold;
            font-size: 11pt;
        }
        
        .experience-date {
            float: right;
            font-size: 10pt;
        }
        
        .experience-company {
            font-style: italic;
            margin-bottom: 5px;
        }
        
        /* Skills */
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        .skill-item {
            font-size: 10pt;
        }
        
        .skill-item::after {
            content: ",";
        }
        
        .skill-item:last-child::after {
            content: "";
        }
        
        /* Education */
        .education-item {
            margin-bottom: 10px;
        }
        
        .education-degree {
            font-weight: bold;
        }
        
        .education-school {
            font-style: italic;
        }
        
        .education-date {
            float: right;
            font-size: 10pt;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 10px;
        }
        
        .project-title {
            font-weight: bold;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="resume">
        <!-- Header -->
        <div class="header">
            <h1>{{ $about->name ?? 'Your Name' }}</h1>
            <h2>{{ $about->title ?? 'Professional Title' }}</h2>
            <div class="contact-info">
                @if($about->email)
                    <span>{{ $about->email }}</span>
                @endif
                @if($about->phone)
                    <span>{{ $about->phone }}</span>
                @endif
                @if($about->address)
                    <span>{{ $about->address }}</span>
                @endif
            </div>
        </div>
        
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
                <div class="skills-list">
                    @foreach($skills as $skill)
                        <span class="skill-item">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Experience -->
        @if($settings->include_experience && $experiences->count() > 0)
            <div class="section">
                <div class="section-title">Work Experience</div>
                @foreach($experiences as $exp)
                    <div class="experience-item clearfix">
                        <div class="experience-header">
                            <span class="experience-title">{{ $exp->job_title }}</span>
                            <span class="experience-date">
                                {{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : $exp->end_date?->format('M Y') }}
                            </span>
                        </div>
                        <div class="experience-company">{{ $exp->company }}@if($exp->location), {{ $exp->location }}@endif</div>
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
                    <div class="education-item clearfix">
                        <span class="education-degree">{{ $edu->degree }} @if($edu->field)in {{ $edu->field }}@endif</span>
                        <span class="education-date">
                            {{ $edu->start_date->format('Y') }} - {{ $edu->is_current ? 'Present' : $edu->end_date?->format('Y') }}
                        </span>
                        <div class="education-school">{{ $edu->institution }}@if($edu->location), {{ $edu->location }}@endif</div>
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
        
        <!-- Footer -->
        <div class="footer">
            <p>Generated on {{ now()->format('F d, Y') }} | {{ $about->email ?? '' }}</p>
        </div>
    </div>
</body>
</html>
