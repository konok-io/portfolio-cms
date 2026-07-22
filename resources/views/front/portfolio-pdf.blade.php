<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $about->name ?? 'Portfolio' }} - Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        
        /* Header */
        .header {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 2px solid #4F2FE8;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .header .title {
            font-size: 16px;
            color: #4F2FE8;
            margin-bottom: 10px;
        }
        
        .header .contact-info {
            font-size: 10px;
            color: #666;
        }
        
        .header .contact-info span {
            margin: 0 8px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #4F2FE8;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-bottom: 8px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        
        /* Summary */
        .summary p {
            text-align: justify;
            color: #555;
        }
        
        /* Experience & Education */
        .item {
            margin-bottom: 15px;
        }
        
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 3px;
        }
        
        .item-title {
            font-weight: bold;
            font-size: 12px;
        }
        
        .item-company {
            color: #666;
            font-size: 11px;
        }
        
        .item-date {
            font-size: 10px;
            color: #888;
        }
        
        .item-description {
            font-size: 10px;
            color: #555;
            margin-top: 3px;
        }
        
        /* Skills */
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        
        .skill-tag {
            background: #f0f0f0;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 9px;
            color: #333;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #eee;
        }
        
        .project-item:last-child {
            border-bottom: none;
        }
        
        .project-title {
            font-weight: bold;
            font-size: 11px;
            color: #333;
        }
        
        .project-description {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }
        
        .project-tags {
            margin-top: 5px;
        }
        
        .project-tag {
            background: #e8f0fe;
            color: #4F2FE8;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            margin-right: 4px;
        }
        
        /* Services */
        .services-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .service-item {
            flex: 0 0 calc(50% - 5px);
            background: #fafafa;
            padding: 10px;
            border-radius: 4px;
            border-left: 3px solid #4F2FE8;
        }
        
        .service-title {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 3px;
        }
        
        .service-description {
            font-size: 9px;
            color: #666;
        }
        
        /* Certifications */
        .cert-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 10px;
        }
        
        .cert-icon {
            color: #4F2FE8;
            margin-right: 8px;
        }
        
        /* Two Column Layout */
        .two-column {
            display: flex;
            gap: 30px;
        }
        
        .two-column .column {
            flex: 1;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            font-size: 9px;
            color: #888;
        }
        
        @page {
            margin: 1cm;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <header class="header">
            <h1>{{ $about->name ?? 'Your Name' }}</h1>
            <div class="title">{{ $about->title ?? 'Professional Title' }}</div>
            <div class="contact-info">
                @if($about->email)
                    <span>✉ {{ $about->email }}</span>
                @endif
                @if($about->phone)
                    <span>☎ {{ $about->phone }}</span>
                @endif
                @if($about->address)
                    <span>⌂ {{ $about->address }}</span>
                @endif
                @if($about->website)
                    <span>⊕ {{ $about->website }}</span>
                @endif
            </div>
        </header>

        {{-- Summary --}}
        @if($about->bio)
            <section class="section summary">
                <h2 class="section-title">About Me</h2>
                <p>{!! nl2br(e($about->bio)) !!}</p>
            </section>
        @endif

        {{-- Two Column Layout --}}
        <div class="two-column">
            <div class="column">
                {{-- Experience --}}
                @if($experiences->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Experience</h2>
                        @foreach($experiences as $exp)
                            <div class="item">
                                <div class="item-header">
                                    <span class="item-title">{{ $exp->job_title }}</span>
                                    <span class="item-date">{{ $exp->start_date->format('M Y') }} - {{ $exp->current ? 'Present' : $exp->end_date?->format('M Y') }}</span>
                                </div>
                                <div class="item-company">{{ $exp->company }}{{ $exp->location ? ' • ' . $exp->location : '' }}</div>
                                @if($exp->description)
                                    <div class="item-description">{!! nl2br(e($exp->description)) !!}</div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- Education --}}
                @if($education->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Education</h2>
                        @foreach($education as $edu)
                            <div class="item">
                                <div class="item-header">
                                    <span class="item-title">{{ $edu->degree }}</span>
                                    <span class="item-date">{{ $edu->start_year }} - {{ $edu->end_year }}</span>
                                </div>
                                <div class="item-company">{{ $edu->institution }}{{ $edu->location ? ' • ' . $edu->location : '' }}</div>
                                @if($edu->description)
                                    <div class="item-description">{!! nl2br(e($edu->description)) !!}</div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- Certifications --}}
                @if($certifications->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Certifications</h2>
                        @foreach($certifications as $cert)
                            <div class="cert-item">
                                <span class="cert-icon">★</span>
                                <span><strong>{{ $cert->name }}</strong> - {{ $cert->issuer }} ({{ $cert->year }})</span>
                            </div>
                        @endforeach
                    </section>
                @endif
            </div>

            <div class="column">
                {{-- Skills --}}
                @if($skills->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Skills</h2>
                        <div class="skills-grid">
                            @foreach($skills as $skill)
                                <span class="skill-tag">{{ $skill->name }}{{ $skill->proficiency ? ' (' . $skill->proficiency . '%)' : '' }}</span>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Services --}}
                @if($services->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Services</h2>
                        <div class="services-grid">
                            @foreach($services as $service)
                                <div class="service-item">
                                    <div class="service-title">{{ $service->title }}</div>
                                    @if($service->short_description)
                                        <div class="service-description">{{ Str::limit(strip_tags($service->short_description), 80) }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Projects --}}
                @if($projects->isNotEmpty())
                    <section class="section">
                        <h2 class="section-title">Featured Projects</h2>
                        @foreach($projects as $project)
                            <div class="project-item">
                                <div class="project-title">{{ $project->title }}</div>
                                @if($project->short_description)
                                    <div class="project-description">{{ Str::limit(strip_tags($project->short_description), 100) }}</div>
                                @endif
                                @if($project->tags && $project->tags->isNotEmpty())
                                    <div class="project-tags">
                                        @foreach($project->tags->take(3) as $tag)
                                            <span class="project-tag">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif
            </div>
        </div>

        {{-- Footer --}}
        <footer class="footer">
            <p>Generated on {{ now()->format('F d, Y') }} | {{ url('/') }}</p>
        </footer>
    </div>
</body>
</html>
