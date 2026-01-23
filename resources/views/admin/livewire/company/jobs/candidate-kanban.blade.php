<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- HEADER -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Candidates
            </h1>
        </div>
    </div>

<div class="flex space-x-6 overflow-x-auto pb-6 px-2 h-[calc(100vh-12rem)]">
    @foreach($stages as $stage)
        <div class="w-80 flex-shrink-0 flex flex-col bg-gray-100 rounded-lg border border-gray-200 h-full">
            <!-- Column Header -->
            <div class="p-3 flex items-center justify-between border-b border-gray-200 bg-gray-50 rounded-t-lg">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">
                    {{ $stage->name }}
                </h3>
                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white border border-gray-200 text-gray-800 shadow-sm">
                    {{ $applications->where('stage_id', $stage->id)->count() }}
                </span>
            </div>

            <!-- Draggable Area -->
            <div
                wire:ignore
                x-data="{ stageId: {{ $stage->id }} }"
                x-init="
                    const root = $el.closest('[wire\\:id]');
                    const component = Livewire.find(root.getAttribute('wire:id'));

                    new Sortable($el, {
                        group: 'candidates',
                        animation: 150,
                        onEnd: (e) => {
                            let applicationId = e.item.dataset.id;
                            component.call('moveCandidate', applicationId, stageId);
                        }
                    });
                "
                class="flex-1 overflow-y-auto p-3 space-y-3 min-h-[100px]"
            >
                @foreach($applications->where('stage_id', $stage->id) as $app)
                    <div
                        wire:key="application-{{ $app->id }}"
                        data-id="{{ $app->id }}"
                        class="group bg-white p-4 rounded-md shadow-sm border border-gray-200 cursor-move hover:shadow-md hover:border-indigo-300 transition-all duration-200"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($app->candidate->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 truncate">
                                        {{ $app->candidate->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $app->candidate->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <div class="text-xs text-gray-400 flex items-center">
                                <svg class="mr-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $app->created_at->format('M d') }}
                            </div>
                            <a href="{{ route('company.applications.show', $app->id) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-900 opacity-0 group-hover:opacity-100 transition-opacity">
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
</div>