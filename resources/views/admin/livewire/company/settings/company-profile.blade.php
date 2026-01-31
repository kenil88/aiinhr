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
            <label class="block text-sm font-medium mb-1">Name</label>
            <input wire:model="name" class="form-input w-full" placeholder="Name">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input wire:model="email" class="form-input w-full" placeholder="Email">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
