<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active()->ordered()->with('category', 'tags');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $projects = $query->paginate(9)->withQueryString();
        $categories = ProjectCategory::orderBy('name')->get();
        $tags = Tag::withCount('projects')->orderBy('projects_count', 'desc')->limit(15)->get();

        return view('front.projects.index', compact('projects', 'categories', 'tags'));
    }

    public function show(Project $project)
    {
        abort_if(! $project->is_active, 404);

        $project->load(['category', 'gallery', 'tags']);

        // Get prev/next projects
        $prevProject = Project::active()
            ->where('sort_order', '<', $project->sort_order)
            ->orWhere(function ($q) use ($project) {
                $q->where('sort_order', $project->sort_order)
                  ->where('id', '<', $project->id);
            })
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->first();
            
        $nextProject = Project::active()
            ->where(function ($q) use ($project) {
                $q->where('sort_order', '>', $project->sort_order)
                  ->orWhere(function ($q2) use ($project) {
                      $q2->where('sort_order', $project->sort_order)
                         ->where('id', '>', $project->id);
                  });
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->with('tags')
            ->where(function ($q) use ($project) {
                // Same category
                $q->where('project_category_id', $project->project_category_id)
                  // OR same tags
                  ->orWhereHas('tags', function ($tagQ) use ($project) {
                      $tagQ->whereIn('tags.id', $project->tags->pluck('id'));
                  });
            })
            ->take(3)
            ->get();

        // If not enough related projects, get more from active projects
        if ($relatedProjects->count() < 3) {
            $existingIds = $relatedProjects->pluck('id')->push($project->id)->toArray();
            $moreProjects = Project::active()
                ->whereNotIn('id', $existingIds)
                ->take(3 - $relatedProjects->count())
                ->get();
            $relatedProjects = $relatedProjects->merge($moreProjects);
        }

        return view('front.projects.show', compact('project', 'relatedProjects', 'prevProject', 'nextProject'));
    }
}
