<div class="h-full flex flex-col">

    <!-- HEADER -->
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-semibold text-lg">
            {{ $selectedCompany->name }}
        </h2>

        <button wire:click="closeDrawer" class="text-gray-500 hover:text-black">
            ✕
        </button>
    </div>

    <!-- CONTENT -->
    <div class="p-4 flex-1 overflow-y-auto space-y-6">

        <!-- COMPANY INFO -->
        <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Company Info</h3>
            <p class="text-sm">
                <strong>Email:</strong>
                {{ $selectedCompany->email ?? '—' }}
            </p>

            <p class="text-sm mt-1">
                <strong>Phone:</strong>
                {{ $selectedCompany->phone ?? '—' }}
            </p>
            <p class="text-sm">
                Status:
                <span class="{{ $selectedCompany->is_active ? 'text-green-600' : 'text-red-600' }}">
                    {{ $selectedCompany->is_active ? 'Active' : 'Disabled' }}
                </span>
            </p>

            <p class="text-sm mt-1">
                Total Users: {{ $selectedCompany->users->count() }}
            </p>
        </div>

        <!-- HR USERS TABLE -->
        <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">HR Users</h3>

            <div class="border rounded overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Email</th>
                            <th class="p-2 text-left">Phone</th>
                            <th class="p-2 text-left">Role</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($selectedCompany->users as $user)
                            <tr class="border-t">
                                <td class="p-2">{{ $user->name }}</td>
                                <td class="p-2">{{ $user->email }}</td>
                                <td class="p-2">{{ $user->phone }}</td>
                                <td class="p-2 capitalize">{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
