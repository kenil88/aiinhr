<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header & Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('company.candidates.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors flex items-center">
                            <svg class="flex-shrink-0 h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Talent Pool
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Candidate Profile</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Candidate Info -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-8 flex flex-col items-center text-center border-b border-gray-100">
                    <div class="h-24 w-24 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl font-bold mb-4 shadow-inner">
                        {{ substr($candidate->name, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $candidate->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $candidate->email }}</p>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-3 text-sm text-gray-600 break-all">
                            {{ $candidate->email }}
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-3 text-sm text-gray-600">
                            {{ $candidate->phone ?? 'No phone provided' }}
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-3 text-sm text-gray-600">
                            Added on {{ $candidate->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Applications & Activity -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Applications Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Applications</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        {{ $candidate->applications->count() }} Total
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AI Score</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($candidate->applications as $application)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $application->job->title ?? 'Unknown Job' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $application->stage?->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $application->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php($badge = $application->aiBadge())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge['class'] }}">
                                            {{ $badge['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('company.applications.show', $application->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                        No applications found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Activity Timeline -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-6">Activity Timeline</h3>
                    
                    @if ($activities->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-sm text-gray-500">No activity recorded yet.</p>
                        </div>
                    @else
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach ($activities as $activity)
                                    <li>
                                        <div class="relative pb-8">
                                            @if (!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-indigo-50 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            <span class="font-medium text-gray-900">{{ $activity->message }}</span>
                                                            @if ($activity->job)
                                                                <span class="block text-xs text-indigo-600 mt-0.5">Job: {{ $activity->job->title }}</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        <time datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Notes -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-base font-semibold text-gray-900">Internal Notes</h3>
                    </div>
                    
                    <div class="flex-1 p-6 overflow-y-auto max-h-[400px] space-y-6">
                        @forelse ($candidate->notes as $note)
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium text-gray-600">
                                        {{ substr($note->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm">
                                        <span class="font-medium text-gray-900">{{ $note->user->name }}</span>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700">
                                        <p>{{ $note->note }}</p>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-500">
                                        {{ $note->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 text-center italic">No notes added yet.</p>
                        @endforelse
                    </div>

                    <div class="p-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl">
                        <div class="flex gap-2">
                            <div class="flex-grow">
                                <label for="note" class="sr-only">Add a note</label>
                                <textarea
                                    wire:model.defer="noteText"
                                    rows="2"
                                    class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Add an internal note..."></textarea>
                                @error('newNote')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button
                                wire:click="addNote"
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 self-end">
                                Post
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
