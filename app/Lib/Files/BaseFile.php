<?php

namespace App\Lib\Files;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    protected function __construct(string $relativePath = '', string $disk = 'local')
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
    public static function find(?string $relativePath, string $disk = 'local'): ?self
    {
        if (is_null($relativePath)) {
            return new Folder('', $disk);
        }

        $filesystem = Storage::disk($disk);
        if (!$filesystem->exists($relativePath)) {
            return null;
        }

        if (is_dir($filesystem->path($relativePath))) {
            return new Folder($relativePath, $disk);
        }

        $file = new File($relativePath, $disk);
        $typeChecker = new TypeChecker($file);

        if ($typeChecker->isMarkdown()) {
            return new MarkdownFile($relativePath, $disk);
        }

        return $file;
    }

    /**
     * Get the file type checker for this file.
     *
     * @return TypeChecker
     */
    public function typeChecker(): TypeChecker
    {
        return new TypeChecker($this);
    }

    /**
     * Get the mime type of this file/folder.
     *
     * @return string
     */
    public function mimeType(): string
    {
        return $this->filesystem->mimeType($this->relativePath);
    }

    /**
     * Get the name of the file/folder.
     *
     * @param bool $includeDirName
     * @return string
     */
    public function name(bool $includeDirName = false): string
    {
        $result = basename($this->relativePath);

        if ($includeDirName) {
            $result = Str::of(dirname($this->relativePath))->split('#[/\\\\]#')->last() . DIRECTORY_SEPARATOR . $result;
        }

        return $result;
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
     * Gives you the disk this file is in.
     */
    public function disk(): string
    {
        return $this->disk;
    }

    /**
     * Rename this file/folder.
     *
     * @param string $newName
     * @return $this
     */
    public function rename(string $newName): self
    {
        $newPath = dirname($this->relativePath()) . DIRECTORY_SEPARATOR . $newName;
        $this->filesystem->move($this->relativePath, $newPath);
        $this->relativePath = $newPath;
        return $this;
    }

    /**
     * Move this file/folder.
     *
     * @param string $newPath Path to a folder (pre-existing or not).
     * @return $this
     */
    public function move(string $newPath): self
    {
        $newPath .= DIRECTORY_SEPARATOR . $this->name();
        $this->filesystem->move($this->relativePath, $newPath);
        $this->relativePath = $newPath;

        return $this;
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
}
