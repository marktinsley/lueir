<?php

namespace App\Lib\Files;

use App\Exceptions\Files\FileExistsException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends BaseFile
{

    /**
     * Get the contents of this file.
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function contents(): string
    {
        return $this->filesystem->get($this->relativePath);
    }

    /**
     * Gives you the parent folder for this file (the one it lives in).
     *
     * @return Folder
     */
    public function parent(): Folder
    {
        $dirname = dirname($this->relativePath());
        return new Folder($dirname === '.' ? '' : $dirname, $this->disk);
    }

    /**
     * Gives you the folder this file lives inside of.
     * This is an alias for the parent method.
     *
     * @return Folder
     */
    public function folder(): Folder
    {
        return $this->parent();
    }

    /**
     * Save the given string in this file.
     *
     * @param string $newContents
     */
    public function save(string $newContents)
    {
        $this->filesystem->put($this->relativePath, $newContents);
    }

    /**
     * Create a new file with the given name in the given folder in the given disk.
     *
     * @param string $filename
     * @param Folder|null $folder
     * @param string $disk
     * @return File
     * @throws FileExistsException
     */
    public static function create(string $filename, ?Folder $folder = null, string $disk = 'local'): self
    {
        $folder = $folder ?? new Folder('', $disk);
        $fullPath = Str::finish($folder->relativePath(), DIRECTORY_SEPARATOR) . $filename;

        if (self::find($fullPath)) {
            throw new FileExistsException('Cannot create file. File already exists with that name.');
        }

        Storage::disk($disk)->put($fullPath, '');

        return self::find($fullPath);
    }

    /**
     * Delete this file.
     */
    public function delete()
    {
        $this->filesystem->delete($this->relativePath());
    }
}
