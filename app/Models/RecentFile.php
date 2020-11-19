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
     * Record the given file as a recent file.
     *
     * @param File $file
     * @return File
     */
    public static function record(File $file): File
    {
        /** @var RecentFile $recentRecord */
        $recentRecord = self::mostRecent()->whereFile($file)->first();

        if ($recentRecord) {
            $recentRecord->touch();
        } else {
            self::create(['path' => $file->relativePath(), 'disk' => $file->disk()]);
        }

        return $file;
    }

    /**
     * Filter down to the most recent files.
     *
     * @param Builder $query
     * @param int $take
     */
    public function scopeMostRecent(Builder $query, int $take = 15)
    {
        $query->reorder()->latest('updated_at')->skip(0)->take($take);
    }

    /**
     * Filter down to records for the given file.
     *
     * @param Builder $query
     * @param File $file
     */
    public function scopeWhereFile(Builder $query, File $file)
    {
        $query->where('path', $file->relativePath())
            ->where('disk', $file->disk());
    }

    /**
     * Get the file that was accessed.
     *
     * @return File|null
     */
    public function getFile(): ?File
    {
        return File::find($this->path, $this->disk);
    }
}
