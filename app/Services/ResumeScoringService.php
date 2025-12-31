<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ResumeScoringService
{
    public function analyze(string $jobDescription, string $resumeText): array
    {
        // Placeholder response (replace with OpenAI later)
        return [
            'overall_score' => null,
            'ai_summary' => null,
            'raw' => null,
        ];
    }
}
