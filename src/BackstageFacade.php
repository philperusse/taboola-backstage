<?php

namespace Taboola\Backstage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Taboola\Backstage\Backstage
 */
class BackstageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Backstage::class;
    }
}
