<?php

namespace App\Lib\Files;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * @property string relativePath
 */
class Folder extends BaseFile implements Arrayable
{
    protected array $ignoreFolders = ['.git', '.idea'];

    /**
     * Get the folders within this folder.
     *
     * @return Collection
     */
    public function folders(): Collection
    {
        return collect($this->filesystem->directories($this->relativePath()))
            ->reject(fn($folderPath) => in_array(basename($folderPath), $this->ignoreFolders))
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

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            ...$this->folders()->map->relativePath(),
            ...$this->files()->map->relativePath(),
        ];
    }
}
