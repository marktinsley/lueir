<div wire:poll.5s="setRecentFiles">
    <ul>
        @forelse($recentFiles as $recentFile)
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
