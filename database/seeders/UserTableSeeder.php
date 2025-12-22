<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::Create([
            'name' => 'Nguyen Van A',
            'email' => 'nguyenvana@gmail.com',
            'password' => bcrypt('123456'),
            'phone_number' => '0123456789',
            'status' => 'active',
            'avatar' => '',
            'address' => 'Hanoi, Vietnam',
            'role_id' => 3, // Assuming role_id 1 is for admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::Create([
            'name' => 'Tran Thi B',
            'email' => 'tranthib@gmail.com',
            'password' => bcrypt('123456'),
            'phone_number' => '0987654321',
            'status' => 'pending',
            'avatar' => '',
            'address' => 'Ho Chi Minh City, Vietnam',
            'role_id' => 3, // Assuming role_id 2 is for staff
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::Create([
            'name' => 'Le Van C',
            'email' => 'levanc@gmail.com',
            'password' => bcrypt('123456'),
            'phone_number' => '0912345678',
            'status' => 'pending',
            'avatar' => '',
            'address' => 'Da Nang, Vietnam',
            'role_id' => 3, // Assuming role_id 3 is for customer
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
