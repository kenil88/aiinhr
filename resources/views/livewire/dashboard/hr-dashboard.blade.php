<div class="p-6 space-y-6">

    <h1 class="text-2xl font-semibold">HR Dashboard</h1>
    <div class="flex gap-3 mb-6">
        <a href="#"
        class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
            Upload Resume
        </a>

        <a href="#"
        class="border px-4 py-2 rounded text-sm hover:bg-gray-50">
            Manage Jobs
        </a>
    </div>

    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-lg shadow-sm border">
            <p class="text-sm text-gray-500">Active Jobs</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $activeJobs }}</p>
        </div>

        <div class="bg-white p-5 rounded-lg shadow-sm border">
            <p class="text-sm text-gray-500">Total Candidates</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalCandidates }}</p>
        </div>

        <div class="bg-white p-5 rounded-lg shadow-sm border">
            <p class="text-sm text-gray-500">Shortlisted</p>
            <p class="text-3xl font-bold text-yellow-600">
                {{ $pipelineCounts['shortlisted'] ?? 0 }}
            </p>
        </div>
    </div>

    <!-- PIPELINE SUMMARY -->
    <div class="bg-white p-5 rounded-lg shadow-sm border">
        <h2 class="text-lg font-semibold mb-4">Pipeline Overview</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ([
                'new' => 'New',
                'shortlisted' => 'Shortlisted',
                'interview_scheduled' => 'Interview',
                'hired' => 'Hired'
            ] as $key => $label)
                <div class="p-3 bg-gray-50 rounded text-center">
                    <p class="text-sm text-gray-500">{{ $label }}</p>
                    <p class="text-xl font-semibold">
                        {{ $pipelineCounts[$key] ?? 0 }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- RECENT JOBS -->
    <div class="bg-white p-5 rounded-lg shadow-sm border">
        <h2 class="text-lg font-semibold mb-4">Recent Jobs</h2>

        @foreach ($recentJobs as $job)
            <div class="flex justify-between items-center py-2 border-b last:border-b-0">
                <div>
                    <p class="font-medium">{{ $job->title }}</p>
                    <p class="text-xs text-gray-500">
                        {{ ucfirst($job->status) }}
                    </p>
                </div>

                <a href="{{ route('company.jobs.applications', $job->id) }}"
                class="text-indigo-600 text-sm hover:underline">
                    View Candidates →
                </a>
            </div>
        @endforeach
    </div>


    <!-- RECENT CANDIDATES -->
    <div class="bg-white p-4 shadow rounded">
        <h2 class="font-semibold mb-3">Recent Applications</h2>

        @forelse ($recentApplications as $app)
            <div class="flex justify-between border-b py-2 text-sm">
                <span>{{ $app->candidate->name }}</span>
                <span class="capitalize">{{ str_replace('_',' ', $app->status) }}</span>
            </div>
        @empty
            <p class="text-sm text-gray-500">No applications yet.</p>
        @endforelse
    </div>

</div>
