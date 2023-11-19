<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Filesystem\Filesystem;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Plank\Mediable\Helpers\File;
use Plank\Mediable\Exceptions\MediaMoveException;
use Plank\Mediable\Exceptions\MediaUrlException;
use Plank\Mediable\UrlGenerators\TemporaryUrlGeneratorInterface;
use Plank\Mediable\UrlGenerators\UrlGeneratorInterface;

use Plank\Mediable\MediaMover;
use Plank\Mediable\Media as Model;

/**
 * Media Model.
 * @property int|string|null $id
 * @property string|null $disk
 * @property string|null $directory
 * @property string|null $filename
 * @property string|null $extension
 * @property string|null $basename
 * @property string|null $mime_type
 * @property string|null $aggregate_type
 * @property string|null $variant_name
 * @property int|string|null $original_media_id
 * @property int|null $size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Pivot $pivot
 * @property Collection|Media[] $variants
 * @property Media $originalMedia
 * @method static Builder inDirectory(string $disk, string $directory, bool $recursive = false)
 * @method static Builder inOrUnderDirectory(string $disk, string $directory)
 * @method static Builder whereBasename(string $basename)
 * @method static Builder forPathOnDisk(string $disk, string $path)
 * @method static Builder unordered()
 * @method static Builder whereIsOriginal()
 * @method static Builder whereIsVariant(string $variant_name = null)
 */
class Media extends Model
{
    /**
     * Get filesize labelled
     *
     * @return string
     */
    public function getFileSize()
    {
        return labelFileSize($this->size);
    }
}
