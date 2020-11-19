<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Models\Favorite;
use Illuminate\Support\Collection;
use Livewire\Component;

class FavoritesList extends Component
{
    public Collection $favorites;
    protected $listeners = ['addFavorite'];

    public function addFavorite(string $path)
    {
        $file = BaseFile::find($path);
        if (Favorite::isFavorite($file)) {
            Favorite::remove($file);
            $this->emit('notify', 'success', 'Removed from favorites');
        } else {
            Favorite::add($file);
            $this->emit('notify', 'success', 'Added to favorites');
        }
    }

    public function setFavoriteFiles()
    {
        $this->favorites = Favorite::orderBy('path')->get();
    }

    public function mount()
    {
        $this->setFavoriteFiles();
    }

    public function render()
    {
        return view('livewire.files.favorites-list');
    }
}
