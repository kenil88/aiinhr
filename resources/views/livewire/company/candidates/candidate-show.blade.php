<div class="max-w-6xl">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold">
                {{ $candidate->name }}
            </h1>
            <p class="text-sm text-gray-500">
                {{ $candidate->email }}
            </p>
        </div>

        <a href="{{ route('company.candidates.index') }}"
           class="text-indigo-600 hover:underline text-sm">
            ← Back to Talent Pool
        </a>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: CANDIDATE INFO -->
        <div class="bg-white rounded-lg shadow p-6 space-y-3">
            <h2 class="text-sm font-semibold text-gray-700">
                Candidate Information
            </h2>

            <p><strong>Name:</strong> {{ $candidate->name }}</p>
            <p><strong>Email:</strong> {{ $candidate->email }}</p>
            <p><strong>Phone:</strong> {{ $candidate->phone ?? '—' }}</p>
            <p><strong>Added On:</strong>
                {{ $candidate->created_at->format('d M Y') }}
            </p>
        </div>

        <!-- RIGHT: APPLICATIONS -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="p-4 border-b font-semibold">
                Applications ({{ $candidate->applications->count() }})
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Job</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Applied</th>
                        <th class="p-3">Action</th>
                        <th class="p-3">AI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($candidate->applications as $application)
                        <tr class="border-t">
                            @if($application->job)
                            <td class="p-3 font-medium">
                                {{ $application->job->title }}
                            </td>
                            @endif

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                            </td>

                            <td class="p-3">
                                {{ $application->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3">
                                <a href="{{ route('company.applications.show', $application->id) }}"
                                   class="text-indigo-600 hover:underline text-sm">
                                    View Application
                                </a>
                            </td>
                            <td class="p-3">
                                @php($badge = $application->aiBadge())
                                <span class="px-2 py-1 text-xs rounded {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="p-6 text-center text-gray-500">
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- ACTIVITY TIMELINE -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">
            Activity Timeline
        </h2>

        @if ($activities->isEmpty())
            <p class="text-sm text-gray-500">
                No activity recorded yet.
            </p>
        @else
            <ol class="relative border-l border-gray-200">
                @foreach ($activities as $activity)
                    <li class="mb-6 ml-4">
                        <div
                            class="absolute w-3 h-3 bg-indigo-500 rounded-full
                                -left-1.5 border border-white">
                        </div>

                        <p class="text-sm font-medium text-gray-900">
                            {{ $activity->message }}
                        </p>

                        @if ($activity->job)
                            <p class="text-xs text-gray-500">
                                Job: {{ $activity->job->title }}
                            </p>
                        @endif

                        <time class="text-xs text-gray-400">
                            {{ $activity->created_at->diffForHumans() }}
                        </time>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-4 border-b font-semibold">
            Internal Notes
        </div>

        <div class="p-4 space-y-4">

            <!-- Add Note -->
            <div>
               <textarea
                    wire:model.defer="noteText"
                    rows="3"
                    class="w-full border rounded px-3 py-2 text-sm"
                    placeholder="Add an internal note..."></textarea>

                @error('newNote')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror

                <button
                    wire:click="addNote"
                    class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded text-sm">
                    Add Note
                </button>
            </div>

            <!-- Notes List -->
            @forelse ($candidate->notes as $note)
                <div class="border rounded p-3 text-sm bg-gray-50">
                    <p class="text-gray-800">
                        {{ $note->note }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        — {{ $note->user->name }},
                        {{ $note->created_at->diffForHumans() }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    No notes yet.
                </p>
            @endforelse
        </div>
    </div>

</div>
