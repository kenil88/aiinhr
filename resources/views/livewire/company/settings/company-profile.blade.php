<div class="max-w-4xl space-y-6">

    <h1 class="text-2xl font-semibold">Company Profile</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">

        <!-- Logo -->
        <div>
            <label class="block text-sm font-medium mb-1">Company Logo</label>

            @if ($logo)
                <img src="{{ $logo->temporaryUrl() }}" class="h-16 mb-2">
            @elseif ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" class="h-16 mb-2">
            @endif

            <input type="file" wire:model="logo">
        </div>

        <!-- Company Name -->
        <input wire:model.defer="name" class="form-input" placeholder="Company Name">

        <textarea wire:model.defer="description"
                rows="4"
                class="form-input"
                placeholder="Company Description"></textarea>

        <div class="grid grid-cols-2 gap-4">
            <input wire:model.defer="country" class="form-input" placeholder="Country">
            <input wire:model.defer="city" class="form-input" placeholder="City">
        </div>

        <input wire:model.defer="address" class="form-input" placeholder="Address">

        <div class="grid grid-cols-2 gap-4">
            <input wire:model.defer="phone" class="form-input" placeholder="Phone">
            <input wire:model.defer="email" class="form-input" placeholder="Email">
        </div>

        <input wire:model.defer="website" class="form-input" placeholder="Website">
        <input wire:model.defer="facebook" class="form-input" placeholder="Facebook">
        <input wire:model.defer="twitter" class="form-input" placeholder="Twitter">
        <input wire:model.defer="linkedin" class="form-input" placeholder="LinkedIn">


        <!-- Save -->
        <button
            wire:click="save"
            class="bg-indigo-600 text-white px-6 py-2 rounded">
            Save
        </button>

        @if (session()->has('success'))
            <p class="text-green-600 text-sm">
                {{ session('success') }}
            </p>
        @endif

    </div>
</div>
