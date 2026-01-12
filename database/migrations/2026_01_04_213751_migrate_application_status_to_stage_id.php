<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Application;
use App\Models\HiringStage;

return new class extends Migration {
    public function up(): void
    {
        // Load only applications with old status
        $applications = Application::whereNotNull('status')->get();

        foreach ($applications as $application) {
            if (!$application->job_id) {
                continue;
            }

            $stage = HiringStage::where('job_id', $application->job_id)
                ->where('name', ucfirst($application->status))
                ->first();

            if ($stage) {
                $application->update([
                    'stage_id' => $stage->id,
                ]);
            }
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
};
