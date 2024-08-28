<div>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <label for="role" class="text-gray-800 dark:text-gray-200">Domain</label>
            <x-ts-input name="domain" id="domain"
                class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg dark:text-gray-200"
                wire:model='domain'>
            </x-ts-input>
        </div>
        <div class="flex flex-wrap space-x-4">
            <div class="flex-1 min-w-[150px]">
                <label for="role" class="text-gray-800 dark:text-gray-200">Role</label>
                <x-ts-select.native name="role" id="role"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 dark:text-white rounded-lg"
                    wire:model='role'>
                    <option selected>Select...</option>
                    <option value="1">Allow</option>
                    <option value="0">Block</option>
                </x-ts-select.native>
            </div>

            <div class="flex-1 min-w-[150px]">
                <label for="status" class="text-gray-800 dark:text-gray-200">Status</label>
                <x-ts-select.native name="status" id="status"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 dark:text-white rounded-lg"
                    wire:model='status'>
                    <option selected>Select...</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </x-ts-select.native>
            </div>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="priority" class="text-gray-800 dark:text-gray-200">Priority</label>
            <x-ts-number id="priority" name="priority"
                class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg" wire:model='priority'
                hint="Press the plus button to increase one by one" min="1" max="100" />
        </div>
        <div class="flex flex-col space-y-2">
            <label for="priority" class="text-gray-800 dark:text-gray-200">Description</label>
            <x-ts-textarea id="description" name="description"
                class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg" wire:model='description' />
        </div>

    </div>

    <x-slot name="footer">
        <x-ts-button color="red" text="Close" x-on:click="$modalClose('modal-create')" />
        <x-ts-button color="primary" text="Apply" wire:click='defineFilter' />
    </x-slot>
</div>
