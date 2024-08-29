<div class="max-w-screen-lg mx-auto px-4 py-6">
    @if ($domains->isEmpty())
        <div class="flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900 p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">No domains found</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Create a new domain to get started.</p>
            <x-ts-button x-on:click="$modalOpen('modal-create')" color="primary" text="Create Domain" class="mt-4" />
        </div>
    @endif
    @foreach ($domains as $domain)
        <div
            class="flex flex-col bg-gray-100 lg:flex-row justify-between items-start lg:items-center p-4 dark:bg-gray-900 shadow-md rounded-lg mb-4">
            <div class="flex-1">
                <!-- Domain Information -->
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $domain->domain }}</h1>
                <div class="flex space-x-4 my-3">
                    <x-ts-badge :color="$domain->status ? 'green' : 'red'" :text="$domain->status ? 'Active' : 'Inactive'" />

                    <x-ts-badge :color="$domain->is_blocked ? 'green' : 'red'" :text="$domain->is_blocked ? 'Allow' : 'Block'" />
                </div>

                <!-- Priority and Description -->
                <div class="space-y-3">
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">Priority:</p>
                    <x-ts-progress :percent="$domain->priority" :color="$domain->priority <= 40 ? 'green' : ($domain->priority <= 60 ? 'yellow' : 'red')" class="w-64 mb-3" />

                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <x-ts-button wire:click="toggleDeleteModal({{ $domain->id }})" color="red" text="Delete" />
                <x-ts-button wire:click="toggleEditModal({{ $domain->id }})" color="yellow" text="Edit" />
            </div>
        </div>
    @endforeach

    @if ($domains)
        {{ $domains->links() }}
    @endif

    <x-ts-modal title="Delete Domain" wire="showDeleteModal">
        <div class="flex flex-col space-y-4">
            <p class="text-gray-800 dark:text-gray-200">Are you sure you want to delete this domain?</p>
        </div>
        <x-slot:footer>
            <x-ts-button color="secondary" text="Cancel" wire:click="toggleDeleteModal" />
            <x-ts-button color="red" text="Delete" wire:click="deleteDomain" />
        </x-slot:footer>
    </x-ts-modal>

    <x-ts-modal title="Edit a modal" wire='showEditModal'>
        <livewire:components.edit-domain />
    </x-ts-modal>

</div>
