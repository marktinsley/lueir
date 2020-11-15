<?php

namespace App\Lib\Files;

use App\Exceptions\Files\FileExistsException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends BaseFile
{
    /**
     * Is this a text file?
     *
     * @return bool
     */
    public function isText(): bool
    {
        return Str::startsWith($this->filesystem->mimeType($this->relativePath), 'text/');
    }

    /**
     * Is this a markdown file?
     *
     * @return bool
     */
    public function isMarkdown(): bool
    {
        return $this->isText() && (new \SplFileInfo($this->absolutePath()))->getExtension() === 'md';
    }

    /**
     * Is this an image that can be rendered in an <img> tag?
     *
     * @return bool
     */
    public function isBrowserRenderableImage(): bool
    {
        return in_array($this->filesystem->mimeType($this->relativePath), [
            'image/gif',
            'image/jpeg',
            'image/png',
        ]);
    }

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
     * Gives you the folder this file lives inside of.
     *
     * @return Folder
     */
    public function folder(): Folder
    {
        $dirname = dirname($this->relativePath());
        return new Folder($dirname === '.' ? '' : $dirname, $this->disk);
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
}
