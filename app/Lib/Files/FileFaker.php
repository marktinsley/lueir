<?php

namespace App\Lib\Files;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FileFaker
{
    private string $disk;

    public function __construct(string $disk = 'local')
    {
        $this->disk = $disk;
        Storage::fake($disk);
    }

    public static function fake()
    {
        return new self();
    }

    /**
     * Scaffold up some fake files and folders to test with.
     *
     * @return Folder
     */
    public function scaffold(): Folder
    {
        $this->folder('base-folder1', [
            'file1.txt' => 'file1 contents',
            'file2.md' => 'file2 contents',
        ]);

        $this->folder('base-folder1/sub-folder1');
        $this->folder('base-folder1/sub-folder2');
        $this->folder('base-folder2');

        $this->file('base-file1.md', 'base-file1 contents');

        return new Folder();
    }

    /**
     * Add a file at the given path with the given contents.
     *
     * @param string $path
     * @param $contents
     * @return File
     */
    public function file(string $path, $contents = 'some content'): File
    {
        Storage::disk($this->disk)->put($path, $contents);

        return File::find($path, $this->disk);
    }

    /**
     * Add multiple files.
     *
     * @param string[] $paths
     * @param $contents
     * @return Collection
     */
    public function files(array $paths, $contents = 'some content'): Collection
    {
        return collect($paths)->map(fn($path) => $this->file($path, $contents));
    }

    /**
     * Add a folder at the given path.
     *
     * @param string $path
     * @param array $files
     * @return Folder
     */
    public function folder(string $path, array $files = []): Folder
    {
        Storage::disk($this->disk)->makeDirectory($path);

        foreach ($files as $filePath => $contents) {
            if (is_numeric($filePath)) {
                $this->file($path . DIRECTORY_SEPARATOR . $contents);
            } else {
                $this->file($path . DIRECTORY_SEPARATOR . $filePath, $contents);
            }
        }

        return Folder::find($path, $this->disk);
    }
}
