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
            'name' => 'sam',
            'email' => 'sam@gmail.com',
            'password' => 'password',
            'role_id' => 1
        ]);

        User::factory()->create([
            'name' => 'martha',
            'email' => 'martha@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'joseph',
            'email' => 'joseph@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);

        User::factory()->create([
            'name' => 'jhon',
            'email' => 'jhon@gmail.com',
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
