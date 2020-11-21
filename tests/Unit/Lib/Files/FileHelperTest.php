<?php

namespace Tests\Unit\Lib\Files;

use App\Lib\Files\FileHelper;
use PHPUnit\Framework\TestCase;

class FileHelperTest extends TestCase
{
    /**
     * @dataProvider makes_file_paths_readable_provider
     * @param $path
     * @param $expectedPath
     * @test
     */
    function makes_file_paths_readable($path, $expectedPath)
    {
        $this->assertSame($expectedPath, FileHelper::readablePath($path)->__toString());
    }

    public function makes_file_paths_readable_provider()
    {
        yield ['/path/to/file.txt', '/ path / to / file.txt'];
        yield ['path/to/folder', 'path / to / folder'];
        yield ['', ''];
        yield [null, ''];
    }
}
