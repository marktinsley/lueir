<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use Livewire\Component;

class LocationBreadcrumbs extends Component
{
    public ?string $path = null;
    protected $queryString = ['path'];
    protected $listeners = ['changePath'];

    public bool $showFullPath = false;

    public function changePath(string $newPath)
    {
        $this->path = $newPath;
    }

    public function showFullPath()
    {
        $this->showFullPath = true;
    }

    public function getCurrentFileProperty()
    {
        return BaseFile::atPath($this->path);
    }

    public function paths()
    {
        $currentPath = '';
        return collect(explode(DIRECTORY_SEPARATOR, $this->path))
            ->filter()
            ->map(function (string $pathSegment) use (&$currentPath) {
                $currentPath .= ($currentPath ? DIRECTORY_SEPARATOR : '') . $pathSegment;
                return BaseFile::atPath($currentPath);
            });
    }

    public function render()
    {
        return view('livewire.files.location-breadcrumbs');
    }
}
