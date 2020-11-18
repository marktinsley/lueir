<?php

namespace App\Models;

use App\Lib\Files\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentFile extends Model
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
     * Record the given file as a recent file.
     *
     * @param File $file
     * @return File
     */
    public static function record(File $file): File
    {
        /** @var RecentFile $recentRecord */
        $recentRecord = self::mostRecent()->where('path', $file->relativePath())->first();

        if ($recentRecord) {
            $recentRecord->touch();
        } else {
            self::create(['path' => $file->relativePath()]);
        }

        return $file;
    }

    /**
     * Filter down to the most recent files.
     *
     * @param Builder $query
     */
    public function scopeMostRecent(Builder $query)
    {
        $query->reorder()->latest()->take(15);
    }

    /**
     * Get the file that was accessed.
     *
     * @return File|null
     */
    public function getFile(): ?File
    {
        return File::find($this->path);
    }
}
