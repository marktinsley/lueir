<?php

namespace App\Models;

use App\Lib\Files\BaseFile;
use App\Lib\Files\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Get the name of the "updated at" column.
     *
     * @return string|null
     */
    public function getUpdatedAtColumn()
    {
        return null;
    }

    /**
     * Add the given file as a favorite file.
     *
     * @param BaseFile $file
     * @return BaseFile
     */
    public static function add(BaseFile $file): BaseFile
    {
        if (!self::isFavorite($file)) {
            self::create(['path' => $file->relativePath(), 'disk' => $file->disk()]);
        }

        return $file;
    }

    /**
     * Remove the given file from favorites.
     *
     * @param BaseFile $file
     * @return BaseFile
     */
    public static function remove(BaseFile $file): BaseFile
    {
        self::query()
            ->where('path', $file->relativePath())
            ->where('disk', $file->disk())
            ->delete();

        return $file;
    }

    /**
     * Find a favorite record for the given file.
     *
     * @param BaseFile $file
     * @return bool
     */
    public static function isFavorite(BaseFile $file): bool
    {
        return self::query()
            ->where('path', $file->relativePath())
            ->where('disk', $file->disk())
            ->exists();
    }

    /**
     * Get the favorite file.
     *
     * @return BaseFile|null
     */
    public function getFile(): ?BaseFile
    {
        return BaseFile::find($this->path, $this->disk);
    }
}
