<?php

namespace App\View\Components\Files;

use App\Models\RecentFile;
use Illuminate\View\Component;

class MenuDrawer extends Component
{
    public $recentFiles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->recentFiles = RecentFile::mostRecent()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.files.menu-drawer');
    }
}
