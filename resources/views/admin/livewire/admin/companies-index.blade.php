<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <x-admin-breadcrumbs :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Companies']
        ]" />

        <div class="sm:flex sm:items-center sm:justify-between mt-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Companies</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all companies registered in the platform.</p>
            </div>
        </div>

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Company</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Users</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jobs</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($companies as $company)
                                    <tr class="hover:bg-gray-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $company->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $company->users_count }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $company->jobs_count }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $company->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $company->is_active ? 'Active' : 'Disabled' }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button
                                                wire:click="viewCompany({{ $company->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 mr-4">
                                                View
                                            </button>

                                            <button
                                                wire:click="toggleStatus({{ $company->id }})"
                                                class="{{ $company->is_active ? 'text-amber-600 hover:text-amber-900' : 'text-green-600 hover:text-green-900' }}">
                                                {{ $company->is_active ? 'Disable' : 'Enable' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DRAWER -->
    @if ($showDrawer && $selectedCompany)
        <div class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 transition-opacity" wire:click="$set('showDrawer', false)"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-96 bg-white shadow-xl transform transition-transform">
            @include('livewire.admin.partials.company-drawer')
        </div>
    @endif
</div>
