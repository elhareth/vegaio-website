<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class MediaFileSize implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $size = null;

        $BY = (int) $value;
        $KB = $BY / 1024;
        $MB = $KB / 1024;
        $GB = $MB / 1024;

        if ($GB >= 1) {
            $size = round($GB, 2) . ' GB';
        } elseif ($MB >= 1) {
            $size = round($MB, 2) . ' MB';
        } elseif ($KB >= 1) {
            $size = round($KB, 2) . ' KB';
        } else {
            $size = round($BY, 2) . ' Bytes';
        }

        return $size;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
