<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::truncate();

        $skills = [
            ['name' => 'Laravel',   'order' => 1],
            ['name' => 'Vue 3',     'order' => 2],
            ['name' => 'Tailwind',   'order' => 3],
            ['name' => 'MySQL',      'order' => 4],
            ['name' => 'PHP',      'order' => 5],
            ['name' => 'Inertia.js', 'order' => 6],
            ['name' => 'Git/GitHub', 'order' => 7],
            ['name' => 'JavaScript', 'order' => 8],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
