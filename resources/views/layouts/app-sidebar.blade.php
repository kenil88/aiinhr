<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
@php
    function activeLink($route) {
        return request()->routeIs($route)
            ? 'bg-indigo-600 text-white'
            : 'text-gray-700 hover:bg-gray-100';
    }
@endphp
    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r hidden md:block">
        <div class="p-4 font-bold text-lg border-b">
            ATS SaaS
        </div>

        <nav class="p-4 space-y-2 text-sm">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 {{ activeLink('dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('company.jobs') }}"
            class="block px-4 py-2 rounded
            {{ request()->routeIs('company.jobs*') ? 'bg-indigo-600 text-white' : '' }}">
                Jobs
            </a>

            <a href="{{ route('company.candidates.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Talent Pool</a>
            @if (auth()->user()->role === 'owner')
                <a href="{{ route('company.team') }}"
                class="block px-4 py-2 rounded hover:bg-gray-100">
                    Team Members
                </a>
            @endif
            
            <a href="{{ route('company.profile.view') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ activeLink('company.profile.view') }}">
                Company Profile 
            </a>

            <div class="mt-auto p-4 border-t">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded text-red-600 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1">
        <!-- TOP BAR -->
        <div class="bg-white border-b px-6 py-3 flex justify-between">
            <span class="font-medium">HR Dashboard</span>

            <div class="text-sm text-gray-600">
                {{ auth()->user()->name }}
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div class="p-6">
            {{ $slot }}
        </div>
    </main>

</div>

@livewireScripts
</body>
</html>
