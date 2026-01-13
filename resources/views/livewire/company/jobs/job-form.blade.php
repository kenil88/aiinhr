<div class="max-w-5xl">
    <h1 class="text-2xl font-semibold mb-6">
        {{ $job ? 'Edit Job' : 'Create Job' }}
    </h1>
    @if (session()->has('success'))
        <div class="mb-4 rounded bg-green-50 border border-green-200 px-4 py-3 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 space-y-6">

        <!-- BASIC INFO -->
        <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">
                Basic Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <input wire:model="title"
                           class="form-input w-full"
                           placeholder="Job Title">
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model="department"
                           class="form-input w-full"
                           placeholder="Department">
                    @error('department') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model="location"
                           class="form-input w-full"
                           placeholder="Location">
                    @error('location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- JOB DETAILS -->
        <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">
                Job Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <select wire:model="employment_type" class="form-select w-full">
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="internship">Internship</option>
                    </select>
                    @error('employment_type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <select wire:model="experience_level" class="form-select w-full">
                        <option value="">Experience Level</option>
                        <option value="junior">Junior</option>
                        <option value="mid">Mid</option>
                        <option value="senior">Senior</option>
                        <option value="lead">Lead</option>
                    </select>
                    @error('experience_level') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <select wire:model="status" class="form-select w-full">
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- SALARY -->
        <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">
                Salary Range
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <input wire:model="salary_min"
                           type="number"
                           class="form-input w-full"
                           placeholder="Salary Min">
                    @error('salary_min') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model="salary_max"
                           type="number"
                           class="form-input w-full"
                           placeholder="Salary Max">
                    @error('salary_max') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">
                Job Description
            </h2>

            <textarea wire:model="description"
                      rows="6"
                      class="form-textarea"
                      placeholder="Describe the role, responsibilities, requirements..."></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- ACTION -->
        <div class="flex justify-end pt-4 border-t">
            <button wire:click="save"
                    class="bg-indigo-600 hover:bg-indigo-700
                           text-white px-6 py-2 rounded-md text-sm font-medium">
                Save Job
            </button>
        </div>
    </div>
</div>
