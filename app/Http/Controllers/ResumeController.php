<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function show(Application $application)
    {
        // 🔐 Security check
        abort_if(
            $application->job->company_id !== Auth::user()->company_id,
            403
        );

        abort_if(! $application->resume_path, 404);

        return response()->file(
            storage_path('app/public/' . $application->resume_path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="resume.pdf"',
            ]
        );
    }
}
