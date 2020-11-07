<div>
    @foreach($this->folders() as $folder)
        {{ $folder->name() }}
    @endforeach
    @foreach($this->files() as $file)
        {{ $file->name() }}
    @endforeach
</div>
