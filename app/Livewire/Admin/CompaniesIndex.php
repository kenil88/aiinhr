<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin-sidebar')]
class CompaniesIndex extends Component
{
    public $selectedCompany = null;
    public $showDrawer = false;

    public function viewCompany($companyId)
    {
        $this->selectedCompany = Company::with('users')->find($companyId);
        $this->showDrawer = true;
    }

    public function closeDrawer()
    {
        $this->showDrawer = false;
        $this->selectedCompany = null;
    }

    public function render()
    {
        return view('livewire.admin.companies-index', [
            'companies' => Company::withCount([
                'users',
                'jobs'
            ])->latest()->get(),
        ]);
    }

    public function toggleStatus($companyId)
    {
        $company = Company::find($companyId);
        if ($company) {
            $company->is_active = !$company->is_active;
            $company->save();
        }
    }
}
