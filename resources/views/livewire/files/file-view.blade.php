<div>
    @if(is_null($this->file()) || $this->file() instanceof \App\Lib\Files\Folder)
        <x-files.folder-contents path="{{ $path }}" :key="$path"/>
    @elseif ($this->file()->isText())
        <textarea name="contents"
                  class="w-full rounded p-4"
                  style="height: 80vh"
        >{{ $this->file()->getContents() }}</textarea>
    @elseif (($this->file()->isBrowserRenderableImage()))
        <div class="p-8">It's an image at this file path: {{ $this->file()->absolutePath() }}.<br><br>We'll need a way
            to access it for the img tag.
        </div>
    @else
        <em>It's a file, but not a text file or an image</em>
    @endif
</div>
