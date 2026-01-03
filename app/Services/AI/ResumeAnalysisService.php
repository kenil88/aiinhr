<?php

namespace App\Services\AI;

use App\Models\Application;
use App\Models\AiUsage;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class ResumeAnalysisService
{
    public function analyze(Application $application): array
    {
        try {
            // 🔐 Prevent duplicate AI runs
            if ($application->ai_result !== null) {
                throw new \Exception('AI analysis already exists.');
            }

            if (empty($application->resume_text)) {
                throw new \Exception('Resume text not available.');
            }

            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<PROMPT
                            You are an Applicant Tracking System (ATS) resume evaluator.

                            Rules:
                            - Return ONLY valid JSON
                            - Do NOT include explanations
                            - Do NOT wrap in markdown
                            - Score must be between 0 and 100

                            JSON format:
                            {
                            "score": number,
                            "strengths": string[],
                            "gaps": string[],
                            "summary": string,
                            "recommendation": "Strong Hire" | "Hire" | "Review" | "Reject"
                            }
                            PROMPT
                    ],
                    [
                        'role' => 'user',
                        'content' => $application->resume_text
                    ],
                ],
            ]);

            $content = $response->choices[0]->message->content ?? '';

            // 🛡️ Validate JSON
            $data = json_decode($content, true);

            if (
                !is_array($data) ||
                !isset(
                    $data['score'],
                    $data['strengths'],
                    $data['gaps'],
                    $data['summary'],
                    $data['recommendation']
                )
            ) {
                throw new \Exception('Invalid AI response format.');
            }

            // ✅ Log success
            AiUsage::create([
                'company_id' => $application->company_id,
                'application_id' => $application->id,
                'provider' => 'openai',
                'model' => 'gpt-4o-mini',
                'prompt_tokens' => $response->usage->promptTokens ?? null,
                'completion_tokens' => $response->usage->completionTokens ?? null,
                'total_tokens' => $response->usage->totalTokens ?? null,
                'status' => 'success',
            ]);

            return $data;
        } catch (Throwable $e) {

            // ❌ Log failure
            AiUsage::create([
                'company_id' => $application->company_id,
                'application_id' => $application->id,
                'provider' => 'openai',
                'status' => 'failed',
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
