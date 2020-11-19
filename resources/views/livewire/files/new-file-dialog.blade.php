<div>
    <x-jet-button wire:click="$toggle('creatingNewFile')">
        <svg class="w-6 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        New File
    </x-jet-button>

    <x-jet-dialog-modal wire:model="creatingNewFile">
        <x-slot name="title">
            New File
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="Filename"
                             wire:model.defer="filename"
                             wire:keydown.enter="createNewFile"/>

                <x-jet-input-error for="filename" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('creatingNewFile')"
                                    wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="createNewFile"
                          wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
