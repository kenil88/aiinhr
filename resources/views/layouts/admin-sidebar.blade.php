<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
@php
    function adminActive($patterns)
    {
        foreach ((array) $patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return 'bg-indigo-600 text-white';
            }
        }
        return 'text-gray-700 hover:bg-gray-100';
    }
@endphp

    <!-- ADMIN SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-gray-100 hidden md:flex flex-col">
        <div class="p-4 font-bold text-lg border-b border-gray-800">
            ATS Admin
        </div>

        <nav class="flex-1 p-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded {{ adminActive('admin.dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-4h-2" />
                </svg> 
               <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.companies') }}"
               class="flex items-center gap-3 px-4 py-2 rounded {{ adminActive('admin.companies') }}">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M3 12h18M3 17h18M5 7v10M9 7v10M15 7v10M19 7v10" />
                </svg>
                Companies
            </a>

            <a href="{{ route('admin.jobs') }}"
            class="flex items-center gap-3 px-4 py-2 rounded
            {{ adminActive([
                    'admin.jobs',
                    'admin.jobs.applications',
                    'admin.applications.show'
            ]) }}">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m-7 6h8a2 2 0 002-2V6a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>

                <span>Jobs</span>
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded text-red-400 hover:bg-gray-800">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <!-- TOP BAR -->
        <div class="bg-white border-b px-6 py-3 flex justify-between">
            <span class="font-medium">Admin Panel</span>

            <span class="text-sm text-gray-600">
                {{ auth()->user()->email }}
            </span>
        </div>

        <!-- PAGE CONTENT -->
        <div class="p-6">
           {{ $slot }}
        </div>

    </main>

</div>

@livewireScripts
</body>
<style>
    nav a {
        transition: background-color 0.15s ease, color 0.15s ease;
    }
</style>
</html>
