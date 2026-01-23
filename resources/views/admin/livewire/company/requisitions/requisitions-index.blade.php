<div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between px-4 sm:px-0">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Requisitions
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage job requisitions, approvals, and job creation.
            </p>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <a href="{{ route('company.requisitions.create') }}"
               class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                New Requisition
            </a>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="mt-6 rounded-md bg-green-50 p-4 border border-green-200 mx-4 sm:mx-0">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters -->
    <div class="mt-8 px-4 sm:px-0">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="sm:flex-auto">
                <!-- Optional: Search input could go here if supported -->
            </div>
            <div class="mt-4 sm:mt-0 sm:flex-none w-full sm:w-auto">
                <label for="statusFilter" class="sr-only">Filter status</label>
                <select wire:model.live="statusFilter" id="statusFilter"
                        class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="all">All Statuses</option>
                    <option value="draft">Draft</option>
                    <option value="submitted">Submitted</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mt-6 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg bg-white">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 sm:pl-6">Requisition</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Details</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Requester</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($requisitions as $req)
                                <tr wire:key="{{ $req->id }}" class="hover:bg-gray-50 transition-colors">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="font-medium text-gray-900">{{ $req->job_title }}</div>
                                        <div class="text-gray-500 font-mono text-xs mt-0.5">{{ $req->requisition_code }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @php
                                            $statusStyles = match($req->status) {
                                                'approved' => 'bg-green-50 text-green-700 ring-green-600/20',
                                                'submitted' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
                                                'rejected' => 'bg-red-50 text-red-700 ring-red-600/10',
                                                'draft' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                                                'closed' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                                default => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusStyles }}">
                                            {{ ucfirst($req->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex flex-col gap-1">
                                            <div>
                                                <span class="text-xs text-gray-400 uppercase">Openings:</span>
                                                <span class="font-medium text-gray-900">{{ $req->openings }}</span>
                                            </div>
                                            <div>
                                                <span class="text-xs text-gray-400 uppercase">Priority:</span>
                                                <span class="capitalize {{ $req->priority === 'high' ? 'text-red-600 font-medium' : 'text-gray-700' }}">
                                                    {{ $req->priority }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="font-medium text-gray-900">{{ $req->requester?->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $req->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('company.requisitions.show', $req) }}" class="text-indigo-600 hover:text-indigo-900">View</a>

                                            @if(auth()->user()->isOwner() && $req->status === 'submitted')
                                                <span class="text-gray-300">|</span>
                                                <button wire:click="approve({{ $req->id }})"
                                                        onclick="confirm('Are you sure you want to approve this requisition?') || event.stopImmediatePropagation()"
                                                        class="text-green-600 hover:text-green-900">
                                                    Approve
                                                </button>
                                                <button wire:click="reject({{ $req->id }})"
                                                        onclick="confirm('Are you sure you want to reject this requisition?') || event.stopImmediatePropagation()"
                                                        class="text-red-600 hover:text-red-900">
                                                    Reject
                                                </button>
                                            @endif

                                            @if($req->status === 'approved' && !$req->job)
                                                <a href="{{ route('company.requisitions.create-job', $req) }}"
                                                   class="ml-2 inline-flex items-center rounded bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 hover:bg-indigo-100 transition-colors">
                                                    Create Job
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No requisitions found</h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            @if ($statusFilter !== 'all')
                                                No requisitions match the status "{{ $statusFilter }}".
                                            @else
                                                Get started by creating a new requisition.
                                            @endif
                                        </p>
                                        @if ($statusFilter === 'all')
                                            <div class="mt-6">
                                                <a href="{{ route('company.requisitions.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>
                                                    New Requisition
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 px-4 sm:px-0">
        {{ $requisitions->links() }}
    </div>
</div>
