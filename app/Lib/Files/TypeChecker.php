<?php

namespace App\Lib\Files;

use App\Exceptions\Files\InvalidFileTypeException;
use Illuminate\Support\Str;

class TypeChecker
{
    /**
     * @var BaseFile
     */
    private BaseFile $file;

    public function __construct(BaseFile $file)
    {
        $this->file = $file;
    }

    /**
     * Is this a text file?
     *
     * @return bool
     */
    public function isText(): bool
    {
        return Str::startsWith($this->file->mimeType(), 'text/');
    }

    /**
     * Is this a markdown file?
     *
     * @return bool
     */
    public function isMarkdown(): bool
    {
        return $this->isText() && (new \SplFileInfo($this->file->absolutePath()))->getExtension() === 'md';
    }

    /**
     * Assert that the given file is a markdown file.
     *
     * @return TypeChecker
     * @throws InvalidFileTypeException
     */
    public function assertMarkdown(): self
    {
        if ($this->file instanceof Folder) {
            throw new InvalidFileTypeException("{$this->file->relativePath()} is not a relative path.");
        }

        if (!$this->isMarkdown()) {
            throw new InvalidFileTypeException("File is not markdown ({$this->file->relativePath()}).");
        }

        return $this;
    }

    /**
     * Is this an image that can be rendered in an <img> tag?
     *
     * @return bool
     */
    public function isBrowserRenderableImage(): bool
    {
        return in_array($this->file->mimeType(), [
            'image/gif',
            'image/jpeg',
            'image/png',
        ]);
    }
}
