<?php

namespace App\Livewire\Company\Jobs;

use App\Models\Job;
use App\Support\CompanyLimits;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class JobsIndex extends Component
{
    public function toggleStatus($jobId)
    {
        $job = Job::where('id', $jobId)
            ->where('company_id', Auth::user()->company_id)
            ->firstOrFail();

        $newStatus = $job->status === 'open' ? 'closed' : 'open';

        $job->update([
            'status' => $newStatus,
        ]);

        $this->dispatch('toast', message: 'Job status updated successfully', type: 'success');
    }

    public function render()
    {
        return view('admin.livewire.company.jobs.jobs-index', [
            'jobs' => Job::where('company_id', Auth::user()->company_id)
                ->withCount('applications')
                ->latest()
                ->get(),
            'canCreateJob' => CompanyLimits::canCreateJob(Auth::user()->company),
        ]);
    }

    public function getCanCreateJobProperty()
    {
        return CompanyLimits::canCreateJob(Auth::user()->company);
    }
}
