<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['role' => 'employee', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'HR', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Owner', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
