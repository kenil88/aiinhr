<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
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
            $this->job = $job;
            $this->fill($job->toArray());
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'status' => 'required|in:open,closed',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,internship',
            'experience_level' => 'nullable|in:junior,mid,senior,lead',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0|gte:salary_min',
        ]);

        Job::updateOrCreate(
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

        return redirect()->route('company.jobs');
    }

    public function render()
    {
        return view('livewire.company.jobs.job-form');
    }
}
