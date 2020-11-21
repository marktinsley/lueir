<div>
    <x-jet-secondary-button wire:click="$toggle('dialogOpen')">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="dialogOpen">
        <x-slot name="title">
            Rename File
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="new name"
                             wire:model.defer="name"
                             wire:keydown.enter="renameFile"></x-jet-input>

                <x-jet-input-error for="name" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('dialogOpen')"
                                    wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="renameFile"
                          wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
