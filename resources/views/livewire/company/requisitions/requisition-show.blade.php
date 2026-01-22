<div class="max-w-5xl mx-auto py-6">

    <a href="{{ route('company.requisitions.index') }}"
       class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
        &larr; Back to Requisitions
    </a>

    @if(session('success'))
        <div class="mt-4 rounded-md bg-green-50 p-4 text-sm text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 bg-white shadow-sm ring-1 ring-gray-900/5 rounded-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $requisition->job_title }}</h2>
                <p class="mt-1 text-sm text-gray-500 font-mono">
                    {{ $requisition->requisition_code }}
                </p>
            </div>

            @php
                $statusColors = match($requisition->status) {
                    'approved' => 'bg-green-100 text-green-700',
                    'submitted' => 'bg-yellow-100 text-yellow-800',
                    'rejected' => 'bg-red-100 text-red-700',
                    'draft' => 'bg-gray-100 text-gray-700',
                    default => 'bg-blue-100 text-blue-700',
                };
            @endphp

            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $statusColors }}">
                {{ ucfirst($requisition->status) }}
            </span>
        </div>

        <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6 text-sm">
            <div>
                <dt class="font-medium text-gray-500">Openings</dt>
                <dd class="mt-1 text-gray-900">{{ $requisition->openings }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-500">Employment Type</dt>
                <dd class="mt-1 text-gray-900 capitalize">{{ str_replace('_', ' ', $requisition->employment_type) }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-500">Priority</dt>
                <dd class="mt-1 text-gray-900 capitalize">{{ $requisition->priority }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-500">Requested By</dt>
                <dd class="mt-1 text-gray-900">{{ $requisition->requester?->name }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-500">Salary Range</dt>
                <dd class="mt-1 text-gray-900">
                    @if($requisition->salary_min)
                        ₹{{ number_format($requisition->salary_min) }} – ₹{{ number_format($requisition->salary_max) }}
                    @else
                        <span class="text-gray-400 italic">Not specified</span>
                    @endif
                </dd>
            </div>

            <div>
                <dt class="font-medium text-gray-500">Created At</dt>
                <dd class="mt-1 text-gray-900">{{ $requisition->created_at->format('d M Y') }}</dd>
            </div>
        </dl>

        @if($requisition->reason)
            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-medium text-gray-500">Reason for Hiring</h3>
                <div class="mt-2 text-sm text-gray-900 prose prose-sm max-w-none">
                    {{ $requisition->reason }}
                </div>
            </div>
        @endif

        {{-- Owner actions --}}
        @if(auth()->user()->isOwner() && $requisition->status === 'submitted')
            <div class="mt-8 border-t border-gray-100 pt-6 flex gap-3">
                <button wire:click="approve"
                        wire:loading.attr="disabled"
                        onclick="confirm('Approve this requisition?') || event.stopImmediatePropagation()"
                        class="inline-flex justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    Approve
                </button>

                <button wire:click="reject"
                        wire:loading.attr="disabled"
                        onclick="confirm('Reject this requisition?') || event.stopImmediatePropagation()"
                        class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    Reject
                </button>
            </div>
        @endif
    </div>
</div>
