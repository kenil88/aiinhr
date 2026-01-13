<div>
    <!-- HEADER -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Hiring Stages
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage interview stages for: <span class="font-medium text-gray-900">{{ $job->title }}</span>
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('company.jobs') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Back to Jobs
            </a>
        </div>
    </div>

    <!-- Add Stage -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mb-8">
        <div class="p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add New Stage</h3>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="newStageName" class="sr-only">Stage Name</label>
                    <input
                        type="text"
                        wire:model.defer="newStageName"
                        id="newStageName"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="e.g. Technical Interview"
                    >
                    @error('newStageName')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button
                    wire:click="addStage"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Add Stage
                </button>
            </div>
        </div>
    </div>

    <!-- Stage List -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
             <h3 class="text-lg leading-6 font-medium text-gray-900">Current Stages</h3>
             <p class="mt-1 text-sm text-gray-500">Drag and drop to reorder stages.</p>
        </div>
        <div
            x-data
            x-init="
                new Sortable($refs.stageList, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: () => {
                        let ids = [...$refs.stageList.children].map(el => el.dataset.id)
                        $wire.reorderStages(ids)
                    }
                })
            "
            class="divide-y divide-gray-200"
        >
            <div x-ref="stageList">
                @foreach ($stages as $stage)
                    <div
                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors"
                        data-id="{{ $stage->id }}"
                    >
                        <div class="flex items-center gap-4">
                            <span class="drag-handle text-gray-400 cursor-move hover:text-gray-600 p-2">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>

                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $stage->name }}</p>
                                <p class="text-xs text-gray-500">
                                    Position: {{ $stage->sort_order }}
                                </p>
                            </div>
                        </div>

                        <button
                            wire:click="toggleStage({{ $stage->id }})"
                            class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ $stage->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                            {{ $stage->is_active ? 'Active' : 'Disabled' }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
