<?php

namespace Tests\Unit\Models;

use App\Lib\Files\FileFaker;
use App\Models\RecentFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RecentFileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function records_a_file_as_a_recent_file()
    {
        // Arrange
        $file = FileFaker::fake()->file('path/to/my/file.txt');

        // Pre-check
        $this->assertDatabaseMissing('recent_files', ['path' => $file->relativePath()]);

        // Execute
        RecentFile::record($file);

        // Check
        $this->assertDatabaseHas('recent_files', ['path' => $file->relativePath()]);
    }

    /** @test */
    function accessing_a_previously_access_file_bumps_it_to_the_top()
    {
        // Arrange
        $files = FileFaker::fake()->files([
            'path/to/my/file1.txt',
            'path/to/my/file2.txt',
        ]);
        RecentFile::record($files->get(0));
        $this->travel(10)->minutes();
        RecentFile::record($files->get(1));
        $this->travel(10)->minutes();

        // Pre-check
        $this->assertEquals($files->get(1)->relativePath(), RecentFile::mostRecent(1)->first()->path);

        // Execute
        RecentFile::record($files->get(0));

        // Check
        $this->assertEquals($files->get(0)->relativePath(), RecentFile::mostRecent(1)->first()->path);
    }
}
