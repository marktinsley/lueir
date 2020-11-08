<?php

namespace App\Lib\Files;

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
    public function getContents(): string
    {
        return $this->filesystem->get($this->relativePath);
    }
}
