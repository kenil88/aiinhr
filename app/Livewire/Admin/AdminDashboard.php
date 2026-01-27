<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Company;
use App\Models\User;
use App\Models\Application;
use App\Models\Job;

#[Layout('admin.layouts.admin-sidebar')]
class AdminDashboard extends Component
{
    public function render()
    {
        return view('admin.livewire.admin.admin-dashboard', [
            'totalCompanies' => Company::count(),
            'activeCompanies' => Company::where('is_active', true)->count(),
            'disabledCompanies' => Company::where('is_active', false)->count(),
            'totalUsers' => User::where('role', '!=', 'admin')->count(),
            'totalJobs' => Job::count(),
            'totalCandidates' => Application::count(),
            'recentCompanies' => Company::latest()->limit(5)->get(),
        ]);
    }
}
