<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Livewire\Component;

class MoveDialog extends Component
{
    public string $path;
    public ?string $newFolderPath;
    public bool $dialogOpen = false;
    protected $listeners = ['changePath', 'shortcutPressed'];

    public function mount()
    {
        $this->setFolderPath();
    }

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
        $this->setFolderPath();
    }

    public function shortcutPressed($shortcut)
    {
        if ($shortcut === 'm' && !$this->dialogOpen) {
            $this->dialogOpen = true;
        }
    }

    private function setFolderPath()
    {
        $file = $this->file();

        $this->newFolderPath = null;
        if ($file instanceof Folder && $file->parent()) {
            $this->newFolderPath = $file->parent()->relativePath();
        } else if ($file instanceof File && $file->folder()) {
            $this->newFolderPath = $file->folder()->relativePath();
        }
    }

    private function file()
    {
        return BaseFile::find($this->path);
    }

    public function moveFile()
    {
        $movedFile = $this->file()->move($this->newFolderPath);
        $this->emit('changePath', $movedFile->relativePath());
        $this->dialogOpen = false;
    }

    public function render()
    {
        return view('livewire.files.move-dialog');
    }
}
