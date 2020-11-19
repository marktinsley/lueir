<?php

namespace App\Http\Livewire\Files;

use App\Models\Favorite;
use Illuminate\Support\Collection;
use Livewire\Component;

class FavoritesList extends Component
{
    public Collection $favorites;

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
