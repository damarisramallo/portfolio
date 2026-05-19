<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        return Inertia::render('Portfolio/Show', [
            'project' => $project,
        ]);
    }
}
