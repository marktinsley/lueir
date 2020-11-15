<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Livewire\Component;

class NewFile extends Component
{
    public string $folderPath;
    public string $filename = '';
    public bool $creatingNewFile = false;

    public function rules()
    {
        return [
            'filename' => 'required',
        ];
    }

    public function createNewFile()
    {
        $this->validate();
        File::create($this->filename, new Folder($this->folderPath));
        $this->creatingNewFile = false;
        $this->filename = '';
        $this->emit('changePath', $this->folderPath);
        $this->emit('notify', 'success', 'Created file!');
    }

    public function render()
    {
        return view('livewire.files.new-file');
    }
}
