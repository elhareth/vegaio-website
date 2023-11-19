<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class ServicesRepository extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'service:repo.services';
    }
}
