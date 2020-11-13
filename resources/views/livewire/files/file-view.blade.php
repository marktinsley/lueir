<div>
    @if(is_null($this->file()) || $this->file() instanceof \App\Lib\Files\Folder)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-files.folder-contents path="{{ $path }}" :key="$path"/>
        </div>
    @elseif ($this->file()->isMarkdown())
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 90rem;">
            <livewire:files.markdown-editor path="{{ $path }}"/>
        </div>
    @elseif ($this->file()->isText())
        <textarea name="contents"
                  class="w-full rounded p-4"
                  style="height: 80vh"
        >{{ $this->file()->contents() }}</textarea>
    @elseif (($this->file()->isBrowserRenderableImage()))
        <div class="p-8">It's an image at this file path: {{ $this->file()->absolutePath() }}.<br><br>We'll need a way
            to access it for the img tag.
        </div>
    @else
        <em>It's a file, but not a text file or an image</em>
    @endif
</div>
