<sl-drawer placement="left" class="drawer-placement-left drawer-scrolling" id="menu-drawer">
    <h2 class="text-xl">Favorites</h2>

    <ul>
        <li class="py-3 px-4 hover:bg-gray-100" onclick="Livewire.emit('changePath', 'para-home-base/1- Projects')">
            a
        </li>
        <li class="py-3 px-4 hover:bg-gray-100" onclick="Livewire.emit('changePath', 'para-home-base/1- Projects')">
            alksdjf
        </li>
        <li class="py-3 px-4 hover:bg-gray-100" onclick="Livewire.emit('changePath', 'para-home-base/1- Projects')">
            alksdjf
        </li>
    </ul>

    <hr class="my-3">

    <h2 class="text-xl mt-4 mb-4">Recent</h2>

    <livewire:files.recent-files/>
</sl-drawer>
