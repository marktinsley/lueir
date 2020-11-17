<?php

namespace App\Listeners;

use App\Events\PathAccessed;
use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use App\Models\RecentFile;

class RecordRecentFile
{
    /**
     * Handle the event.
     *
     * @param PathAccessed $event
     * @return void
     */
    public function handle(PathAccessed $event)
    {
        if (!$event->path) {
            return;
        }

        $file = BaseFile::find($event->path);

        if ($file instanceof File) {
            RecentFile::record($file);
        }
    }
}
