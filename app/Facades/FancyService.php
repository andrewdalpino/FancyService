<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FancyService extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fancy_service_client';
    }
}