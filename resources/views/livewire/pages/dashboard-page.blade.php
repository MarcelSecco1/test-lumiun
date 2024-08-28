<div class="container mx-auto mt-4 p-4  bg-white dark:bg-gray-800">
    <div class="flex flex-col sm:flex-row justify-between px-5 mx-4 mb-3 w-full">
        <div class="flex-1 mb-4 sm:mb-0">
            <h1 class="text-2xl font-normal text-gray-800 dark:text-gray-200">Dashboard</h1>
        </div>
        <div class="flex space-x-4">
            <x-ts-button color="secondary" text="Filter" x-on:click="$modalOpen('modal-filter')" />
            <x-ts-button x-on:click="$modalOpen('modal-create')" text="Add Domain" wire:navigate />
        </div>
    </div>
    {{-- <span class="borde-2 my-3"></span> --}}
    <div class="flex justify-center w-full">
        <div class="mt-4 w-full max-w-screen-xl">
            <livewire:components.list-domain />
        </div>
    </div>

    <x-ts-modal title="Register a new domain" id="modal-create">
        <livewire:components.create-domain />
    </x-ts-modal>

    <x-ts-modal title="Apply Filter in Domains" id="modal-filter">
        <div class="flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <label for="role" class="text-gray-800 dark:text-gray-200">Role</label>
                <x-ts-select.native name="role" id="role"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 dark:text-white rounded-lg"
                    wire:model='role'>
                    <option value="all" selected>Select...</option>
                    <option value="1">Allow</option>
                    <option value="0">Block</option>
                </x-ts-select.native>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="status" class="text-gray-800 dark:text-gray-200">Status</label>
                <x-ts-select.native name="status" id="status"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 dark:text-white rounded-lg"
                    wire:model='status'>
                    <option value="all" selected>Select...</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </x-ts-select.native>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="priority" class="text-gray-800 dark:text-gray-200">Priority</label>
                <x-ts-input type="number" id="priority" name="priority"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg" wire:model='priority' />
            </div>
        </div>

        <x-slot name="footer">
            <x-ts-button color="stone" text="Clear Filter" x-on:click="$modalClose('modal-filter')"
                wire:click='resetFilter' />
            <x-ts-button color="red" text="Close" x-on:click="$modalClose('modal-filter')" />
            <x-ts-button color="primary" text="Apply" x-on:click="$modalClose('modal-filter')"
                wire:click='defineFilter' />
        </x-slot>
    </x-ts-modal>
</div>
