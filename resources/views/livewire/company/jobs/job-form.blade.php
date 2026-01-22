<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- HEADER -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $job ? 'Edit Job' : 'Create Job' }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                {{ $job ? 'Update the details of your job posting.' : 'Post a new job opportunity.' }}
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('company.jobs') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Back to Jobs
            </a>
        </div>
    </div>
    @if ($errors->has('limit'))
        <div class="bg-yellow-50 border border-yellow-300 text-yellow-800
                    px-4 py-2 rounded mb-4 text-sm">
            {{ $errors->first('limit') }}
            <br>
            <span class="text-xs">
                Upgrade will be available soon.
            </span>
        </div>
    @endif


    @if (session()->has('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="p-6 space-y-8">
            <!-- BASIC INFO -->
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Basic Information</h3>
                <p class="mt-1 text-sm text-gray-500">General information about the position.</p>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                        <div class="mt-1">
                            <input type="text" wire:model="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                        <div class="mt-1">
                            <input type="text" wire:model="department" id="department" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('department') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-6">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <div class="mt-1">
                            <input type="text" wire:model="location" id="location" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('location') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Job Details</h3>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                        <div class="mt-1">
                            <select id="employment_type" wire:model="employment_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="intern">Intern</option>
                            </select>
                        </div>
                        @error('employment_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="experience_level" class="block text-sm font-medium text-gray-700">Experience Level</label>
                        <div class="mt-1">
                            <select id="experience_level" wire:model.defer="experience_level" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Level</option>
                                <option value="junior">Junior</option>
                                <option value="mid">Mid</option>
                                <option value="senior">Senior</option>
                                <option value="lead">Lead</option>
                            </select>
                        </div>
                        @error('experience_level') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-1">
                            <select id="status" wire:model.defer="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="draft">Draft</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Salary Range</h3>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
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
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Job Description</h3>
                <div class="mt-6">
                    <div wire:ignore>
                        <textarea id="editor" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                    </div>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t border-gray-200">
            <button wire:click="save" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Job
            </button>
        </div>
    </div>

  <script>
document.addEventListener('livewire:init', () => {

    ClassicEditor
        .create(document.querySelector('#editor'))
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
