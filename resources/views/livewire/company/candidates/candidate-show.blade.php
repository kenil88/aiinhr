<div class="max-w-6xl">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold">
                {{ $candidate->name }}
            </h1>
            <p class="text-sm text-gray-500">
                {{ $candidate->email }}
            </p>
        </div>

        <a href="{{ route('company.candidates.index') }}"
           class="text-indigo-600 hover:underline text-sm">
            ← Back to Talent Pool
        </a>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: CANDIDATE INFO -->
        <div class="bg-white rounded-lg shadow p-6 space-y-3">
            <h2 class="text-sm font-semibold text-gray-700">
                Candidate Information
            </h2>

            <p><strong>Name:</strong> {{ $candidate->name }}</p>
            <p><strong>Email:</strong> {{ $candidate->email }}</p>
            <p><strong>Phone:</strong> {{ $candidate->phone ?? '—' }}</p>
            <p><strong>Added On:</strong>
                {{ $candidate->created_at->format('d M Y') }}
            </p>
        </div>

        <!-- RIGHT: APPLICATIONS -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="p-4 border-b font-semibold">
                Applications ({{ $candidate->applications->count() }})
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Job</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Applied</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($candidate->applications as $application)
                        <tr class="border-t">
                            <td class="p-3 font-medium">
                                {{ $application->job->title }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                            </td>

                            <td class="p-3">
                                {{ $application->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3">
                                <a href="{{ route('company.applications.show', $application->id) }}"
                                   class="text-indigo-600 hover:underline text-sm">
                                    View Application
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="p-6 text-center text-gray-500">
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
