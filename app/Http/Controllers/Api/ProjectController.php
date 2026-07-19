<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active()->ordered()->with(['category', 'gallery']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        $projects = $query->paginate((int) $request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    public function show(Project $project)
    {
        if (! $project->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        $project->load(['category', 'gallery']);

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }
}
