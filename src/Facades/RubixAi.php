<?php

namespace Torian257x\RubixAi\Facades;

use Illuminate\Support\Facades\Facade;

class RubixAi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'rubixai';
    }
}
