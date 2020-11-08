<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\Folder;
use Illuminate\Support\Collection;
use Livewire\Component;

class FolderContents extends Component
{
    public ?string $path = null;
    protected Folder $folder;

    public function mount()
    {
        $this->path = empty($this->path) ? null : $this->path;

        $folder = BaseFile::atPath($this->path);

        if (!($folder instanceof Folder)) {
            throw new \InvalidArgumentException('The given path must be a folder. ' . $this->path);
        }

        $this->folder = $folder;
    }

    public function folders(): Collection
    {
        return $this->folder->folders();
    }

    public function files(): Collection
    {
        return $this->folder->files();
    }

    public function render()
    {
        return view('livewire.files.folder-contents');
    }
}
