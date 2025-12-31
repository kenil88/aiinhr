<?php

namespace App\Livewire\Admin;

use App\Models\Job;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin-sidebar')]
class JobsIndex extends Component
{
    public $selectedJob = null;
    public $showDrawer = false;

    public function viewJob($jobId)
    {
        $this->selectedJob = Job::with('company')->find($jobId);
        $this->showDrawer = true;
    }

    public function closeDrawer()
    {
        $this->showDrawer = false;
        $this->selectedJob = null;
    }

    public function render()
    {
        return view('livewire.admin.jobs-index', [
            'jobs' => Job::with('company')
                ->withCount('applications')
                ->latest()
                ->get(),
        ]);
    }
}
