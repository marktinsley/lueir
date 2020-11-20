<?php

namespace App\Http\Livewire\Files;

use Livewire\Component;

class FileContextMenu extends Component
{
    public ?string $path;
    protected $listeners = ['changePath'];

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
    }

    public function render()
    {
        return view('livewire.files.file-context-menu');
    }
}
