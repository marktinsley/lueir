<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\Folder;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FolderTest extends TestCase
{
    /** @test */
    function gives_the_available_base_folders()
    {
        // Arrange
        Storage::fake();
        Storage::makeDirectory('base-folder1');
        Storage::makeDirectory('base-folder2');

        // Execute
        $folders = Folder::baseFolders();

        // Check
        $paths = $folders->map->path();
        $this->assertCount(2, $paths);
        $this->assertContains('base-folder1', $paths);
        $this->assertContains('base-folder2', $paths);
    }
}
