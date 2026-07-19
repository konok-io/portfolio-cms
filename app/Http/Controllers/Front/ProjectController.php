<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active()->ordered()->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $projects = $query->paginate(9)->withQueryString();
        $categories = ProjectCategory::orderBy('name')->get();

        return view('front.projects.index', compact('projects', 'categories'));
    }

    public function show(Project $project)
    {
        abort_if(! $project->is_active, 404);

        $project->load(['category', 'gallery']);

        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->when($project->project_category_id, function ($q) use ($project) {
                $q->where('project_category_id', $project->project_category_id);
            })
            ->take(3)
            ->get();

        return view('front.projects.show', compact('project', 'relatedProjects'));
    }
}
