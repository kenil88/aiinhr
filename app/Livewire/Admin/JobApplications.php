<?php

namespace App\Livewire\Admin;

use App\Models\Application;
use App\Models\Job;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin-sidebar')]
class JobApplications extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        $this->job = $job;
    }

    public function render()
    {
        return view('livewire.admin.job-applications', [
            'applications' => Application::where('job_id', $this->job->id)->latest()->get(),
        ]);
    }
}
