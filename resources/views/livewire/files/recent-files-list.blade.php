<div>
    <div class="flex justify-between">
        <h2 class="text-xl mt-4 mb-4">Recent</h2>
        <div class="pt-2">
            <a class="px-4 py-2 text-sm text-gray-700 hover:text-blue-700 cursor-pointer"
               wire:click="clearRecentlyViewed"
               title="Clear recently viewed files">
                clear
            </a>
        </div>
    </div>

    <ul wire:poll.5s="setRecentFiles">
        @forelse($recentFiles as $recentFile)
            @continue(!$recentFile->getFile())
            <li class="py-3 px-4 hover:bg-gray-100 cursor-pointer"
                title="{{ $recentFile->created_at->tz(config('lueir.display_timezone'))->toDayDateTimeString() }}"
                onclick="Livewire.emit('changePath', '{{ $recentFile->path }}'); Lueir.MenuDrawer.hide();">
                {{ $recentFile->getFile()->name(true) }}
            </li>
        @empty
            <li class="py-3 px-4">
                <em>none</em>
            </li>
        @endforelse
    </ul>
</div>
