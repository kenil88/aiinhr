<div>
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold">
                Applications
            </h1>
            <p class="text-sm text-gray-500">
                {{ $job->title }}
            </p>
        </div>

        <a href="{{ route('company.jobs') }}"
           class="text-indigo-600 hover:underline text-sm">
            ← Back to Jobs
        </a>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Candidate</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Applied</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($applications as $app)
                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            {{ $app->candidate->name }}
                        </td>

                        <td class="p-3">
                            {{ $app->candidate->email }}
                        </td>

                        <td class="p-3">
                            <span class="px-2 py-1 text-xs rounded
                                bg-gray-100 text-gray-700">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>

                        <td class="p-3">
                            {{ $app->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            <a href="{{ route('company.applications.show', $app->id) }}"
                               class="text-indigo-600 hover:underline text-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="p-6 text-center text-gray-500">
                            No applications yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
