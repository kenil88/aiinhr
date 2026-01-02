<?php

namespace App\Livewire\Company\Candidates;

use Livewire\Component;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CandidateShow extends Component
{
    public Candidate $candidate;
    public $activities = [];

    public function mount(Candidate $candidate)
    {
        abort_if(
            $candidate->company_id !== Auth::user()->company_id,
            403
        );

        $this->candidate = $candidate->load(['applications' => function ($q) {
            $q->whereNotNull('job_id')->with('job');
        }]);

        $this->activities = CandidateActivity::where('candidate_id', $this->candidate->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.company.candidates.candidate-show');
    }
}
