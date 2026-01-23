<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\Application;
use App\Models\CandidateActivity;
use App\Models\HiringStage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class JobApplications extends Component
{
    public Job $job;

    public $stageSelections = [];

    public function mount(Job $job)
    {
        // Security: ensure job belongs to company
        abort_if(
            $job->company_id !== Auth::user()->company_id,
            403
        );

        foreach ($this->job->applications as $application) {
            $this->stageSelections[$application->id] = $application->stage_id;
        }


        $this->job = $job->load([
            'stages' => fn($q) => $q->where('is_active', true)->orderBy('sort_order'),
            'applications.candidate',
            'applications.stage',
        ]);
    }

    public function updateStage($applicationId, $stageId)
    {
        abort_if(Auth::user()->isViewer(), 403);

        $application = Application::where('id', $applicationId)
            ->where('job_id', $this->job->id)
            ->firstOrFail();

        $stage = HiringStage::where('id', $stageId)
            ->where('job_id', $this->job->id)
            ->firstOrFail();

        // Prevent unnecessary updates
        if ($application->stage_id === $stage->id) {
            return;
        }

        $oldStage = $application->stage?->name ?? 'None';

        $application->update([
            'stage_id' => $stage->id,
        ]);

        // Log activity
        CandidateActivity::create([
            'company_id' => Auth::user()->company_id,
            'candidate_id' => $application->candidate_id,
            'job_id' => $this->job->id,
            'user_id' => Auth::id(),
            'type' => 'stage_changed',
            'message' => "Stage changed from {$oldStage} to {$stage->name}",
        ]);
    }

    public function render()
    {
        return view('admin.livewire.company.jobs.job-applications', [
            'applications' => $this->job
                ->applications()
                ->with(['stage', 'candidate'])
                ->get(),

            'stages' => $this->job
                ->stages()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
        ]);
    }
}
