<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    <div class="md:flex md:items-center md:justify-between mb-6 px-4 sm:px-0">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Requisitions
            </h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <a href="{{ route('company.requisitions.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                New Requisition
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border-l-4 border-green-400 mx-4 sm:mx-0">
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

    <div class="px-4 sm:px-0">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700">A list of all the requisitions in your company.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <select wire:model.live="statusFilter" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="all">All Statuses</option>
                    <option value="draft">Draft</option>
                    <option value="submitted">Submitted</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Job Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Code</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Openings</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Priority</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Requested By</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($requisitions as $req)
                                    <tr wire:key="{{ $req->id }}">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $req->job_title }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-mono">{{ $req->requisition_code }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset
                                                @switch($req->status)
                                                    @case('approved') bg-green-50 text-green-700 ring-green-600/20 @break
                                                    @case('submitted') bg-yellow-50 text-yellow-800 ring-yellow-600/20 @break
                                                    @case('rejected') bg-red-50 text-red-700 ring-red-600/10 @break
                                                    @case('draft') bg-gray-50 text-gray-600 ring-gray-500/10 @break
                                                    @case('closed') bg-blue-50 text-blue-700 ring-blue-700/10 @break
                                                    @default bg-gray-50 text-gray-600 ring-gray-500/10
                                                @endswitch
                                            ">
                                                {{ ucfirst($req->status) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $req->openings }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize">{{ $req->priority }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $req->requester?->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $req->created_at->format('d M Y') }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, {{ $req->job_title }}</span></a>
                                            @if(auth()->user()->isOwner() && $req->status === 'submitted')
                                                <button wire:click="approve({{ $req->id }})" onclick="confirm('Are you sure you want to approve this requisition?') || event.stopImmediatePropagation()" class="ml-4 text-green-600 hover:text-green-900">Approve</button>
                                                <button wire:click="reject({{ $req->id }})" onclick="confirm('Are you sure you want to reject this requisition?') || event.stopImmediatePropagation()" class="ml-4 text-red-600 hover:text-red-900">Reject</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center py-20">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.528a3.375 3.375 0 00-3.375 3.375v2.625m3.375-3.375v-1.875a.375.375 0 01.375-.375h1.5a.375.375 0 01.375.375v1.875m-3.375 0h3.375M9 13.5V9m0 4.5h-1.5V9h1.5m3-4.5v4.5m-6-4.5v4.5m-6 9h18c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v5.25c0 .621.504 1.125 1.125 1.125z" />
                                                </svg>
                                                <h3 class="mt-2 text-sm font-semibold text-gray-900">No requisitions found</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    @if ($statusFilter !== 'all')
                                                        There are no requisitions with the status "{{ $statusFilter }}".
                                                    @else
                                                        Get started by creating a new requisition.
                                                    @endif
                                                </p>
                                                <div class="mt-6">
                                                    <a href="{{ route('company.requisitions.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                        </svg>
                                                        New Requisition
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $requisitions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
