<?php

namespace App\Lib\Files;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class BaseFile
{
    /**
     * The path to the file, relative to the "Disk".
     *
     * @var string
     */
    protected string $relativePath;

    /**
     * The disk the file is in.
     *
     * @var string
     */
    protected string $disk;

    /**
     * This is what we're providing our own interface for.
     *
     * @var Filesystem
     */
    protected Filesystem $filesystem;

    /**
     * @param string $relativePath The path to the file or folder.
     * @param string $disk The Laravel disk this file is in.
     */
    public function __construct(string $relativePath, string $disk = 'local')
    {
        $this->relativePath = $relativePath;
        $this->disk = $disk;
        $this->filesystem = Storage::disk($disk);
    }

    /**
     * Get the name of the file/folder.
     *
     * @return string
     */
    public function name()
    {
        return basename($this->relativePath);
    }

    /**
     * Gives you the relative path to this file (or folder).
     *
     * @return string
     */
    public function relativePath(): string
    {
        return $this->relativePath;
    }

    /**
     * Gives you the absolute path to this file (or folder).
     *
     * @return string
     */
    public function absolutePath(): string
    {
        return $this->filesystem->path($this->relativePath);
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

        return Folder::baseFolders();
    }
}
