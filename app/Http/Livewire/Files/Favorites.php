<?php

namespace App\Http\Livewire\Files;

use App\Models\Favorite;
use Illuminate\Support\Collection;
use Livewire\Component;

class Favorites extends Component
{
    public Collection $favorites;

    public function setFavorites()
    {
        $this->favorites = Favorite::orderBy('path')->get();
    }

    public function mount() {
        $this->setFavorites();
    }

    public function render()
    {
        return view('livewire.files.favorites');
    }
}
