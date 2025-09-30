<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $staffRole = \App\Models\Role::where('name', 'staff')->first();
        
        $permissions = \App\Models\Permission::all();

        // Admin gets all permissions
        $adminRole->permissions()->sync($permissions);
        
        // Staff gets some permissions
        $staffPermissions = \App\Models\Permission::whereIn('name', [
            'manage_products',
            'manage_contacts'
        ])->get();
        $staffRole->permissions()->sync($staffPermissions);
    }
}
