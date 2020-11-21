<?php

namespace App\View\Components\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\Folder;
use App\Lib\Files\MarkdownFile;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FolderContents extends Component
{
    public ?string $path;
    public Folder $folder;
    public bool $isBaseFolder;
    public ?MarkdownFile $readmeFile;
    public Collection $folders;
    public Collection $files;

    /**
     * Create a new component instance.
     *
     * @param string|null $path
     */
    public function __construct(?string $path)
    {
        $this->path = $path ?: null;
        $folder = BaseFile::find($this->path);

        if (!($folder instanceof Folder)) {
            throw new \InvalidArgumentException('The path must be a folder. ' . $this->path);
        }

        $this->folder = $folder;
        $this->isBaseFolder = is_null($this->folder->parent());
        $this->folders = $this->folder->folders();
        $this->files = $this->folder->files();
        $this->setReadmeFile();
    }

    private function setReadmeFile()
    {
        $this->readmeFile = $this->files
            ->first(fn($file) => $file instanceof MarkdownFile && strtolower($file->name()) === 'readme.md');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.files.folder-contents');
    }
}
