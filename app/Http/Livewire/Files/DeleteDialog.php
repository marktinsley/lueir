<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use Livewire\Component;

class DeleteDialog extends Component
{
    public string $path;
    public bool $dialogOpen = false;
    protected $listeners = ['changePath'];

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
    }

    public function file(): ?BaseFile
    {
        return BaseFile::find($this->path);
    }

    public function deleteFile()
    {
        $file = $this->file();
        $file->delete();
        $this->emit('changePath', optional($file->parent())->relativePath());
        $this->dialogOpen = false;
    }

    public function render()
    {
        return view('livewire.files.delete-dialog');
    }
}
