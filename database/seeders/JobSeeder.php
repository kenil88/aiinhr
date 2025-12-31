<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Company;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('name', 'Demo Company')->first();

        Job::updateOrCreate(
            [
                'company_id' => $company->id,
                'title' => 'Laravel Developer',
            ],
            [
                'description' => 'Looking for a Laravel developer with experience in MySQL and REST APIs.',
                'visibility' => 'public',
                'status' => 'open',
            ]
        );
    }
}
