<?php

namespace App\Livewire\Dashboard;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('admin.layouts.app-sidebar')]
class HrDashboard extends Component
{
    public function render()
    {
        $companyId = Auth::user()->company_id;
        $user = Auth::user();

        return view('admin.livewire.dashboard.hr-dashboard', [

            // Open jobs
            'activeJobs' => Job::where('company_id', $companyId)
                ->where('status', 'open')
                ->count(),

            // Unique candidates who applied to jobs
            'totalCandidates' => Application::where('company_id', $companyId)
                ->whereNotNull('job_id')
                ->distinct('candidate_id')
                ->count('candidate_id'),

            // Pipeline counts by stage
            'pipelineCounts' => Application::query()
                ->join('hiring_stages', 'applications.stage_id', '=', 'hiring_stages.id')
                ->where('applications.company_id', $companyId)
                ->whereNotNull('applications.job_id')
                ->where('hiring_stages.is_active', true)
                ->selectRaw('LOWER(hiring_stages.name) as stage, COUNT(*) as total')
                ->groupBy('stage')
                ->pluck('total', 'stage'),

            // Recent jobs
            'recentJobs' => Job::where('company_id', $companyId)
                ->latest()
                ->limit(5)
                ->get(),

            // Recent applications (job only)
            'recentApplications' => Application::where('company_id', $companyId)
                ->whereNotNull('job_id')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
