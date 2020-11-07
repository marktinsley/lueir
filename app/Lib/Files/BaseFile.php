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
        return collect(Storage::disk()->directories())->mapInto(Folder::class);
    }

    /**
     * Gives you the path to this file (or folder).
     *
     * @return string
     */
    public function path(): string
    {
        return $this->basePath;
    }

    /**
     * Scaffold up some fake files and folders to test with.
     *
     * @return Collection
     */
    public static function fakeScaffold(): Collection
    {
        Storage::fake();

        Storage::makeDirectory('base-folder1');
        Storage::makeDirectory('base-folder1/sub-folder1');
        Storage::makeDirectory('base-folder1/sub-folder2');
        Storage::makeDirectory('base-folder2');

        Storage::put('base-folder1/file1.txt', 'test');
        Storage::put('base-folder1/file2.md', 'test');

        return static::baseFolders();
    }
}
