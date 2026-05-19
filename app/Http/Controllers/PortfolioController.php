<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;



class PortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('Portfolio/Index', [
            'about' => [
                'name'  => 'Damaris',
                'bio'   => 'Analista de Sistemas y Desarrolladora Fullstack.',
                'photo' => null,
                'stack' => ['Laravel', 'Vue 3', 'Inertia.js', 'Tailwind', 'MySQL'],
            ],
            'skills'   => Skill::orderBy('order')->get(),
            'projects' => Project::where('visible', true)
                                 ->orderBy('order')
                                 ->get(),
        ]);
    }
}
