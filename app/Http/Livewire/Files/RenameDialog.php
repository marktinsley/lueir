<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use Livewire\Component;

class RenameDialog extends Component
{
    public string $path;
    public string $name;
    public bool $dialogOpen = false;
    protected $listeners = ['changePath', 'shortcutPressed'];

    public function mount()
    {
        $this->setName();
    }

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
        $this->setName();
    }

    public function shortcutPressed($shortcut)
    {
        if ($shortcut === 'r' && !$this->dialogOpen) {
            $this->dialogOpen = true;
        }
    }

    private function setName()
    {
        $this->name = optional($this->file())->name() ?? '';
    }

    private function file()
    {
        return BaseFile::find($this->path);
    }

    public function renameFile()
    {
        $renamedFile = $this->file()->rename($this->name);
        $this->emit('changePath', $renamedFile->relativePath());
        $this->dialogOpen = false;
    }

    public function render()
    {
        return view('livewire.files.rename-dialog');
    }
}
