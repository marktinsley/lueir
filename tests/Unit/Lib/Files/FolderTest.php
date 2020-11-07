<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\FakeFolder;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Tests\TestCase;

class FolderTest extends TestCase
{
    /** @test */
    function gives_the_available_base_folders()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute
        $folders = Folder::baseFolders();

        // Check
        $paths = $folders->map->path();
        $this->assertCount(2, $paths);
        $this->assertContains('base-folder1', $paths);
        $this->assertContains('base-folder2', $paths);
    }

    /** @test */
    function gives_the_folders_within_a_folder()
    {
        // Arrange
        /** @var Folder $baseFolder */
        $baseFolder = Folder::fakeScaffold()->first();

        // Execute
        $subFolders = $baseFolder->folders();
        $paths = $subFolders->map->path();

        // Check
        $this->assertCount(2, $subFolders);
        $this->assertTrue($subFolders->every(fn($folder) => $folder instanceof Folder));
        $this->assertContains($baseFolder->path() . DIRECTORY_SEPARATOR . 'sub-folder1', $paths);
        $this->assertContains($baseFolder->path() . DIRECTORY_SEPARATOR . 'sub-folder2', $paths);
    }

    /** @test */
    function gives_the_files_within_a_folder()
    {
        // Arrange
        /** @var Folder $baseFolder */
        $baseFolder = Folder::fakeScaffold()->first();

        // Execute
        $subFiles = $baseFolder->files();
        $paths = $subFiles->map->path();

        // Check
        $this->assertCount(2, $subFiles);
        $this->assertTrue($subFiles->every(fn($folder) => $folder instanceof File));
        $this->assertContains($baseFolder->path() . DIRECTORY_SEPARATOR . 'file1.txt', $paths);
        $this->assertContains($baseFolder->path() . DIRECTORY_SEPARATOR . 'file2.md', $paths);
    }
}
