<?php

namespace App\Http\Livewire\Files;

use App\Models\RecentFile;
use Illuminate\Support\Collection;
use Livewire\Component;

class MenuDrawer extends Component
{
    public Collection $recentFiles;

    protected $listeners = ['echo-private:files,RecentFileAdded' => 'refreshRecentFiles'];

    public function refreshRecentFiles()
    {
        // TODO This doesn't seem to be running.
        $this->recentFiles = RecentFile::mostRecent()->get();
    }

    public function mount()
    {
        $this->recentFiles = RecentFile::mostRecent()->get();
    }

    public function render()
    {
        return view('livewire.files.menu-drawer');
    }
}
