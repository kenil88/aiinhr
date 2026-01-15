<?php

namespace Database\Factories;

use App\Models\Requisition;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RequisitionFactory extends Factory
{
    protected $model = Requisition::class;

    public function definition(): array
    {
        return [
            'requisition_code' => 'REQ-' . now()->year . '-' . Str::upper(Str::random(5)),

            'job_title' => $this->faker->jobTitle(),

            'company_id' => Company::factory(),

            'department_id' => null,

            'requested_by' => User::factory(),

            'approved_by' => null,

            'openings' => $this->faker->numberBetween(1, 5),

            'employment_type' => $this->faker->randomElement([
                'full_time',
                'part_time',
                'contract',
                'intern'
            ]),

            'salary_min' => $this->faker->numberBetween(300000, 800000),
            'salary_max' => $this->faker->numberBetween(800000, 1500000),

            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),

            'status' => $this->faker->randomElement([
                'draft',
                'submitted',
                'approved'
            ]),

            'reason' => $this->faker->sentence(),

            'approved_at' => null,
            'closed_at' => null,
        ];
    }

    /**
     * Approved requisition state
     */
    public function approved(User $approver = null): static
    {
        return $this->state(function () use ($approver) {
            return [
                'status' => 'approved',
                'approved_by' => $approver?->id,
                'approved_at' => now(),
            ];
        });
    }

    /**
     * Submitted requisition state
     */
    public function submitted(): static
    {
        return $this->state([
            'status' => 'submitted',
        ]);
    }
}
