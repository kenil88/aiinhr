<div class="h-full flex flex-col">

    <!-- HEADER -->
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-semibold text-lg">
            {{ $selectedJob->title }}
        </h2>

        <button wire:click="closeDrawer" class="text-gray-500 hover:text-black">
            ✕
        </button>
    </div>

    <!-- CONTENT -->
    <div class="p-4 flex-1 overflow-y-auto space-y-6 text-sm">

        <!-- JOB META -->
        <div>
            <p><strong>Company:</strong> {{ $selectedJob->company->name }}</p>
            <p class="mt-1"><strong>Status:</strong> {{ ucfirst($selectedJob->status) }}</p>
            <p class="mt-1"><strong>Visibility:</strong> {{ ucfirst($selectedJob->visibility) }}</p>
            <p class="mt-1"><strong>Posted:</strong> {{ $selectedJob->created_at->format('d M Y') }}</p>
        </div>

        <!-- JOB DESCRIPTION -->
        <div>
            <h3 class="font-semibold text-gray-500 mb-2">Job Description</h3>

            <div class="bg-gray-50 p-3 rounded text-sm leading-relaxed">
                {{ $selectedJob->description }}
            </div>
        </div>

    </div>

</div>
