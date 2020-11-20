<x-jet-dropdown align="right" width="48">
    <x-slot name="trigger">
        <div class="cursor-pointer">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
            </svg>
        </div>
    </x-slot>

    <x-slot name="content">
        <x-jet-dropdown-link onclick="alert('not yet')" class="cursor-pointer">
            Rename
        </x-jet-dropdown-link>

        <x-jet-dropdown-link onclick="alert('not yet')" class="cursor-pointer">
            Move
        </x-jet-dropdown-link>

        <x-jet-dropdown-link onclick="alert('not yet')" class="cursor-pointer">
            Delete
        </x-jet-dropdown-link>
    </x-slot>
</x-jet-dropdown>
