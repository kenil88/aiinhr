<?php

namespace App\Livewire\Dashboard;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app-sidebar')]
class HrDashboard extends Component
{
    public function render()
    {
        $companyId = Auth::user()->company_id;

        $user = Auth::user();

        $isOwner = $user->role === 'owner';
        $isRecruiter = $user->role === 'recruiter';
        $isViewer = $user->role === 'viewer';

        return view('livewire.dashboard.hr-dashboard', [
            'activeJobs' => Job::where('company_id', $companyId)
                ->where('status', 'open')
                ->count(),
            'totalCandidates' => Application::where('company_id', $companyId)
                ->count(),
            'pipelineCounts' => Application::where('company_id', $companyId)
                ->selectRaw('status, COUNT(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),

            'recentJobs' => Job::where('company_id', $companyId)
                ->latest()
                ->limit(5)
                ->get(),

            'recentApplications' => Application::where('company_id', $companyId)
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
