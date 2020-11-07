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
        return collect(Storage::directories($this->path()))->mapInto(static::class);
    }

    /**
     * Get the files within this folder.
     *
     * @return Collection
     */
    public function files(): Collection
    {
        return collect(Storage::files($this->path()))->mapInto(File::class);
    }
}
