<div class="bg-white shadow-sm overflow-hidden sm:rounded-lg border border-gray-200"
     x-data
     x-init="
        new Sortable($refs.list, {
            animation: 150,
            handle: '.drag-handle',
            onEnd: () => {
                let ids = Array.from($refs.list.children).map(el => el.dataset.id);
                $wire.reorderStages(ids);
            }
        });
     ">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gray-50">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Hiring Stages</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Manage and reorder hiring stages.
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:flex sm:items-center gap-2">
                <label for="newStageName" class="sr-only">New Stage</label>
                <input type="text" wire:model.defer="newStageName" id="newStageName" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="New Stage Name">
                <button wire:click="addStage" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                </button>
            </div>
        </div>
        @error('newStageName') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10"></th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">
                        Stage Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" x-ref="list">
                @foreach($stages as $stage)
                    <tr wire:key="stage-{{ $stage->id }}" data-id="{{ $stage->id }}" class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="drag-handle cursor-move text-gray-400 hover:text-gray-600 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                </svg>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <div class="flex items-center">
                                <span class="flex-shrink-0 h-6 w-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-3">
                                    {{ $loop->iteration }}
                                </span>
                                {{ $stage->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="toggleStage({{ $stage->id }})" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ $stage->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                {{ $stage->is_active ? 'Active' : 'Disabled' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
