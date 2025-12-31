<div class="max-w-4xl">
    <h1 class="text-2xl font-semibold mb-6">Company Profile</h1>

    <div class="bg-white rounded shadow p-6 space-y-4">

        @if ($company->logo)
            <img src="{{ asset('storage/'.$company->logo) }}" class="h-20">
        @endif

        <p><strong>Name:</strong> {{ $company->name }}</p>
        <p><strong>Description:</strong> {{ $company->description }}</p>
        <p><strong>Location:</strong> {{ $company->city }}, {{ $company->country }}</p>
        <p><strong>Email:</strong> {{ $company->email }}</p>
        <p><strong>Phone:</strong> {{ $company->phone }}</p>

        @if (auth()->user()->isOwner())
            <a href="{{ route('company.profile.edit') }}"
               class="text-indigo-600 hover:underline text-sm">
                Edit Profile
            </a>
        @endif
    </div>
</div>
