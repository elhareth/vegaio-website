<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see /app/Services/SiteOptions
 *
 * @method get(string $name, $default = null)
 */
class SiteOptions extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'service:site.options';
    }
}
