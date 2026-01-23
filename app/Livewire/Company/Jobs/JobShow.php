<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class JobShow extends Component
{
    public Job $job;
    public int $totalCandidates = 0;

    public function mount(Job $job)
    {
        abort_if(
            $job->company_id !== Auth::user()->company_id,
            403
        );

        $this->job = $job;

        $this->totalCandidates = Application::where('job_id', $job->id)->count();
    }

    public function render()
    {
        return view('admin.livewire.company.jobs.job-show');
    }
}
