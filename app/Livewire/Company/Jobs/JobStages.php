<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Job;
use App\Models\HiringStage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class JobStages extends Component
{
    public Job $job;

    public $newStageName = '';

    public function mount(Job $job)
    {
        abort_if($job->company_id !== Auth::user()->company_id, 403);

        $this->job = $job;
    }

    public function addStage()
    {
        $this->validate([
            'newStageName' => 'required|string|max:50',
        ]);

        $maxOrder = $this->job->stages()->max('sort_order') ?? 0;

        HiringStage::create([
            'job_id' => $this->job->id,
            'name' => $this->newStageName,
            'sort_order' => $maxOrder + 1,
        ]);

        $this->reset('newStageName');
    }

    public function toggleStage($stageId)
    {
        $stage = HiringStage::where('job_id', $this->job->id)
            ->where('id', $stageId)
            ->firstOrFail();

        $stage->update([
            'is_active' => ! $stage->is_active,
        ]);
    }

    public function render()
    {
        return view('livewire.company.jobs.job-stages', [
            'stages' => $this->job->stages()->orderBy('sort_order')->get(),
        ]);
    }

    public function reorderStages($orderedIds)
    {
        abort_if(Auth::user()->isViewer(), 403);

        foreach ($orderedIds as $index => $stageId) {
            HiringStage::where('id', $stageId)
                ->where('job_id', $this->job->id)
                ->update([
                    'sort_order' => $index + 1,
                ]);
        }
    }
}
