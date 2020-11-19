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
    public bool $creatingNewFile = false;
    protected $listeners = ['changePath'];

    public function changePath(string $newPath)
    {
        $this->folderPath = $newPath;
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
            File::create($this->filename, new Folder($this->folderPath));
        } catch (FileExistsException $e) {
            $this->addError('filename', $e->getMessage());
            return;
        }

        $this->creatingNewFile = false;
        $this->filename = '';

        $this->emit('changePath', $this->folderPath);
        $this->emit('notify', 'success', 'Created file!');
    }

    public function render()
    {
        return view('livewire.files.new-file-dialog');
    }
}
