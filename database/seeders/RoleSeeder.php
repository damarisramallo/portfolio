<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $permIndex = Permission::firstOrCreate(['name' => 'index']);
        $permLogin = Permission::firstOrCreate(['name' => 'login']);
        $permDashboard = Permission::firstOrCreate(['name' => 'dashboard']);

        $user->givePermissionTo($permIndex);

        $admin->givePermissionTo([$permIndex, $permLogin, $permDashboard]);
    }
}
