@php
    use Illuminate\Support\Str;
@endphp

<div>
    <!-- HEADER -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $application->candidate->name }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Applied for <span class="font-medium text-gray-900">{{ $application->job->title }}</span>
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('company.jobs.applications', $application->job_id) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Back to Applications
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- LEFT COLUMN -->
        <div class="lg:col-span-2 space-y-8">
            <!-- CANDIDATE INFO -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Candidate Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Personal details and application status.</p>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->candidate->name }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->candidate->email }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Current Stage</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ ucfirst($application->stage->name ?? '--') }}
                                </span>
                            </dd>
                        </div>
                         <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Applied On</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- RESUME -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Resume</h3>
                </div>
                <div class="p-6">
                    @if ($application->resume_path)
                        @php
                            $isPdf = Str::endsWith($application->resume_path, '.pdf');
                        @endphp

                        @if ($isPdf)
                            <iframe
                                src="{{ route('company.resume.show', $application->id) }}"
                                class="w-full h-[600px] border border-gray-200 rounded-md">
                            </iframe>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div class="mt-4">
                                    <a href="{{ route('company.resume.show', $application->id) }}"
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Download Resume
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500 text-sm italic">No resume uploaded.</p>
                    @endif
                </div>
            </div>

            <!-- APPLICATION TIMELINE -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Application Timeline</h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @forelse ($timeline as $event)
                                <li>
                                    <div class="relative pb-8">
                                        @if (!$loop->last)
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">{{ $event->message }} <span class="font-medium text-gray-900">{{ $event->user ? 'by ' . $event->user->name : '' }}</span></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="{{ $event->created_at }}">{{ $event->created_at->diffForHumans() }}</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p class="text-sm text-gray-500">No activity recorded.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-8">
            <!-- JOB INFO -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Job Details</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Position</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->job->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($application->job->status) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- PIPELINE ACTION -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Move Stage</h3>
                    <p class="mt-1 text-sm text-gray-500">Update candidate progress.</p>
                </div>
                <div class="p-6">
                    @if (!auth()->user()->isViewer())
                        <label for="stage" class="block text-sm font-medium text-gray-700">Select Stage</label>
                        <select
                            id="stage"
                            wire:model="stageId"
                            wire:change="updateStage"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        >
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">
                                    {{ $stage->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="text-sm text-gray-500">
                            Current Stage: <span class="font-medium text-gray-900">{{ $application->stage?->name ?? '—' }}</span>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="mt-2 text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
