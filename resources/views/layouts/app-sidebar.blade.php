<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

</head>
<body class="h-full">

<div class="min-h-full">
    <!-- Static sidebar for desktop -->
    <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
        <div class="flex min-h-0 flex-1 flex-col border-r border-gray-200 bg-white">
            <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                <div class="flex flex-shrink-0 items-center px-4">
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900 tracking-tight">ATS SaaS</span>
                    </div>
                </div>
                <nav class="mt-8 flex-1 space-y-1 px-2">
                    @php
                        $navItems = [
                            ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
                            ['route' => 'company.jobs*', 'href' => route('company.jobs'), 'label' => 'Jobs', 'icon' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z'],
                            ['route' => 'company.candidates*', 'href' => route('company.candidates.index'), 'label' => 'Talent Pool', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
                            ['route' => 'company.team', 'label' => 'Team Members', 'icon' => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z', 'role' => 'owner'],
                            ['route' => 'company.profile.view', 'label' => 'Company Profile', 'icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        @if(isset($item['role']) && auth()->user()->role !== $item['role'])
                            @continue
                        @endif
                        @php
                            $isActive = request()->routeIs($item['route']);
                            $href = $item['href'] ?? route($item['route']);
                        @endphp
                        <a href="{{ $href }}"
                           class="{{ $isActive ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors">
                            <svg class="{{ $isActive ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} mr-3 h-6 w-6 flex-shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
            <div class="flex flex-shrink-0 border-t border-gray-200 p-4">
                <div class="group block w-full flex-shrink-0">
                    <div class="flex items-center">
                        <div>
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-500">
                                <span class="font-medium leading-none text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ auth()->user()->name }}</p>
                            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                @csrf
                                <button type="submit" class="text-xs font-medium text-gray-500 group-hover:text-gray-700 hover:underline">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-1 flex-col md:pl-64">
        <!-- Mobile Header -->
        <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow md:hidden">
            <div class="flex flex-1 justify-between px-4">
                <div class="flex flex-1 items-center justify-between">
                    <span class="text-lg font-bold text-indigo-600">ATS SaaS</span>
                    <div class="flex items-center">
                         <!-- Mobile menu button placeholder -->
                         <button type="button" class="-ml-0.5 -mt-0.5 inline-flex h-12 w-12 items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                          </button>
                    </div>
                </div>
            </div>
        </div>

        <main class="flex-1">
            <div class="py-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>

@livewireScripts
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

</body>
</html>
