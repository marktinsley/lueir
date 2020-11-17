<?php

namespace App\Http\Livewire\Files;

use App\Events\PathAccessed;
use App\Lib\Files\BaseFile;
use Livewire\Component;

class FileView extends Component
{
    public ?string $path = null;
    protected $queryString = ['path'];
    protected $listeners = ['changePath'];

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
        PathAccessed::dispatch($newPath);
    }

    public function file()
    {
        return BaseFile::find(empty($this->path) ? null : $this->path);
    }

    public function render()
    {
        return view('livewire.files.file-view');
    }
}
