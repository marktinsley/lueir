<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use App\Lib\Files\Folder;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileTest extends TestCase
{
    /** @test */
    function gives_you_the_name_of_a_file()
    {
        // Arrange
        /** @var File $file */
        $file = BaseFile::fakeScaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertSame('file1.txt', $file->name());
    }

    /** @test */
    function gives_you_the_relative_path_to_the_file()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertSame('base-folder1' . DIRECTORY_SEPARATOR . 'file1.txt', $folder->relativePath());
    }

    /** @test */
    function gives_you_the_absolute_path_to_the_file()
    {
        // Arrange
        /** @var File $file */
        $file = BaseFile::fakeScaffold()->folders()->first()->files()->first();

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
        $textFile = BaseFile::fakeScaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertTrue($textFile->isText());
    }

    /** @test */
    function tells_you_if_the_file_is_a_markdown_file()
    {
        // Arrange
        /** @var File $mdFile */
        $mdFile = BaseFile::fakeScaffold()->files()->first();
        /** @var File $textFile */
        $textFile = BaseFile::fakeScaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertTrue($mdFile->isMarkdown());
        $this->assertFalse($textFile->isMarkdown());
    }

    /** @test */
    function allows_you_to_search_by_name_when_in_a_collection()
    {
        // Arrange
        /** @var Folder $folder */
        $folder = BaseFile::fakeScaffold()->folders()->first();
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
        /** @var File $file */
        $file = BaseFile::fakeScaffold()->folders()->first()->files()->first();
        /** @var File $baseFile */
        $baseFile = BaseFile::fakeScaffold()->files()->first();

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
        $file = BaseFile::fakeScaffold()->files()->first();
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
        $this->assertNull(BaseFile::find('test.md'));

        // Execute
        File::create($filename);

        // Check
        $this->assertInstanceOf(File::class, BaseFile::find('test.md'));
    }
}
