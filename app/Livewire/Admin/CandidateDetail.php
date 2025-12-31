<?php

namespace App\Livewire\Admin;

use App\Models\Application;
use App\Services\ResumeAiService;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-sidebar')]
class CandidateDetail extends Component
{
    public Application $application;

    public function mount(Application $application)
    {
        $this->application = $application->load('job.company');
    }

    public function render()
    {
        return view('livewire.admin.candidate-detail');
    }

    public function generateAiAnalysis(ResumeAiService $service)
    {
        if ($this->application->ai_score) {
            return; // already generated
        }

        // Extract resume text (for MVP: assume text already stored)
        $resumeText = $this->application->resume_text ?? '';

        $jobDescription = $this->application->job->description;

        $result = $service->analyze($resumeText, $jobDescription);

        $this->application->update([
            'ai_score' => $result['score'] ?? null,
            'ai_summary' => implode("\n", $result['summary'] ?? []),
            'ai_breakdown' => $result['breakdown'] ?? null,
        ]);
    }
}
