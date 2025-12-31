<div>
<x-admin-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Jobs']
]" />

<div class="flex">

    <!-- LEFT: JOBS TABLE -->
    <div class="flex-1">

        <h1 class="text-2xl font-bold mb-6">Jobs</h1>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">Job Title</th>
                        <th class="p-3">Company</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Visibility</th>
                        <th class="p-3">Applications</th>
                        <th class="p-3">Created</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $job->title }}</td>
                            <td class="p-3">{{ $job->company->name }}</td>
                            <td class="p-3 capitalize">{{ $job->status }}</td>
                            <td class="p-3 capitalize">{{ $job->visibility }}</td>
                            <td class="p-3">
                                 <a href="{{ route('admin.jobs.applications', $job) }}"
                                    class="text-indigo-600 hover:underline font-medium">
                                        {{ $job->applications_count }}
                                </a>
                            </td>
                            <td class="p-3">{{ $job->created_at->format('d M Y') }}</td>
                            <td class="p-3">
                                <button
                                    wire:click="viewJob({{ $job->id }})"
                                    class="text-indigo-600 hover:underline">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <!-- RIGHT: JOB DETAIL DRAWER -->
    @if ($showDrawer && $selectedJob)
        <div class="w-96 bg-white border-l shadow-xl fixed right-0 top-0 h-full z-50">
            @include('livewire.admin.partials.job-drawer')
        </div>
    @endif

</div>
</div>