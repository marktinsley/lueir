<?php

namespace App\Lib\Files;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class FileHelper
{
    /**
     * Turns a file path into something that's easier to read for humans.
     *
     * @param string|null $path
     * @return Stringable
     */
    public static function readablePath(?string $path): Stringable
    {
        return Str::of($path)->replaceMatches('#[/\\\\]#', ' / ')->trim();
    }

    /**
     * Convert the given markdown to HTML.
     *
     * @param $markdown
     * @return string
     */
    public static function markdownToHtml($markdown): string
    {
        return (new GithubFlavoredMarkdownConverter())->convertToHtml($markdown);
    }
}
