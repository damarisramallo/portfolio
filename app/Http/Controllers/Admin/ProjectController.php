<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('id')->get();
        return Inertia::render('Admin/Projects/Index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'nullable|string|unique:projects,slug|max:255',
            'excerpt'     => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'url'         => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tags'        => 'nullable|array',
            'in_development' => 'required|boolean',
            'order'       => 'required|integer',
            'visible'     => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['tags'] = $request->tags ?? [];


        Project::create($validated);

        session()->flash('success', 'Project created successfully.');

        return redirect('/admin/projects');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Inertia::render('Admin/Projects/Show', [
        'project' => $project,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
    
        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image',
            'slug'        => 'nullable|string|unique:projects,slug,' . $project->id . '|max:255',
            'excerpt'     => 'nullable|string|max:255',
            'url'         => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tags'        => 'nullable|array',
            'in_development' => 'required|boolean',
            'order'       => 'required|integer',
            'visible'     => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $data['image'] = Storage::put('projects', $request->file('image'));
        }
        if (!$request->hasFile('image')) unset($data['image']);

        $project->update($data);

        session()->flash('success', 'Project updated successfully.');

        return redirect('/admin/projects');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
