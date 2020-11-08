<?php

namespace App\Lib\Files;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Folder extends BaseFile
{
    /**
     * Get the folders within this folder.
     *
     * @return Collection
     */
    public function folders(): Collection
    {
        return collect($this->filesystem->directories($this->relativePath()))
            ->map(fn($folderPath) => new Folder($folderPath, $this->disk));
    }

    /**
     * Get the files within this folder.
     *
     * @return Collection
     */
    public function files(): Collection
    {
        return collect($this->filesystem->files($this->relativePath()))
            ->map(fn($filePath) => new File($filePath, $this->disk));
    }
}
