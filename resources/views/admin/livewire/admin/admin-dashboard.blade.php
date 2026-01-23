<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Admin Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">System overview and platform statistics.</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Companies -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Total Companies</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalCompanies }}</p>
            </div>
        </div>

        <!-- Active Companies -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-green-50 text-green-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Active Companies</p>
                <p class="text-2xl font-bold text-gray-900">{{ $activeCompanies }}</p>
            </div>
        </div>

        <!-- Disabled Companies -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-red-50 text-red-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Disabled Companies</p>
                <p class="text-2xl font-bold text-gray-900">{{ $disabledCompanies }}</p>
            </div>
        </div>

        <!-- Total HR Users -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Total HR Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Total Jobs -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-orange-50 text-orange-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalJobs }}</p>
            </div>
        </div>

        <!-- Total Candidates -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-xl bg-teal-50 text-teal-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500">Total Candidates</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalCandidates }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Companies -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-900">Recent Companies</h3>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach ($recentCompanies as $company)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-sm">
                            {{ substr($company->name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">{{ $company->name }}</p>
                            <p class="text-xs text-gray-500">Added {{ $company->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $company->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $company->is_active ? 'Active' : 'Disabled' }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
