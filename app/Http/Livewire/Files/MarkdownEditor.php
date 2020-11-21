<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files;
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
    protected $listeners = ['shortcutPressed'];

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \InvalidArgumentException
     */
    public function mount()
    {
        $this->setContentsFromFile();
    }

    public function shortcutPressed($shortcut)
    {
        if ($shortcut === 'e' && !$this->edit) {
            $this->toggleEdit();
        } elseif ($shortcut === 'q' && $this->edit) {
            $this->toggleEdit();
        } elseif ($shortcut === 'x' && $this->edit) {
            $this->save();
            $this->toggleEdit();
        } elseif (in_array($shortcut, ['w', 'save']) && $this->edit) {
            $this->save();
        }
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
    }

    public function getFileProperty()
    {
        return Files\BaseFile::find(empty($this->path) ? null : $this->path);
    }

    public function getFolderPathProperty()
    {
        return $this->file->folder()->relativePath();
    }

    /**
     * Set the contents property based on the file at the given path.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function setContentsFromFile()
    {
        $this->file->typeChecker()->assertMarkdown();
        $this->contents = $this->file->contents();
    }

    public function render()
    {
        return view('livewire.files.markdown-editor');
    }
}
