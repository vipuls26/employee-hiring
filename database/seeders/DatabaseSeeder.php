<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        $this->call([
            RoleSeeder::class
        ]);

        User::factory()->create([
            'name' => 'employee1',
            'email' => 'employee1@gmail.com',
            'password' => 'password',
            'role_id' => 1
        ]);

        User::factory()->create([
            'name' => 'employee2',
            'email' => 'employee2@gmail.com',
            'password' => 'password',
            'role_id' => 1
        ]);

        User::factory()->create([
            'name' => 'hr1',
            'email' => 'hr1@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'hr2',
            'email' => 'hr2@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'manager1',
            'email' => 'manager1@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);

        User::factory()->create([
            'name' => 'manager2',
            'email' => 'manager2@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);

        User::factory()->create([
            'name' => 'owner1',
            'email' => 'owner1@gmail.com',
            'password' => 'password',
            'role_id' => 4
        ]);

        User::factory()->create([
            'name' => 'owner2',
            'email' => 'owner2@gmail.com',
            'password' => 'password',
            'role_id' => 4
        ]);

        $this->call([
            CompanySeeder::class,
        ]);

        $this->call([
            JobApplicationSeeder::class,
        ]);
    }
}
