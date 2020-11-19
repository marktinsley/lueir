<?php

namespace Tests\Unit\Components\Files;

use App\Http\Livewire\Files\FileView;
use App\Lib\Files\FileFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Livewire\Livewire;
use Tests\TestCase;

class FileViewTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function gives_listing_of_contents_for_folder_structures()
    {
        // Arrange
        FileFaker::fake()->scaffold();

        // Execute & Check
        Livewire::test(FileView::class, ['path' => 'base-folder1'])
            ->assertSee('sub-folder1')
            ->assertSee('sub-folder2')
            ->assertSee('file1.txt')
            ->assertSee('file2.md');
    }

    /** @test */
    function lists_folders_in_root_dir_by_default()
    {
        // Arrange
        FileFaker::fake()->scaffold();

        // Execute & Check
        Livewire::test(FileView::class)
            ->assertSee('base-folder1')
            ->assertSee('base-folder2');
    }

    /** @test */
    function allows_you_to_edit_text_files()
    {
        // Arrange
        FileFaker::fake()->scaffold();

        // Execute & Check
        Livewire::test(FileView::class, ['path' => 'base-folder1/file2.md'])
            ->assertSee('file2 contents');
    }

    /** @test */
    function viewed_files_are_recorded_as_recently_viewed()
    {
        // Arrange
        $file = FileFaker::fake()->file('file.md');

        // Pre-check
        $this->assertDatabaseMissing('recent_files', ['path' => $file->relativePath()]);

        // Execute
        Livewire::test(FileView::class, ['path' => $file->relativePath()]);

        // Check
        $this->assertDatabaseHas('recent_files', ['path' => $file->relativePath()]);
    }
}
