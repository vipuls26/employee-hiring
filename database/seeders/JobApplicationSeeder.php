<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplication::insert([
            'name' => 'software developer',
            'salary' => 15000,
            'status' => 'active',
            'type' => 'full-time',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now()

        ]);

        JobApplication::insert([
            'name' => 'graphic designer',
            'salary' => 10000,
            'status' => 'active',
            'type' => 'part-time',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        JobApplication::insert([
            'name' => 'data analyst',
            'salary' => 12000,
            'status' => 'active',
            'type' => 'hybrid',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
