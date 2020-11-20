<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\File;
use App\Lib\Files\FileFaker;
use App\Lib\Files\Folder;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileExistsException;
use Tests\TestCase;

class FileTest extends TestCase
{
    /** @test */
    function gives_you_the_name_of_a_file()
    {
        // Arrange
        /** @var File $file */
        $file = FileFaker::fake()->scaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertSame('file1.txt', $file->name());
    }

    /** @test */
    function gives_you_the_relative_path_to_the_file()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = FileFaker::fake()->scaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertSame('base-folder1' . DIRECTORY_SEPARATOR . 'file1.txt', $folder->relativePath());
    }

    /** @test */
    function gives_you_the_absolute_path_to_the_file()
    {
        // Arrange
        /** @var File $file */
        $file = FileFaker::fake()->scaffold()->folders()->first()->files()->first();

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

    /** @test */
    function tells_you_if_the_file_is_a_text_file()
    {
        // Arrange
        /** @var File $textFile */
        $textFile = FileFaker::fake()->scaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertTrue($textFile->isText());
    }

    /** @test */
    function tells_you_if_the_file_is_a_markdown_file()
    {
        // Arrange
        $rootFolder = FileFaker::fake()->scaffold();
        /** @var File $mdFile */
        $mdFile = $rootFolder->files()->first();
        /** @var File $textFile */
        $textFile = $rootFolder->folders()->first()->files()->first();

        // Execute & Check
        $this->assertTrue($mdFile->isMarkdown());
        $this->assertFalse($textFile->isMarkdown());
    }

    /** @test */
    function allows_you_to_search_by_name_when_in_a_collection()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = FileFaker::fake()->scaffold()->folders()->first();
        $pathToSearchFor = 'base-folder1' . DIRECTORY_SEPARATOR . 'file1.txt';

        // Execute
        $foundFolder = $folder->files()->firstWhere('relativePath', $pathToSearchFor);

        // Check
        $this->assertSame($pathToSearchFor, $foundFolder->relativePath());
    }

    /** @test */
    function gives_you_the_folder_its_contained_in()
    {
        // Arrange
        $rootFolder = FileFaker::fake()->scaffold();
        /** @var File $file */
        $file = $rootFolder->folders()->first()->files()->first();
        /** @var File $baseFile */
        $baseFile = $rootFolder->files()->first();

        // Execute
        $folder = $file->folder();
        $baseFolder = $baseFile->folder();

        // Check
        $this->assertInstanceOf(Folder::class, $folder);
        $this->assertEquals('base-folder1', $folder->relativePath());
        $this->assertInstanceOf(Folder::class, $baseFolder);
        $this->assertEquals('', $baseFolder->relativePath());
    }

    /** @test */
    function allows_you_to_change_the_content_of_text_files()
    {
        // Arrange
        /** @var File $file */
        $file = FileFaker::fake()->scaffold()->files()->first();
        $originalContents = $file->contents();
        $newContents = $originalContents . "\nTesting 123";

        // Execute
        $file->save($newContents);

        // Check
        $this->assertSame($newContents, $file->contents());
    }

    /** @test */
    function creates_new_files()
    {
        // Arrange
        Storage::fake();
        $filename = 'test.md';

        // Pre-check
        $this->assertNull(Folder::find($filename));

        // Execute
        File::create($filename);

        // Check
        $this->assertInstanceOf(File::class, Folder::find($filename));
    }

    /** @test */
    function renames_files()
    {
        // Arrange
        $file = FileFaker::fake()->file('my/new/file.txt');

        // Execute
        $renamedFile = $file->rename('renamed-file.txt');

        // Check
        $this->assertEquals('my/new/renamed-file.txt', $renamedFile->relativePath());
        $this->assertNull(File::find('my/new/file.txt'));
        $this->assertInstanceOf(File::class, File::find($renamedFile->relativePath()));
    }

    /** @test */
    function moves_files()
    {
        // Arrange
        $file = FileFaker::fake()->file('my/new/file.txt');

        // Execute
        $movedFile = $file->move('new/place');

        // Check
        $this->assertEquals('new/place/file.txt', $movedFile->relativePath());
        $this->assertNull(File::find('my/new/file.txt'));
        $this->assertInstanceOf(File::class, File::find($movedFile->relativePath()));
    }

    /** @test */
    function prevents_moving_a_file_on_top_of_another()
    {
        // Arrange
        /**
         * @var File $file1
         * @var File $file2
         */
        [$file1, $file2] = FileFaker::fake()->files(['orange/file1.txt', 'blue/file1.txt'])->toArray();

        // Execute
        $this->expectException(FileExistsException::class);
        $file1->move($file2->folder()->relativePath());
    }
}
