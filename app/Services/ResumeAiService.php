<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class ResumeAiService
{

    public function analyze(string $resumeText, string $jobDescription): array
    {
        $prompt = "
            You are an ATS resume analyzer.

            Job Description:
            {$jobDescription}

            Candidate Resume:
            {$resumeText}

            Return JSON ONLY with:
            {
            \"score\": number between 0-100,
            \"summary\": short professional summary (max 4 bullet points),
            \"breakdown\": {
                \"skills_match\": \"...\",
                \"experience_match\": \"...\",
                \"missing_gaps\": \"...\"
            }
            }
            ";

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return json_decode(
            $response->choices[0]->message->content,
            true
        );
    }
}
