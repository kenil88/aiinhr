<div>
<x-admin-breadcrumbs :items="[
    ['label' => 'Admin', 'url' => route('admin.dashboard')],
    ['label' => 'Jobs', 'url' => route('admin.jobs')],
    ['label' => 'Applications'],
]" />
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Candidate Detail
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            {{ $application->job->title }}
            · {{ $application->job->company->name }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- CANDIDATE INFO -->
        <div class="bg-white shadow rounded p-4 space-y-2">
            <h3 class="font-semibold text-gray-600 mb-2">Candidate Info</h3>

            <p><strong>Name:</strong> {{ $application->candidate->name ?? '—' }}</p>
            <p><strong>Email:</strong> {{ $application->candidate->email ?? '—' }}</p>
            <p><strong>Phone:</strong> {{ $application->candidate->phone ?? '—' }}</p>
        </div>

        <!-- APPLICATION INFO -->
        <div class="bg-white shadow rounded p-4 space-y-2">
            <h3 class="font-semibold text-gray-600 mb-2">Application</h3>

            <p><strong>Status:</strong>
                <span class="capitalize">
                    {{ str_replace('_',' ', $application->status) }}
                </span>
            </p>

            <p><strong>Applied On:</strong>
                {{ $application->created_at->format('d M Y') }}
            </p>
        </div>

        <!-- RESUME -->
        <div class="bg-white shadow rounded p-4 md:col-span-2">
            <h3 class="font-semibold text-gray-600 mb-3">Resume</h3>

            @if ($application->resume_path)
                @php
                    $resumeUrl = asset('storage/' . $application->resume_path);
                @endphp

                <!-- PDF PREVIEW -->
                <div class="border rounded overflow-hidden mb-3" style="height: 600px;">
                    <iframe
                        src="{{ $resumeUrl }}"
                        class="w-full h-full"
                        frameborder="0">
                    </iframe>
                </div>

                <!-- ACTIONS -->
                <div class="flex gap-4 text-sm">
                    <a href="{{ $resumeUrl }}"
                    target="_blank"
                    class="text-indigo-600 hover:underline">
                        Open in new tab
                    </a>

                    <a href="{{ $resumeUrl }}"
                    download
                    class="text-gray-600 hover:underline">
                        Download
                    </a>
                </div>
            @else
                <p class="text-sm text-gray-500">No resume uploaded</p>
            @endif
        </div>


    </div>

    <div class="mt-6">
        <a href="{{ url()->previous() }}"
           class="text-sm text-indigo-600 hover:underline">
            ← Back
        </a>
    </div>
</div>

<div class="bg-white shadow rounded p-4 md:col-span-2 mt-6">
    <h3 class="font-semibold text-gray-600 mb-3">
        AI Resume Analysis
    </h3>

    @if ($application->ai_score)
        <div class="flex items-center gap-4 mb-4">
            <div class="text-3xl font-bold text-indigo-600">
                {{ $application->ai_score }}/100
            </div>
            <span class="text-sm text-gray-500">
                Match Score
            </span>
        </div>

        <div class="text-sm mb-4 whitespace-pre-line">
            {{ $application->ai_summary }}
        </div>

        <div class="text-sm space-y-2">
            <p><strong>Skills:</strong> {{ $application->ai_breakdown['skills_match'] ?? '—' }}</p>
            <p><strong>Experience:</strong> {{ $application->ai_breakdown['experience_match'] ?? '—' }}</p>
            <p><strong>Gaps:</strong> {{ $application->ai_breakdown['missing_gaps'] ?? '—' }}</p>
        </div>
    @else
        <button
            wire:click="generateAiAnalysis"
            class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">
            Generate AI Analysis
        </button>
        <span wire:loading>Generating...</span>
        <p class="text-xs text-gray-500 mt-2">
            This will use AI credits and run once.
        </p>
    @endif
</div>
</div>
