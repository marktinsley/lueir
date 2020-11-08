<div>
    @foreach($this->folders() as $folder)
        <a href="{{ route('files.index', ['path' => $folder->relativePath()]) }}"
           class="py-5 px-6 bg-white hover:bg-gray-600 hover:text-white flex cursor-pointer">
            <div class="flex-initial pr-4 w-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
            </div>
            <div>
                {{ $folder->name() }}
            </div>
        </a>
    @endforeach
    @foreach($this->files() as $file)
        <a href="{{ route('files.index', ['path' => $file->relativePath()]) }}"
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
        </a>
    @endforeach
</div>
