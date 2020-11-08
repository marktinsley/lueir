<?php

namespace Tests\Unit\Components\Files;

use App\Http\Livewire\Files\FolderContents;
use App\Lib\Files\Folder;
use Livewire\Livewire;
use Tests\TestCase;

class FolderContentsTest extends TestCase
{
    /** @test */
    function lists_files_and_folders_in_a_directory()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute & Check
        Livewire::test(FolderContents::class, ['path' => 'base-folder1'])
            ->assertSee('sub-folder1')
            ->assertSee('sub-folder2')
            ->assertSee('file1.txt')
            ->assertSee('file2.md');
    }

    /** @test */
    function lists_folders_in_root_dir_by_default()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute & Check
        Livewire::test(FolderContents::class)
            ->assertSee('base-folder1')
            ->assertSee('base-folder2');
    }
}
