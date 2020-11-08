<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use Livewire\Component;

class FileView extends Component
{
    public ?string $path = null;
    protected ?BaseFile $file;

    public function mount()
    {
        $this->file = BaseFile::atPath(empty($this->path) ? null : $this->path);
    }

    public function file()
    {
        return $this->file;
    }

    public function render()
    {
        return view('livewire.files.file-view');
    }
}
