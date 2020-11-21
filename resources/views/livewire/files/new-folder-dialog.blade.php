<div>
    <x-jet-button wire:click="$toggle('dialogOpen')">
        <svg class="w-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 11h4m-2-2v4"/>
        </svg>
        New Folder
    </x-jet-button>

    <x-jet-dialog-modal wire:model="dialogOpen">
        <x-slot name="title">
            New Folder
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="name"
                             wire:model.defer="name"
                             wire:keydown.enter="createNewFolder"/>

                <x-jet-input-error for="name" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('dialogOpen')"
                                    wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="createNewFolder"
                          wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
