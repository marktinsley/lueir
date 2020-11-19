<div>
    @if(is_null($this->file()) || $this->file() instanceof \App\Lib\Files\Folder)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-files.folder-contents path="{{ $path }}"/>
        </div>
    @elseif ($this->file()->isMarkdown())
        <livewire:files.markdown-editor path="{{ $path }}"/>
    @elseif ($this->file()->isText())
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <pre style="white-space: pre-wrap">{{ $this->file()->contents() }}</pre>
        </div>
    @elseif (($this->file()->isBrowserRenderableImage()))
        <div class="p-8">It's an image at this file path: {{ $this->file()->absolutePath() }}.<br><br>We'll need a way
            to access it for the img tag.
        </div>
    @else
        <em>It's a file, but not a text file or an image</em>
    @endif
</div>
