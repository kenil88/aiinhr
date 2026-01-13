@php
    use Illuminate\Support\Str;
@endphp

<div class="max-w-5xl">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold">
                {{ $application->candidate->name }}
            </h1>
            <p class="text-sm text-gray-500">
                Applied for {{ $application->job->title }}
            </p>
        </div>

        <a href="{{ route('company.jobs.applications', $application->job_id) }}"
           class="text-indigo-600 hover:underline text-sm">
            ← Back to Applications
        </a>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: CANDIDATE + RESUME -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6 space-y-6">

            <!-- Candidate Info -->
            <div>
                <h2 class="text-sm font-semibold text-gray-700 mb-2">
                    Candidate Information
                </h2>

                <p><strong>Name:</strong> {{ $application->candidate->name }}</p>
                <p><strong>Email:</strong> {{ $application->candidate->email }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="px-2 py-1 text-xs rounded bg-gray-100">
                        {{ ucfirst($application->stage->name ?? '--') }}
                    </span>
                </p>
            </div>

            <!-- Resume -->
            <div>
                <h2 class="text-sm font-semibold text-gray-700 mb-2">
                    Resume
                </h2>

                @if ($application->resume_path)
                    @php
                        $isPdf = Str::endsWith($application->resume_path, '.pdf');
                    @endphp

                    @if ($isPdf)
                        <iframe
                            src="{{ route('company.resume.show', $application->id) }}"
                            class="w-full h-[600px] border rounded">
                        </iframe>
                    @else
                        <a href="{{ route('company.resume.show', $application->id) }}"
                           class="text-indigo-600 hover:underline">
                            Download Resume
                        </a>
                    @endif
                @else
                    <p class="text-gray-500 text-sm">No resume uploaded.</p>
                @endif
            </div>

        </div>

        <!-- RIGHT: SIDEBAR -->
        <div class="space-y-6">

            <!-- Job Info -->
            <div class="bg-white rounded-lg shadow p-6 space-y-2">
                <h2 class="text-sm font-semibold text-gray-700">
                    Job Information
                </h2>

                <p><strong>Job:</strong> {{ $application->job->title }}</p>
                <p><strong>Job Stage:</strong> {{ ucfirst($application->job->status) }}</p>
                <p><strong>Applied On:</strong>
                    {{ $application->created_at->format('d M Y') }}
                </p>
            </div>

            <!-- Pipeline -->
            <div class="bg-white rounded-lg shadow p-4 space-y-3">
                <h2 class="text-sm font-semibold text-gray-700">
                    Pipeline Stage
                </h2>

                @if (!auth()->user()->isViewer())
                    <select
                        wire:model="stageId"
                        wire:change="updateStage"
                        class="w-full border rounded px-3 py-2 text-sm focus:ring-indigo-500"
                    >
                        @foreach ($stages as $stage)
                            <option value="{{ $stage->id }}">
                                {{ $stage->name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <span class="px-2 py-1 text-xs rounded bg-gray-100">
                        {{ $application->stage?->name ?? '—' }}
                    </span>
                @endif

                @if (session()->has('success'))
                    <p class="text-xs text-green-600">
                        {{ session('success') }}
                    </p>
                @endif
            </div>


        </div>

    </div>

    <!-- APPLICATION TIMELINE -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">
            Application Timeline
        </h2>

        <div class="space-y-4">
            @forelse ($timeline as $event)
                <div class="flex gap-3">
                    <!-- Dot -->
                    <div class="mt-1">
                        <span class="inline-block w-2 h-2 rounded-full bg-indigo-600"></span>
                    </div>

                    <!-- Content -->
                    <div class="text-sm">
                        <p class="text-gray-800">
                            {{ $event->message }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ $event->created_at->diffForHumans() }}
                            @if ($event->user)
                                · {{ $event->user->name }}
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    No activity yet.
                </p>
            @endforelse
        </div>
    </div>

</div>
