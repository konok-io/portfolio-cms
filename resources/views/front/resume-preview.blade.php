@extends('front.layouts.app')

@section('title', 'Resume Preview')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-body p-5">
                    @if($about)
                        <div class="text-center mb-4">
                            <h1>{{ $about->name }}</h1>
                            <p class="text-muted">{{ $about->title }}</p>
                            @if($about->email)
                                <p>{{ $about->email }} | {{ $about->phone ?? '' }}</p>
                            @endif
                        </div>
                    @endif

                    @if($about && $about->bio)
                        <div class="mb-4">
                            <h4>About</h4>
                            <p>{{ $about->bio }}</p>
                        </div>
                    @endif

                    @if($skills->count() > 0)
                        <div class="mb-4">
                            <h4>Skills</h4>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($skills as $skill)
                                    <span class="badge bg-primary">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($experiences->count() > 0)
                        <div class="mb-4">
                            <h4>Experience</h4>
                            @foreach($experiences as $exp)
                                <div class="mb-3">
                                    <h5>{{ $exp->job_title }}</h5>
                                    <p class="text-muted mb-1">{{ $exp->company }} | {{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</p>
                                    @if($exp->description)
                                        <p>{{ $exp->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($educations->count() > 0)
                        <div class="mb-4">
                            <h4>Education</h4>
                            @foreach($educations as $edu)
                                <div class="mb-3">
                                    <h5>{{ $edu->degree }}</h5>
                                    <p class="text-muted mb-1">{{ $edu->institute_name }} | {{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($projects->count() > 0)
                        <div class="mb-4">
                            <h4>Projects</h4>
                            @foreach($projects as $project)
                                <div class="mb-3">
                                    <h5>{{ $project->title }}</h5>
                                    @if($project->description)
                                        <p>{{ Str::limit(strip_tags($project->description), 150) }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
