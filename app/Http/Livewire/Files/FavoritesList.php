<?php

namespace App\Http\Livewire\Files;

use App\Lib\Files\BaseFile;
use App\Models\Favorite;
use Illuminate\Support\Str;
use Livewire\Component;

class FavoritesList extends Component
{
    public array $favoriteFiles;

    public function mount()
    {
        $this->setFavoriteFiles();
    }

    public function setFavoriteFiles()
    {
        $this->favoriteFiles = Favorite::query()->get()
            ->map->getFile()
            ->filter()
            ->map(fn(BaseFile $file) => [
                'relativePath' => $file->relativePath(),
                'truncatedPath' => strrev(
                    Str::of(strrev($file->relativePath()))->replaceMatches('#[/\\\\]#', ' / ')->limit(40)
                ),
            ])
            ->sortBy('truncatedPath')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.files.favorites-list');
    }
}
