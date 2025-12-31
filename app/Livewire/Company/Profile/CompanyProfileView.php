<?php

namespace App\Livewire\Company\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CompanyProfileView extends Component
{
    public function render()
    {
        return view('livewire.company.profile.company-profile-view', [
            'company' => auth()->user()->company,
        ]);
    }
}
