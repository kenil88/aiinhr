<?php

namespace App\Livewire\Company\Candidates;

use Livewire\Component;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CandidateShow extends Component
{
    public Candidate $candidate;

    public function mount(Candidate $candidate)
    {
        abort_if(
            $candidate->company_id !== Auth::user()->company_id,
            403
        );

        $this->candidate = $candidate->load('applications.job');
    }

    public function render()
    {
        return view('livewire.company.candidates.candidate-show');
    }
}
