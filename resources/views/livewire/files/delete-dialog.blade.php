@php $typeName = $this->file() instanceof \App\Lib\Files\Folder ? 'Folder' : 'File'; @endphp
<div>
    <x-jet-secondary-button wire:click="$toggle('dialogOpen')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    </x-jet-secondary-button>

    <x-jet-confirmation-modal wire:model="dialogOpen">
        <x-slot name="title">
            Delete {{ $typeName }}
        </x-slot>

        <x-slot name="content">
            <p>Are you sure you want to delete this {{ strtolower($typeName) }}?</p>

            @if($this->file() instanceof \App\Lib\Files\Folder && ($this->file()->files()->isNotEmpty() || $this->file()->folders()->isNotEmpty()))
                <div class="my-3 text-red-800">
                    This will delete everything inside of this folder as well.
                </div>
            @endif

            <div class="my-3 p-3 bg-gray-100 rounded-lg">{{ \App\Lib\Files\FileHelper::readablePath($path) }}</div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('dialogOpen')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteFile" wire:loading.attr="disabled">
                Delete {{ $typeName }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
