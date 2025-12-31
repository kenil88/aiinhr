<div>
<x-admin-breadcrumbs :items="[
    ['label' => 'Admin', 'url' => route('admin.dashboard')],
    ['label' => 'Jobs', 'url' => route('admin.jobs')],
    ['label' => 'Applications'],
]" />

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Applications
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Job: {{ $job->title }} — {{ $job->company->name }}
        </p>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Candidate</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Applied At</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($applications as $app)
                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            <a href="{{ route('admin.applications.show', $app) }}"
                            class="text-indigo-600 hover:underline">
                                {{ $app->candidate->name ?? 'Candidate #' . $app->id }}
                            </a>
                        </td>
                        <td class="p-3">
                            {{ $app->candidate->email ?? '—' }}
                        </td>
                        <td class="p-3 capitalize">
                            {{ str_replace('_',' ', $app->status) }}
                        </td>
                        <td class="p-3">
                            {{ $app->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            No applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.jobs') }}"
           class="text-sm text-indigo-600 hover:underline">
            ← Back to Jobs
        </a>
    </div>
</div>
</div>