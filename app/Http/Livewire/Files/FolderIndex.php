<?php

namespace App\Http\Livewire\Files;

use Livewire\Component;

class FolderIndex extends Component
{
    public $path;

    public function render()
    {
        return view('livewire.files.folder-index');
    }
}
