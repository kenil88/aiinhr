<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class JobApplications extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        // Security: ensure job belongs to company
        abort_if(
            $job->company_id !== Auth::user()->company_id,
            403
        );

        $this->job = $job;
    }

    public function render()
    {
        return view('livewire.company.jobs.job-applications', [
            'applications' => Application::where('job_id', $this->job->id)
                ->latest()
                ->get(),
        ]);
    }
}
