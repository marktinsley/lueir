<div>
    @foreach((new \App\Lib\Files\Folder($this->path))->folders() as $folder)
        {{ basename($folder->path()) }}
    @endforeach
    @foreach((new \App\Lib\Files\Folder($this->path))->files() as $file)
        {{ basename($file->path()) }}
    @endforeach
</div>
