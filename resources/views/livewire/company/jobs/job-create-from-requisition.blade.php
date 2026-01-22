<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- HEADER -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create Job</h1>
            <p class="mt-1 text-sm text-gray-500">
                Creating job from requisition: <span class="font-mono font-medium text-indigo-600">{{ $requisition->requisition_code }}</span>
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('company.requisitions.show', $requisition) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Back to Requisition
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-6 rounded-md bg-red-50 p-4 border border-red-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <form wire:submit.prevent="createJob">
            <div class="p-6 space-y-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Job Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Review and edit the job details derived from the requisition.</p>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <div class="mt-1">
                                <input type="text" wire:model.defer="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select wire:model.defer="employment_type" id="employment_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Select Type</option>
                                    <option value="full_time">Full Time</option>
                                    <option value="part_time">Part Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="intern">Intern</option>
                                </select>
                            </div>
                            @error('employment_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" wire:model.defer="salary_min" id="salary_min" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                            </div>
                            @error('salary_min') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="salary_max" class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" wire:model.defer="salary_max" id="salary_max" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                            </div>
                            @error('salary_max') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
                            <div class="mt-1">
                                <textarea wire:model.defer="description" id="description" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t border-gray-200">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Job
                </button>
            </div>
        </form>
    </div>
      <script>
document.addEventListener('livewire:init', () => {

    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {

            // 🔥 SET INITIAL CONTENT
            editor.setData(@js($description ?? ''));

            // Sync editor → Livewire
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData(), false);
            });

            // Sync Livewire → editor (for edit mode)
            Livewire.on('refreshEditor', content => {
                editor.setData(content ?? '');
            });
        })
        .catch(error => console.error(error));
});
</script>

</div>
