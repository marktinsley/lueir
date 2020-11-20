<div>
    <x-jet-dropdown-link wire:click="$toggle('dialogOpen')" class="cursor-pointer">
        Rename
    </x-jet-dropdown-link>

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
