<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = ['admin', 'staff', 'customer'];
        foreach ($role as $value) {
            \App\Models\Role::create(['name' => $value]);
        };
    }
}
