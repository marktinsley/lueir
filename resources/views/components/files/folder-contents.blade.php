<div>
    @if ($path)
        <div class="mb-4">
            <div class="py-5 px-6 flex justify-end">
                <livewire:files.new-file folder-path="{{ $path }}"/>

                <div class="ml-2">
                    <livewire:files.new-folder parent-path="{{ $path }}"/>
                </div>
            </div>
        </div>
    @endif

    @if ($folders->isEmpty() && $files->isEmpty())
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">This folder is empty</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @foreach($folders as $folder)
                <div class="bg-white hover:bg-gray-600 hover:text-white flex">
                    <div class="flex-none pl-6 pr-4 py-5 w-15 cursor-pointer"
                         wire:click="$emit('changePath', '{{ $folder->relativePath() }}')">
                        <svg class="w-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                        </svg>
                    </div>
                    <div class="flex-grow cursor-pointer py-5"
                         wire:click="$emit('changePath', '{{ $folder->relativePath() }}')">
                        {{ $folder->name() }}
                    </div>
                    <div class="flex-none w-12 py-5 pr-6 flex justify-end">
                        <div>
                            <livewire:files.folder-menu/>
                        </div>
                        <div>
                            <svg class="ml-3 w-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="#ffff00"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" wire:click="toggleFavorite('{{ $folder->relativePath() }}')">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($files as $file)
                <div wire:click="$emit('changePath', '{{ $file->relativePath() }}')"
                     class="py-5 px-6 bg-white hover:bg-gray-600 hover:text-white flex cursor-pointer">
                    <div class="flex-initial pr-4 w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        {{ $file->name() }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
