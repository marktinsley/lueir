<?php

namespace Tests\Unit\Components\Files;

use App\Http\Livewire\Files\FolderIndex;
use App\Lib\Files\FakeFolder;
use App\Lib\Files\Folder;
use Livewire\Livewire;
use Tests\TestCase;

class FolderIndexTest extends TestCase
{
    /** @test */
    function lists_files_and_folders_in_a_directory()
    {
        // Arrange
        Folder::fakeScaffold();

        // Execute & Check
        Livewire::test(FolderIndex::class, ['path' => 'base-folder1'])
            ->assertSee('sub-folder1')
            ->assertSee('sub-folder2')
            ->assertSee('file1.txt')
            ->assertSee('file2.md');
    }
}
