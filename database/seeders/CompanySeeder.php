<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::insert([
            'name' => 'google',
            'email' => 'google@gmail.com',
            'location' => 'new york city',
            'description' => 'google is a technology company that specializes in internet-related services and products, including search engines, online advertising technologies, cloud computing, software, and hardware.',
            'owner_id' => 4,
            'phone' => 7896541230,
            'website' => 'https://www.google.com',
            'created_at' => now(),
            'updated_at' => now(),
            'hr_id' => 2,
            'manager_id' => 3
        ]);

        Company::insert([
            'name' => 'amazon',
            'email' => 'amazon@gmail.com',
            'location' => 'africa',
            'description' => 'amazon is a technology company that specializes in internet-related services and products, including search engines, online advertising technologies, cloud computing, software, and hardware.',
            'owner_id' => 7,
            'phone' => 7896541231,
            'website' => 'https://www.amaxon.com',
            'created_at' => now(),
            'updated_at' => now(),
            'hr_id' => 4,
            'manager_id' => 6
        ]);
    }
}
