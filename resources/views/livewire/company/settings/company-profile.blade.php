<div class="max-w-4xl space-y-6">

    <h1 class="text-2xl font-semibold">Company Profile</h1>

    <form wire:submit="save" class="bg-white p-6 rounded shadow space-y-4">

        <!-- Logo -->
        <div>
            <label class="block text-sm font-medium mb-1">Company Logo</label>

            @if ($logo)
                <img src="{{ $logo->temporaryUrl() }}" class="h-16 mb-2">
            @elseif ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" class="h-16 mb-2">
            @endif

            <input type="file" wire:model="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('logo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Company Name -->
        <div>
            <label class="block text-sm font-medium mb-1">Company Name</label>
            <input wire:model="name" class="form-input w-full" placeholder="Company Name">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div wire:ignore>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea
                id="editor"
                wire:model="description"
                class="form-textarea w-full rounded-md border-gray-300 shadow-sm"
            >{!! $description !!}</textarea>
        </div>
        @error('description')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Country</label>
                <input wire:model="country" class="form-input w-full" placeholder="Country">
                @error('country') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">City</label>
                <input wire:model="city" class="form-input w-full" placeholder="City">
                @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Address</label>
            <input wire:model="address" class="form-input w-full" placeholder="Address">
            @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Phone</label>
                <input wire:model="phone" class="form-input w-full" placeholder="Phone">
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input wire:model="email" class="form-input w-full" placeholder="Email">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Website</label>
                <input wire:model="website" class="form-input w-full" placeholder="Website">
                @error('website') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Facebook</label>
                <input wire:model="facebook" class="form-input w-full" placeholder="Facebook">
                @error('facebook') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Twitter</label>
                <input wire:model="twitter" class="form-input w-full" placeholder="Twitter">
                @error('twitter') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">LinkedIn</label>
                <input wire:model="linkedin" class="form-input w-full" placeholder="LinkedIn">
                @error('linkedin') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Save -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                Save Changes
            </button>
        </div>

        @if (session()->has('success'))
            <div class="mt-4 p-4 rounded bg-green-50 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

    </form>
</div>
<script>
    document.addEventListener('livewire:init', () => {

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {

                // Set initial value
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData(), false);
                });

                // Optional: update editor if Livewire changes value
                Livewire.on('refreshEditor', content => {
                    editor.setData(content);
                });

            })
            .catch(error => {
                console.error(error);
            });

    });
</script>
