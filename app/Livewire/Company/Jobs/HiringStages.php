<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\HiringStage;
use App\Models\Job;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class HiringStages extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        abort_unless(
            $job->company_id === auth()->user()->company_id,
            403
        );

        $this->job = $job;
    }


    public function moveUp($stageId)
    {
        $stage = HiringStage::findOrFail($stageId);

        $previous = HiringStage::where('job_id', $stage->job_id)
            ->where('sort_order', '<', $stage->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if (! $previous) return;

        $this->swapOrder($stage, $previous);
    }

    public function moveDown($stageId)
    {
        $stage = HiringStage::findOrFail($stageId);

        $next = HiringStage::where('job_id', $stage->job_id)
            ->where('sort_order', '>', $stage->sort_order)
            ->orderBy('sort_order')
            ->first();

        if (! $next) return;

        $this->swapOrder($stage, $next);
    }

    private function swapOrder($a, $b)
    {
        [$a->sort_order, $b->sort_order] = [$b->sort_order, $a->sort_order];
        $a->save();
        $b->save();
    }

    public function render()
    {
        return view('admin.livewire.company.jobs.hiring-stages', [
            'stages' => HiringStage::where('job_id', $this->job->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
        ]);
    }
}
