<div>
    <div class="mb-4">
        <div class="py-5 flex justify-between">
            @if ($path)
                <div class="flex">
                    @if (!$isBaseFolder)
                        <x-files.manipulation-buttons :path="$path"/>
                    @endif
                </div>

                <div class="flex justify-end">
                    <div class="py-3 px-3 mr-4">
                        <livewire:files.favorites-toggle :path="$path"/>
                    </div>

                    <div>
                        <livewire:files.new-file-dialog :folder-path="$path"/>
                    </div>

                    <div class="ml-2">
                        <livewire:files.new-folder-dialog :parent-path="$path"/>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div>
        @if ($folders->isEmpty() && $files->isEmpty())
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                 role="alert">
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
                @foreach($folders->concat($files) as $file)
                    <div onclick="Livewire.emit('changePath', '{{ $file->relativePath() }}')"
                         :key="{{ $file->relativePath() }}"
                         class="px-6 bg-white hover:bg-gray-600 hover:text-white flex cursor-pointer">
                        @if ($file instanceof \App\Lib\Files\Folder)
                            <div class="flex-none py-5 w-10">
                                <svg class="w-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                </svg>
                            </div>
                        @else
                            <div class="flex-none py-5 w-10">
                                <svg class="w-6 mr-1" xxmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-grow py-5">
                            {{ $file->name() }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if ($readmeFile)
        <div
            class="mb-24 mt-24 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 pb-24 w-full"
            onclick="Livewire.emit('changePath', '{{ $readmeFile->relativePath() }}')">
            <div class="pb-6">{{ $readmeFile->name() }}</div>

            <x-files.markdown-view :markdown="$readmeFile->toHtml()"/>
        </div>
    @endif
</div>
