<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Application;
use App\Services\AI\ResumeAnalysisService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ApplicationShow extends Component
{
    public Application $application;

    public function mount(Application $application)
    {
        // 🔐 Admin-only access
        abort_if(!Auth::user()->isAdmin(), 403);

        // ❌ Block placeholder applications
        abort_if($application->job_id === null, 404);

        $this->application = $application;
    }

    public function generateAiAnalysis(ResumeAnalysisService $service)
    {
        // ❌ Prevent re-run
        abort_if($this->application->ai_result !== null, 403);

        $result = $service->analyze($this->application);

        $this->application->update([
            'ai_result' => $result,,
            'overall_score' => $result['score'],
        ]);

        session()->flash('success', 'AI resume analysis generated.');
    }

    public function render()
    {
        return view('livewire.admin.application-show');
    }
}
