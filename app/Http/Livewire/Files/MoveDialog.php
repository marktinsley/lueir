<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\Folder;
use Livewire\Component;

class MoveDialog extends Component
{
    public string $path;
    public string $newFolderPath;
    public bool $dialogOpen = false;
    protected $listeners = ['changePath'];

    public function mount()
    {
        $this->setFolderPath();
    }

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
        $this->setFolderPath();
    }

    private function setFolderPath()
    {
        $file = $this->file();

        $this->newFolderPath = $file instanceof Folder ? $file->parent()->relativePath() : $file->folder()->relativePath();
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
