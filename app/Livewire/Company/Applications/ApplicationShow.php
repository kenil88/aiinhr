<?php

namespace App\Livewire\Company\Applications;

use Livewire\Component;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class ApplicationShow extends Component
{
    public Application $application;
    public $stages = [];
    public $stageId;

    public function mount(Application $application)
    {
        // 🔐 Security: ensure application belongs to company
        abort_if(
            $application->job->company_id !== Auth::user()->company_id,
            403
        );

        $this->application = $application;
        $this->stages = $this->application->job
            ->stages()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $this->stageId = $this->application->stage_id;
    }

    public function render()
    {
        return view('livewire.company.applications.application-show');
    }

    public function updateStage()
    {
        abort_if(auth()->user()->isViewer(), 403);

        if (!$this->stageId || $this->stageId == $this->application->stage_id) {
            return;
        }

        $stage = $this->stages->firstWhere('id', $this->stageId);

        if (!$stage) {
            return;
        }

        $old = $this->application->stage?->name ?? 'None';

        $this->application->update([
            'stage_id' => $stage->id,
        ]);

        // optional activity log
        // CandidateActivity::create([...]);

        session()->flash('success', 'Stage updated successfully.');
    }
}
