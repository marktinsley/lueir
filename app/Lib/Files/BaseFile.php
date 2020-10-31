<?php

namespace App\Lib\Files;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class BaseFile
{
    protected string $basePath;

    /**
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Gives you the base folders that a user can access.
     *
     * @return Collection
     */
    public static function baseFolders(): Collection
    {
        return collect(Storage::disk()->directories())->map(fn($path) => new Folder($path));
    }
}
