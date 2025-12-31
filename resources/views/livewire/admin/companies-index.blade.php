<div>
<x-admin-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Companies']
]" />

<div class="flex">
    <!-- LEFT: TABLE -->
    <div class="flex-1">

        <h1 class="text-2xl font-bold mb-6">Companies</h1>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">Company</th>
                        <th class="p-3">Users</th>
                        <th class="p-3">Jobs</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($companies as $company)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $company->name }}</td>
                            <td class="p-3">{{ $company->users_count }}</td>
                            <td class="p-3">{{ $company->jobs_count }}</td>
                            <td class="p-3">
                                <span class="{{ $company->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $company->is_active ? 'Active' : 'Disabled' }}
                                </span>
                            </td>
                            <td class="p-3 space-x-3">
                                <button
                                    wire:click="viewCompany({{ $company->id }})"
                                    class="text-indigo-600 hover:underline">
                                    View
                                </button>

                                <button
                                    wire:click="toggleStatus({{ $company->id }})"
                                    class="text-gray-600 hover:underline">
                                    {{ $company->is_active ? 'Disable' : 'Enable' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <!-- RIGHT: DRAWER -->
    @if ($showDrawer && $selectedCompany)
        <div class="w-96 bg-white border-l shadow-xl fixed right-0 top-0 h-full z-50">
            @include('livewire.admin.partials.company-drawer')
        </div>
    @endif

</div>
</div>