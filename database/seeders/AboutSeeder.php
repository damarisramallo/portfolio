<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name'  => 'Damaris',
            'bio'   => 'Analista de Sistemas y Desarrolladora Fullstack.',
            'photo' => null,
            'cv'    => null,
            'stack' => ['Laravel', 'Vue 3', 'Inertia.js', 'Tailwind', 'MySQL'],
        ]);
    }
}
