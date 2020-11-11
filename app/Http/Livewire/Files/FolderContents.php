<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\Folder;
use Illuminate\Support\Collection;
use Livewire\Component;

class FolderContents extends Component
{
    public ?string $path = null;

    public function mount()
    {
        $this->path = empty($this->path) ? null : $this->path;
    }

    public function folder()
    {
        $folder = BaseFile::atPath($this->path);

        if (!($folder instanceof Folder)) {
            throw new \InvalidArgumentException('The path must be a folder. ' . $this->path);
        }

        return $folder;
    }

    public function getFoldersProperty(): Collection
    {
        return $this->folder()->folders();
    }

    public function getFilesProperty(): Collection
    {
        return $this->folder()->files();
    }

    public function render()
    {
        return view('livewire.files.folder-contents');
    }
}
