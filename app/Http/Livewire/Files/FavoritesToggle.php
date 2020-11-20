<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Models\Favorite;
use Livewire\Component;

class FavoritesToggle extends Component
{
    public ?string $path;
    public bool $isFavorite;

    public function mount()
    {
        $this->isFavorite = Favorite::isFavorite($this->file);
    }

    public function addFavorite(string $path)
    {
        $file = BaseFile::find($path);
        if (Favorite::isFavorite($file)) {
            Favorite::remove($file);
            $this->emit('notify', 'success', 'Removed from favorites');
            $this->isFavorite = false;
        } else {
            Favorite::add($file);
            $this->emit('notify', 'success', 'Added to favorites');
            $this->isFavorite = true;
        }
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
