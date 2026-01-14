<?php

namespace App\Livewire\Company\Jobs;

use App\Models\Company;
use Livewire\Component;
use App\Models\Job;
use App\Support\CompanyLimits;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class JobForm extends Component
{
    public ?Job $job = null;

    public $title;
    public $description;
    public $status = 'open';
    public $department;
    public $location;
    public $employment_type = 'full-time';
    public $experience_level;
    public $salary_min;
    public $salary_max;

    public function mount(?Job $job = null)
    {
        if ($job) {
            // Security: ensure job belongs to company
            abort_if(
                $job->company_id !== Auth::user()->company_id,
                403
            );
            $this->job = $job;
            $this->fill($job);
        }
    }

    public function save()
    {
        $company = Auth::user()->company;

        if (!CompanyLimits::canCreateJob($company)) {
            $this->addError('limit', 'You have reached the maximum number of jobs allowed for your plan.');
            return;
        }

        $this->validate(
            [
                'title' => 'required|min:3',
                'description' => 'required|min:10',
                'status' => 'required|in:open,closed',
                'department' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'employment_type' => 'required|in:full-time,part-time,contract,internship',
                'experience_level' => 'nullable|in:junior,mid,senior,lead',
                'salary_min' => 'nullable|integer|min:0',
                'salary_max' => 'nullable|integer|min:0|gte:salary_min',
            ],
            [
                'title.required' => 'The job title is required.',
                'title.min' => 'The job title must be at least 3 characters long.',
                'description.required' => 'A job description is required.',
                'description.min' => 'The job description must be at least 10 characters long.',
                'status.required' => 'Please select a status for the job.',
                'employment_type.required' => 'Please select an employment type.',
                'salary_max.gte' => 'The maximum salary must be greater than or equal to the minimum salary.',
            ]
        );

        $job = Job::updateOrCreate(
            ['id' => optional($this->job)->id],
            [
                'company_id' => Auth::user()->company_id,
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'department' => $this->department,
                'location' => $this->location,
                'employment_type' => $this->employment_type,
                'experience_level' => $this->experience_level,
                'salary_min' => $this->salary_min,
                'salary_max' => $this->salary_max,
                'created_by' => Auth::id(),
            ]
        );

        // 🔥 Create default stages ONLY for new job
        if ($job->wasRecentlyCreated) {

            $defaultStages = [
                ['name' => 'New', 'sort_order' => 1],
                ['name' => 'Shortlisted', 'sort_order' => 2],
                ['name' => 'Interview', 'sort_order' => 3],
                ['name' => 'Hired', 'sort_order' => 4],
                ['name' => 'Rejected', 'sort_order' => 5],
            ];

            foreach ($defaultStages as $stage) {
                $job->stages()->create([
                    'company_id' => Auth::user()->company_id,
                    'name' => $stage['name'],
                    'sort_order' => $stage['sort_order'],
                    'is_active' => true,
                ]);
            }
        }


        return redirect()->route('company.jobs');
    }

    public function render()
    {
        return view('livewire.company.jobs.job-form');
    }
}
