<div>
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Talent Pool</h1>
    </div>
    <!-- FILTERS -->
    <div class="flex flex-wrap gap-4 mb-4">

        <!-- Search -->
        <input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="Search name or email..."
            class="border rounded px-3 py-2 text-sm w-64"
        >

        <!-- Resume Filter -->
        <select
            wire:model.live.debounce.500ms="resumeFilter"
            class="border rounded px-3 py-2 text-sm"
        >
            <option value="all">All Candidates</option>
            <option value="uploaded">Resume Uploaded</option>
            <option value="missing">Resume Missing</option>
        </select>

        <!-- Per Page -->
        <select
            wire:model.live.debounce.500ms="perPage"
            class="border rounded px-3 py-2 text-sm"
        >
            <option value="10">10 / page</option>
            <option value="20">20 / page</option>
            <option value="50">50 / page</option>
        </select>

    </div>

    <div class="bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Candidate</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Applications</th>
                    <th class="p-3">Added On</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($candidates as $candidate)
                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            {{ $candidate->name }}

                            @if($this->hasResume($candidate))
                                <span class="ml-2 inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    Resume Uploaded
                                </span>
                            @endif
                        </td>

                        <td class="p-3">
                            {{ $candidate->email }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $candidate->applications_count }}
                        </td>

                        <td class="p-3">
                            {{ $candidate->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3 space-x-4 text-center">
                            <a href="{{ route('company.candidates.show', $candidate->id) }}"
                               class="text-indigo-600 hover:underline text-sm">
                                View
                            </a>
                       
                            <button
                                wire:click="openAssignModal({{ $candidate->id }})"
                                class="text-indigo-600 hover:underline text-sm">
                                Add to Job
                            </button>

                            @if (! $this->hasResume($candidate))
                                <button
                                    wire:click.prevent="openResumeModal({{ $candidate->id }})"
                                    class="ml-2 text-sm text-indigo-600 hover:underline">
                                    Upload Resume
                                </button>
                            @endif

                            @if ($this->hasResume($candidate))
                                <button
                                    wire:click.prevent="openResumePreview({{ $candidate->id }})"
                                    class="ml-2 text-sm text-indigo-600 hover:underline">
                                    View Resume
                                </button>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="p-6 text-center text-gray-500">
                            No candidates found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $candidates->links() }}
        </div>

    </div>

@if ($showAssignModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg p-6 w-full max-w-md space-y-4">

            <h2 class="text-lg font-semibold">
                Assign Candidate to Job
            </h2>

            <select wire:model="selectedJobId"
                    class="w-full border rounded px-3 py-2">
                <option value="">Select Job</option>
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}">
                        @disabled(in_array($job->id, $appliedJobIds))
                        {{ $job->title }}
                        @if(in_array($job->id, $appliedJobIds)) (Already Applied) @endif
                    </option>
                @endforeach
            </select>

            @error('selectedJobId')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="flex justify-end gap-2">
                <button
                    wire:click="$set('showAssignModal', false)"
                    class="px-4 py-2 border rounded">
                    Cancel
                </button>

                <button
                    wire:click="assignToJob"
                    class="px-4 py-2 bg-indigo-600 text-white rounded">
                    Assign
                </button>
            </div>
        </div>
    </div>
@endif
@if ($showResumeModal)
<div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md space-y-4">

        <h2 class="text-lg font-semibold">
            Upload Resume
        </h2>

        <input type="file" wire:model="resume"
               class="w-full border rounded px-3 py-2">

        @error('resume')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div class="flex justify-end gap-2">
            <button
                wire:click="$set('showResumeModal', false)"
                class="px-4 py-2 border rounded">
                Cancel
            </button>

            <button
                wire:click="uploadResume"
                class="px-4 py-2 bg-indigo-600 text-white rounded">
                Upload
            </button>
        </div>
    </div>
</div>
@endif
@if ($showResumePreview)
<div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-4xl h-[80vh] p-4 relative">

        <button
            wire:click="$set('showResumePreview', false)"
            class="absolute top-3 right-3 text-gray-500 hover:text-black">
            ✕
        </button>

        <h2 class="text-lg font-semibold mb-3">
            Resume Preview
        </h2>

        @php
            $isPdf = str_ends_with($resumePreviewPath, '.pdf');
        @endphp

        @if ($isPdf)
            <iframe
                src="{{ asset('storage/' . $resumePreviewPath) }}"
                class="w-full h-full border rounded">
            </iframe>
        @else
            <div class="flex items-center justify-center h-full">
                <a href="{{ asset('storage/' . $resumePreviewPath) }}"
                   class="text-indigo-600 underline"
                   target="_blank">
                    Download Resume
                </a>
            </div>
        @endif
    </div>
</div>
@endif

</div>