<div>
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Companies</p>
            <p class="text-2xl font-bold">{{ $totalCompanies }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Active Companies</p>
            <p class="text-2xl font-bold text-green-600">{{ $activeCompanies }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Disabled Companies</p>
            <p class="text-2xl font-bold text-red-600">{{ $disabledCompanies }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total HR Users</p>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Jobs</p>
            <p class="text-2xl font-bold">{{ $totalJobs }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Candidates</p>
            <p class="text-2xl font-bold">{{ $totalCandidates }}</p>
        </div>
    </div>

    <!-- RECENT COMPANIES -->
    <div class="bg-white rounded shadow">
        <div class="p-4 border-b font-semibold">
            Recent Companies
        </div>

        <div class="divide-y">
            @foreach ($recentCompanies as $company)
                <div class="p-4 flex justify-between">
                    <span>{{ $company->name }}</span>
                    <span class="text-sm {{ $company->is_active ? 'text-green-600' : 'text-red-600' }}">
                        {{ $company->is_active ? 'Active' : 'Disabled' }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
