<?php

namespace App\Livewire\Company\Candidates;

use App\Models\Application;
use Livewire\Component;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class CandidateShow extends Component
{
    public Candidate $candidate;
    public $activities = [];
    public $noteText = '';
    public ?Application $application = null;

    public function mount(Candidate $candidate)
    {
        abort_if(
            $candidate->company_id !== Auth::user()->company_id,
            403
        );

        $this->candidate = $candidate->load([
            'applications' => function ($q) {
                $q->whereNotNull('job_id')->with('job');
            },
            'notes.user'
        ]);

        $this->application = Application::where('candidate_id', $this->candidate->id)
            ->with([
                'candidate',
                'job',
                'stage',
                'stageHistories.fromStage',
                'stageHistories.toStage',
                'stageHistories.movedBy',
            ])
            ->latest()
            ->first();

        $this->activities = CandidateActivity::where('candidate_id', $this->candidate->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('admin.livewire.company.candidates.candidate-show');
    }

    public function addNote()
    {
        $this->validate([
            'noteText' => 'required|string|max:5000',
        ]);

        $note = $this->candidate->notes()->create([
            'company_id' => Auth::user()->company_id,
            'candidate_id' => $this->candidate->id,
            'user_id' => Auth::id(),
            'note' => $this->noteText,
        ]);

        // Clear the note text
        $this->reset('noteText');

        // Refresh notes
        $this->candidate->load('notes.user');
    }
}
