<?php

namespace Weblid\Massdbinterface\Facades;

use Illuminate\Support\Facades\Facade;

class Massdbimport extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Weblid\Massdbinterface\Massdbinterface';
    }
}