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
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();

        // Execute
        $subFolders = $folder->folders();
        $paths = $subFolders->map->relativePath();

        // Check
        $this->assertCount(2, $subFolders);
        $this->assertTrue($subFolders->every(fn($folder) => $folder instanceof Folder));
        $this->assertContains($folder->relativePath() . DIRECTORY_SEPARATOR . 'sub-folder1', $paths);
        $this->assertContains($folder->relativePath() . DIRECTORY_SEPARATOR . 'sub-folder2', $paths);
    }

    /** @test */
    function gives_the_files_within_a_folder()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();

        // Execute
        $subFiles = $folder->files();
        $paths = $subFiles->map->relativePath();

        // Check
        $this->assertCount(2, $subFiles);
        $this->assertTrue($subFiles->every(fn($folder) => $folder instanceof File));
        $this->assertContains($folder->relativePath() . DIRECTORY_SEPARATOR . 'file1.txt', $paths);
        $this->assertContains($folder->relativePath() . DIRECTORY_SEPARATOR . 'file2.md', $paths);
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
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();

        // Execute & Check
        $this->assertSame('base-folder1', $folder->name());
    }

    /** @test */
    function gives_you_an_array_of_files_and_folders_in_it()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();

        // Execute
        $folderContents = $folder->toArray();

        // Check
        $this->assertContains('base-folder1' . DIRECTORY_SEPARATOR . 'sub-folder2', $folderContents);
        $this->assertContains('base-folder1' . DIRECTORY_SEPARATOR . 'file1.txt', $folderContents);
    }

    /** @test */
    function allows_you_to_get_the_relative_path_via_array_access()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first()->folders()->first();

        // Execute & Check
        $this->assertSame('base-folder1' . DIRECTORY_SEPARATOR . 'sub-folder1', $folder['relativePath']);
    }

    /** @test */
    function allows_you_to_set_the_relative_path_via_array_access()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();

        // Pre-check
        $this->assertSame('base-folder1', $folder['relativePath']);

        // Execute
        $folder['relativePath'] = 'base-folder2';

        // Check
        $this->assertSame('base-folder2', $folder['relativePath']);
    }

    /** @test */
    function allows_you_to_search_by_name_when_in_a_collection()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();
        $pathToSearchFor = 'base-folder1' . DIRECTORY_SEPARATOR . 'sub-folder2';

        // Execute
        $foundFolder = $folder->folders()->firstWhere('relativePath', $pathToSearchFor);

        // Check
        $this->assertSame($pathToSearchFor, $foundFolder->relativePath());
    }
}
