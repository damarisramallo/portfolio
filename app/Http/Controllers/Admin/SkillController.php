<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::orderBy('id')->get();
        return Inertia::render('Admin/Skills/Index', [
            'skills' => $skills,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Skills/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'icon'  => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'order'       => 'required|integer',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = Storage::disk('public')->put('skills', $request->file('icon'));
        }


        Skill::create($validated);

        session()->flash('success', 'Skill created successfully.');

        return redirect('/admin/skills');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return Inertia::render('Admin/Skills/Edit', [
            'skill' => $skill,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'icon'  => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('icon')) {
            if ($skill->icon) {
                Storage::disk('public')->delete($skill->icon);
            }
            $data['icon'] = Storage::disk('public')->put('skills', $request->file('icon'));
        }

        $skill->update($data);

        session()->flash('success', 'Skill updated successfully.');

        return redirect('/admin/skills');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        if ($skill->icon) {
            Storage::disk('public')->delete($skill->icon);
        }

        $skill->delete();

        return redirect()->route('skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}
