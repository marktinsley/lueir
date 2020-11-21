<?php

namespace App\Http\Livewire\Files;

use App\Exceptions\Files\FileExistsException;
use App\Lib\Files\Folder;
use Livewire\Component;

class NewFolderDialog extends Component
{
    public string $parentPath;
    public string $name = '';
    public bool $dialogOpen = false;
    protected $listeners = ['changePath', 'shortcutPressed'];

    public function changePath(string $newPath)
    {
        $this->parentPath = $newPath;
    }

    public function shortcutPressed($shortcut)
    {
        if ($shortcut === 'n' && !$this->dialogOpen) {
            $this->dialogOpen = true;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function createNewFolder()
    {
        $this->validate();

        try {
            $newFolder = Folder::create($this->name, Folder::find($this->parentPath));
        } catch (FileExistsException $e) {
            $this->addError('name', $e->getMessage());
            return;
        }

        $this->dialogOpen = false;
        $this->name = '';

        $this->emit('changePath', $newFolder->relativePath());
        $this->emit('notify', 'success', 'Created folder!');
    }

    public function render()
    {
        return view('livewire.files.new-folder-dialog');
    }
}
