<?php

namespace App\Livewire\Company\Candidates;

use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CandidatesIndex extends Component
{
    public function render()
    {
        return view('livewire.company.candidates.candidates-index', [
            'candidates' => Candidate::withCount('applications')
                ->where('company_id', Auth::user()->company_id)
                ->latest()
                ->get(),
        ]);
    }
}
