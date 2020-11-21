<?php

namespace App\Http\Livewire\Files;

use App\Exceptions\Files\FileExistsException;
use App\Lib\Files\Folder;
use Livewire\Component;

class NewFolderDialog extends Component
{
    public string $parentPath;
    public string $name = '';
    public bool $creatingNewFolder = false;
    protected $listeners = ['changePath'];

    public function changePath(string $newPath)
    {
        $this->parentPath = $newPath;
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

        $this->creatingNewFolder = false;
        $this->name = '';

        $this->emit('changePath', $newFolder->relativePath());
        $this->emit('notify', 'success', 'Created folder!');
    }

    public function render()
    {
        return view('livewire.files.new-folder-dialog');
    }
}
