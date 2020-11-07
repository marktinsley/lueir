<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Tests\TestCase;

class FileTest extends TestCase
{
    /** @test */
    function gives_you_the_name_of_a_file()
    {
        // Arrange
        /** @var File $file */
        $file = BaseFile::fakeScaffold()->first()->files()->first();

        // Execute & Check
        $this->assertSame('file1.txt', $file->name());
    }

    /** @test */
    function gives_you_the_relative_path_to_the_file()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->first()->files()->first();

        // Execute & Check
        $this->assertSame('base-folder1' . DIRECTORY_SEPARATOR . 'file1.txt', $folder->relativePath());
    }

    /** @test */
    function gives_you_the_absolute_path_to_the_file()
    {
        // Arrange
        /** @var File $file */
        $file = BaseFile::fakeScaffold()->first()->files()->first();

        // Execute & Check
        $this->assertSame(
            storage_path(join(DIRECTORY_SEPARATOR, [
                'framework/testing/disks/local',
                'base-folder1',
                'file1.txt',
            ])),
            $file->absolutePath()
        );
    }
}
