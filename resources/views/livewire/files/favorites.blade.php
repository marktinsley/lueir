<div>
    <ul>
        @forelse($favorites as $favorite)
            <li class="py-3 px-4 hover:bg-gray-100 cursor-pointer"
                title="{{ $favorite->path }}"
                onclick="Livewire.emit('changePath', '{{ $favorite->path }}'); Lueir.MenuDrawer.hide();">
                {{ $favorite->getFile()->name(true) }}
            </li>
        @empty
            <li class="py-3 px-4">
                <em>none</em>
            </li>
        @endforelse
    </ul>
</div>
