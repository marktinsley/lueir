<div>
    <a wire:click="$emit('changePath', '')"
       @if ($path) class="cursor-pointer underline hover:text-blue-600" @endif
    >root</a>
    /
    @foreach($this->paths() as $file)
        <a wire:click="$emit('changePath', '{{ $file->relativePath() }}')"
           @if (!$loop->last) class="cursor-pointer underline hover:text-blue-600" @endif
        >{{ $file->name() }}</a> @if ($file instanceof \App\Lib\Files\Folder) / @endif
    @endforeach
</div>
