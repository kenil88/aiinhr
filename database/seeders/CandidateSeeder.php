<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\Company;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('No companies found. Skipping CandidateSeeder.');
            return;
        }

        foreach ($companies as $company) {

            // 30–50 candidates per company
            $count = rand(30, 50);

            for ($i = 0; $i < $count; $i++) {

                Candidate::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'email' => $faker->unique()->safeEmail,
                    ],
                    [
                        'name' => $faker->name,
                        'phone' => $faker->phoneNumber,
                        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                    ]
                );
            }
        }
    }
}
