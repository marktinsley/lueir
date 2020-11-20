<?php

namespace App\Lib\Files;

use App\Exceptions\Files\FileExistsException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * Gives you the parent folder of this folder, if any.
     *
     * @return Folder|null
     */
    public function parent(): ?Folder
    {
        return self::find(dirname($this->relativePath()));
    }

    /**
     * Create a folder in the given folder in the given disk.
     *
     * @param string $name
     * @param Folder|null $parentFolder
     * @param string $disk
     * @return static
     * @throws FileExistsException
     */
    public static function create(string $name, ?Folder $parentFolder = null, string $disk = 'local'): self
    {
        $parentFolder = $parentFolder ?? new Folder('', $disk);
        $fullPath = Str::finish($parentFolder->relativePath(), DIRECTORY_SEPARATOR) . $name;

        if (self::find($fullPath)) {
            throw new FileExistsException('Cannot create folder. Folder already exists with that name.');
        }

        Storage::disk($disk)->makeDirectory($fullPath);

        return self::find($fullPath);
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
