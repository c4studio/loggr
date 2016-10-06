<?php

namespace C4studio\Loggr\Facades;

use Illuminate\Support\Facades\Facade;

class Loggr extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return 'loggr';
    }
}