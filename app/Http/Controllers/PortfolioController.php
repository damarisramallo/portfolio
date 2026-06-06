<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\About;



class PortfolioController extends Controller
{
    public function index()
    {
        $about = About::first();

        return Inertia::render('Portfolio/Index', [
            'about' => $about,
            'skills'   => Skill::orderBy('order')->get(),
            'projects' => Project::where('visible', true)
                                 ->orderBy('order')
                                 ->get(),
        ]);
    }
}
