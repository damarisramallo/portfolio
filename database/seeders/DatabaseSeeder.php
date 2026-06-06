<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);


        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'damarisbelenramallo@gmail.com',
            'password' => bcrypt('Pimp0nsuAfr4nc4'),
        ]);
        $admin->assignRole('admin'); 

        $user = User::create([
            'name'     => 'User',
            'email'    => 'user@user.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('user'); 
        $this->call([
        RoleSeeder::class,
        ProjectSeeder::class,
        SkillSeeder::class,
        AboutSeeder::class,
    ]);
    }
}
