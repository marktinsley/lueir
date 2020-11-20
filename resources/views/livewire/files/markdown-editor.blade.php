<div class="mx-auto sm:px-6 lg:px-8 @if ($fullWidth) w-full @else max-w-6xl @endif">
    <div class="mb-4">
        <div
            class="py-5 px-6 flex justify-end">
            @if($edit)
                <x-jet-button wire:click="save" wire:loading.attr="disabled">
                    <svg class="w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Save
                </x-jet-button>
                <x-jet-secondary-button class="ml-2" wire:click="toggleEdit" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>
            @else
                <x-jet-button wire:click="toggleEdit">
                    <svg class="w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit
                </x-jet-button>
                <x-jet-secondary-button class="ml-2" wire:click="$emit('changePath', '{{ $this->folderPath }}')">
                    Close
                </x-jet-secondary-button>
            @endif
            <x-jet-secondary-button class="ml-2" wire:click="$toggle('fullWidth')">
                Toggle Width
            </x-jet-secondary-button>
            <div class="ml-2">
                <livewire:files.rename-dialog path="{{ $path }}"/>
            </div>
            <div class="ml-2">
                <livewire:files.move-dialog path="{{ $path }}"/>
            </div>
            <div class="py-3 px-3">
                <livewire:files.favorites-toggle path="{{ $path }}"/>
            </div>
        </div>
    </div>
    <div class="xl:flex">
        @if ($edit)
            <div class="flex-grow">
                <textarea name="contents"
                          class="w-full rounded p-4"
                          style="height: 80vh"
                          wire:model="contents"
                ></textarea>
            </div>
        @endif
        <div
            class="mb-12 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 pb-24 @if ($edit) ml-10 max-w-prose @else mx-auto @if (!$fullWidth) @endif @endif w-full">
            <article class="prose-lg">
                {!! $this->toHtml() !!}
            </article>
        </div>
    </div>
</div>
