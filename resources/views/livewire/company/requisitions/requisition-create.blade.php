<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Create Requisition
            </h2>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border-l-4 border-green-400">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
                <!-- Job Title -->
                <div class="sm:col-span-4">
                    <label for="job_title" class="block text-sm font-medium leading-6 text-gray-900">Job Title <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" wire:model.defer="job_title" id="job_title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('job_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Openings -->
                <div class="sm:col-span-2">
                    <label for="openings" class="block text-sm font-medium leading-6 text-gray-900">Openings <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="number" wire:model.defer="openings" id="openings" min="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('openings') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Employment Type -->
                <div class="sm:col-span-3">
                    <label for="employment_type" class="block text-sm font-medium leading-6 text-gray-900">Employment Type <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select wire:model.defer="employment_type" id="employment_type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="">Select Type</option>
                            <option value="full_time">Full Time</option>
                            <option value="part_time">Part Time</option>
                            <option value="contract">Contract</option>
                            <option value="intern">Intern</option>
                        </select>
                    </div>
                    @error('employment_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Priority -->
                <div class="sm:col-span-3">
                    <label for="priority" class="block text-sm font-medium leading-6 text-gray-900">Priority <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select wire:model.defer="priority" id="priority" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>

                <!-- Salary Range -->
                <div class="sm:col-span-3">
                    <label for="salary_min" class="block text-sm font-medium leading-6 text-gray-900">Salary Min</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" wire:model.defer="salary_min" id="salary_min" class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="salary_max" class="block text-sm font-medium leading-6 text-gray-900">Salary Max</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" wire:model.defer="salary_max" id="salary_max" class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                    </div>
                    @error('salary_max') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Reason -->
                <div class="col-span-full">
                    <label for="reason" class="block text-sm font-medium leading-6 text-gray-900">Reason for Hiring</label>
                    <div class="mt-2">
                        <textarea wire:model.defer="reason" id="reason" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Briefly describe why this position is needed.</p>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 bg-gray-50 rounded-b-xl">
            <button type="button" wire:click="saveDraft" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Save as Draft</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit for Approval</button>
        </div>
    </form>
</div>
