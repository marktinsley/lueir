<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Tests\TestCase;

class FolderTest extends TestCase
{
    /** @test */
    function gives_the_available_base_folders()
    {
        // Arrange
        $rootFolder = BaseFile::fakeScaffold();

        // Execute
        $folders = $rootFolder->folders();

        // Check
        $paths = $folders->map->relativePath();
        $this->assertCount(2, $paths);
        $this->assertContains('base-folder1', $paths);
        $this->assertContains('base-folder2', $paths);
    }

    /** @test */
    function gives_the_folders_within_a_folder()
    {
        // Arrange
        /** @var Folder $baseFolder */
        $baseFolder = BaseFile::fakeScaffold()->folders()->first();

        // Execute
        $subFolders = $baseFolder->folders();
        $paths = $subFolders->map->relativePath();

        // Check
        $this->assertCount(2, $subFolders);
        $this->assertTrue($subFolders->every(fn($folder) => $folder instanceof Folder));
        $this->assertContains($baseFolder->relativePath() . DIRECTORY_SEPARATOR . 'sub-folder1', $paths);
        $this->assertContains($baseFolder->relativePath() . DIRECTORY_SEPARATOR . 'sub-folder2', $paths);
    }

    /** @test */
    function gives_the_files_within_a_folder()
    {
        // Arrange
        /** @var Folder $baseFolder */
        $baseFolder = BaseFile::fakeScaffold()->folders()->first();

        // Execute
        $subFiles = $baseFolder->files();
        $paths = $subFiles->map->relativePath();

        // Check
        $this->assertCount(2, $subFiles);
        $this->assertTrue($subFiles->every(fn($folder) => $folder instanceof File));
        $this->assertContains($baseFolder->relativePath() . DIRECTORY_SEPARATOR . 'file1.txt', $paths);
        $this->assertContains($baseFolder->relativePath() . DIRECTORY_SEPARATOR . 'file2.md', $paths);
    }

    /** @test */
    function gives_you_the_relative_path_to_the_folder()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first()->folders()->first();

        // Execute & Check
        $this->assertSame('base-folder1' . DIRECTORY_SEPARATOR . 'sub-folder1', $folder->relativePath());
    }

    /** @test */
    function gives_you_the_absolute_path_to_the_folder()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first()->folders()->first();

        // Execute & Check
        $this->assertSame(
            storage_path(join(DIRECTORY_SEPARATOR, [
                'framework/testing/disks/local',
                'base-folder1',
                'sub-folder1',
            ])),
            $folder->absolutePath()
        );
    }

    /** @test */
    function tells_you_the_name_of_the_folder()
    {
        // Arrange
        /** @var Folder $baseFolder */
        $baseFolder = BaseFile::fakeScaffold()->folders()->first();

        // Execute & Check
        $this->assertSame('base-folder1', $baseFolder->name());
    }
}
