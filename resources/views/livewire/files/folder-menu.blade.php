<sl-dropdown hoist x-data>
    <span slot="trigger" class="cursor-pointer">
        <sl-icon name="three-dots-vertical"></sl-icon>
    </span>
    <sl-menu class="text-gray-800">
        <sl-menu-item x-on:click="alert('not-yet')">
            Rename
        </sl-menu-item>
        <sl-menu-item x-on:click="alert('not-yet')">
            Move
        </sl-menu-item>
        <sl-menu-item x-on:click="alert('not-yet')">
            Delete
        </sl-menu-item>
    </sl-menu>
</sl-dropdown>
