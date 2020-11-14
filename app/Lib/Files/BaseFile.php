<?php

namespace App\Lib\Files;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

abstract class BaseFile implements \ArrayAccess
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
    public function __construct(string $relativePath = '', string $disk = 'local')
    {
        $this->relativePath = $relativePath;
        $this->disk = $disk;
        $this->filesystem = Storage::disk($disk);
    }

    /**
     * Gives you the file or folder at the given path.
     *
     * @param string|null $relativePath
     * @param string $disk
     * @return static|null
     */
    public static function atPath(?string $relativePath, string $disk = 'local'): ?self
    {
        if (is_null($relativePath)) {
            return new Folder('', $disk);
        }

        $filesystem = Storage::disk($disk);
        if (!$filesystem->exists($relativePath)) {
            return null;
        }

        return is_dir($filesystem->path($relativePath))
            ? new Folder($relativePath, $disk)
            : new File($relativePath, $disk);
    }

    /**
     * Get the name of the file/folder.
     *
     * @return string
     */
    public function name(): string
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

    public function offsetExists($offset)
    {
        return $offset === 'relativePath';
    }

    public function offsetGet($offset)
    {
        if ($offset === 'relativePath') {
            return $this->relativePath;
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === 'relativePath') {
            $this->relativePath = $value;
        }
    }

    public function offsetUnset($offset)
    {
        $this->relativePath = '';
    }

    /**
     * Scaffold up some fake files and folders to test with.
     *
     * @return Folder
     */
    public static function fakeScaffold(): Folder
    {
        Storage::fake();

        Storage::makeDirectory('base-folder1');
        Storage::makeDirectory('base-folder1/sub-folder1');
        Storage::makeDirectory('base-folder1/sub-folder2');
        Storage::makeDirectory('base-folder2');

        Storage::put('base-folder1/file1.txt', 'file1 contents');
        Storage::put('base-folder1/file2.md', 'file2 contents');
        Storage::put('base-file1.md', 'base-file1 contents');

        return new Folder();
    }
}
