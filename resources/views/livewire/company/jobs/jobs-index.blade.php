<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Jobs</h1>

        <a href="{{ route('company.jobs.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            + Create Job
        </a>
    </div>

    <div class="bg-white rounded shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Applications</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($jobs as $job)
                    <tr class="border-t">
                        <td class="p-3 font-medium">{{ $job->title }}</td>

                        <td class="p-3">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $job->status === 'open'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-200 text-gray-600' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>

                        <td class="p-3 text-center">
                            <a href="{{ route('company.jobs.applications', $job->id) }}"
                            class="text-indigo-600 hover:underline">
                                {{ $job->applications_count }}
                            </a>
                        </td>

                        <td class="p-3 space-x-3">
                            <a href="{{ route('company.jobs.edit', $job->id) }}"
                               class="text-blue-600">Edit</a>

                            <button
                                wire:click="toggleStatus({{ $job->id }})"
                                class="text-red-600">
                                {{ $job->status === 'open' ? 'Close' : 'Open' }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            No jobs created yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
