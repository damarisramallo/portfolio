<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate(); 

        $projects = [
            [
                'title'       => 'Portfolio Personal',
                'description' => 'Sitio web personal desarrollado con Laravel 13, Vue 3 e Inertia.js. Incluye panel de administración.',
                'image'       => null,
                'slug'        => 'portfolio-personal',
                'excerpt'     => 'Sitio web personal desarrollado con Laravel 13, Vue 3 e Inertia.js...',
                'url'         => 'https://github.com',
                'in_development' => false,
                'youtube_url' => 'https://www.youtube.com/watch?v=oukaArpFUrU&list=PLZ2ovOgdI-kVtF2yQ2kiZetWWTmOQoUSG&index=44',
                'tags'        => ['Laravel', 'Vue 3', 'Tailwind'],
                'order'       => 1,
                'visible'     => true,
            ],
            [
                'title'       => 'Blog Autoadministrable',
                'description' => 'Blog desarrollado con Laravel 13, Vue 3 e Inertia.js. Incluye panel de administración.',
                'image'       => null,
                'slug'        => 'blog-autoadministrable',
                'excerpt'     => 'Blog desarrollado con Laravel 13, Vue 3 e Inertia.js...',
                'url'         => null,
                'in_development' => true,
                'youtube_url' => 'https://www.youtube.com/watch?v=oukaArpFUrU&list=PLZ2ovOgdI-kVtF2yQ2kiZetWWTmOQoUSG&index=44',
                'tags'        => ['Laravel', 'MySQL'],
                'order'       => 2,
                'visible'     => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
