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
            'updated_at' => now()
        ]);
    }
}
