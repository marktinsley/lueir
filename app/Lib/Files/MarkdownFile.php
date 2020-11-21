<?php

namespace App\Lib\Files;

class MarkdownFile extends File
{
    /**
     * Get the contents of this file as HTML.
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function toHtml(): string
    {
        return FileHelper::markdownToHtml($this->contents());
    }
}
