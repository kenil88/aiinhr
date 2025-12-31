<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Job;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $statuses = [
            'new',
            'shortlisted',
            'rejected',
            'interview_scheduled',
            'interviewed',
            'hired',
        ];

        $jobs = Job::all();

        if ($jobs->isEmpty()) {
            $this->command->warn('No jobs found. Skipping ApplicationSeeder.');
            return;
        }

        foreach ($jobs as $job) {

            // Get candidates from SAME company
            $candidates = Candidate::where('company_id', $job->company_id)
                ->inRandomOrder()
                ->limit(rand(5, 15))
                ->get();

            foreach ($candidates as $candidate) {

                // Prevent duplicate application for same job
                Application::firstOrCreate(
                    [
                        'job_id' => $job->id,
                        'candidate_id' => $candidate->id,
                    ],
                    [
                        'company_id' => $job->company_id,
                        'resume_path' => 'resumes/sample-resume.pdf',
                        'status' => $faker->randomElement($statuses),
                        'overall_score' => rand(45, 95),
                        'ai_result' => [
                            'summary' => $faker->sentence(14),
                            'skills_match' => rand(40, 100),
                            'experience_match' => rand(40, 100),
                            'recommendation' => $faker->randomElement([
                                'Strong fit',
                                'Good fit',
                                'Average fit',
                                'Not recommended',
                            ]),
                        ],
                        'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
                    ]
                );
            }
        }
    }
}
