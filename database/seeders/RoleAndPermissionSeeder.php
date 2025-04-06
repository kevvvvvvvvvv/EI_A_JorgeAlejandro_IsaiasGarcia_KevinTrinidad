<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        $roleAdmin = Role::firstOrCreate([
            'name' => 'user',
        ]);

        Permission::firstOrCreate([
            'name' => 'editarUsuario',
        ]);

    }
}
