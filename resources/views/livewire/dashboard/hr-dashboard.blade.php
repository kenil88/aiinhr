<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">Overview of your hiring pipeline and recent activity.</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Active Jobs -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                <p class="text-2xl font-bold text-gray-900">{{ $activeJobs }}</p>
            </div>
        </div>

        <!-- Total Candidates -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-green-50 text-green-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Total Candidates</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalCandidates }}</p>
            </div>
        </div>

        <!-- Shortlisted -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Shortlisted</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pipelineCounts['shortlisted'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Pipeline Overview -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-8">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Pipeline Overview</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ([
                    'new' => ['label' => 'New', 'color' => 'bg-blue-50 text-blue-700'],
                    'shortlisted' => ['label' => 'Shortlisted', 'color' => 'bg-yellow-50 text-yellow-700'],
                    'interview_scheduled' => ['label' => 'Interview', 'color' => 'bg-purple-50 text-purple-700'],
                    'hired' => ['label' => 'Hired', 'color' => 'bg-green-50 text-green-700']
                ] as $key => $config)
                    <div class="rounded-xl border border-gray-100 p-4 text-center hover:shadow-md transition-shadow">
                        <p class="text-sm font-medium text-gray-500 mb-1">{{ $config['label'] }}</p>
                        <div class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-bold {{ $config['color'] }}">
                            {{ $pipelineCounts[$key] ?? 0 }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Jobs -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Jobs</h3>
                <a href="{{ route('company.jobs') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
            </div>
            <div class="flex-1 overflow-y-auto max-h-[400px]">
                <ul role="list" class="divide-y divide-gray-100">
                    @forelse ($recentJobs as $job)
                        <li class="px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $job->title }}</p>
                                    <div class="flex items-center mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $job->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500 ml-2">{{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('company.jobs.applications', $job->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Candidates
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-8 text-center text-gray-500 text-sm">
                            No jobs posted yet.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Applications</h3>
                <a href="{{ route('company.candidates.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
            </div>
            <div class="flex-1 overflow-y-auto max-h-[400px]">
                <ul role="list" class="divide-y divide-gray-100">
                    @forelse ($recentApplications as $app)
                        <li class="px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-sm">
                                        {{ substr($app->candidate->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $app->candidate->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $app->job->title ?? 'Unknown Job' }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">
                                        {{ str_replace('_', ' ', $app->status) }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-1">{{ $app->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-8 text-center text-gray-500 text-sm">
                            No applications received yet.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
