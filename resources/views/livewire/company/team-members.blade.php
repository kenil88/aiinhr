<div>
    <h1 class="text-2xl font-bold mb-6">Team Members</h1>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-3 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-3 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- INVITE FORM -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="font-semibold mb-4">Invite Team Member</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" wire:model="name" placeholder="Name"
                   class="border rounded p-2">
            @error('name')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror

            <input type="email" wire:model="email" placeholder="Email"
                   class="border rounded p-2">
            @error('email')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror

            <select wire:model="role" class="border rounded p-2">
                <option value="recruiter">Recruiter</option>
                <option value="viewer">Viewer</option>
            </select>
            @error('role')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button wire:click="invite"
                class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">
            Invite
        </button>

        @if ($generatedPassword)
            <div class="mt-4 bg-yellow-50 p-3 rounded text-sm">
                <strong>Temporary Password:</strong>
                {{ $generatedPassword }}
            </div>
        @endif
    </div>

    <!-- TEAM LIST -->
    <div class="bg-white shadow rounded">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr class="border-t">
                        <td class="p-3">{{ $member->name }}</td>
                        <td class="p-3">{{ $member->email }}</td>
                        <td class="p-3">
                            @if ($member->role === 'owner')
                                <span class="font-semibold capitalize">{{ $member->role }}</span>
                            @elseif (! $member->is_active)
                                <span class="capitalize text-gray-400">{{ $member->role }}</span>
                            @else
                                <select
                                    wire:model.defer="roles.{{ $member->id }}"
                                    wire:change="updateRole({{ $member->id }})"
                                    class="w-36 h-9 px-3 pr-8 text-sm
                                        rounded-md border border-gray-300 bg-white
                                        appearance-none
                                        focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                    <option value="recruiter">Recruiter</option>
                                    <option value="viewer">Viewer</option>
                                </select>

                            @endif
                        </td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-1 rounded
                                {{ $member->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="p-3">
                            @if ($member->is_active)
                                @if ($member->id !== auth()->id())
                                    <button
                                        wire:click="deactivate({{ $member->id }})"
                                        class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                        Deactivate
                                    </button>
                                @endif
                            @else
                                <button
                                    wire:click="activate({{ $member->id }})"
                                    class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                                    Activate
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
