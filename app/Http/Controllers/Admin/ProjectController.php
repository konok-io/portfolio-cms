<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category')->ordered();

        if ($request->filled('category')) {
            $query->where('project_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $projects = $query->paginate(15)->withQueryString();
        $categories = ProjectCategory::orderBy('name')->get();

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = ProjectCategory::orderBy('name')->get();

        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['slug'] = $request->filled('slug')
            ? Project::generateUniqueSlug($request->slug)
            : Project::generateUniqueSlug($request->title);

        $project = Project::create($validated);

        $this->storeGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $categories = ProjectCategory::orderBy('name')->get();
        $project->load('gallery');

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateData($request, $project->id);

        if ($request->hasFile('featured_image')) {
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->filled('slug') && $request->slug !== $project->slug) {
            $validated['slug'] = Project::generateUniqueSlug($request->slug, $project->id);
        }

        $project->update($validated);

        $this->storeGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }

        foreach ($project->gallery as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function destroyGalleryImage(ProjectGallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $projectId = $gallery->project_id;
        $gallery->delete();

        return redirect()->route('admin.projects.edit', $projectId)->with('success', 'Gallery image removed.');
    }

    // ---------------------------------------------------------------
    // Project Categories
    // ---------------------------------------------------------------

    public function categories()
    {
        $categories = ProjectCategory::orderBy('name')->paginate(20);

        return view('admin.projects.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:project_categories,name'],
        ]);

        ProjectCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.projects.categories')->with('success', 'Category added successfully.');
    }

    public function destroyCategory(ProjectCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.projects.categories')->with('success', 'Category deleted successfully.');
    }

    // ---------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable', 'string', 'max:255', 'alpha_dash',
                Rule::unique('projects', 'slug')->ignore($ignoreId),
            ],
            'project_category_id' => ['nullable', 'exists:project_categories,id'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'technologies' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['completed', 'ongoing', 'on_hold'])],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    protected function storeGalleryImages(Request $request, Project $project): void
    {
        if (! $request->hasFile('gallery_images')) {
            return;
        }

        $maxSort = $project->gallery()->max('sort_order') ?? 0;

        foreach ($request->file('gallery_images') as $index => $file) {
            $path = $file->store('projects/gallery', 'public');

            ProjectGallery::create([
                'project_id' => $project->id,
                'image' => $path,
                'sort_order' => $maxSort + $index + 1,
            ]);
        }
    }
}
