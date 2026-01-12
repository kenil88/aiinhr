<div class="max-w-3xl">

    <h1 class="text-2xl font-semibold mb-4">
        Hiring Stages – {{ $job->title }}
    </h1>

    <!-- Add Stage -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <div class="flex gap-2">
            <input
                wire:model.defer="newStageName"
                class="flex-1 border rounded px-3 py-2"
                placeholder="Add new stage (e.g. Tech Interview)">

            <button
                wire:click="addStage"
                class="bg-indigo-600 text-white px-4 py-2 rounded">
                Add
            </button>
        </div>
        @error('newStageName')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Stage List -->
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
    class="bg-white rounded shadow divide-y"
>
    <div x-ref="stageList">
        @foreach ($stages as $stage)
            <div
                class="flex items-center justify-between p-4 cursor-move"
                data-id="{{ $stage->id }}"
            >
                <div class="flex items-center gap-3">
                    <span class="drag-handle text-gray-400 cursor-grab">☰</span>

                    <div>
                        <p class="font-medium">{{ $stage->name }}</p>
                        <p class="text-xs text-gray-500">
                            Order: {{ $stage->sort_order }}
                        </p>
                    </div>
                </div>

                <button
                    wire:click="toggleStage({{ $stage->id }})"
                    class="text-sm px-3 py-1 rounded
                        {{ $stage->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $stage->is_active ? 'Active' : 'Disabled' }}
                </button>
            </div>
        @endforeach
    </div>
</div>


</div>
