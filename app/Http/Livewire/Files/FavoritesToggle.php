<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Models\Favorite;
use Livewire\Component;

class FavoritesToggle extends Component
{
    public ?string $path;
    public bool $isFavorite;
    public $listeners = ['favoriteAdded'];

    public function mount()
    {
        $this->isFavorite = Favorite::isFavorite($this->file);
    }

    public function favoriteAdded()
    {
        $this->isFavorite = Favorite::isFavorite($this->file);
    }

    public function getFileProperty()
    {
        return BaseFile::find($this->path);
    }

    public function render()
    {
        return view('livewire.files.favorites-toggle');
    }
}
