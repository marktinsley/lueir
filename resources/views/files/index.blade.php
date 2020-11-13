<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <livewire:files.location-breadcrumbs/>
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:files.file-view/>
    </div>
</x-app-layout>
