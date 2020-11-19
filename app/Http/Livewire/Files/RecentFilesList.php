<?php

namespace App\Http\Livewire\Files;

use App\Models\RecentFile;
use Illuminate\Support\Collection;
use Livewire\Component;

class RecentFilesList extends Component
{
    public Collection $recentFiles;

    public function setRecentFiles()
    {
        $this->recentFiles = RecentFile::mostRecent()->get();
    }

    public function mount()
    {
        $this->setRecentFiles();
    }

    public function render()
    {
        return view('livewire.files.recent-files-list');
    }
}
