<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8" x-data="{ showNameModal: false, showWebsiteModal: false }">
    <!-- Header Section -->
    <div class="space-y-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your workspace settings and profile.</p>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="p-6">
                <div class="flex w-full items-center gap-4">
                    <span class="relative flex shrink-0 overflow-hidden rounded-full h-12 w-12 border border-gray-100">
                        <span class="flex h-full w-full items-center justify-center bg-black text-lg font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </span>
                    <div class="flex-1 overflow-hidden">
                        <h2 class="truncate text-base font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="truncate text-sm text-gray-500">{{ $company->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Workspace Info</h3>
            </div>
            
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm divide-y divide-gray-100">
                <div class="flex flex-col gap-4 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <span class="text-sm font-medium text-gray-900">Logo</span>
                    <div class="flex sm:justify-end">
                        <label class="group relative cursor-pointer">
                        <input type="file" wire:model="logo" class="hidden">
                            <span class="relative flex h-16 w-16 overflow-hidden rounded-lg border border-gray-200">
                           @if ($company->logo)
                                    <img src="{{ asset('storage/'.$company->logo) }}" class="h-full w-full object-cover">
                            @else
                                    <div class="flex h-full w-full items-center justify-center bg-gray-50 text-xl font-bold text-gray-400">
                                  {{ substr($name ?? $company->name, 0, 1) }}
                                </div>
                            @endif
                            </span>
                            <div class="absolute inset-0 flex items-center justify-center rounded-lg bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-white"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path><path d="m15 5 4 4"></path></svg>
                            </div>
                        </label>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <span class="text-sm font-medium text-gray-900">Name</span>
                    <div class="w-full sm:w-auto sm:max-w-xs">
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" wire:model="name" class="block w-full rounded-lg border-gray-300 bg-white text-gray-900 text-sm focus:border-black focus:ring-black pr-10" placeholder="Workspace Name" readonly>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" @click="showNameModal = true" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-900">Public link</span>
                        <div class="group relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 cursor-help">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                            <div class="absolute bottom-full left-0 mb-2 hidden w-64 rounded-md bg-gray-900 p-2 text-xs text-white shadow-lg group-hover:block z-50 text-center">
                                This link shows all live jobs and can be shared with candidates.
                                <div class="absolute -bottom-1 left-2 h-2 w-2 -translate-x-1/2 rotate-45 bg-gray-900"></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto sm:max-w-xs">
                        <div class="flex rounded-lg shadow-sm relative">
                            <div class="relative flex-grow focus-within:z-10">
                                <input type="text" wire:model="website" class="block w-full rounded-l-lg border-gray-300 text-sm focus:border-black focus:ring-black pr-10" placeholder="https://example.com" readonly>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <button type="button" @click="showWebsiteModal = true" class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <a href="{{ $website ?? '#' }}" target="_blank" class="inline-flex items-center rounded-r-lg border border-l-0 border-gray-300 bg-gray-50 px-3 text-gray-500 hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <span class="text-sm font-medium text-gray-900">Plan</span>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">{{ $company->plan ?? 'Free' }}</span>
                        <button type="button" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Upgrade
                        </button>
                    </div>
                </div>
            </div>

        @if (session()->has('success'))
            <div class="rounded-lg bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
    <div class="mt-12 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Workspace Users</h3>
            <button class="inline-flex items-center justify-center rounded-lg bg-black px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Invite User
            </button>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-black text-sm font-medium text-white">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">{{ auth()->user()->name }} (Owner)</h4>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center rounded-md bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </span>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Name Change Modal -->
    <div x-show="showNameModal" wire:ignore.self class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showNameModal" @click="showNameModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showNameModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Change workspace name</h3>
                    <div class="mt-4">
                       <input type="text" wire:model.defer="name" class="block w-full rounded-lg border-gray-300 text-sm" placeholder="Enter Workspace Name">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="save" @click="showNameModal = false" class="w-full inline-flex justify-center rounded-md bg-black px-4 py-2 text-white hover:bg-gray-800 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button type="button" @click="showNameModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Change Modal -->
    <div x-show="showWebsiteModal" wire:ignore.self class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showWebsiteModal" @click="showWebsiteModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showWebsiteModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Change handle</h3>
                    <div class="mt-4">
                        <input type="text" wire:model="website" class="block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-black focus:ring-black" placeholder="https://example.com">
                        @error('website') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="save" @click="showWebsiteModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                    <button type="button" @click="showWebsiteModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
