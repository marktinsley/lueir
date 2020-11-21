<?php

namespace App\Http\Livewire\Files;

use App\Exceptions\Files\FileExistsException;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Livewire\Component;

class NewFileDialog extends Component
{
    public string $folderPath;
    public string $filename = '';
    public bool $dialogOpen = false;
    protected $listeners = ['changePath', 'shortcutPressed'];

    public function changePath(string $newPath)
    {
        $this->folderPath = $newPath;
    }

    public function shortcutPressed($shortcut)
    {
        if ($shortcut === 'f' && !$this->dialogOpen) {
            $this->dialogOpen = true;
        }
    }

    public function rules()
    {
        return [
            'filename' => 'required',
        ];
    }

    public function createNewFile()
    {
        $this->validate();

        try {
            File::create($this->filename, Folder::find($this->folderPath));
        } catch (FileExistsException $e) {
            $this->addError('filename', $e->getMessage());
            return;
        }

        $this->dialogOpen = false;
        $this->filename = '';

        $this->emit('changePath', $this->folderPath);
        $this->emit('notify', 'success', 'Created file!');
    }

    public function render()
    {
        return view('livewire.files.new-file-dialog');
    }
}
