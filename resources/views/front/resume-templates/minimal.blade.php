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
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 50px 40px;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .header h1 {
            font-size: 24pt;
            font-weight: 300;
            color: #222;
            margin-bottom: 5px;
        }
        
        .header .title {
            font-size: 11pt;
            color: #666;
            margin-bottom: 10px;
        }
        
        .header .contact {
            font-size: 9pt;
            color: #888;
        }
        
        .header .contact span {
            margin: 0 10px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 10pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #444;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
        
        /* Summary */
        .summary p {
            color: #555;
            font-size: 10pt;
        }
        
        /* Experience */
        .experience-item {
            margin-bottom: 15px;
        }
        
        .experience-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 3px;
        }
        
        .experience-title {
            font-weight: 600;
            font-size: 10pt;
            color: #333;
        }
        
        .experience-date {
            font-size: 9pt;
            color: #888;
        }
        
        .experience-company {
            font-size: 9pt;
            color: #666;
            margin-bottom: 3px;
        }
        
        .experience-description {
            font-size: 9pt;
            color: #555;
        }
        
        /* Skills */
        .skills-list {
            font-size: 9pt;
            color: #555;
        }
        
        .skill-tag {
            display: inline-block;
            margin: 2px 5px 2px 0;
        }
        
        /* Education */
        .education-item {
            margin-bottom: 10px;
        }
        
        .education-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        
        .education-degree {
            font-weight: 600;
            font-size: 10pt;
        }
        
        .education-date {
            font-size: 9pt;
            color: #888;
        }
        
        .education-school {
            font-size: 9pt;
            color: #666;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 10px;
        }
        
        .project-title {
            font-weight: 600;
            font-size: 10pt;
        }
        
        .project-description {
            font-size: 9pt;
            color: #555;
            margin-top: 3px;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 8pt;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $about->name ?? 'Your Name' }}</h1>
        @if($about->title)
            <div class="title">{{ $about->title }}</div>
        @endif
        <div class="contact">
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
            <div class="section-title">Summary</div>
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
                    <span class="skill-tag">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- Experience -->
    @if($settings->include_experience && $experiences->count() > 0)
        <div class="section">
            <div class="section-title">Experience</div>
            @foreach($experiences as $exp)
                <div class="experience-item">
                    <div class="experience-header">
                        <span class="experience-title">{{ $exp->designation }}</span>
                        <span class="experience-date">
                            {{ is_object($exp->start_date) ? $exp->start_date->format('M Y') : $exp->start_date }}
                            - 
                            {{ $exp->is_current ? 'Present' : (is_object($exp->end_date) ? $exp->end_date->format('M Y') : ($exp->end_date ?? 'Present')) }}
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
    
    <!-- Footer -->
    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y') }}</p>
    </div>
</body>
</html>
