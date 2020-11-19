<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Livewire\Component;

/**
 * @property ?Files\File file
 * @property string folderPath
 */
class MarkdownEditor extends Component
{
    public string $path;
    public string $contents;
    public bool $edit = false;
    public bool $fullWidth = false;

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \InvalidArgumentException
     */
    public function mount()
    {
        $this->setContentsFromFile();
    }

    public function save()
    {
        $this->file->save($this->contents);
        $this->emit('notify', 'success', 'Saved changes');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function toggleEdit()
    {
        $this->edit = !$this->edit;

        if (!$this->edit) {
            $this->setContentsFromFile();
        }

	$this->emit('markdown-editor:view-change');
    }

    public function getFileProperty()
    {
        return Files\BaseFile::find(empty($this->path) ? null : $this->path);
    }

    public function getFolderPathProperty()
    {
        return $this->file->folder()->relativePath();
    }

    public function toHtml()
    {
        return (new GithubFlavoredMarkdownConverter())->convertToHtml($this->contents);
    }

    public function render()
    {
        return view('livewire.files.markdown-editor');
    }

    /**
     * Set the contents property based on the file at the given path.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function setContentsFromFile()
    {
        if ($this->file instanceof Files\Folder) {
            throw new \InvalidArgumentException("Folder provided ({$this->path}). Must provide a markdown file.");
        }

        if (!$this->file->isMarkdown()) {
            throw new \InvalidArgumentException("File is not markdown ({$this->path}).");
        }

        $this->contents = $this->file->contents();
    }
}
