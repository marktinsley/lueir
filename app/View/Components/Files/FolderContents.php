<?php

namespace App\View\Components\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\Folder;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FolderContents extends Component
{
    public ?string $path;
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
        $folder = BaseFile::atPath($this->path);

        if (!($folder instanceof Folder)) {
            throw new \InvalidArgumentException('The path must be a folder. ' . $this->path);
        }

        $this->folders = $folder->folders();
        $this->files = $folder->files();
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
