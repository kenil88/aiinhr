<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\HiringStage;
use App\Models\Application;
use App\Models\ApplicationStageHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('admin.layouts.app-sidebar')]
class CandidateKanban extends Component
{
    public Job $job;
    public $applications; // 🔥
    public function mount(Job $job)
    {
        abort_if(
            $job->company_id !== Auth::user()->company_id,
            403
        );

        $this->job = $job;
    }

    // public function moveCandidate($applicationId, $stageId)
    // {
    //     Log::info('MOVE CANDIDATE', [
    //         'application_id' => $applicationId,
    //         'to_stage' => $stageId,
    //     ]);

    //     $application = Application::findOrFail($applicationId);

    //     abort_unless($application->job_id === $this->job->id, 403);

    //     if ($application->stage_id == $stageId) {
    //         return;
    //     }

    //     // ApplicationStageHistory::create([
    //     //     'application_id' => $application->id,
    //     //     'from_stage_id'  => $application->stage_id,
    //     //     'to_stage_id'    => $stageId,
    //     //     'moved_by'       => Auth::user(),
    //     // ]);

    //     $application->update([
    //         'stage_id' => $stageId,
    //     ]);

    //     $this->dispatch('$refresh');
    // }

    public function moveCandidate($applicationId, $stageId)
    {
        $application = Application::findOrFail($applicationId);

        abort_unless($application->job_id === $this->job->id, 403);

        if ((int)$application->stage_id === (int)$stageId) {
            return;
        }

        // Save history (already added)
        $application->stageHistories()->create([
            'from_stage_id' => $application->stage_id,
            'to_stage_id'   => $stageId,
            'moved_by'      => Auth::user(),
        ]);

        $application->update(['stage_id' => $stageId]);

        // 🔥 reload applications
        $this->applications = Application::where('job_id', $this->job->id)
            ->with('candidate')
            ->get();
    }


    public function render()
    {
        return view('admin.livewire.company.jobs.candidate-kanban', [
            'stages' => HiringStage::where('job_id', $this->job->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            'applications' => Application::where('job_id', $this->job->id)
                ->with('candidate')
                ->get(),
        ]);
    }



    #[On('candidateMoved')]
    public function handleCandidateMoved($applicationId, $stageId)
    {
        $this->moveCandidate($applicationId, $stageId);
    }

    public function getStageCountsProperty()
    {
        return $this->applications
            ->groupBy('stage_id')
            ->map(fn($group) => $group->count());
    }
}
