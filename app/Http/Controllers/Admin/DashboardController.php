<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Contact;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/DashboardAdmin', [
            'stats' => [
                'projects'         => Project::count(),
                'projects_visible' => Project::where('visible', true)->count(),
                'projects_dev'     => Project::where('in_development', true)->count(),
                'skills'           => Skill::count(),
                'messages'         => Contact::count(),
                'messages_today'   => Contact::whereDate('created_at', today())->count(),
            ]
        ]);
    }
}
