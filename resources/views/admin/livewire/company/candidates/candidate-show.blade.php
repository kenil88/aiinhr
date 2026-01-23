<div class="min-h-screen bg-gray-50/50 pb-12">

    <!-- Header & Navigation -->
    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <nav class="flex mb-1" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-2">
                            <li>
                                <a href="{{ route('company.candidates.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors flex items-center">
                                    <svg class="flex-shrink-0 h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Talent Pool
                                </a>
                            </li>
                            <li>
                                <span class="text-gray-300">/</span>
                            </li>
                            <li>
                                <span class="text-sm font-medium text-gray-900" aria-current="page">{{ $candidate->name }}</span>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight flex items-center gap-3">
                        {{ $candidate->name }}
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            Candidate
                        </span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Candidate Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="relative h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                    <div class="relative px-6 pb-6">
                        <div class="flex justify-center -mt-12 mb-4">
                            <div class="h-24 w-24 rounded-full bg-white p-1 shadow-lg">
                                <div class="h-full w-full rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl font-bold">
                                    {{ substr($candidate->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mb-6">
                            <h2 class="text-xl font-bold text-gray-900">{{ $candidate->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $candidate->email }}</p>
                        </div>

                        <div class="space-y-4 border-t border-gray-100 pt-6">
                            <div class="flex items-center text-sm">
                                <div class="flex-shrink-0 w-8 flex justify-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 ml-2 truncate" title="{{ $candidate->email }}">{{ $candidate->email }}</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="flex-shrink-0 w-8 flex justify-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 ml-2">{{ $candidate->phone ?? 'No phone provided' }}</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="flex-shrink-0 w-8 flex justify-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 ml-2">Joined {{ $candidate->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Applications & Activity -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Applications Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-semibold text-gray-900">Applications</h3>
                        <span class="bg-white border border-gray-200 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $candidate->applications->count() }}
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($candidate->applications as $application)
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-indigo-600 group-hover:text-indigo-800">
                                                {{ $application->job->title ?? 'Unknown Job' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                                {{ $application->stage?->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php($badge = $application->aiBadge())
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge['class'] }}">
                                                {{ $badge['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('company.applications.show', $application->id) }}" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">No applications found for this candidate.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Activity Timeline -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-semibold text-gray-900">Activity Timeline</h3>
                        </div>
                        <div class="p-6 flex-1 overflow-y-auto max-h-[500px]">
                            @if ($activities->isEmpty())
                                <div class="text-center py-8">
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
                                                            <span class="h-8 w-8 rounded-full bg-indigo-50 flex items-center justify-center ring-8 ring-white border border-indigo-100">
                                                                <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    <span class="font-medium text-gray-900">{{ $activity->message }}</span>
                                                                </p>
                                                                @if ($activity->job)
                                                                    <p class="mt-0.5 text-xs text-indigo-600 bg-indigo-50 inline-block px-1.5 py-0.5 rounded">
                                                                        {{ $activity->job->title }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="text-right text-xs text-gray-400 mt-1">
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
                    </div>

                    <!-- Internal Notes -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-semibold text-gray-900">Internal Notes</h3>
                        </div>
                        
                        <div class="flex-1 p-6 overflow-y-auto max-h-[400px] space-y-6 bg-gray-50/30">
                            @forelse ($candidate->notes as $note)
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-xs font-bold text-gray-600 shadow-sm">
                                            {{ substr($note->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 bg-white p-3 rounded-lg shadow-sm border border-gray-100">
                                        <div class="flex justify-between items-start">
                                            <span class="text-xs font-semibold text-gray-900">{{ $note->user->name }}</span>
                                            <span class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="mt-1 text-sm text-gray-700">
                                            <p>{{ $note->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500 italic">No notes added yet.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-4 bg-white border-t border-gray-100 rounded-b-xl">
                            <div class="relative">
                                <label for="note" class="sr-only">Add a note</label>
                                <textarea
                                    wire:model.defer="noteText"
                                    rows="3"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm resize-none pr-20"
                                    placeholder="Type a note..."></textarea>
                                <div class="absolute bottom-2 right-2">
                                    <button
                                        wire:click="addNote"
                                        type="button"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Post
                                    </button>
                                </div>
                            </div>
                            @error('newNote')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Stage History (Safely wrapped) -->
                @if(isset($candidate->applications) && $candidate->applications->isNotEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                         <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-semibold text-gray-900">Recent Stage History</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="space-y-4">
                                @foreach($candidate->applications as $app)
                                    @foreach($app->stageHistories as $history)
                                        <li class="flex items-center text-sm text-gray-600">
                                            <span class="w-2 h-2 bg-indigo-400 rounded-full mr-3"></span>
                                            <span class="font-medium text-gray-900 mr-1">{{ $app->job->title ?? 'Job' }}:</span>
                                            Moved from 
                                            <span class="font-medium mx-1">{{ $history->fromStage->name }}</span>
                                            to
                                            <span class="font-medium mx-1">{{ $history->toStage->name }}</span>
                                            by {{ $history->movedBy->name }}
                                            <span class="text-gray-400 ml-auto text-xs">{{ $history->created_at->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                            @if($candidate->applications->pluck('stageHistories')->flatten()->isEmpty())
                                <p class="text-sm text-gray-500 italic">No stage history available.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
