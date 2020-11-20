<div>
    <x-jet-button wire:click="$toggle('dialogOpen')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
        </svg>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="dialogOpen">
        <x-slot name="title">
            Move File
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="new folder path"
                             wire:model.defer="newFolderPath"
                             wire:keydown.enter="moveFile"></x-jet-input>

                <x-jet-input-error for="name" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('dialogOpen')"
                                    wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="moveFile"
                          wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
