<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\HiringStage;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CandidateKanban extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        abort_if(
            $job->company_id !== Auth::user()->company_id,
            403
        );

        $this->job = $job;
    }

    public function moveCandidate($applicationId, $stageId)
    {
        $application = Application::findOrFail($applicationId);

        abort_unless($application->job_id === $this->job->id, 403);

        $application->update([
            'stage_id' => $stageId,
        ]);
    }

    public function render()
    {
        return view('livewire.company.jobs.candidate-kanban', [
            'stages' => HiringStage::where('job_id', $this->job->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            'applications' => Application::where('job_id', $this->job->id)
                ->with('candidate')
                ->get(),
        ]);
    }
}
