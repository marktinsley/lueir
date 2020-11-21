<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\File;
use App\Lib\Files\FileFaker;
use Tests\TestCase;

class TypeCheckerTest extends TestCase
{
    /** @test */
    function tells_you_if_the_file_is_a_text_file()
    {
        // Arrange
        /** @var File $textFile */
        $textFile = FileFaker::fake()->scaffold()->folders()->first()->files()->first();

        // Execute & Check
        $this->assertTrue($textFile->typeChecker()->isText());
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
        $this->assertTrue($mdFile->typeChecker()->isMarkdown());
        $this->assertFalse($textFile->typeChecker()->isMarkdown());
    }
}
