@props(['path'])

<div class="flex">
    <div>
        <livewire:files.move-dialog path="{{ $path }}"/>
    </div>

    <div class="ml-2">
        <livewire:files.rename-dialog path="{{ $path }}"/>
    </div>

    <div class="ml-2">
        <livewire:files.delete-dialog path="{{ $path }}"/>
    </div>

    {{ $slot }}
</div>
