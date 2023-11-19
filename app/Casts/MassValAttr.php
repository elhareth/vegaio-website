<?php

namespace App\Casts;

use Illuminate\Support\Enumerable;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Log;

class MassValAttr implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $serializedStarts = [
            'a:',
            'b:',
            'd:',
            'i:',
            's:',
            'o:',
            'O:',
            'N;',
        ];


        if (str($value)->startsWith($serializedStarts)) {
            // Suppose serialized, Try unserialize
            try {
                $value = unserialize($value);
                if (is_array($value)) {
                    return collect($value);
                }
            } catch (\Exception $e) {
                // Log::error($e->getMessage());
            }
        }

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof Enumerable) {
            return serialize($value->all());
        } elseif (is_object($value) || is_array($value)) {
            return serialize($value);
        } else {
            return $value;
        }
    }
}
