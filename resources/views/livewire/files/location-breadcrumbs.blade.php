<div class="flex justify-between">
    <div>
        <a wire:click="$emit('changePath', '')"
           @if ($path) class="cursor-pointer underline hover:text-blue-600" @endif
        >root</a>
        /
        @foreach($this->paths() as $file)
            <a wire:click="$emit('changePath', '{{ $file->relativePath() }}')"
               class="@if (!$loop->last) cursor-pointer underline hover:text-blue-600 @else text-blue-800 @endif"
            >{{ $file->name() }}</a> @if ($file instanceof \App\Lib\Files\Folder) / @endif
        @endforeach
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
         class="w-6 hover:text-blue-600 cursor-pointer"
         onclick="Lueir.Clipboard.copy('{{ $this->currentFile ? $this->currentFile->absolutePath() : '' }}')">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
    </svg>
</div>
