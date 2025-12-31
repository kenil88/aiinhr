<div>
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Talent Pool</h1>
    </div>

    <div class="bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Candidate</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Applications</th>
                    <th class="p-3">Added On</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($candidates as $candidate)
                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            {{ $candidate->name }}
                        </td>

                        <td class="p-3">
                            {{ $candidate->email }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $candidate->applications_count }}
                        </td>

                        <td class="p-3">
                            {{ $candidate->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            <a href="{{ route('company.candidates.show', $candidate->id) }}"
                               class="text-indigo-600 hover:underline text-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="p-6 text-center text-gray-500">
                            No candidates found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
