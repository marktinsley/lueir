<div>
    <ul wire:poll.10s="setFavoriteFiles">
        @forelse($favoriteFiles as $fileInfo)
            <li class="py-3 px-4 hover:bg-gray-100 cursor-pointer"
                wire:key="{{ $fileInfo['relativePath'] }}"
                title="{{ $fileInfo['relativePath'] }}"
                onclick="Livewire.emit('changePath', '{{ $fileInfo['relativePath'] }}'); Lueir.MenuDrawer.hide();">
                {{ $fileInfo['truncatedPath'] }}
            </li>
        @empty
            <li class="py-3 px-4">
                <em>none</em>
            </li>
        @endforelse
    </ul>
</div>
