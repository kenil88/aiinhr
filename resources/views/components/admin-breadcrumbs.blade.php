@props([
    'items' => []
])

<nav class="text-sm mb-4 text-gray-600">
    <ol class="flex items-center space-x-2">

        @foreach ($items as $index => $item)
            <li class="flex items-center">
                @if ($index > 0)
                    <span class="mx-2 text-gray-400">/</span>
                @endif

                @if (isset($item['url']) && $index !== count($items) - 1)
                    <a href="{{ $item['url'] }}"
                       class="hover:underline text-indigo-600">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="font-medium text-gray-800">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach

    </ol>
</nav>
