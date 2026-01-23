@if ($application->ai_result)
<div class="mt-6 bg-white rounded-lg shadow p-4">
    <h3 class="text-sm font-semibold mb-3">
        AI Resume Analysis
    </h3>

    <div class="flex items-center gap-2 mb-3">
        <span class="text-lg font-bold">
            Score: {{ $application->ai_result['score'] }}/100
        </span>

        <span class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700">
            {{ $application->ai_result['recommendation'] }}
        </span>
    </div>

    <p class="text-sm text-gray-700 mb-3">
        {{ $application->ai_result['summary'] }}
    </p>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <strong>Strengths</strong>
            <ul class="list-disc ml-4">
                @foreach ($application->ai_result['strengths'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <strong>Gaps</strong>
            <ul class="list-disc ml-4">
                @foreach ($application->ai_result['gaps'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
