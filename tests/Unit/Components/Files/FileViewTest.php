<?php

namespace Tests\Unit\Components\Files;

use App\Http\Livewire\Files\FileView;
use App\Lib\Files\Folder;
use Livewire\Livewire;
use Tests\TestCase;

class FileViewTest extends TestCase
{
    /** @test */
    function gives_listing_of_contents_for_folder_structures()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute & Check
        Livewire::test(FileView::class, ['path' => 'base-folder1'])
            ->assertSee('sub-folder1')
            ->assertSee('sub-folder2')
            ->assertSee('file1.txt')
            ->assertSee('file2.md');
    }

    /** @test */
    function allows_you_to_edit_text_files()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute & Check
        Livewire::test(FileView::class, ['path' => 'base-folder1/file2.md'])
            ->assertSee('file2 contents');
    }
}
