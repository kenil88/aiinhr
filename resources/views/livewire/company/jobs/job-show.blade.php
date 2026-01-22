<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $job->title }}
            </h1>
            <p class="text-sm text-gray-500">
                {{ ucfirst($job->employment_type) }} · {{ $job->location ?? 'Remote' }}
            </p>
        </div>

        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
            {{ $job->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
            {{ ucfirst($job->status) }}
        </span>
    </div>

    <!-- TABS -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">

            <a href="{{ route('company.jobs.show', $job) }}"
               class="border-indigo-500 text-indigo-600 border-b-2 font-medium pb-2">
                Overview
            </a>

            <a href="{{ route('company.jobs.candidates', $job) }}"
               class="text-gray-500 hover:text-gray-700 pb-2">
                Candidates ({{ $totalCandidates }})
            </a>

            <a href="{{ route('company.jobs.stages', $job) }}"
               class="text-gray-500 hover:text-gray-700 pb-2">
                Hiring Stages
            </a>
        </nav>
    </div>

    <!-- OVERVIEW CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow border">
            <p class="text-sm text-gray-500">Candidates</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $totalCandidates }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border">
            <p class="text-sm text-gray-500">Salary Range</p>
            <p class="text-lg font-medium text-gray-900">
                @if($job->salary_min || $job->salary_max)
                    ₹{{ number_format($job->salary_min) }} – ₹{{ number_format($job->salary_max) }}
                @else
                    Not specified
                @endif
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border">
            <p class="text-sm text-gray-500">Experience Level</p>
            <p class="text-lg font-medium text-gray-900">
                {{ ucfirst($job->experience_level ?? 'Any') }}
            </p>
        </div>

    </div>

    <!-- DESCRIPTION -->
    <div class="bg-white p-6 rounded-lg shadow border mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
            Job Description
        </h3>

        <div class="prose max-w-none">
            {!! $job->description !!}
        </div>
    </div>

</div>
