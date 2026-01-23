<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Hiring Stages</h1>
        <p class="text-sm text-gray-500">
            Manage stages for job:
            <span class="font-medium text-gray-900">{{ $job->title }}</span>
        </p>
    </div>

    <!-- Add Stage -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="flex gap-4">
            <input
                type="text"
                wire:model.defer="newStageName"
                class="flex-1 rounded-md border-gray-300"
                placeholder="Stage name (e.g. HR Interview)"
            >

            <button
                wire:click="addStage"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
            >
                Add Stage
            </button>
        </div>

        @error('newStageName')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Stage List -->
    <div
        x-data="{ livewire: @this }"
        x-init="
            new Sortable($refs.list, {
                animation: 150,
                handle: '.drag-handle',
                onEnd: () => {
                    let ids = [...$refs.list.children].map(el => el.dataset.id)
                    livewire.reorderStages(ids)
                }
            })
        "
        class="bg-white rounded-lg shadow"
    >
        <div x-ref="list" class="divide-y divide-gray-200">
            @foreach($stages as $stage)
                <div
                    data-id="{{ $stage->id }}"
                    class="flex items-center justify-between p-4 hover:bg-gray-50"
                >
                    <div class="flex items-center gap-4">
                        <span class="drag-handle cursor-move text-gray-400">
                            ☰
                        </span>

                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $stage->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Order: {{ $stage->sort_order }}
                            </p>
                        </div>
                    </div>

                    <button
                        wire:click="toggleStage({{ $stage->id }})"
                        class="text-xs px-3 py-1 rounded-full
                            {{ $stage->is_active
                                ? 'bg-green-100 text-green-800'
                                : 'bg-gray-200 text-gray-700' }}"
                    >
                        {{ $stage->is_active ? 'Active' : 'Disabled' }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
