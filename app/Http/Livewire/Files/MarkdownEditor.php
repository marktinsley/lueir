<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Livewire\Component;

class MarkdownEditor extends Component
{
    public string $path;
    public string $contents;
    public bool $edit = false;

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \InvalidArgumentException
     */
    public function mount()
    {
        /** @var Files\File $file */
        $file = Files\BaseFile::atPath(empty($this->path) ? null : $this->path);

        if ($file instanceof Files\Folder) {
            throw new \InvalidArgumentException("Folder provided ({$this->path}). Must provide a markdown file.");
        }

        if (!$file->isMarkdown()) {
            throw new \InvalidArgumentException("File is not markdown ({$this->path}).");
        }

        $this->contents = $file->contents();
    }

    public function toggleEdit()
    {
        $this->edit = !$this->edit;
    }

    public function getFolderPathProperty()
    {
        return (Files\BaseFile::atPath(empty($this->path) ? null : $this->path))->folder()->relativePath();
    }

    public function toHtml()
    {
        return (new GithubFlavoredMarkdownConverter())->convertToHtml($this->contents);
    }

    public function render()
    {
        return view('livewire.files.markdown-editor');
    }
}
